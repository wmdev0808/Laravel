<?php

use App\Models\Category;
use App\Models\Post;
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
    // \Illuminate\Support\Facades\DB::listen(function ($query) {
    //     // \Illuminate\Support\Facades\Log::info('foo');
    //     logger($query->sql, $query->bindings);
    // });

    return view('posts', [
        'posts' => Post::with('category')->get()
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
