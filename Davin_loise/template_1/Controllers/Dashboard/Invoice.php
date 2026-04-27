<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
class Helpdesk extends BaseController
{
    public function invoice()
    {
        $data = ['title' => 'Invoice Dashboard'];
        return view('dashboard/invoice', $data);
    }
}