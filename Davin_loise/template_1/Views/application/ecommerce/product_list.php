<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Daftar Produk' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

        .product-image {
            width: 50px;
            height: 50px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            max-width: 40px;
            height: auto;
        }

        .badge-stock {
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-stock.in-stock {
            background: #e6f9ed;
            color: #2b7e3a;
        }

        .badge-stock.low-stock {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-stock.out-stock {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-action.edit {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .btn-action.edit:hover {
            background: #4f46e5;
            color: white;
        }

        .btn-action.delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .btn-action.delete:hover {
            background: #ef4444;
            color: white;
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

        body.dark-mode .product-image {
            background: #0f172a;
        }

        body.dark-mode .table {
            color: #e2e8f0;
        }

        body.dark-mode .table td,
        body.dark-mode .table th {
            border-color: #334155;
        }

        body.dark-mode .badge-stock.in-stock {
            background: rgba(52, 211, 153, 0.15);
            color: #34d399;
        }

        body.dark-mode .badge-stock.low-stock {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
        }

        body.dark-mode .badge-stock.out-stock {
            background: rgba(248, 113, 113, 0.15);
            color: #f87171;
        }

        body.dark-mode .dataTables_wrapper .dataTables_length,
        body.dark-mode .dataTables_wrapper .dataTables_filter,
        body.dark-mode .dataTables_wrapper .dataTables_info,
        body.dark-mode .dataTables_wrapper .dataTables_paginate {
            color: #94a3b8;
        }

        body.dark-mode .dataTables_wrapper .dataTables_filter input {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
        }

        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
        }

        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #334155 !important;
            color: #818cf8 !important;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.8rem;
            }

            .btn-action {
                width: 28px;
                height: 28px;
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
                    <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Daftar Produk</h2>
                    <p class="text-muted mt-1">Kelola semua produk yang tersedia di toko Anda</p>
                </div>
                <div class="mt-2 mt-sm-0">
                    <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn btn-primary rounded-pill">
                        <i class="fas fa-plus me-2"></i> Tambah Produk
                    </a>
                </div>
            </div>

            <!-- Product Table -->
            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="productTable" class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Product 1 -->
                                <tr>
                                    <td>1</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/4f46e5/white?text=Shoes" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Glitter Gold Mesh Walking Shoes</h6><small class="text-muted">SKU: SKU-001</small></td>
                                    <td>Sepatu</td>
                                    <td><span class="fw-bold">$89.00</span><small class="text-muted text-decoration-line-through ms-1">$127.00</small></td>
                                    <td>45</td>
                                    <td><span class="badge-stock in-stock">Tersedia</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- Product 2 -->
                                <tr>
                                    <td>2</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/10b981/white?text=Bag" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Premium Leather Backpack</h6><small class="text-muted">SKU: SKU-002</small></td>
                                    <td>Tas</td>
                                    <td><span class="fw-bold">$149.00</span></td>
                                    <td>23</td>
                                    <td><span class="badge-stock in-stock">Tersedia</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- Product 3 -->
                                <tr>
                                    <td>3</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/f59e0b/white?text=Watch" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Smart Watch Series 8</h6><small class="text-muted">SKU: SKU-003</small></td>
                                    <td>Elektronik</td>
                                    <td><span class="fw-bold">$299.00</span></td>
                                    <td>12</td>
                                    <td><span class="badge-stock low-stock">Stok Terbatas</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- Product 4 -->
                                <tr>
                                    <td>4</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/ef4444/white?text=Jacket" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Winter Parka Jacket</h6><small class="text-muted">SKU: SKU-004</small></td>
                                    <td>Pakaian</td>
                                    <td><span class="fw-bold">$179.00</span><small class="text-muted text-decoration-line-through ms-1">$210.00</small></td>
                                    <td>56</td>
                                    <td><span class="badge-stock in-stock">Tersedia</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- Product 5 -->
                                <tr>
                                    <td>5</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/06b6d4/white?text=Headphone" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Wireless Headphone Pro</h6><small class="text-muted">SKU: SKU-005</small></td>
                                    <td>Elektronik</td>
                                    <td><span class="fw-bold">$159.00</span></td>
                                    <td>34</td>
                                    <td><span class="badge-stock in-stock">Tersedia</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- Product 6 -->
                                <tr>
                                    <td>6</td>
                                    <td><div class="product-image"><img src="https://placehold.co/50x50/8b5cf6/white?text=Glasses" alt="Product"></div></td>
                                    <td><h6 class="fw-semibold mb-0">Polarized Sunglasses</h6><small class="text-muted">SKU: SKU-006</small></td>
                                    <td>Aksesoris</td>
                                    <td><span class="fw-bold">$59.00</span></td>
                                    <td>78</td>
                                    <td><span class="badge-stock in-stock">Tersedia</span></td>
                                    <td>
                                        <a href="<?= base_url('/ecommerce/product-add') ?>" class="btn-action edit me-1"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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

    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#productTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                order: [[0, 'asc']],
                pageLength: 10
            });
        });

        // Tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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