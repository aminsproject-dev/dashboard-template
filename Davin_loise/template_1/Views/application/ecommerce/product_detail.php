<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Product Detail' ?></title>

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
        }

        .product-image {
            background: #f8fafc;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
        }

        .rating {
            color: #fbbf24;
        }

        .quantity-input {
            width: 120px;
            display: flex;
            align-items: center;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            overflow: hidden;
        }
        .quantity-input button {
            width: 36px;
            height: 36px;
            border: none;
            background: #f1f5f9;
            cursor: pointer;
            transition: all 0.2s;
        }
        .quantity-input button:hover {
            background: #e2e8f0;
        }
        .quantity-input input {
            width: 48px;
            text-align: center;
            border: none;
            outline: none;
            background: white;
        }

        /* Dark Mode */
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
        body.dark-mode .border {
            border-color: #334155 !important;
        }
        body.dark-mode .quantity-input {
            border-color: #334155;
        }
        body.dark-mode .quantity-input button {
            background: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .quantity-input button:hover {
            background: #475569;
        }
        body.dark-mode .quantity-input input {
            background: #1e293b;
            color: #e2e8f0;
        }
        body.dark-mode .bg-light {
            background: #334155 !important;
        }

        @media (max-width: 768px) {
            .product-image {
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
                    <li class="breadcrumb-item"><a href="<?= base_url('/ecommerce/product') ?>">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $product['name'] ?></li>
                </ol>
            </nav>

            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="product-image">
                            <img src="https://placehold.co/500x400/<?= $product['color'] ?? '4f46e5' ?>/white?text=<?= urlencode($product['image'] ?? $product['name']) ?>" alt="<?= $product['name'] ?>">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <?php if (isset($product['discount']) && $product['discount'] > 0): ?>
                            <span class="badge bg-danger mb-3" style="width: fit-content;">-<?= $product['discount'] ?>%</span>
                        <?php endif; ?>
                        
                        <h2 class="fw-bold mb-2"><?= $product['name'] ?></h2>
                        
                        <div class="rating mb-2">
                            <?php
                            $rating = $product['rating'] ?? 0;
                            $fullStars = floor($rating);
                            $halfStar = ($rating - $fullStars) >= 0.5;
                            for ($i = 1; $i <= 5; $i++):
                                if ($i <= $fullStars):
                                    echo '<i class="fas fa-star"></i>';
                                elseif ($halfStar && $i == $fullStars + 1):
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                else:
                                    echo '<i class="far fa-star"></i>';
                                endif;
                            endfor;
                            ?>
                            <span class="text-muted ms-2">(<?= number_format($rating, 1) ?>)</span>
                        </div>

                        <div class="mb-3">
                            <?php if (isset($product['old_price']) && $product['old_price']): ?>
                                <span class="text-muted text-decoration-line-through me-2">$<?= number_format($product['old_price'], 2) ?></span>
                            <?php endif; ?>
                            <span class="product-price fs-2 fw-bold text-primary">$<?= number_format($product['price'], 2) ?></span>
                        </div>

                        <p class="text-muted mb-3"><?= $product['description'] ?></p>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Detail Produk:</small>
                            <p class="small"><?= $product['details'] ?? 'Tidak ada informasi tambahan' ?></p>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Brands:</small>
                            <p class="small fw-semibold"><?= $product['brands'] ?? '-' ?></p>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-2 text-center">
                                    <small class="text-muted d-block">Stok</small>
                                    <span class="fw-bold"><?= $product['stock'] ?? 0 ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-2 text-center">
                                    <small class="text-muted d-block">Terjual</small>
                                    <span class="fw-bold"><?= $product['sold'] ?? 0 ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light rounded-3 p-2 text-center">
                                    <small class="text-muted d-block">Rating</small>
                                    <span class="fw-bold"><?= number_format($rating, 1) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-4">
                            <label class="fw-semibold mb-2">Jumlah</label>
                            <div class="quantity-input">
                                <button type="button" id="minusBtn">-</button>
                                <input type="number" id="quantity" value="1" min="1" max="<?= $product['stock'] ?? 999 ?>">
                                <button type="button" id="plusBtn">+</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-grow-1 rounded-pill" id="buyNowBtn">
                                <i class="fas fa-shopping-cart me-2"></i> Beli Sekarang
                            </button>
                            <button class="btn btn-outline-primary rounded-circle" style="width: 48px;" id="wishlistBtn">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="btn btn-outline-primary rounded-circle" style="width: 48px;" id="shareBtn">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Quantity Selector
        const quantityInput = document.getElementById('quantity');
        const minusBtn = document.getElementById('minusBtn');
        const plusBtn = document.getElementById('plusBtn');
        const maxStock = <?= $product['stock'] ?? 999 ?>;

        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            } else {
                alert('Stok tersedia hanya ' + maxStock + ' item');
            }
        });

        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxStock) {
                this.value = maxStock;
                alert('Stok tersedia hanya ' + maxStock + ' item');
            }
        });

        // Buy Now Button
        document.getElementById('buyNowBtn').addEventListener('click', function() {
            const quantity = quantityInput.value;
            alert('Menambahkan ' + quantity + ' item ke keranjang!\nHalaman checkout akan segera hadir.');
        });

        // Wishlist Button
        document.getElementById('wishlistBtn').addEventListener('click', function() {
            alert('Produk ditambahkan ke wishlist!');
        });

        // Share Button
        document.getElementById('shareBtn').addEventListener('click', function() {
            alert('Fitur share akan segera hadir!');
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
            .product-price {
                color: #4f46e5;
            }
            body.dark-mode .product-price {
                color: #818cf8;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>