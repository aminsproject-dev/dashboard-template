<?php

namespace App\Controllers\Application\Ecommerce;

use App\Controllers\BaseController;

class Product extends BaseController
{
    public function product()
    {


        $data = ['title' => 'Product'];
        return view('application/ecommerce/product', $data);
    }
   public function list()
{
        $data = ['title' => 'Product List'];
        return view('application/ecommerce/product_list', $data);
}

    // ProductAdd.php
    public function addproduct()
    {
        return view('application/ecommerce/product_add');
    }


    // ProductAdd.php
    public function store()
    {
        // Validasi input
        $rules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'brand' => 'required',
            'regular_price' => 'required|numeric',
            'stock' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'brand' => $this->request->getPost('brand'),
            'regular_price' => $this->request->getPost('regular_price'),
            'discount_price' => $this->request->getPost('discount_price'),
            'discount_percent' => $this->request->getPost('discount_percent'),
            'sku' => $this->request->getPost('sku'),
            'stock' => $this->request->getPost('stock'),
            'weight' => $this->request->getPost('weight'),
            'status' => $this->request->getPost('status'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'slug' => $this->request->getPost('slug'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Upload gambar
        $image = $this->request->getFile('product_image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads/products', $newName);
            $data['image'] = $newName;
        }

        // Simpan ke database (contoh dengan model)
        // $productModel = new \App\Models\ProductModel();
        // $productModel->save($data);

        // Simpan varian jika ada
        $variants = $this->request->getPost('variants');
        if ($variants && is_array($variants)) {
            foreach ($variants as $variant) {
                // Simpan varian ke database
                // $variantModel->save($variant);
            }
        }

        // Redirect dengan pesan sukses
        session()->setFlashdata('success', 'Produk berhasil ditambahkan!');
        return redirect()->to('/ecommerce/product-list');
    }

    // Menampilkan halaman form edit produk
    public function edit($id = null)
    {
        // Ambil data produk dari database berdasarkan ID
        // $productModel = new \App\Models\ProductModel();
        // $product = $productModel->find($id);

        // Data sementara (nanti diganti dengan database)
        $product = [
            'id' => $id,
            'product_name' => 'Contoh Produk',
            'description' => 'Deskripsi produk...',
            'category' => 'Sepatu',
            'brand' => 'Nike',
            'regular_price' => 100000,
            'discount_price' => 80000,
            'discount_percent' => 20,
            'sku' => 'SKU-001',
            'stock' => 50,
            'weight' => 500,
            'status' => 'published',
            'is_featured' => 1,
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'slug' => 'contoh-produk'
        ];

        if (!$product) {
            return redirect()->to('/ecommerce/product-list')->with('error', 'Produk tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Produk',
            'product' => $product,
            'validation' => \Config\Services::validation()
        ];
        return view('application/ecommerce/product_add', $data);
    }

    // Mengupdate data produk
    public function update($id = null)
    {
        // Validasi input
        $rules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'brand' => 'required',
            'regular_price' => 'required|numeric',
            'stock' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'brand' => $this->request->getPost('brand'),
            'regular_price' => $this->request->getPost('regular_price'),
            'discount_price' => $this->request->getPost('discount_price'),
            'discount_percent' => $this->request->getPost('discount_percent'),
            'sku' => $this->request->getPost('sku'),
            'stock' => $this->request->getPost('stock'),
            'weight' => $this->request->getPost('weight'),
            'status' => $this->request->getPost('status'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'slug' => $this->request->getPost('slug'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Upload gambar baru jika ada
        $image = $this->request->getFile('product_image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads/products', $newName);
            $data['image'] = $newName;
        }

        // Update ke database
        // $productModel = new \App\Models\ProductModel();
        // $productModel->update($id, $data);

        session()->setFlashdata('success', 'Produk berhasil diupdate!');
        return redirect()->to('/ecommerce/product-list');
    }

    // Menghapus produk
    public function delete($id = null)
    {
        // Hapus dari database
        // $productModel = new \App\Models\ProductModel();
        // $productModel->delete($id);

        session()->setFlashdata('success', 'Produk berhasil dihapus!');
        return redirect()->to('/ecommerce/product-list');
    }
}
