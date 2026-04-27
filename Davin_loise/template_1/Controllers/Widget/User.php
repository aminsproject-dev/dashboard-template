<?php

namespace App\Controllers\Widget;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function user()
    {
        $data = ['title' => 'User Widgets'];
        return view('widget/user', $data);
    }
}