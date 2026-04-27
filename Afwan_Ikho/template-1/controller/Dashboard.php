<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $cacheKey = 'dashboard_data_v1';
        
        // Coba ambil dari cache
        if (!$cached = cache($cacheKey)) {
            // Generate data (hanya terjadi sekali)
            $stats = [
                'total_users'   => 1245,
                'revenue'       => 8249,
                'active_orders' => 64,
                'conversion'    => 2.4,
            ];
            
            $revenueLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            $revenueData   = [4200, 4800, 5900, 6100, 7200, 8249];
            
            $trafficSources = [
                ['label' => 'Direct',  'value' => 38, 'color' => '#6366f1'],
                ['label' => 'Social',  'value' => 27, 'color' => '#8b5cf6'],
                ['label' => 'Email',   'value' => 19, 'color' => '#ec4899'],
                ['label' => 'Organic', 'value' => 16, 'color' => '#3b82f6'],
            ];
            
            $recentOrders = [
            ['id' => '#ORD-001', 'customer' => 'John Doe',       'product' => 'Wireless Headphones', 'status' => 'completed',  'amount' => 300.00,   'date' => '2024-01-15'],
            ['id' => '#ORD-002', 'customer' => 'Jane Smith',     'product' => 'Smart Watch',          'status' => 'pending',    'amount' => 199.00,   'date' => '2024-01-14'],
            ['id' => '#ORD-003', 'customer' => 'Robert Johnson', 'product' => 'Laptop Pro',           'status' => 'processing', 'amount' => 1299.00,  'date' => '2024-01-13'],
            ['id' => '#ORD-004', 'customer' => 'Emily Davis',    'product' => 'Tablet Air',           'status' => 'cancelled',  'amount' => 499.00,   'date' => '2024-01-12'],
            ['id' => '#ORD-005', 'customer' => 'Michael Brown',  'product' => 'Gaming Mouse',         'status' => 'completed',  'amount' => 79.00,    'date' => '2024-01-11'],
            ['id' => '#ORD-006', 'customer' => 'Sarah Wilson',   'product' => 'Mechanical Keyboard',  'status' => 'completed',  'amount' => 149.00,   'date' => '2024-01-10'],
            ['id' => '#ORD-007', 'customer' => 'David Lee',      'product' => 'USB-C Hub',            'status' => 'pending',    'amount' => 59.00,    'date' => '2024-01-09'],
        ];
            
            $cached = [
                'stats' => $stats,
                'revenueLabels' => $revenueLabels,
                'revenueData' => $revenueData,
                'trafficSources' => $trafficSources,
                'recentOrders' => $recentOrders,
            ];
            
            // Simpan ke cache selama 10 menit
            cache()->save($cacheKey, $cached, 600);
        }
        
        return view('dashboard/index', array_merge(
            ['pageTitle' => 'Dashboard'],
            $cached
        ));
    }
}