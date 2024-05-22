<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $åpsts = [];
    if (auth()->check()) {
        $posts = auth()->user()->userPosts()->latest()->get();
    } else {
        $posts = Post::latest()->get();
    }
    // actually works even with userPosts as an error (reason unknown)
    //$posts = auth()->user()->userPosts()->latest()->get();
    //$posts = Post::where('user_id', auth()->id())->get();
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/mainforum', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});


// Forum posts routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
