<?php

namespace App\Controllers;

/**
 * Settings Controller
 * File: app/Controllers/Settings.php
 *
 * Mengelola halaman pengaturan admin.
 * Pengaturan tema disimpan di localStorage browser (tidak ke DB),
 * sehingga controller ini hanya perlu merender view tanpa data khusus.
 */
class Settings extends BaseController
{
    /**
     * Halaman pengaturan
     * Route: GET /settings
     */
    public function index()
    {
        return view('settings/index', [
            'pageTitle' => 'Pengaturan',
        ]);
    }

    /**
     * Simpan pengaturan (untuk pengembangan selanjutnya)
     * Route: POST /settings/save
     *
     * Saat ini hanya mengembalikan response JSON sederhana.
     * Nanti bisa dihubungkan ke database untuk menyimpan preferensi user.
     */
    public function save()
    {
        // TODO: Implementasi simpan ke database
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pengaturan berhasil disimpan'
        ]);
    }
}
