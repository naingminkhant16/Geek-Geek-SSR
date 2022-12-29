<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::when(request('search'), function ($query, $search) {
            $query->where('status', "LIKE", "%$search%")
                //get posts by user's name
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                });
        })
            ->latest()
            ->with(['user', 'comments.user', 'likes', 'photos'])
            ->paginate(6);

        // $deletedPosts = Post::when(request('search'), function ($query, $search) {
        //     $query->where('status', "LIKE", "%$search%")
        //         //get posts by user's name
        //         ->orWhereHas('user', function ($query) use ($search) {
        //             $query->where('name', 'LIKE', "%$search%");
        //         });
        // })->with(['user', 'comments.user', 'likes', 'photos'])
        //     ->onlyTrashed()->latest()
        //     ->paginate(6);


        return view('Admin.Post.index', [
            'posts' => $posts
        ]);
    }

    public function deletedPosts()
    {
        $deletedPosts = Post::when(request('search'), function ($query, $search) {
            $query->where('status', "LIKE", "%$search%")
                //get posts by user's name
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                });
        })->with(['user', 'comments.user', 'likes', 'photos'])
            ->onlyTrashed()->latest()
            ->paginate(6);

        return view('Admin.Post.deletedPosts', [
            'deletedPosts' => $deletedPosts
        ]);
    }

    public function softDelete(Post $post)
    {
        $post->delete();
        return back()->with('warning', "Post is temporarily deleted");
    }

    public function destroy($id)
    {
        $post =  Post::onlyTrashed()->findOrFail($id);

        //delete photos
        if (!empty($post->photos)) {
            foreach ($post->photos as $photo) {
                Storage::delete('public/' . $photo->name);
            }
            $post->photos()->delete();
        }

        //delete comments
        if (!empty($post->comments)) {
            $post->comments()->delete();
        }

        //delete likes
        if (!empty($post->likes)) {
            $post->likes()->delete();
        }

        $post->forceDelete();

        return back()->with('success', 'Your post is permanently deleted.');
    }
}
