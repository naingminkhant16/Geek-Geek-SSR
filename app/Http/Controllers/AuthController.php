<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if (auth()->attempt($formData)) {
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'password' => 'Your email or password is incorrect'
            ]);
        }
    }

    public function register()
    {
        return 'This is Register';
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
