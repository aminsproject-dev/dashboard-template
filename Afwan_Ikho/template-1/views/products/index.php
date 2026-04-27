<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-content">

    <div class="page-header">
        <h1>📦 Manajemen Produk</h1>
        <p>Kelola katalog produk toko Anda</p>
    </div>

    <!-- Statistik Produk -->
    <div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom:24px">
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Produk</div>
                <div class="stat-card-value"><?= $totalProducts ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.1); color:#6366f1">
                <i class="bi bi-box-seam-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Stok Habis</div>
                <div class="stat-card-value"><?= $outOfStock ?></div>
                <div class="stat-card-change down"><i class="bi bi-exclamation-triangle"></i> Perlu restock</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(239,68,68,0.1); color:#ef4444">
                <i class="bi bi-exclamation-octagon-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Kategori</div>
                <div class="stat-card-value"><?= $totalCategories ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(59,130,246,0.1); color:#3b82f6">
                <i class="bi bi-tags-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Nilai Stok</div>
                <div class="stat-card-value" style="font-size:20px">$<?= number_format($totalStockValue) ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="bi bi-grid-fill icon"></i>
                Daftar Produk
            </div>
            <div style="display:flex; gap:8px">
                <!-- <select class="form-input form-select" style="width:auto; padding:7px 32px 7px 12px; font-size:12px">
                    <option>Semua Kategori</option>
                    <option>Electronics</option>
                    <option>Accessories</option>
                    <option>Computers</option>
                </select> -->
                <button class="btn btn-primary btn-sm" onclick="openProductModal()">
                    <i class="bi bi-plus"></i> Tambah Produk
                </button>
            </div>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Terjual</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <!-- Thumbnail produk dengan emoji sebagai placeholder -->
                                    <div style="display:flex; align-items:center; gap:12px">
                                        <div class="product-img-thumb"><?= $product['icon'] ?></div>
                                        <div>
                                            <div style="font-weight:600; font-size:13px"><?= $product['name'] ?></div>
                                            <div style="font-size:11px; color:var(--text-muted); font-family:'JetBrains Mono',monospace">
                                                SKU: <?= $product['sku'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size:11px; padding:3px 8px; border-radius:4px; background:var(--bg-primary); color:var(--accent-primary); font-weight:600">
                                        <?= $product['category'] ?>
                                    </span>
                                </td>
                                <td style="font-family:'JetBrains Mono',monospace; font-weight:600">
                                    $<?= number_format($product['price'], 2) ?>
                                </td>
                                <td>
                                    <!-- Progress bar stok -->
                                    <div style="display:flex; align-items:center; gap:8px">
                                        <div class="progress-bar-wrap">
                                            <?php
                                            // Hitung persentase stok dari maksimum 200 unit
                                            $pct = min(100, ($product['stock'] / 200) * 100);
                                            // Warna berubah sesuai jumlah stok
                                            $barColor = $pct < 15 ? '#ef4444' : ($pct < 40 ? '#f59e0b' : '#6366f1');
                                            ?>
                                            <div class="progress-bar-fill" style="width:<?= $pct ?>%; background:<?= $barColor ?>"></div>
                                        </div>
                                        <span style="font-size:12px; font-weight:600; color:<?= $pct < 15 ? '#ef4444' : 'var(--text-primary)' ?>">
                                            <?= $product['stock'] ?>
                                        </span>
                                    </div>
                                </td>
                                <td style="font-family:'JetBrains Mono',monospace; text-align:center">
                                    <?= $product['sold'] ?>
                                </td>
                                <td>
                                    <!-- Rating bintang -->
                                    <span style="color:#f59e0b; font-size:12px">★</span>
                                    <span style="font-size:12px; font-weight:600"><?= $product['rating'] ?></span>
                                </td>
                                <td>
                                    <span class="badge-status <?= $product['stock'] > 0 ? 'active' : 'cancelled' ?>">
                                        <?= $product['stock'] > 0 ? 'Tersedia' : 'Habis' ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex; gap:4px">
                                        <button class="btn btn-icon" onclick="openProductDetailModal(<?= htmlspecialchars(json_encode($product)) ?>)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div id="modalProduct" class="modal-overlay" style="display:none">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tambah Produk Baru</h3>
                <button class="modal-close" onclick="closeModal('modalProduct')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" id="productName" class="form-input" placeholder="Masukkan nama produk">
                </div>
                <div class="form-group">
                    <label class="form-label">SKU</label>
                    <input type="text" id="productSku" class="form-input" placeholder="SKU-XXX-001">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select id="productCategory" class="form-input form-select">
                        <option value="Electronics">Electronics</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Computers">Computers</option>
                        <option value="Audio">Audio</option>
                        <option value="Gaming">Gaming</option>
                        <option value="Wearables">Wearables</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga ($)</label>
                    <input type="number" id="productPrice" class="form-input" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" id="productStock" class="form-input" placeholder="0">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('modalProduct')">Batal</button>
                <button class="btn btn-primary" onclick="confirmProduct()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Detail Produk -->
    <div id="modalProductDetail" class="modal-overlay" style="display:none">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Detail Produk</h3>
                <button class="modal-close" onclick="closeModal('modalProductDetail')">&times;</button>
            </div>
            <div class="modal-body" id="productDetailContent">
                <!-- Isi detail akan diisi JavaScript -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="editProduct()">Edit</button>
                <button class="btn btn-danger" onclick="deleteProduct()">Hapus</button>
                <button class="btn btn-outline" onclick="closeModal('modalProductDetail')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div id="modalProductEdit" class="modal-overlay" style="display:none">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Edit Produk</h3>
                <button class="modal-close" onclick="closeModal('modalProductEdit')">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editProductIndex">
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" id="editProductName" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">SKU</label>
                    <input type="text" id="editProductSku" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select id="editProductCategory" class="form-input form-select">
                        <option value="Electronics">Electronics</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Computers">Computers</option>
                        <option value="Audio">Audio</option>
                        <option value="Gaming">Gaming</option>
                        <option value="Wearables">Wearables</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga ($)</label>
                    <input type="number" id="editProductPrice" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" id="editProductStock" class="form-input">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('modalProductEdit')">Batal</button>
                <button class="btn btn-primary" onclick="updateProduct()">Update</button>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>