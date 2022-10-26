<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
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

    public function peopleYouMayKnow()
    {
        $followers_ids = Auth::user()->followings->map(function ($user) {
            return $user->id;
        });
        $followers_ids = [...$followers_ids, Auth::id()];

        return view('Auth.Users.people-you-may-know', ['people' => User::whereNotIn('id', $followers_ids)
            ->latest()
            ->paginate(10)
            ->withQueryString()]);
    }
}
