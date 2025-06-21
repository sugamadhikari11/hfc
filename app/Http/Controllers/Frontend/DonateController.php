<?php

// file: app/Http/Controllers/Frontend/DonateController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class DonateController extends Controller
{
    public function index()
    {
        return view('frontend.pages.donate.index');
    }
}
