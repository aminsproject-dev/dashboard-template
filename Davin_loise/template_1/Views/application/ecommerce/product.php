<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Products' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            height: 100%;
        }

        .product-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1;
        }

        .product-image {
            position: relative;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
            background: #f8fafc;
            text-align: center;
            padding: 30px;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-actions {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 2;
        }
        .product-card:hover .product-actions {
            opacity: 1;
        }
        .product-actions .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            margin-left: 8px;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-decoration: none;
        }
        .product-actions .btn-action:hover {
            background: #4f46e5;
            color: white;
            transform: scale(1.1);
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #4f46e5;
        }
        .product-price-old {
            font-size: 0.85rem;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .rating {
            color: #fbbf24;
            font-size: 0.8rem;
        }

        .offcanvas {
            width: 320px;
        }
        .filter-section {
            border-bottom: 1px solid #eef2ff;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .pagination-custom .page-link {
            border: none;
            border-radius: 12px;
            margin: 0 4px;
            color: #475569;
            background: transparent;
        }
        .pagination-custom .page-link:hover {
            background: #f1f5f9;
            color: #4f46e5;
        }
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
        }

        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .card {
            background: #1e293b !important;
        }
        body.dark-mode .product-image {
            background: #0f172a;
        }
        body.dark-mode .text-muted {
            color: #94a3b8 !important;
        }
        body.dark-mode .product-actions .btn-action {
            background: #334155;
            color: #cbd5e1;
        }
        body.dark-mode .product-actions .btn-action:hover {
            background: #4f46e5;
            color: white;
        }
        body.dark-mode .filter-section {
            border-bottom-color: #334155;
        }
        body.dark-mode .offcanvas {
            background: #1e293b;
        }
        body.dark-mode .offcanvas .btn-close {
            filter: invert(1);
        }
        body.dark-mode .form-check-label {
            color: #cbd5e1;
        }
        body.dark-mode .pagination-custom .page-link {
            color: #94a3b8;
        }
        body.dark-mode .pagination-custom .page-link:hover {
            background: #334155;
            color: #818cf8;
        }

        @media (max-width: 768px) {
            .product-image {
                padding: 20px;
            }
            .offcanvas {
                width: 280px;
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
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Katalog Produk</h2>
                    <p class="text-muted mt-1">Temukan produk terbaik untuk kebutuhan Anda</p>
                </div>
                <div class="d-flex gap-2 mt-2 mt-sm-0">
                    <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    
                    <div class="input-group" style="width: 200px;">
                        <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Cari produk...">
                        <button class="btn btn-sm btn-primary rounded-pill ms-1">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill dropdown-toggle btn-sm" data-bs-toggle="dropdown">
                            <i class="fas fa-sort-amount-down me-1"></i> Urutkan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Terbaru</a></li>
                            <li><a class="dropdown-item" href="#">Termurah</a></li>
                            <li><a class="dropdown-item" href="#">Termahal</a></li>
                            <li><a class="dropdown-item" href="#">Terlaris</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Offcanvas Filter -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title fw-bold"><i class="fas fa-filter text-primary me-2"></i>Filter Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="filter-section">
                        <label class="fw-semibold mb-2">Kategori</label>
                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cat1"><label class="form-check-label" for="cat1">Sepatu (12)</label></div>
                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cat2"><label class="form-check-label" for="cat2">Pakaian (24)</label></div>
                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cat3"><label class="form-check-label" for="cat3">Aksesoris (8)</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="cat4"><label class="form-check-label" for="cat4">Elektronik (15)</label></div>
                    </div>

                    <div class="filter-section">
                        <label class="fw-semibold mb-2">Rentang Harga</label>
                        <div class="row g-2"><div class="col-6"><input type="number" class="form-control form-control-sm" placeholder="Min"></div><div class="col-6"><input type="number" class="form-control form-control-sm" placeholder="Max"></div></div>
                    </div>

                    <div class="filter-section">
                        <label class="fw-semibold mb-2">Rating</label>
                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="rating"><label class="form-check-label"><i class="fas fa-star text-warning"></i> 5.0 & Up</label></div>
                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="rating"><label class="form-check-label"><i class="fas fa-star text-warning"></i> 4.0 & Up</label></div>
                        <div class="form-check"><input class="form-check-input" type="radio" name="rating"><label class="form-check-label"><i class="fas fa-star text-warning"></i> 3.0 & Up</label></div>
                    </div>

                    <button class="btn btn-primary w-100 rounded-pill mt-3">Terapkan Filter</button>
                    <button class="btn btn-outline-secondary w-100 rounded-pill mt-2" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row">
                <div class="col-12">
                    <div class="row g-4">
                        
                        <!-- Product 1 - Clickable Card -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/1') ?>'">
                                <div class="product-badge"><span class="badge bg-danger rounded-pill px-3 py-2">-30%</span></div>
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/4f46e5/white?text=Shoes" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><span class="text-muted ms-1">(4.5)</span></div>
                                    <h6 class="fw-bold mb-2">Glitter gold Mesh Walking Shoes</h6>
                                    <p class="text-muted small mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$89.00</span><span class="product-price-old">$127.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/2') ?>'">
                                <div class="product-badge"><span class="badge bg-success rounded-pill px-3 py-2">Best Seller</span></div>
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/10b981/white?text=Bag" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><span class="text-muted ms-1">(5.0)</span></div>
                                    <h6 class="fw-bold mb-2">Premium Leather Backpack</h6>
                                    <p class="text-muted small mb-2">Tas ransel kulit premium dengan banyak kompartemen.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$149.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/3') ?>'">
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/f59e0b/white?text=Watch" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><span class="text-muted ms-1">(4.0)</span></div>
                                    <h6 class="fw-bold mb-2">Smart Watch Series 8</h6>
                                    <p class="text-muted small mb-2">Jam tangan pintar dengan fitur kesehatan lengkap.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$299.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/4') ?>'">
                                <div class="product-badge"><span class="badge bg-danger rounded-pill px-3 py-2">-15%</span></div>
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/ef4444/white?text=Jacket" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><span class="text-muted ms-1">(4.7)</span></div>
                                    <h6 class="fw-bold mb-2">Winter Parka Jacket</h6>
                                    <p class="text-muted small mb-2">Jaket tebal anti air cocok untuk musim dingin.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$179.00</span><span class="product-price-old">$210.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 5 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/5') ?>'">
                                <div class="product-badge"><span class="badge bg-info rounded-pill px-3 py-2">New</span></div>
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/06b6d4/white?text=Headphone" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><span class="text-muted ms-1">(4.2)</span></div>
                                    <h6 class="fw-bold mb-2">Wireless Headphone Pro</h6>
                                    <p class="text-muted small mb-2">Headphone nirkabel dengan noise cancellation.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$159.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 6 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card card" onclick="window.location.href='<?= base_url('/ecommerce/product-detail/6') ?>'">
                                <div class="product-image">
                                    <img src="https://placehold.co/400x300/8b5cf6/white?text=Glasses" alt="Product">
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="#" class="btn-action" onclick="event.preventDefault()"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rating mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><span class="text-muted ms-1">(5.0)</span></div>
                                    <h6 class="fw-bold mb-2">Polarized Sunglasses</h6>
                                    <p class="text-muted small mb-2">Kacamata hitam dengan lensa polarisasi UV400.</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div><span class="product-price">$59.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        <nav>
                            <ul class="pagination pagination-custom">
                                <li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-5 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted">© 2026 <strong class="text-primary">Davin Loise</strong> • All rights reserved.</p>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
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