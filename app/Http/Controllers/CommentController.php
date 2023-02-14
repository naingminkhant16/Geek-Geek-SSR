<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\GetComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate(['body' => 'required']);
        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => request('body')
        ]);

        //to notify Post owner
        if ($post->user->id !== $comment->user_id) {
            $post->user->notify(new GetComment($comment));
        }

        return redirect()->route('posts.show', $post->id);
    }
}
