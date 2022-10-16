<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

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

        if (auth()->attempt($formData)) return redirect()->route('home');

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
            'name' => 'required|min:3|max:20',
            'email' => "required|email|unique:users,email",
            'password' => [
                'required',
                "confirmed",
                Password::min(8)->letters()->mixedCase()->numbers()->symbols()
            ],
            'date_of_birth' => 'required|date|before:today',
        ]);

        $formData['username'] = uniqid($formData['name']);
        $formData['password'] = Hash::make($formData['password']);

        $user = User::create($formData);

        Cache::put('email_verify_token_' . $user->id, $user->username . Str::random(100), now()->addMinutes(10));

        Mail::to($user->email)->send(new EmailVerify($user, Cache::get('email_verify_token_' . $user->id)));

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function verifyEmail(User $user, $token)
    {
        if (Cache::get('email_verify_token_' . $user->id) === $token) {
            $user->email_verified_at = now();
            $user->save();

            if (!auth()->check())
                auth()->login($user);

            Cache::forget('email_verify_token_' . $user->id);
            return redirect()->route('home');
        }
        return abort(403, 'Invalid or Expired verification');
    }
}
