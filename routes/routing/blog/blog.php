<?php

use Illuminate\Support\Facades\Route;

Route::resource('manage-blog', "\App\Http\Controllers\Backend\Blogs\BlogController");
Route::patch('/manage-blog/{id}/toggle-publish', [\App\Http\Controllers\Backend\Blogs\BlogController::class, 'togglePublish'])
    ->name('manage-blog.toggle-publish');
