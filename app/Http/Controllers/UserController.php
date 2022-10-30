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
        request()->validate([
            'user_id' => "exists:users,id"
        ]);

        //check duplicate data
        if (Follower::where('user_id', request('user_id'))->where('follower_id', Auth::id())->exists()) {
            return back();
        }

        Follower::create([
            'user_id' => request('user_id'),
            'follower_id' => Auth::id()
        ]);

        return back();
    }

    public function unfollow()
    {
        request()->validate([
            'user_id' => "exists:users,id"
        ]);

        if (Follower::where('user_id', request('user_id'))->where('follower_id', Auth::id())->exists()) {
            $f = Follower::where('user_id', request('user_id'))->where('follower_id', Auth::id())->first();
            $f->delete();
            return back();
        } else {
            return back();
        }
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

    public function followers(User $user)
    {
        return view('Auth.Users.followers', ['people' => $user->followers]);
    }

    public function followings(User $user)
    {
        return view('Auth.Users.followings', ['people' => $user->followings]);
    }

    public function show(User $user)
    {
        return view('Auth.Users.show', ['user' => $user]);
    }
}
