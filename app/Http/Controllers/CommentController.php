<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
    $comments = Comment::all();
    return view('comments.index', compact('comments'));
    }

public function store(Request $request, Post $post)
    {
    $request->validate([
        'body' => 'required',
    ]);

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = auth()->id();
    $post->comments()->save($comment);

    return back();
    }
}
