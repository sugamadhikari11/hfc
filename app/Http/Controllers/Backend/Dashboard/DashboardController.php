<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Backend\Common\BackendController;

class DashboardController extends BackendController
{

    public function index()
    {
        return view($this->pagePath . 'dashboard.index', $this->data);
    }

}
