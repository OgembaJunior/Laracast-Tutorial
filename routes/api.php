<?php

use App\Http\Controllers\APIS\AuthControllerApi;
use App\Http\Controllers\APIS\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/unauthorized', function(){
    return [
        "message"=>"unauthorized"
    ];

})->name('unauthorized');


// Authentication
Route::controller(AuthControllerApi::class)->group(function(){
    Route::post('/register', 'register')->name('register');
    Route::post('/login',  'login')->name('login');
    
});



Route::controller(PostControllerApi::class)->group(function(){
    
    Route::get('/posts',  'posts');
    Route::get('/post/{post}',  'post');
    Route::get('/category/{category:name}',  'category');
    Route::get('/tag/{tag:name}',  'tag');
    Route::get('/categories',  'categories');
    Route::get('/tags',  'tags');
    Route::get('/author/{user:name}',  'user');
    Route::post('/create-post',  'post_creation');

});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
