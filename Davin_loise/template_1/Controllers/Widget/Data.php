<?php

namespace App\Controllers\Widget;

use App\Controllers\BaseController;

class Data extends BaseController
{
    public function data()
    {
        $data = ['title' => 'Data Widgets'];
        return view('widget/data', $data);
    }
}