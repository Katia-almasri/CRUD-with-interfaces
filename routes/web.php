<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Post;
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

Route::get('/', function () {
    return view('components.index', ['post'=>Post::get()]);
});


// Route::resource('posts', PostController::class);
Route::resource('products', ProductController::class);
Route::post('products/search', [ProductController::class, 'search'])->name('products.search');
//the wanted routes are listed when (php artisan route:list)

//next simple curd using blade

//route grouping
// Route::controller(PostController::class)->group(function (){
//     Route::get('posts', 'index')->name('posts.index');
//     Route::get('posts/create', 'create')->name('posts.create');
//     Route::get('posts/{id}', 'show')->name('posts.show');
//     Route::delete('posts/{id}', 'destroy')->name('posts.destroy');
//     Route::get('posts/{id}/edit', 'edit');
   
//    Route::get('render-blade', 'renderBlade');
//    Route::get('/users/{user}/posts/{post}', 'getUsersPost')->scopeBindings();
//    Route::get('/use-apost/{post:user_id}', 'getAPost')->scopeBindings();
//    Route::get('/search/users/{user}/posts/{key}', 'search')->scopeBindings();
// });
