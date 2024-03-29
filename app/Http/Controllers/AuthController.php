<?php

namespace App\Http\Controllers;

use App\Events\EmailVerify as EventsEmailVerify;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function login()
    {
        return view('Public.login');
    }

    public function attemptLogin()
    {
        $formData = request()->validate([
            'email' => 'required|exists:users,email|email',
            'password' => "required|min:8|max:30"
        ]);

        if (!User::where('email', $formData['email'])->first()->email_verified_at) return back()->withErrors([
            'email' => 'Your email is not verified yet!'
        ]);

        if (auth()->attempt($formData))
            return redirect()->route('home')->with('success', "Successfully Login.Welcome Back 👋");

        return back()->withErrors([
            'password' => 'Your email or password is incorrect!'
        ]);
    }

    public function register()
    {
        return view('Public.register');
    }

    public function attemptRegister()
    {
        $formData = request()->validate([
            'name' => 'required|min:3|max:30',
            'email' => "required|email|unique:users,email",
            'password' => [
                'required',
                "confirmed",
                Password::min(8)
                // ->letters()->mixedCase()->numbers()->symbols()
            ],
            'date_of_birth' => 'required|date|before:today',
        ]);

        $formData['username'] = $formData['name'];
        $formData['password'] = Hash::make($formData['password']);
        $formData['profile'] = 'default_pp.png';

        $user = User::create($formData);

        //follow admin
        Follower::create([
            'user_id' => 1,
            'follower_id' => $user->id
        ]);

        //alread put this code to event
        // Cache::put('email_verify_token_' . $user->id, $user->username . Str::random(100), now()->addMinutes(10));
        // Mail::to($user->email)->send(new EmailVerify($user, Cache::get('email_verify_token_' . $user->id)));

        //verify mail send event
        EventsEmailVerify::dispatch($user);

        return redirect()->route('login')->with('success', 'Successfully registered.You can now login.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('info', "Successfully Logout! See ya.");
    }

    public function verifyEmail(User $user, $token)
    {
        if (Cache::get('email_verify_token_' . $user->id) === $token) {
            $user->email_verified_at = now();
            $user->update();

            if (!auth()->check())
                auth()->login($user);

            Cache::forget('email_verify_token_' . $user->id);
            return redirect()->route('home');
        }
        return abort(403, 'Invalid or Expired verification');
    }
}
