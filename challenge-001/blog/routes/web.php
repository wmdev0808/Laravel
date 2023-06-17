<?php

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
    // return view('welcome');
    // return 'Hello World';
    // return ['foo' => 'bar'];
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (!file_exists($path)) {
        // dd('file does not exist'); // Dump, Die
        // ddd('file does not exist'); // Dump, Die, Debug

        // abort(404);
        return redirect('/');
    }

    // $post = cache()->remember("posts.{$slug}", 5, function () use ($path) {
    //     var_dump('file_get_contents'); // Get value from cache for 5 seconds, once it times out, it will fetch from execute callback and return
    //     return file_get_contents($path);
    // });

    // $post = cache()->remember(
    //     "posts.{$slug}",
    //     5,
    //     fn () => file_get_contents($path)
    // );

    // $post = cache()->remember("posts.{$slug}", now()->addMinutes(20), function () use ($path) {
    //     return file_get_contents($path);
    // });

    $post = cache()->remember(
        "posts.{$slug}",
        now()->addMinutes(20),
        fn () => file_get_contents($path)
    );

    return view('post', [
        // 'post' => '<h1>Hello World</h1>' // $post
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+'); // Or whereAlpha, whereNumber, whereAlphaNumeric
