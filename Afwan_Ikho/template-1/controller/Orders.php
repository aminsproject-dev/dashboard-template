<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Orders extends BaseController
{
    public function index()
    {
        // ─── DUMMY DATA: Daftar Pesanan ────────────────────────────────
        $orders = [
            ['id' => '#ORD-001', 'customer' => 'John Doe', 'product' => 'Wireless Headphones', 'status' => 'completed', 'amount' => 299.00, 'date' => '2024-01-15', 'payment_method' => 'Credit Card', 'shipping_address' => 'Jakarta, Indonesia'],
            ['id' => '#ORD-002', 'customer' => 'Jane Smith', 'product' => 'Smart Watch', 'status' => 'pending', 'amount' => 199.00, 'date' => '2024-01-14', 'payment_method' => 'Bank Transfer', 'shipping_address' => 'Surabaya, Indonesia'],
            ['id' => '#ORD-003', 'customer' => 'Robert Johnson', 'product' => 'Laptop Pro', 'status' => 'processing', 'amount' => 1299.00, 'date' => '2024-01-13', 'payment_method' => 'Credit Card', 'shipping_address' => 'Bandung, Indonesia'],
            ['id' => '#ORD-004', 'customer' => 'Emily Davis', 'product' => 'Tablet Air', 'status' => 'cancelled', 'amount' => 499.00, 'date' => '2024-01-12', 'payment_method' => 'PayPal', 'shipping_address' => 'Medan, Indonesia'],
            ['id' => '#ORD-005', 'customer' => 'Michael Brown', 'product' => 'Gaming Mouse', 'status' => 'completed', 'amount' => 79.00, 'date' => '2024-01-11', 'payment_method' => 'Credit Card', 'shipping_address' => 'Semarang, Indonesia'],
            ['id' => '#ORD-006', 'customer' => 'Sarah Wilson', 'product' => 'Mechanical Keyboard', 'status' => 'completed', 'amount' => 149.00, 'date' => '2024-01-10', 'payment_method' => 'Bank Transfer', 'shipping_address' => 'Yogyakarta, Indonesia'],
            ['id' => '#ORD-007', 'customer' => 'David Lee', 'product' => 'USB-C Hub', 'status' => 'pending', 'amount' => 59.00, 'date' => '2024-01-09', 'payment_method' => 'Credit Card', 'shipping_address' => 'Bali, Indonesia'],
            ['id' => '#ORD-008', 'customer' => 'Lisa Martinez', 'product' => 'Bluetooth Speaker', 'status' => 'processing', 'amount' => 119.00, 'date' => '2024-01-08', 'payment_method' => 'PayPal', 'shipping_address' => 'Makassar, Indonesia'],
            ['id' => '#ORD-009', 'customer' => 'Tom Anderson', 'product' => 'Laptop Stand', 'status' => 'completed', 'amount' => 39.00, 'date' => '2024-01-07', 'payment_method' => 'Credit Card', 'shipping_address' => 'Palembang, Indonesia'],
            ['id' => '#ORD-010', 'customer' => 'Admin User', 'product' => 'USB-C Hub', 'status' => 'completed', 'amount' => 59.00, 'date' => '2024-01-06', 'payment_method' => 'Bank Transfer', 'shipping_address' => 'Jakarta, Indonesia'],
        ];

        // Hitung statistik dari array dummy
        $totalOrders = count($orders);
        $completedOrders = count(array_filter($orders, fn($o) => $o['status'] === 'completed'));
        $pendingOrders = count(array_filter($orders, fn($o) => $o['status'] === 'pending'));
        $processingOrders = count(array_filter($orders, fn($o) => $o['status'] === 'processing'));
        $cancelledOrders = count(array_filter($orders, fn($o) => $o['status'] === 'cancelled'));

        // Total revenue dari pesanan completed
        $totalRevenue = array_sum(array_filter(array_column($orders, 'amount'), function ($key) use ($orders) {
            return $orders[$key]['status'] === 'completed';
        }, ARRAY_FILTER_USE_KEY));

        return view('orders/index', [
            'pageTitle'         => 'Pesanan',
            'orders'            => $orders,
            'totalOrders'       => $totalOrders,
            'completedOrders'   => $completedOrders,
            'pendingOrders'     => $pendingOrders,
            'processingOrders'  => $processingOrders,
            'cancelledOrders'   => $cancelledOrders,
            'totalRevenue'      => $totalRevenue,
        ]);
    }
}
