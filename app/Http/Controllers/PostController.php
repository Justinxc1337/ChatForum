<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
    return view('post\show', compact('post'));
    }
    
    public function index()
    {
    $posts = Post::all();
    return view('posts.index', compact('posts'));
    }
    
    public function addComment(Request $request, Post $post)
    {
    $request->validate(['body' => 'required']);
    $post->comments()->create([
        'body' => $request->body,
        'user_id' => auth()->id() // get the ID of the currently authenticated user
    ]);
    return back();
    }
    
    /*public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get();
        return view('post.show', ['post' => $post, 'comments' => $comments]);
    }*/
    
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }
    
    public function updatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        
        $incomingFields = $request->validate([
            'title' => 'required|min:1|max:50',
            'body' => 'required|min:1|max:500'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required|min:1|max:50',
            'body' => 'required|min:1|max:500'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);


        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);

        return redirect('/');
    }
}
