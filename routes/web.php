<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryContrroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Livewire\BlogComponent;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //Post
    Route::get('/post',[PostController::class,'index'])->name('post.index');
    Route::get('/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('/post/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/post/delete/{id}',[PostController::class,'delete'])->name('post.delete');

    //category

    Route::get('/category',[CategoryContrroller::class,'index'])->name('category.index');
    Route::get('/category/create',[CategoryContrroller::class,'create'])->name('category.create');
    Route::post('category/store',[CategoryContrroller::class,'store'])->name('category.store');
    Route::get('category/edit/{id}',[CategoryContrroller::class,'edit'])->name('category.edit');
    Route::post('category/update/{id}',[CategoryContrroller::class,'update'])->name('category.update');
    Route::get('category/delete/{id}',[CategoryContrroller::class,'delete'])->name('category.delete');

    //comment
    Route::get('/comment',[CommentController::class,'index'])->name('comment.index');

    //Blog
    Route::get('Blog',[BlogController::class,'index'])->name('blog.index');
    Route::get('Blog/{id}',[BlogController::class,'show'])->name('blog.show');
});
