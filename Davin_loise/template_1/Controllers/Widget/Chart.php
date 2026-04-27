<?php


namespace App\Controllers\Widget;
use App\Controllers\BaseController;

class Chart extends BaseController
{
    public function chart()
    {
        $data = ['title' => 'Chart Widget'];
        return view('widget/chart', $data);
    }
}