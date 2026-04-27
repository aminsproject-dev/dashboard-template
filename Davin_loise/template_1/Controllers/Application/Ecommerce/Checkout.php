<?php

namespace App\Controllers\Application\Ecommerce;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function checkout()
    {
        $data = ['title' => 'Checkout'];
        return view('application/ecommerce/checkout', $data);
    }
}