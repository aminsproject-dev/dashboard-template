<?php

namespace App\Controllers;

/**
 * Users Controller
 * File: app/Controllers/Users.php
 *
 * Mengelola halaman manajemen pengguna.
 * Semua data saat ini masih dummy (simulasi database).
 */
class Users extends BaseController
{
    /**
     * Halaman daftar pengguna
     * Route: GET /users
     */
    public function index()
    {
        // ─── DUMMY DATA: Daftar Pengguna ────────────────────────────────
        // Warna avatar dibuat bervariasi untuk tampilan yang lebih menarik

        $users = [
            ['name' => 'John Doe',       'email' => 'john.doe@gmail.com',       'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-05', 'total_orders' => 12, 'color' => '#6366f1'],
            ['name' => 'Jane Smith',     'email' => 'jane.smith@yahoo.com',     'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-08', 'total_orders' => 8,  'color' => '#ec4899'],
            ['name' => 'Robert Johnson', 'email' => 'robert.j@hotmail.com',     'role' => 'Customer',  'status' => 'inactive', 'joined' => '2023-12-15', 'total_orders' => 3,  'color' => '#3b82f6'],
            ['name' => 'Emily Davis',    'email' => 'emily.davis@gmail.com',    'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-10', 'total_orders' => 20, 'color' => '#10b981'],
            ['name' => 'Michael Brown',  'email' => 'michael.b@outlook.com',    'role' => 'Customer',  'status' => 'active',   'joined' => '2023-11-20', 'total_orders' => 5,  'color' => '#f59e0b'],
            ['name' => 'Sarah Wilson',   'email' => 'sarah.w@gmail.com',        'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-12', 'total_orders' => 15, 'color' => '#8b5cf6'],
            ['name' => 'David Lee',      'email' => 'david.lee@company.com',    'role' => 'Customer',  'status' => 'active',   'joined' => '2023-10-05', 'total_orders' => 7,  'color' => '#ef4444'],
            ['name' => 'Lisa Martinez',  'email' => 'lisa.m@gmail.com',         'role' => 'Customer',  'status' => 'inactive', 'joined' => '2023-09-18', 'total_orders' => 2,  'color' => '#06b6d4'],
            ['name' => 'Tom Anderson',   'email' => 'tom.and@gmail.com',        'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-14', 'total_orders' => 9,  'color' => '#84cc16'],
            ['name' => 'Admin User',     'email' => 'admin@onlineshop.com',     'role' => 'Admin',     'status' => 'active',   'joined' => '2023-01-01', 'total_orders' => 0,  'color' => '#6366f1'],
            ['name' => 'Kevin Hart',     'email' => 'kevin.hart@comedy.com',    'role' => 'Customer',  'status' => 'active',   'joined' => '2024-02-01', 'total_orders' => 4,  'color' => '#f97316'],
            ['name' => 'Maria Garcia',   'email' => 'maria.g@outlook.com',      'role' => 'Customer',  'status' => 'active',   'joined' => '2024-02-03', 'total_orders' => 11, 'color' => '#ec4899'],
            ['name' => 'James Wilson',   'email' => 'james.w@yahoo.com',        'role' => 'Customer',  'status' => 'inactive', 'joined' => '2024-01-20', 'total_orders' => 1,  'color' => '#3b82f6'],
            ['name' => 'Emma Watson',    'email' => 'emma.w@company.com',       'role' => 'Admin',     'status' => 'active',   'joined' => '2024-01-15', 'total_orders' => 0,  'color' => '#8b5cf6'],
            ['name' => 'Chris Evans',    'email' => 'chris.e@marvel.com',       'role' => 'Customer',  'status' => 'active',   'joined' => '2024-02-05', 'total_orders' => 6,  'color' => '#ef4444'],
            ['name' => 'Sophia Turner',  'email' => 'sophia.t@gmail.com',       'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-28', 'total_orders' => 18, 'color' => '#10b981'],
            ['name' => 'Daniel Craig',   'email' => 'daniel.c@bond.com',        'role' => 'Customer',  'status' => 'inactive', 'joined' => '2023-12-10', 'total_orders' => 3,  'color' => '#6366f1'],
            ['name' => 'Olivia Brown',   'email' => 'olivia.b@email.com',       'role' => 'Customer',  'status' => 'active',   'joined' => '2024-02-08', 'total_orders' => 14, 'color' => '#f59e0b'],
            ['name' => 'Lucas Silva',    'email' => 'lucas.s@tech.com',         'role' => 'Customer',  'status' => 'active',   'joined' => '2024-01-25', 'total_orders' => 7,  'color' => '#06b6d4'],

        ];

        // Hitung statistik dari array dummy
        $totalUsers       = count($users);   // Total keseluruhan (dummy besar)
        $activeUsers      = count(array_filter($users, fn($u) => $u['status'] === 'active'));
        $newUsersThisMonth = 12;    // Dummy: pengguna baru bulan ini

        return view('users/index', [
            'pageTitle'          => 'Pengguna',
            'users'              => $users,
            'totalUsers'         => $totalUsers,
            'activeUsers'        => $activeUsers,
            'newUsersThisMonth'  => $newUsersThisMonth,
        ]);
    }
}
