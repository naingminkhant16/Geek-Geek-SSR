<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
            ->paginate(6)
            ->withQueryString();

        return view('Admin.Post.index', [
            'posts' => $posts
        ]);
    }
}
