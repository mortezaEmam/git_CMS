<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleController extends Controller
{
    public function  index(Post $post)
    {
        $comments = $post->comments;
        return view('single', compact('post', 'comments'));
    }

    public function comment(Request $request, Post $post)
    {
        $post->comments()
            ->create([
                'user_id' => Auth::id(),
                'body' =>$request->body,
            ]);
        return redirect(route('single',['post' =>$post->id]));
    }
}
