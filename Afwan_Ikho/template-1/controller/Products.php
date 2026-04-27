<?php

namespace App\Controllers;

/**
 * Products Controller
 * File: app/Controllers/Products.php
 *
 * Mengelola halaman manajemen produk.
 */
class Products extends BaseController
{
    /**
     * Halaman daftar produk
     * Route: GET /products
     */
    public function index()
    {
        // ─── DUMMY DATA: Katalog Produk ─────────────────────────────────
        // Field 'icon' menggunakan emoji sebagai placeholder gambar produk
        $products = [
            ['name' => 'Wireless Headphones',   'sku' => 'SKU-WH-001', 'category' => 'Audio',       'price' => 299.00,  'stock' => 45,  'sold' => 120, 'rating' => 4.8, 'icon' => '🎧', 'image' => 'https://static.retailworldvn.com/Products/Images/12252/302867/headphone-bluetooth-loops-x01-grey-1.jpg'],
            ['name' => 'Smart Watch Pro',        'sku' => 'SKU-SW-002', 'category' => 'Wearables',   'price' => 199.00,  'stock' => 30,  'sold' => 89,  'rating' => 4.6, 'icon' => '⌚', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Laptop Pro 15"',         'sku' => 'SKU-LP-003', 'category' => 'Computers',   'price' => 1299.00, 'stock' => 12,  'sold' => 45,  'rating' => 4.9, 'icon' => '💻', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Tablet Air 10"',         'sku' => 'SKU-TA-004', 'category' => 'Electronics', 'price' => 499.00,  'stock' => 0,   'sold' => 67,  'rating' => 4.5, 'icon' => '📱', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Gaming Mouse RGB',       'sku' => 'SKU-GM-005', 'category' => 'Gaming',      'price' => 79.00,   'stock' => 180, 'sold' => 145, 'rating' => 4.7, 'icon' => '🖱️', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Mechanical Keyboard',    'sku' => 'SKU-MK-006', 'category' => 'Gaming',      'price' => 149.00,  'stock' => 55,  'sold' => 78,  'rating' => 4.8, 'icon' => '⌨️', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'USB-C Hub 7-in-1',       'sku' => 'SKU-UH-007', 'category' => 'Accessories', 'price' => 59.00,   'stock' => 90,  'sold' => 200, 'rating' => 4.4, 'icon' => '🔌', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Webcam 4K',              'sku' => 'SKU-WC-008', 'category' => 'Electronics', 'price' => 89.00,   'stock' => 8,   'sold' => 55,  'rating' => 4.3, 'icon' => '📷', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Bluetooth Speaker',      'sku' => 'SKU-BS-009', 'category' => 'Audio',       'price' => 119.00,  'stock' => 0,   'sold' => 95,  'rating' => 4.6, 'icon' => '🔊', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
            ['name' => 'Laptop Stand Aluminium', 'sku' => 'SKU-LS-010', 'category' => 'Accessories', 'price' => 39.00,   'stock' => 120, 'sold' => 310, 'rating' => 4.5, 'icon' => '🖥️', 'image' => 'https://picsum.photos/seed/picsum/200/300 '],
        ];

        // Hitung statistik dari array produk
        $totalProducts = count($products);

        // Hitung produk yang stoknya habis (stock = 0)
        $outOfStock = count(array_filter($products, fn($p) => $p['stock'] === 0));

        // Hitung jumlah kategori unik menggunakan array_unique
        $totalCategories = count(array_unique(array_column($products, 'category')));

        // Hitung total nilai stok: jumlah (harga * stok) semua produk
        $totalStockValue = array_sum(array_map(fn($p) => $p['price'] * $p['stock'], $products));

        return view('products/index', [
            'pageTitle'       => 'Produk',
            'products'        => $products,
            'totalProducts'   => $totalProducts,
            'outOfStock'      => $outOfStock,
            'totalCategories' => $totalCategories,
            'totalStockValue' => $totalStockValue,
        ]);
    }
}
