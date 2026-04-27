<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Finance extends BaseController
{
    public function finance()
    {
        $data = ['title' => 'Finance Dashboard'];
        return view('dashboard/finance', $data);
    }
}