<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryContrroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\NeastedCommentController;
use App\Http\Controllers\CkeditorController;

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
    Route::get('/comment/status/{id}',[CommentController::class,'status'])->name('comment.status');
    Route::get('/comment/disable/{id}',[CommentController::class,'disable'])->name('comment.disable');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'storeReply'])->name('comments.storeReply');
    Route::get('/comments/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');

    //Replies
    Route::get('Replies',[ReplyController::class,'index'])->name('reply.index');
    Route::get('Replies/status/{id}',[ReplyController::class,'status'])->name('reply.status');
    Route::get('Replies/disable/{id}',[ReplyController::class,'disable'])->name('reply.disable');

    //Blog
    Route::get('Blog',[BlogController::class,'index'])->name('blog.index');
    Route::get('Blog/{id}',[BlogController::class,'show'])->name('blog.show');
    Route::post('blog/{id}/store',[BlogController::class,'store'])->name('comment.store');

    //soft delete data 
    Route::get('restore/post',[PostController::class,'softindex'])->name('soft.index');
    Route::get('restore/post/{id}',[PostController::class,'restore'])->name('post.restore');
    Route::get('post/restore',[PostController::class,'restore_all'])->name('post.restore.all');

    //soft delete comment
    Route::get('restore/comment',[CommentController::class,'softindex'])->name('soft.comment.index');
    Route::get('restore/comment/{id}',[CommentController::class,'restore'])->name('comment.restore');
    Route::get('comment/restore',[CommentController::class,'restore_all'])->name('comment.restore.all');

    //Neasted Comment
    Route::post('Neasted_comments',[NeastedCommentController::class,'store'])->name('neasted.store');

    //ckeditor add image

   // Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');
    Route::get('ckeditor', [CkeditorController::class, 'index']);
    Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');






    
});
 //Blog
 Route::get('Blog',[BlogController::class,'index'])->name('blog.index');
 Route::get('Blog/{id}',[BlogController::class,'show'])->name('blog.show');



