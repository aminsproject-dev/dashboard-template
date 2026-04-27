<?php

namespace App\Controllers\Application\Ecommerce;

use App\Controllers\BaseController;

class ProductDetail extends BaseController
{
    public function index($id = null)
    {
        // Data 6 produk lengkap
        $products = [
            1 => [
                'id' => 1,
                'name' => 'Glitter Gold Mesh Walking Shoes',
                'price' => 89.00,
                'old_price' => 127.00,
                'discount' => 30,
                'rating' => 4.5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
                'details' => 'Image Enlargement: After shooting, you can enlarge photographs of the objects for clear zoomed view. Change In Aspect Ratio: Boldly crop the subject and save it with a composition that has impact.',
                'brands' => 'Nike, Adidas, Puma',
                'stock' => 45,
                'sold' => 128,
                'image' => 'Shoes',
                'color' => '4f46e5'
            ],
            2 => [
                'id' => 2,
                'name' => 'Premium Leather Backpack',
                'price' => 149.00,
                'old_price' => null,
                'discount' => 0,
                'rating' => 5.0,
                'description' => 'Tas ransel kulit premium dengan banyak kompartemen. Cocok untuk perjalanan dan kegiatan sehari-hari.',
                'details' => 'Made from genuine leather with waterproof coating. Has 3 main compartments and 2 side pockets for water bottle. Adjustable shoulder straps for comfortable carry.',
                'brands' => 'The North Face, Jansport, Herschel',
                'stock' => 23,
                'sold' => 89,
                'image' => 'Backpack',
                'color' => '10b981'
            ],
            3 => [
                'id' => 3,
                'name' => 'Smart Watch Series 8',
                'price' => 299.00,
                'old_price' => null,
                'discount' => 0,
                'rating' => 4.0,
                'description' => 'Jam tangan pintar dengan fitur kesehatan lengkap. Pantau detak jantung, oksigen darah, dan aktivitas olahraga.',
                'details' => '1.9 inch AMOLED display, up to 7 days battery life, GPS built-in, water resistant up to 50m. Compatible with iOS and Android.',
                'brands' => 'Apple, Samsung, Garmin',
                'stock' => 12,
                'sold' => 234,
                'image' => 'Watch',
                'color' => 'f59e0b'
            ],
            4 => [
                'id' => 4,
                'name' => 'Winter Parka Jacket',
                'price' => 179.00,
                'old_price' => 210.00,
                'discount' => 15,
                'rating' => 4.7,
                'description' => 'Jaket tebal anti air cocok untuk musim dingin. Dilengkapi dengan hoodie yang bisa dilepas.',
                'details' => 'Material polyester dengan lapisan fleece di dalam. Ada 4 kantong luar dan 2 kantong dalam. Hoodie adjustable dengan tali serut.',
                'brands' => 'Columbia, The North Face, Uniqlo',
                'stock' => 56,
                'sold' => 312,
                'image' => 'Jacket',
                'color' => 'ef4444'
            ],
            5 => [
                'id' => 5,
                'name' => 'Wireless Headphone Pro',
                'price' => 159.00,
                'old_price' => null,
                'discount' => 0,
                'rating' => 4.2,
                'description' => 'Headphone nirkabel dengan noise cancellation. Cocok untuk bekerja, belajar, dan traveling.',
                'details' => 'Active Noise Cancellation, 30 hours battery life, Bluetooth 5.2, fast charging (10 min = 4 hours playback). Foldable design for easy storage.',
                'brands' => 'Sony, Bose, JBL',
                'stock' => 34,
                'sold' => 567,
                'image' => 'Headphone',
                'color' => '06b6d4'
            ],
            6 => [
                'id' => 6,
                'name' => 'Polarized Sunglasses',
                'price' => 59.00,
                'old_price' => null,
                'discount' => 0,
                'rating' => 5.0,
                'description' => 'Kacamata hitam dengan lensa polarisasi UV400. Melindungi mata dari sinar UV dan silau.',
                'details' => 'UV400 protection, polarized lens that reduces glare, lightweight frame, comes with a protective case and cleaning cloth.',
                'brands' => 'Ray-Ban, Oakley, Quay',
                'stock' => 78,
                'sold' => 423,
                'image' => 'Glasses',
                'color' => '8b5cf6'
            ]
        ];

        // Cek apakah produk dengan ID tersebut ada
        if (!isset($products[$id])) {
            // Jika tidak ada, redirect ke halaman produk
            return redirect()->to('/ecommerce/product');
        }

        $data = [
            'title' => $products[$id]['name'],
            'product' => $products[$id]
        ];

        return view('application/ecommerce/product_detail', $data);
    }
}