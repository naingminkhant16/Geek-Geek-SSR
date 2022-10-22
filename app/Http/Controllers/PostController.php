<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostPhoto;
use Illuminate\Support\Facades\Auth;

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

        $posts = Post::whereIn('user_id', [...$followers_ids, Auth::id()])
            ->with(['user', 'comments.user', 'photos', 'likes'])
            ->latest()
            ->get();

        return view('Auth.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Auth.post-create');
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
            foreach ($request->photos as $key => $photo) {
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

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function handleLikePost(Post $post)
    {
        $like =  Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
        }
        return back();
    }
}
