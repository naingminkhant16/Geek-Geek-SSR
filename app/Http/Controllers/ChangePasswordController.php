<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        return view('Auth.Users.Password.index', [
            'breadcrumb_links' => [
                $user->name => route('users.show', $user->username),
                'Change Password' => ''
            ]
        ]);
    }

    public function change(Request $request)
    {
        $request->validate([
            'current_password' => "required",
            'password' => "required|confirmed|min:8"
        ], [
            'password.required' => "The new password filed is required."
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => "The provided current password does not match our records."]);
        };

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.show', $user->username)
            ->with('success', 'Successfully changed password.');
    }
}
