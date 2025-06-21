<?php
// filepath: /home/sarbada/Desktop/booking/routes/routing/frontend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\ApplicationController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\CategoryPageController;
use App\Http\Controllers\Frontend\HotelsController;
use App\Http\Controllers\Frontend\DonateController;

// Home page
Route::get('/', '\App\Http\Controllers\Frontend\ApplicationController@index')->name('index');


Route::get('/contact', [App\Http\Controllers\Frontend\ApplicationController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\Frontend\ApplicationController::class, 'storeContact'])->name('contact.store');;
Route::get('/faq', '\App\Http\Controllers\Frontend\ApplicationController@faq')->name('faq');
Route::get('/about-us', '\App\Http\Controllers\Frontend\ApplicationController@about')->name('about-us');

// Blog comments
Route::post('/blog/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');
Route::post('/blog/comment/reply', [BlogController::class, 'storeReply'])->name('blog.comment.reply');

// Content pages
Route::get('/gallery', '\App\Http\Controllers\Frontend\ApplicationController@gallery')->name('gallery');
Route::get('/projects', '\App\Http\Controllers\Frontend\ApplicationController@projects')->name('projects');

// Services
Route::get('/services/{slug?}', '\App\Http\Controllers\Frontend\ApplicationController@services')
    ->name('services');

Route::get('/blogs/{slug?}', '\App\Http\Controllers\Frontend\ApplicationController@blogs')->name('blogs');

Route::post('/newsletter/subscribe', [App\Http\Controllers\Frontend\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

//DOnate
Route::get('/donate', [App\Http\Controllers\Frontend\DonateController::class, 'index'])->name('donate');
