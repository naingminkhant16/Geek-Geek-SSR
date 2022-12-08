<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function follow()
    {
        request()->validate([
            'user_id' => "exists:users,id"
        ]);

        $user_id = request('user_id');
        //check duplicate data
        if (Follower::where('user_id', $user_id)->where('follower_id', Auth::id())->exists()) {
            return back();
        }

        Follower::create([
            'user_id' => $user_id,
            'follower_id' => Auth::id()
        ]);

        return back()->with('info', "Now u can see " . User::find($user_id)->name . "\' posts.");
    }

    public function unfollow()
    {
        request()->validate([
            'user_id' => "exists:users,id"
        ]);
        $user_id = request('user_id');

        if (Follower::where('user_id', $user_id)->where('follower_id', Auth::id())->exists()) {
            $f = Follower::where('user_id', $user_id)->where('follower_id', Auth::id())->first();
            $f->delete();
            return back()->with('info', "Unfollowed " . User::find($user_id)->name);
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

        return view('Auth.Users.people-you-may-know', [
            'people' => User::whereNotIn('id', $followers_ids)
                ->latest()
                ->paginate(10)
                ->withQueryString(),
            'breadcrumb_links' => [
                'People You May Know' => route('users.peopleYouMayKnow')
            ]
        ]);
    }

    public function followers(User $user)
    {
        return view('Auth.Users.followers', ['people' => $user->followers, 'user' => $user, 'breadcrumb_links' => [
            $user->name => route('users.show', $user->username),
            'Followers' => ''
        ]]);
    }

    public function followings(User $user)
    {
        return view('Auth.Users.followings', ['people' => $user->followings, 'user' => $user, 'breadcrumb_links' => [
            $user->name => route('users.show', $user->username),
            'Following' => ''
        ]]);
    }

    public function show(User $user)
    {
        return view('Auth.Users.show', [
            'user' => $user->load([
                'posts' => function ($query) {
                    $query->with(['comments.user', 'user', 'photos'])->latest();
                }
            ]),
            'breadcrumb_links' => [$user->name => '']
        ]);
    }

    public function search()
    {
        $posts = Post::where('status', 'like', "%" . request('search') . "%")
            ->latest()->with(['user', 'comments.user', 'likes', 'photos'])
            ->paginate(3)->withQueryString();

        $users = User::where('name', 'like', "%" . request('search') . "%")
            ->latest()
            ->get();

        return view('Auth.Users.search', ['posts' => $posts, 'users' => $users, 'bradcrumb_links' => ['Search' => '']]);
    }

    public function edit(User $user)
    {
        Gate::authorize('update-user', $user);
        return view('Auth.Users.edit', [
            'user' => $user,
            'breadcrumb_links' => [
                $user->name => route('users.show', $user->username),
                'Edit' => ''
            ]
        ]);
    }

    public function update(User $user)
    {
        Gate::authorize('update-user', $user);
        request()->validate([
            'name' => 'required|min:3|max:30',
            'bio' => 'nullable|min:3|max:100',
            'date_of_birth' => "nullable|date",
            'profile' => "nullable|file|mimes:png,jpg,jpeg|max:512",
        ]);

        $user = User::findOrFail($user->id);
        $user->name = request('name');
        $user->bio = request('bio');
        $user->date_of_birth = request('date_of_birth');

        if (request('profile')) {
            // delete old profile photo
            if ($user->profile !== 'default_pp.png') {
                Storage::delete('public/' . $user->profile);
            }

            $newName = uniqid() . "_profile_photo." . request('profile')->extension();
            request('profile')->storeAs('public', $newName);
            $user->profile = $newName;
        }

        $user->update();

        return redirect()->route('users.show', $user->username)
            ->with("success", "Your Profile is updated");
    }
}
