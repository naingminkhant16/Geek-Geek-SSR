<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate(['body' => 'required']);
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => request('body')
        ]);
        return back();
    }
}
