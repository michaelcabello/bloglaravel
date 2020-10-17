<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', 'PagesController@home');

Route::get('admin/posts', 'Admin\PostsController@index');

Route::get('/', function () {
    $posts = App\Post::latest('published_at')->get();
    return view('welcome',compact('posts'));
});

Route::get('posts', function () {
    return App\Post::all();
});



Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=>'auth'],
    function(){
        Route::get('/', 'AdminController@index');
        Route::get('posts', 'PostsController@index')->name('admin.posts.index');
        Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
        Route::post('posts', 'PostsController@store')->name('admin.posts.store');

    }
);
//Auth::routes();
//esta en el archivo Auth.php, alli esta el metodo routes
//luego ir al archivo AuthRoutheMethods.php
//C:\laragon\www\blogmichael\vendor\laravel\ui\src\AuthRouteMethods.php:

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');



    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');




//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('home', function () {
//    return view('admin.dashboard');
//})->middleware('auth');


