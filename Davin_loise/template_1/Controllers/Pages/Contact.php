<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function contactUs()
    {
        $data = ['title' => 'Hubungi Kami'];
        return view('pages/contact', $data);  // ← pastikan file view ada
    }
    
    public function sendContact()
    {
       $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');
        
        // Validasi
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'subject' => 'required',
            'message' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Kirim email (gunakan Email library CodeIgniter)
        // $emailService = \Config\Services::email();
        // $emailService->setTo('info@lightable.com');
        // $emailService->setFrom($email, $firstName . ' ' . $lastName);
        // $emailService->setSubject($subject);
        // $emailService->setMessage($message);
        // $emailService->send();
        
        // Simpan ke database jika perlu
        // $contactModel = new \App\Models\ContactModel();
        // $contactModel->save([
        //     'name' => $firstName . ' ' . $lastName,
        //     'email' => $email,
        //     'subject' => $subject,
        //     'message' => $message,
        //     'created_at' => date('Y-m-d H:i:s')
        // ]);
        
        session()->setFlashdata('success', 'Pesan berhasil dikirim');
        return redirect()->back();
    }
}