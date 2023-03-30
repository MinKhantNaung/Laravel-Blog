<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/', [ArticleController::class, 'index']);

Route::group(['prefix' => 'articles'], function() {
    // for main page
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    // for create page
    Route::get('/add', [ArticleController::class, 'add'])->name('articles.add');

    // for create articles
    Route::post('/add', [ArticleController::class, 'create'])->name('articles.create');

    // for detail page
    Route::get('/detail/{id}', [ArticleController::class, 'detail'])->name('articles.detail');

    // for edit page
    Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');

    // for update article
    Route::post('/edit/{id}', [ArticleController::class, 'update'])->name('articles.update');

    // for delete article
    Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
});

Route::group(['prefix' => 'comments'], function() {
    // for add comment
    Route::post('/add', [CommentController::class, 'create'])->name('comments.add');

    // for delete comment
    Route::get('/delete/{id}', [CommentController::class, 'delete'])->name('comments.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
