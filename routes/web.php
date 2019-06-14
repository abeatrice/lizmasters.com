<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;

Route::get('/', function () {
    $posts = App\Post::where('published', true)->orderBy('sort_order', 'desc')->paginate();
    return view('welcome', compact('posts'));
});

Route::post('/email', function() {
    //validate request
    //send mail
    //return (new App\Mail\ContactUs())->render();
    Mail::to('abeatrice.mail@gmail.com')->send(new ContactUs());

    return back()->with('status', 'Message Delivered!');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');
Route::post('/posts/{post}/order/{direction}', 'PostController@changeSortOrder');