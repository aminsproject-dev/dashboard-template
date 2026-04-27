<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Tambah Produk' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fc;
        }

        .main-content {
            margin-left: 280px;
            padding: 0;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            margin-top: 70px;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0 0 20px 0;
        }
        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #4f46e5;
            font-weight: 500;
        }
        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #adb5bd;
            font-size: 18px;
        }

        .card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .image-upload {
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .image-upload:hover {
            border-color: #4f46e5;
            background: #f8fafc;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .card {
            background: #1e293b !important;
        }
        body.dark-mode .text-muted {
            color: #94a3b8 !important;
        }
        body.dark-mode .form-label {
            color: #e2e8f0;
        }
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            border-color: #4f46e5;
        }
        body.dark-mode .image-upload {
            border-color: #334155;
        }
        body.dark-mode .image-upload:hover {
            background: #334155;
            border-color: #4f46e5;
        }
        body.dark-mode .border-bottom {
            border-bottom-color: #334155 !important;
        }
        body.dark-mode .bg-light {
            background: #334155 !important;
        }

        /* Select2 Dark Mode */
        body.dark-mode .select2-container--bootstrap-5 .select2-selection {
            background-color: #0f172a;
            border-color: #334155;
        }
        body.dark-mode .select2-container--bootstrap-5 .select2-selection__rendered {
            color: #e2e8f0;
        }

        @media (max-width: 768px) {
            .image-upload {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <?= view('layout/navbar') ?>
    <?= view('layout/sidebar_new') ?>

    <div class="main-content">
        <div class="container-fluid px-4 py-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ecommerce</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('/ecommerce/product-list') ?>">Daftar Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Tambah Produk Baru</h2>
                    <p class="text-muted mt-1">Isi formulir di bawah untuk menambahkan produk baru ke toko Anda</p>
                </div>
            </div>

            <form action="<?= base_url('/ecommerce/product-add') ?>" method="post" enctype="multipart/form-data">
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <!-- Product Description -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-align-left text-primary me-2"></i>Deskripsi Produk</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama produk" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="4" placeholder="Deskripsi lengkap produk..."></textarea>
                                <small class="text-muted">Informasi detail tentang produk, fitur, dan spesifikasi.</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select">
                                        <option selected>Pilih kategori</option>
                                        <option>Sepatu</option>
                                        <option>Tas</option>
                                        <option>Pakaian</option>
                                        <option>Elektronik</option>
                                        <option>Aksesoris</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Brand / Merek</label>
                                    <select class="form-select">
                                        <option selected>Pilih merek</option>
                                        <option>Nike</option>
                                        <option>Adidas</option>
                                        <option>Puma</option>
                                        <option>Apple</option>
                                        <option>Samsung</option>
                                        <option>Sony</option>
                                        <option>Ray-Ban</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-tag text-primary me-2"></i>Harga</h5>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Normal</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Diskon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Diskon (%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="0">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-boxes text-primary me-2"></i>Inventaris</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SKU</label>
                                    <input type="text" class="form-control" placeholder="SKU-001">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Berat</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="0">
                                    <span class="input-group-text">gram</span>
                                </div>
                            </div>
                        </div>

                        <!-- Variants -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-cubes text-primary me-2"></i>Varian Produk</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipe Penjualan</label>
                                <select class="form-select">
                                    <option selected>Produk Tunggal</option>
                                    <option>Produk dengan Varian</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Varian Produk</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" id="addVariantBtn">
                                        <i class="fas fa-plus me-1"></i> Tambah Varian
                                    </button>
                                </div>
                                <div id="variantsContainer">
                                    <div class="row g-2 mb-2 variant-item">
                                        <div class="col-5"><input type="text" class="form-control" placeholder="Ukuran (contoh: M, L, XL)"></div>
                                        <div class="col-4"><input type="text" class="form-control" placeholder="SKU"></div>
                                        <div class="col-2"><input type="number" class="form-control" placeholder="Stok"></div>
                                        <div class="col-1"><button type="button" class="btn btn-sm btn-danger remove-variant"><i class="fas fa-trash"></i></button></div>
                                    </div>
                                </div>
                                <small class="text-muted">Tambahkan varian seperti ukuran, warna, dll.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-4">
                        <!-- Product Image -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-image text-primary me-2"></i>Gambar Produk</h5>
                            
                            <div class="image-upload" id="imageUpload">
                                <i class="fas fa-cloud-upload-alt fs-1 text-muted mb-2"></i>
                                <p class="text-muted mb-1">Klik atau drag & drop untuk upload</p>
                                <small class="text-muted">* Resolusi yang direkomendasikan 640x640 dengan ukuran file maksimal 2MB</small>
                                <input type="file" id="fileInput" style="display: none;" accept="image/*">
                            </div>
                            <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                                <img id="previewImg" src="#" alt="Preview" style="max-width: 100%; border-radius: 12px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="removeImageBtn">Hapus Gambar</button>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="card p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-toggle-on text-primary me-2"></i>Status Produk</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option value="published" selected>Published (Publik)</option>
                                    <option value="draft">Draft (Sembunyikan)</option>
                                    <option value="archived">Archived (Arsip)</option>
                                </select>
                            </div>
                            
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="featuredSwitch">
                                <label class="form-check-label" for="featuredSwitch">Jadikan Produk Unggulan</label>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="card p-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i>SEO</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" placeholder="Judul untuk SEO">
                                <small class="text-muted">Panjang maksimal 60 karakter</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" rows="2" placeholder="Deskripsi untuk SEO"></textarea>
                                <small class="text-muted">Panjang maksimal 160 karakter</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Slug URL</label>
                                <input type="text" class="form-control" placeholder="nama-produk-seo-friendly">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="<?= base_url('/ecommerce/product-list') ?>" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i> Simpan Produk
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <footer class="mt-5 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted">
                    © 2026
                    <strong class="text-primary">Davin Loise</strong>
                    <span class="mx-2">•</span>
                    All rights reserved.
                </p>
            </footer>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Select2 untuk dropdown
        $('.form-select').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // Image Upload
        const imageUpload = document.getElementById('imageUpload');
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImageBtn');

        imageUpload.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    imagePreview.style.display = 'block';
                    imageUpload.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        removeImageBtn.addEventListener('click', () => {
            imagePreview.style.display = 'none';
            imageUpload.style.display = 'block';
            fileInput.value = '';
        });

        // Drag & Drop
        imageUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUpload.style.borderColor = '#4f46e5';
            imageUpload.style.background = '#f8fafc';
        });

        imageUpload.addEventListener('dragleave', (e) => {
            e.preventDefault();
            imageUpload.style.borderColor = '#e2e8f0';
            imageUpload.style.background = 'transparent';
        });

        imageUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    imagePreview.style.display = 'block';
                    imageUpload.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
            imageUpload.style.borderColor = '#e2e8f0';
            imageUpload.style.background = 'transparent';
        });

        // Add Variant
        let variantCount = 1;
        document.getElementById('addVariantBtn').addEventListener('click', () => {
            variantCount++;
            const newVariant = `
                <div class="row g-2 mb-2 variant-item">
                    <div class="col-5"><input type="text" class="form-control" placeholder="Ukuran (contoh: M, L, XL)"></div>
                    <div class="col-4"><input type="text" class="form-control" placeholder="SKU"></div>
                    <div class="col-2"><input type="number" class="form-control" placeholder="Stok"></div>
                    <div class="col-1"><button type="button" class="btn btn-sm btn-danger remove-variant"><i class="fas fa-trash"></i></button></div>
                </div>
            `;
            document.getElementById('variantsContainer').insertAdjacentHTML('beforeend', newVariant);
            
            // Add event listener to new remove button
            document.querySelectorAll('.remove-variant').forEach(btn => {
                btn.removeEventListener('click', removeVariant);
                btn.addEventListener('click', removeVariant);
            });
        });

        function removeVariant(e) {
            e.target.closest('.variant-item').remove();
        }

        document.querySelectorAll('.remove-variant').forEach(btn => {
            btn.addEventListener('click', removeVariant);
        });

        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggleCheckbox');
        if (themeToggle) {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.checked = true;
            }
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        }

        // Scroll to Top Button
        const scrollBtn = document.createElement('div');
        scrollBtn.className = 'scroll-top-btn';
        scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        document.body.appendChild(scrollBtn);
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        });
        
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const style = document.createElement('style');
        style.textContent = `
            .scroll-top-btn {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 45px;
                height: 45px;
                background: linear-gradient(135deg, #4f46e5, #7c3aed);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                cursor: pointer;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            }
            .scroll-top-btn.show {
                opacity: 1;
                visibility: visible;
            }
            .scroll-top-btn:hover {
                transform: translateY(-3px);
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>