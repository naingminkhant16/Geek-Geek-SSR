<?php

namespace App\Http\Controllers;

use App\Models\PostPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostPhotoController extends Controller
{
    public function delete(PostPhoto $photo)
    {
        //can delete only your photos(admin also)
        if ($photo->post->user->id === Auth::id() || Auth::user()->is_admin) {
            Storage::delete('public/' . $photo->name); //delete photo from storage
            $photo->delete(); //delete db
            return back();
        }

        return abort(401);
    }
}
