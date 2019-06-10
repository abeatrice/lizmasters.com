<?php

Route::get('/', function () {
    $posts = App\Post::orderBy('sort_order', 'desc')->paginate();
    return view('welcome', compact('posts'));
});

Route::post('/email', function() {
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');
Route::post('/posts/{post}/order/{direction}', 'PostController@changeSortOrder');