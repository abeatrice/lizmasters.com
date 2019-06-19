<?php

Route::get('/', 'WelcomeController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');
Route::post('/posts/{post}/order/{direction}', 'PostController@changeSortOrder');

Route::post('/contact-us', 'ContactUsController@store');