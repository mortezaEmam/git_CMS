<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DragonCode\Support\Concerns\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SingleController extends Controller
{
    public function  index(Post $post)
    {
        $comments = $post->comments;
        return view('single', compact('post', 'comments'));
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $post->comments()
            ->create([
                'user_id' => Auth::id(),
                'body' =>$request->body,
            ]);
        return response()->json([
            'created' => true,
        ]);
    }

}
