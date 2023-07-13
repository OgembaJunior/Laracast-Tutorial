<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function(){
    Route::get('/sign-in', 'login')->name('login');
    Route::get('/sign-up', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');

});


Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('posts');
    Route::get('/post/{post:slug}/', 'show')->name('post');
    Route::get('/user/{user:name}/', 'author')->name('author');
    Route::get('/category/{category:name}/', 'category')->name('category');

    Route::post('/create_post', 'create_post')->name('create_post');


});
