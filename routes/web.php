<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Retrieve all posts and return a view called 'posts'
    return view('posts', [
        'posts' => Post::all(),
    ]);
});

Route::get('post/{post}', function ($slug) {
    // Find the post with a given slug and return a view called 'post'
    return view('post', [
        'post' => Post::find($slug),
    ]);

    // Where the given slug can only contain letters and the symbols '-' and '_'
})->where('post', '[A-z_\-]+');
