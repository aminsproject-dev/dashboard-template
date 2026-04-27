<?php

/**
 * Routes Configuration
 * File: app/Config/Routes.php
 *
 * Di sini kita mendaftarkan semua URL yang bisa diakses di aplikasi.
 *
 * Format dasar:
 *   $routes->get('url', 'NamaController::namaMethod');
 *
 * CodeIgniter 4 menggunakan konsep RESTful routing secara default.
 */

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ─── Halaman Utama ──────────────────────────────────────────────────────────

// Redirect root (/) ke /dashboard
$routes->get('/', 'Dashboard::index');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// Pengguna
$routes->get('users', 'Users::index');

// Produk
$routes->get('products', 'Products::index');

// Analitik
$routes->get('analytics', 'Analytics::index');

// Pengaturan
$routes->get('settings', 'Settings::index');
$routes->post('settings/save', 'Settings::save');   // POST untuk simpan

// Pesanan (placeholder, belum diimplementasi)
$routes->get('orders', 'Orders::index');  // Sementara redirect ke dashboard


// ─── Catatan untuk Pengembangan Selanjutnya ─────────────────────────────────
// Contoh route CRUD yang bisa ditambahkan:
//
// $routes->get('users/(:num)', 'Users::show/$1');        // Detail user by ID
// $routes->get('users/create', 'Users::create');         // Form tambah user
// $routes->post('users/store', 'Users::store');          // Simpan user baru
// $routes->get('users/edit/(:num)', 'Users::edit/$1');   // Form edit user
// $routes->post('users/update/(:num)', 'Users::update/$1'); // Update user
// $routes->get('users/delete/(:num)', 'Users::delete/$1'); // Hapus user
