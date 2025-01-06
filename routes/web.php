<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;



Auth::routes();

Route::group(["middleware"=>"auth"],function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    /**
     * Route use to open the create post page(create.blade.php)
     * */
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/{id}/post/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/{id}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/{id}/update',[PostController::class,'update'])->name('post.update');
    Route::delete('/{id}/destroy',[PostController::class,'destroy'])->name('post.destroy');

    Route::group(["prefix"=>"comment", "as"=>"comment."], function()
    {
        Route::post('/store/{post_id}',[CommentController::class,'store'])->name('store');
        Route::delete('/delete/{comment_id}',[CommentController::class,'destroy'])->name('delete');
    });

    Route::group(["prefix"=>"profile", "as"=>"profile."], function()
    {
        Route::get('/show/{id}/profile', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update/profile', [ProfileController::class, 'update'])->name('update'); 

        Route::get('/user/{id}/following', [ProfileController::class, 'following'])->name('following');
        Route::get('/user/{id}/follower', [ProfileController::class, 'follower'])->name('follower');

    });

    Route::group(["prefix"=>"like", "as"=>"like."], function()
    {
        Route::post('/store/{post_id}',[LikeController::class,'store'])->name('store');
        Route::delete('/delete/{post_id}',[LikeController::class,'destroy'])->name('delete');
    });

    Route::group(["prefix"=>"like", "as"=>"like."], function()
    {
        Route::post('/store/{post_id}',[LikeController::class,'store'])->name('store');
        Route::delete('/delete/{post_id}',[LikeController::class,'destroy'])->name('delete');
    });

    Route::group(["prefix"=>"follow", "as"=>"follow."], function()
    {
        Route::post('/store/{following_id}',[FollowController::class,'store'])->name('store');
        Route::delete('/delete/{following_id}',[FollowController::class,'destroy'])->name('delete');
    });

    Route::group(["prefix"=>"admin", "as"=>"admin."], function()
    {   Route::get('/users',[UsersController::class,'index'])->name('users.index');
        Route::delete('/user/{id}/deactivate',[UsersController::class,'deactivate'])->name('users.deactivate');
        Route::patch('/user/{id}/activate',[UsersController::class,'activate'])->name('users.activate');

        Route::get('/posts', [PostsController::class, 'index'])->name('posts');
       Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide');
       Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide');

        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
        Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    });

    

    

});
