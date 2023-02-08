<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function request()
    {
        return view('Public.Password.forgot-password');
    }

    public function email()
    {
        request()->validate(['email' => "required|email|exists:users,email"]);

        $status = Password::sendResetLink(request()->only('email'));
        return $status === Password::RESET_LINK_SENT ?
            back()->with("success", __($status)) :
            back()->with('error', __($status));
    }

    public function reset($token)
    {
        return view('Public.Password.reset-password', ['token' => $token]);
    }

    public function update()
    {
        request()->validate([
            "token" => "required",
            "email" => "required|email|exists:users,email",
            "password" => "required|min:8|confirmed"
        ]);

        $status = Password::reset(
            request()->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ?
            redirect()->route('login')->with('success', __($status)) :
            back()->withErrors(['email' => [__($status)]]);
    }
}
