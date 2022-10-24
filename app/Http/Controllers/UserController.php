<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function follow()
    {
        //check duplicate data
        if (Follower::where('user_id', request('user_id'))->where('follower_id', Auth::id())->exists()) {
            return back();
        }

        request()->validate([
            'user_id' => "exists:users,id"
        ]);

        Follower::create([
            'user_id' => request('user_id'),
            'follower_id' => Auth::id()
        ]);

        return back();
    }
}
