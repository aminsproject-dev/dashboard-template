<?php

namespace App\Controllers\Pages\Authentication;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        $data = ['title' => 'Login'];
        return view('pages/authentication/login', $data);
    }

    public function register()
    {
        $data = ['title' => 'Register'];
        return view('pages/authentication/register', $data);
    }

    public function forgotPassword()
    {
        $data = ['title' => 'Lupa Password'];
        return view('pages/authentication/forgot_password', $data);
    }

    public function resetPassword()
    {
        $data = ['title' => 'Reset Password'];
        return view('pages/authentication/reset_password', $data);
    }

    public function verifyCode()
    {
        $data = ['title' => 'Verifikasi Kode'];
        return view('pages/authentication/verify_code', $data);
    }
}