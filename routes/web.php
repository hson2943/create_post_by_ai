<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\UrlController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', 'App\Http\Controllers\PostController@index')->name('home');  
    Route::get('/detail', 'App\Http\Controllers\PostController@detail');   
    Route::get('/history', 'App\Http\Controllers\PostController@history')->name('history');
    Route::get('/setting', [UrlController::class, 'setting'])->name('setting');
    Route::post('/setting', [UrlController::class, 'create']);

    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'create']);
    Route::get('/posts/delete/{id}', [PostController::class, 'delete']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('/posts/{id}', [PostController::class, 'update']);
 
    Route::post('/create-post', 'App\Http\Controllers\PostController@create_post');

    Route::get('/create-post-by-gpt', [StreamController::class, 'CreatePostByGPT']);
    Route::get('/sns/delete/{id}', [UrlController::class, 'deleteSns']);
    Route::post('/keyword', [PostController::class, 'create_keyword_by_gpt']);
});

require __DIR__.'/auth.php';

