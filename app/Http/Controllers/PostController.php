<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostPhoto;
use App\Models\ReportedPost;
use App\Models\User;
use App\Notifications\GetLike;
use App\Notifications\PostCreated;
use App\Notifications\PostReported;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //need to show other users' posts who user follow
        $followers_ids = Auth::user()->followings->map(function ($user) {
            return $user->id;
        });
        $followers_ids = [...$followers_ids, Auth::id()];

        $posts = Post::whereIn('user_id', $followers_ids)
            ->with(['user', 'comments.user', 'photos', 'likes'])
            ->latest()
            ->get();

        return view('Auth.Posts.index', [
            'posts' => $posts,
            'people' => User::whereNotIn('id', $followers_ids)
                ->limit(5)->inRandomOrder()->get(),
            'breadcrumb_links' => ['Posts' => route('posts.index')]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Auth.Posts.create', ['breadcrumb_links' => [
            'Posts' => route('posts.index'),
            'Create' => ''
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //create post
        $post = Post::create([
            'user_id' => Auth::id(),
            'status' => $request->status
        ]);

        //photos saving
        if ($request->photos) {
            $photos = [];
            foreach ($request->photos as  $photo) {
                //generate new name
                $newName = uniqid() . "_post_photo." . $photo->extension();
                //store to storage
                $photo->storeAs("public", $newName);
                //for multiple insertaion
                $photos[] = [
                    'post_id' => $post->id,
                    'name' => $newName
                ];
            }
            //multiple insertaion
            PostPhoto::insert($photos);
        }

        //to notify your followers
        Notification::send(Auth::user()->followers, new PostCreated($post));

        return redirect()->route('home')->with('success', 'Your Post is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('Auth.Posts.show', [
            'post' => $post->load(['comments.user', 'photos', 'likes']),
            'breadcrumb_links' => [
                'Posts' => route('posts.index'),
                Str::words($post->status, 5) => ''
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('Auth.Posts.edit', [
            'post' => $post,
            'breadcrumb_links' => [
                'Posts' => route('posts.index'),
                'Edit' => ''
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->status = $request->status;
        $post->update();

        //photos saving
        if ($request->photos) {
            $photos = [];
            foreach ($request->photos as  $photo) {
                //generate new name
                $newName = uniqid() . "_post_photo." . $photo->extension();
                //store to storage
                $photo->storeAs("public", $newName);
                //for multiple insertaion
                $photos[] = [
                    'post_id' => $post->id,
                    'name' => $newName
                ];
            }
            //multiple insertaion
            PostPhoto::insert($photos);
        }

        return redirect()->route('posts.show', $post->id)->with('success', 'Your post is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
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

        return redirect()->route('home')->with('success', 'Your post is successfully deleted.');
    }

    public function handleLikePost(Post $post)
    {
        $like =  Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
            $msg = "unlike";
        } else {
            $like = Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
            $msg = "like";

            //Notify post owner
            if ($post->user->id !== $like->user_id) {
                $post->user->notify(new GetLike($like));
            }
        }
        //response for fetch call from lilke post
        return response()->json(['msg' => $msg], 200);
    }

    //report post
    public function report()
    {
        request()->validate([
            'post_id' => "required|exists:posts,id",
            'message' => "required|max:800|min:3"
        ]);

        $reportedPost =  ReportedPost::create([
            "post_id" => request('post_id'),
            "reporter_id" => auth()->id(),
            "message" => request('message')
        ]);

        //notify admin
        Notification::send(
            User::where('is_admin', "1")->get(),
            new PostReported($reportedPost)
        );

        return back()->with('success', 'Successfully Reported');
    }
}
