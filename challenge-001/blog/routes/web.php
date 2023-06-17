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

    return view('post', [
        // 'post' => '<h1>Hello World</h1>' // $post
        'post' => file_get_contents($path)
    ]);
})->where('post', '[A-z_\-]+'); // Or whereAlpha, whereNumber, whereAlphaNumeric
