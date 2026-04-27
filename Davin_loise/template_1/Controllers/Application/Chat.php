<?php

namespace App\Controllers\Application;

use App\Controllers\BaseController;

class Chat extends BaseController
{
    public function chat()
    {
        $data = ['title' => 'Chat'];
        return view('application/chat', $data);
    }
}