<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = $this->getDataCountByDate(new User, 'Users');

        $posts = $this->getDataCountByDate(new Post, 'Posts');

        $likes = $this->getDataCountByDate(new Like, 'Likes');

        $comments = $this->getDataCountByDate(new Comment, 'Comments');

        $data = [...$users, ...$posts, ...$likes, ...$comments];

        return  view('Admin.Dashboard.index', ['data' => $data]);
    }

    public function getDataCountByDate(Object $obj, String $label): array
    {
        return [
            $label => $obj->latest()
                ->limit(12) // last 12 months
                ->get()
                ->map(
                    fn ($item) =>  [
                        'date' => Carbon::parse($item->created_at)->format('F Y'),
                        'item' => $item
                    ]
                )
                ->groupBy('date')
                ->map(fn ($item) => $item->count())
        ];
    }
}
