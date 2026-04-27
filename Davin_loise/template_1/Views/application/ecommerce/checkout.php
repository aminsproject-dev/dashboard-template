<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Checkout' ?> </title>

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
            background: #f8fafc;
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

        .card {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Nav Pills Style */
        .nav-pills .nav-link {
            color: #475569;
            background: #f1f5f9;
            border-radius: 30px;
            padding: 10px 28px;
            font-weight: 600;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        .nav-pills .nav-link:hover {
            background: #e2e8f0;
            color: #4f46e5;
        }
        .nav-pills .nav-link.active {
            background: #4f46e5;
            color: white;
        }

        /* Cart Item */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #eef2ff;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item-image {
            width: 70px;
            height: 70px;
            background: #f8fafc;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }
        .cart-item-image img {
            max-width: 50px;
        }

        /* Quantity Selector */
        .qty-wrapper {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 30px;
            overflow: hidden;
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-weight: 600;
        }
        .qty-btn:hover {
            background: #e2e8f0;
        }
        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            outline: none;
            font-weight: 500;
        }

        /* Method Card */
        .method-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 12px;
            background: #ffffff;
        }
        .method-card:hover {
            border-color: #4f46e5;
            background: #f8fafc;
        }
        .method-card.selected {
            border-color: #4f46e5;
            background: #eef2ff;
        }

        /* Form Input */
        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
            font-size: 0.9rem;
            background: #ffffff;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        /* Buttons */
        .btn-block {
            width: 100%;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .btn-primary {
            background: #4f46e5;
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: #4338ca;
        }
        .btn-outline {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #475569;
        }
        .btn-outline:hover {
            border-color: #4f46e5;
            color: #4f46e5;
            background: #f8fafc;
        }

        /* Summary Card */
        .summary-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 20px;
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
        body.dark-mode .cart-item {
            border-bottom-color: #334155;
        }
        body.dark-mode .cart-item-image {
            background: #0f172a;
        }
        body.dark-mode .qty-wrapper {
            background: #334155;
        }
        body.dark-mode .qty-btn:hover {
            background: #475569;
        }
        body.dark-mode .method-card {
            border-color: #334155;
            background: #1e293b;
        }
        body.dark-mode .method-card:hover {
            background: #334155;
        }
        body.dark-mode .method-card.selected {
            background: #334155;
            border-color: #4f46e5;
        }
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .summary-card {
            background: #0f172a;
        }
        body.dark-mode .nav-pills .nav-link {
            background: #334155;
            color: #cbd5e1;
        }
        body.dark-mode .nav-pills .nav-link:hover {
            background: #475569;
            color: #818cf8;
        }
        body.dark-mode .nav-pills .nav-link.active {
            background: #4f46e5;
            color: white;
        }
        body.dark-mode .btn-outline {
            background: transparent;
            border-color: #334155;
            color: #94a3b8;
        }
        body.dark-mode .btn-outline:hover {
            background: #334155;
            border-color: #4f46e5;
            color: #818cf8;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-wrap: wrap;
                gap: 10px;
            }
            .nav-pills .nav-link {
                padding: 6px 16px;
                font-size: 0.75rem;
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
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Checkout</h2>
                <p class="text-muted mt-1">Selesaikan pesanan Anda</p>
            </div>

            <!-- Step Indicator dengan Nav Pills -->
            <ul class="nav nav-pills align-items-center justify-content-center mb-5 gap-2 flex-wrap" id="checkout-tab" role="tablist">
                <li class="nav-item"><button class="nav-link active" id="cart-tab" data-bs-toggle="pill" data-bs-target="#cart" type="button" role="tab">Keranjang</button></li>
                <li class="nav-item"><button class="nav-link" id="shipping-tab" data-bs-toggle="pill" data-bs-target="#shipping" type="button" role="tab">Pengiriman</button></li>
                <li class="nav-item"><button class="nav-link" id="payment-tab" data-bs-toggle="pill" data-bs-target="#payment" type="button" role="tab">Pembayaran</button></li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="checkout-tabContent">
                
                <!-- Tab 1: Keranjang -->
                <div class="tab-pane fade show active" id="cart" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="card p-4">
                                <h5 class="fw-bold mb-3">Keranjang Belanja</h5>
                                <div class="cart-item">
                                    <div class="cart-item-image"><img src="https://placehold.co/50x50/4f46e5/white?text=Shoes" alt="Product"></div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">Glitter Gold Mesh Walking Shoes</h6>
                                        <small class="text-muted">Size: 42 | Color: Gold</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="qty-wrapper">
                                            <button class="qty-btn">-</button>
                                            <input type="text" value="1" class="qty-input">
                                            <button class="qty-btn">+</button>
                                        </div>
                                        <div class="mt-2">
                                            <span class="fw-bold text-primary">$89.00</span>
                                            <a href="#" class="text-danger ms-3"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-item">
                                    <div class="cart-item-image"><img src="https://placehold.co/50x50/10b981/white?text=Bag" alt="Product"></div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">Premium Leather Backpack</h6>
                                        <small class="text-muted">Color: Brown</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="qty-wrapper">
                                            <button class="qty-btn">-</button>
                                            <input type="text" value="1" class="qty-input">
                                            <button class="qty-btn">+</button>
                                        </div>
                                        <div class="mt-2">
                                            <span class="fw-bold text-primary">$149.00</span>
                                            <a href="#" class="text-danger ms-3"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card p-4">
                                <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal</span>
                                    <span class="fw-semibold">$238.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pengiriman</span>
                                    <span>Free</span>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold fs-4 text-primary">$238.00</span>
                                </div>
                                <button class="btn btn-primary btn-block nextTab" data-next="shipping-tab">Lanjut ke Pengiriman</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Pengiriman -->
                <div class="tab-pane fade" id="shipping" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="card p-4">
                                <h5 class="fw-bold mb-3">Informasi Pengiriman</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Depan</label>
                                        <input type="text" class="form-control" value="Davin">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" class="form-control" value="Loise">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="Gmail.com">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="tel" class="form-control" placeholder="+62 xxx xxx xxx">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" placeholder="Alamat lengkap">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kota</label>
                                        <input type="text" class="form-control" placeholder="Kota">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-select">
                                            <option>Pilih Provinsi</option>
                                            <option>DKI Jakarta</option>
                                            <option>Jawa Barat</option>
                                            <option>Jawa Tengah</option>
                                            <option>Jawa Timur</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" placeholder="Kode pos">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card p-4">
                                <h5 class="fw-bold mb-3">Metode Pengiriman</h5>
                                <div class="method-card selected" data-shipping="regular" data-cost="0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-truck me-2 text-primary"></i>Reguler</span>
                                        <span class="fw-bold text-primary">Free</span>
                                    </div>
                                    <small class="text-muted">Estimasi 3-5 hari</small>
                                </div>
                                <div class="method-card" data-shipping="express" data-cost="10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-rocket me-2 text-primary"></i>Express</span>
                                        <span class="fw-bold text-primary">$10.00</span>
                                    </div>
                                    <small class="text-muted">Estimasi 1-2 hari</small>
                                </div>
                                <div class="method-card" data-shipping="same" data-cost="25">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-clock me-2 text-primary"></i>Same Day</span>
                                        <span class="fw-bold text-primary">$25.00</span>
                                    </div>
                                    <small class="text-muted">Hari ini</small>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline btn-block prevTab" data-prev="cart-tab">Kembali</button>
                                    <button class="btn btn-primary btn-block nextTab" data-next="payment-tab">Lanjut ke Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Pembayaran -->
                <div class="tab-pane fade" id="payment" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="card p-4">
                                <h5 class="fw-bold mb-3">Metode Pembayaran</h5>
                                <div class="method-card selected" data-payment="card">
                                    <div class="d-flex align-items-center">
                                        <i class="fab fa-cc-visa fs-2 me-3"></i>
                                        <div>
                                            <span class="fw-semibold">Kartu Kredit / Debit</span>
                                            <br><small class="text-muted">Visa, Mastercard, Amex</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="method-card" data-payment="bank">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-university fs-2 me-3"></i>
                                        <div>
                                            <span class="fw-semibold">Transfer Bank</span>
                                            <br><small class="text-muted">BCA, Mandiri, BNI, BRI</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="method-card" data-payment="ewallet">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-wallet fs-2 me-3"></i>
                                        <div>
                                            <span class="fw-semibold">E-Wallet</span>
                                            <br><small class="text-muted">GoPay, OVO, Dana</small>
                                        </div>
                                    </div>
                                </div>
                                <div id="cardDetails" class="mt-4">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Nomor Kartu</label>
                                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Kadaluarsa</label>
                                            <input type="text" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">CVV</label>
                                            <input type="text" class="form-control" placeholder="123">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control" placeholder="Davin Loise">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="summary-card">
                                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal</span>
                                    <span>$238.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pengiriman</span>
                                    <span id="summaryShipping">Free</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">PPN (11%)</span>
                                    <span>$26.18</span>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold fs-3 text-primary" id="summaryTotal">$264.18</span>
                                </div>
                                <div class="alert alert-light border-0 p-3 mb-3">
                                    <i class="fas fa-lock text-primary me-2"></i>
                                    <small>Transaksi aman & terenkripsi</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline btn-block prevTab" data-prev="shipping-tab">Kembali</button>
                                    <button class="btn btn-primary btn-block" id="placeOrderBtn">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
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
        // Tab Navigation
        const tabTriggerList = [].slice.call(document.querySelectorAll('#checkout-tab button'));
        const tabList = tabTriggerList.map(function(triggerEl) {
            return new bootstrap.Tab(triggerEl);
        });

        // Next Tab
        document.querySelectorAll('.nextTab').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-next');
                const targetTrigger = document.querySelector(`#${targetId}`);
                if (targetTrigger) {
                    bootstrap.Tab.getOrCreateInstance(targetTrigger).show();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        // Prev Tab
        document.querySelectorAll('.prevTab').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-prev');
                const targetTrigger = document.querySelector(`#${targetId}`);
                if (targetTrigger) {
                    bootstrap.Tab.getOrCreateInstance(targetTrigger).show();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        // Shipping Method Selection
        let shippingCost = 0;
        document.querySelectorAll('[data-shipping]').forEach(method => {
            method.addEventListener('click', () => {
                document.querySelectorAll('[data-shipping]').forEach(m => m.classList.remove('selected'));
                method.classList.add('selected');
                shippingCost = parseInt(method.getAttribute('data-cost')) || 0;
                const shippingText = shippingCost === 0 ? 'Free' : '$' + shippingCost + '.00';
                document.getElementById('summaryShipping').innerHTML = shippingText;
                const total = 238 + shippingCost;
                const tax = total * 0.11;
                document.getElementById('summaryTotal').innerHTML = '$' + (total + tax).toFixed(2);
            });
        });

        // Payment Method Selection
        const cardDetails = document.getElementById('cardDetails');
        document.querySelectorAll('[data-payment]').forEach(method => {
            method.addEventListener('click', () => {
                document.querySelectorAll('[data-payment]').forEach(m => m.classList.remove('selected'));
                method.classList.add('selected');
                cardDetails.style.display = method.getAttribute('data-payment') === 'card' ? 'block' : 'none';
            });
        });

        // Place Order
        document.getElementById('placeOrderBtn').addEventListener('click', () => {
            alert('Pesanan Anda telah berhasil dibuat!\nTerima kasih telah berbelanja.');
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
            if (window.scrollY > 300) scrollBtn.classList.add('show');
            else scrollBtn.classList.remove('show');
        });
        scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        const style = document.createElement('style');
        style.textContent = `.scroll-top-btn { position: fixed; bottom: 30px; right: 30px; width: 45px; height: 45px; background: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); } .scroll-top-btn.show { opacity: 1; visibility: visible; } .scroll-top-btn:hover { background: #4338ca; transform: translateY(-3px); }`;
        document.head.appendChild(style);
    </script>
</body>
</html>