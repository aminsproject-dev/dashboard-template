<?php

namespace App\Controllers\Widget;

use App\Controllers\BaseController;

class Statistics extends BaseController
{
    public function statistics()
    {
        $data = ['title' => 'Statistics'];
        return view('widget/statistics', $data);
    }
}