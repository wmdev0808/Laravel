<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // You can pass a column to latest() like latest('published_at')
    return view('posts', [
        // 'posts' => Post::latest()->with('category', 'author')->get()
        // You can also use an array as the argument
        'posts' => Post::latest()->get()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()
    return view('post', [
        'post' => $post
    ]);
});

// Alternative way

// Route::get('posts/{post}', function (Post $post) {
//     return view('post', [
//         'post' => $post
//     ]);
// });

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts
    ]);
});
