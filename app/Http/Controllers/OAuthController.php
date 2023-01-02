<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class OAuthController extends Controller
{
    //Google OAuth
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        return $this->callback($googleUser);
    }

    //Github OAuth
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        return $this->callback($githubUser);
    }

    //callback function
    protected function callback($OAuthUser)
    {
        if (User::where('email', $OAuthUser->email)->exists()) {
            auth()->login(User::where('email', $OAuthUser->email)->first());
            return redirect()->route('home');
        };

        $user = User::create([
            'name' => $OAuthUser->name,
            'username' => $OAuthUser->name,
            'email' => $OAuthUser->email,
            'password' => Hash::make('password'),
            'profile' => 'default_pp.png'
        ]);

        //verify email cuz oauth user email dont need to verify by sending mail
        $user->email_verified_at = now();
        $user->save();

        Follower::create([
            'user_id' => 1,
            'follower_id' => $user->id
        ]);

        auth()->login($user);
        return redirect()->route('home')->with('success', "Successfully Login.Welcome Back 👋");
    }
}
