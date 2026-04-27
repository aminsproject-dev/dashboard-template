<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
class Helpdesk extends BaseController
{
    public function helpdesk()
    {
        $data = ['title' => 'Helpdesk Dashboard'];
        return view('dashboard/helpdesk', $data);
    }
}