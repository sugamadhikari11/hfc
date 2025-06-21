<?php

use Illuminate\Support\Facades\Route;

Route::resource('manage-projects', "\App\Http\Controllers\Backend\Project\ProjectController");
