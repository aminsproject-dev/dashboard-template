<?php

namespace App\Controllers;

/**
 * Analytics Controller
 * File: app/Controllers/Analytics.php
 *
 * Mengelola halaman laporan dan analitik.
 */
class Analytics extends BaseController
{
    /**
     * Halaman analitik
     * Route: GET /analytics
     */
    public function index()
    {
        // ─── DUMMY DATA: KPI Utama ──────────────────────────────────────
        $kpi = [
            'total_sales'  => 36500,   // Total penjualan 6 bulan
            'total_orders' => 308,     // Total pesanan 6 bulan
            'avg_order'    => 118,     // Rata-rata nilai per pesanan
        ];

        // ─── DUMMY DATA: Produk Terlaris ────────────────────────────────
        $topProducts = [
            ['name' => 'Laptop Stand Aluminium', 'icon' => '🖥️', 'sold' => 310, 'revenue' => 12090],
            ['name' => 'USB-C Hub 7-in-1',       'icon' => '🔌', 'sold' => 200, 'revenue' => 11800],
            ['name' => 'Wireless Headphones',    'icon' => '🎧', 'sold' => 120, 'revenue' => 35880],
            ['name' => 'Bluetooth Speaker',      'icon' => '🔊', 'sold' => 95,  'revenue' => 11305],
            ['name' => 'Gaming Mouse RGB',       'icon' => '🖱️', 'sold' => 145, 'revenue' => 11455],
        ];

        // Urutkan berdasarkan revenue tertinggi
        usort($topProducts, fn($a, $b) => $b['revenue'] <=> $a['revenue']);

        return view('analytics/index', [
            'pageTitle'   => 'Analitik',
            'kpi'         => $kpi,
            'topProducts' => $topProducts,
        ]);
    }
}
