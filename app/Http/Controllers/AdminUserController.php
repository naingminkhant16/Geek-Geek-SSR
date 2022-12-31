<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::when(request('search'), function ($query, $search) {
            $query->where('name', "LIKE", "%$search%")->orWhere('email', "LIKE", "%$search%");
        })
            ->latest()
            ->paginate(15);
        return view('Admin.User.index', ['users' => $users]);
    }

    public function changeRole(User $user)
    {
        if ($user->is_admin)
            $user->is_admin = '0';
        else
            $user->is_admin = '1';

        $user->update();

        // if ($status)
        return back()->with('success', "Role successfully Changed");
        // else
        // return back()->with('danger', "Fail to change role!!");
    }

    public function deletedUsers()
    {
        $users = User::when(request('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', "LIKE", "%$search%")->orWhere('email', "LIKE", "%$search%");
            });
        })
            ->onlyTrashed()
            ->latest()
            ->paginate(15);
        return view('Admin.User.deletedUsers', ['users' => $users]);
    }

    public function softDelete(User $user)
    {
        $user->posts()->delete(); //soft delete user related posts
        $status = $user->delete();

        if ($status)
            return back()->with('success', "User is temporarily deleted");
        else
            return abort(500);
    }

    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        $status = Post::where('user_id', $id)->restore();
        return back()->with('success', "Successfully restored!");
    }

    public function destroy($id)
    {
        //Delete followers
        Follower::where('user_id', $id)->orWhere('follower_id', $id)->delete();
        // //Delete comments
        Comment::where('user_id', $id)->delete();
        // //Delete likes
        Like::where('user_id', $id)->delete();

        //Delete Posts
        $posts = Post::where('user_id', $id)->withTrashed()->get();

        foreach ($posts as $post) {
            if (!empty($post->photos)) {
                foreach ($post->photos as $photo) {
                    Storage::delete('public/' . $photo->name);
                }
                $post->photos()->delete();
            }

            //delete post related comments
            if (!empty($post->comments)) {
                $post->comments()->delete();
            }

            //delete post related likes
            if (!empty($post->likes)) {
                $post->likes()->delete();
            }

            $post->forceDelete();
        }

        $user = User::onlyTrashed()->findOrFail($id);
        //delete profile
        if ($user->profile !== 'default_pp.png') {
            Storage::delete('public/' . $user->profile);
        }
        $status = $user->forceDelete();

        if ($status)
            return back()->with('success', "User is permanently deleted.");
        else
            return abort(500);
        // return $user;
    }
}
