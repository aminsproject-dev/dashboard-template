<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Statistics Widgets' ?></title>

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

        /* Main Content */
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

        /* Breadcrumb */
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

        /* Card Styles */
        .card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.03);
            height: 100%;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            background: rgba(79, 70, 229, 0.12);
            border-radius: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4f46e5;
            font-size: 1.8rem;
        }

        .badge-trend-up {
            background: #e6f9ed;
            color: #2b7e3a;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
        }

        .badge-trend-down {
            background: #fee2e2;
            color: #dc2626;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
        }

        .progress-custom {
            height: 6px;
            border-radius: 12px;
            background-color: #e2e8f0;
        }
        .progress-custom .progress-bar {
            border-radius: 12px;
        }

        /* Tab Navigation Styles */
        .nav-pills .nav-link {
            color: #475569;
            background: transparent;
            border-radius: 30px;
            padding: 10px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        .nav-pills .nav-link:hover {
            background: #f1f5f9;
            color: #4f46e5;
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        /* Tab Stats Card */
        .tab-stats-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
        }
        .tab-stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .card {
            background: #1e293b !important;
            border-color: #334155 !important;
        }
        body.dark-mode .tab-stats-card {
            background: #1e293b !important;
            border-color: #334155 !important;
        }
        body.dark-mode .text-muted {
            color: #94a3b8 !important;
        }
        body.dark-mode .text-dark {
            color: #e2e8f0 !important;
        }
        body.dark-mode .bg-light {
            background: #334155 !important;
        }
        body.dark-mode .badge-trend-up {
            background: rgba(52, 211, 153, 0.15) !important;
            color: #34d399 !important;
        }
        body.dark-mode .badge-trend-down {
            background: rgba(248, 113, 113, 0.15) !important;
            color: #f87171 !important;
        }
        body.dark-mode .progress-custom {
            background-color: #334155 !important;
        }
        body.dark-mode .nav-pills .nav-link {
            color: #cbd5e1;
        }
        body.dark-mode .nav-pills .nav-link:hover {
            background: #334155;
            color: #818cf8;
        }
        body.dark-mode .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
        }
        body.dark-mode .badge.bg-light {
            background: #334155 !important;
            color: #e2e8f0 !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card, .tab-stats-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        /* Scroll to top button */
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

        @media (max-width: 768px) {
            .nav-pills .nav-link {
                padding: 6px 14px;
                font-size: 0.75rem;
            }
            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
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
                    
                    <li class="breadcrumb-item active" aria-current="page">Widget / Statistik</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Statistik</h2>
                <p class="text-muted">Berbagai widget statistik untuk memantau performa Anda.</p>
            </div>

            <!-- ========== TAB NAVIGATION (MON - SUN) ========== -->
            <ul class="nav nav-pills align-items-center justify-content-center mb-5 gap-2 flex-wrap" id="stats-tab" role="tablist">
                <li class="nav-item"><button class="nav-link" id="mon-tab" data-bs-toggle="pill" data-bs-target="#mon" type="button">Senin</button></li>
                <li class="nav-item"><button class="nav-link" id="tue-tab" data-bs-toggle="pill" data-bs-target="#tue" type="button">Selasa</button></li>
                <li class="nav-item"><button class="nav-link" id="wed-tab" data-bs-toggle="pill" data-bs-target="#wed" type="button">Rabu</button></li>
                <li class="nav-item"><button class="nav-link" id="thu-tab" data-bs-toggle="pill" data-bs-target="#thu" type="button">Kamis</button></li>
                <li class="nav-item"><button class="nav-link active" id="fri-tab" data-bs-toggle="pill" data-bs-target="#fri" type="button">Jumat</button></li>
                <li class="nav-item"><button class="nav-link" id="sat-tab" data-bs-toggle="pill" data-bs-target="#sat" type="button">Sabtu</button></li>
                <li class="nav-item"><button class="nav-link" id="sun-tab" data-bs-toggle="pill" data-bs-target="#sun" type="button">Minggu</button></li>
            </ul>

            <!-- Tab Content (Earnings & Expenses per day) -->
            <div class="tab-content mb-5" id="stats-tabContent">
                <!-- Monday -->
                <div class="tab-pane fade" id="mon">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 984,632</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 10%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 134,276</h2><div class="mt-2"><span class="badge-trend-down"><i class="fas fa-arrow-down me-1"></i> 12%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Tuesday -->
                <div class="tab-pane fade" id="tue">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 876,543</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 8%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 145,890</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 5%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Wednesday -->
                <div class="tab-pane fade" id="wed">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 765,432</h2><div class="mt-2"><span class="badge-trend-down"><i class="fas fa-arrow-down me-1"></i> 3%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 156,789</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 7%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Thursday -->
                <div class="tab-pane fade" id="thu">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 892,345</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 15%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 123,456</h2><div class="mt-2"><span class="badge-trend-down"><i class="fas fa-arrow-down me-1"></i> 2%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Friday (Active) -->
                <div class="tab-pane fade show active" id="fri">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 1,234,567</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 25%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 98,765</h2><div class="mt-2"><span class="badge-trend-down"><i class="fas fa-arrow-down me-1"></i> 15%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Saturday -->
                <div class="tab-pane fade" id="sat">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 543,210</h2><div class="mt-2"><span class="badge-trend-down"><i class="fas fa-arrow-down me-1"></i> 5%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 187,654</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 10%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
                <!-- Sunday -->
                <div class="tab-pane fade" id="sun">
                    <div class="row g-4">
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h2 class="mt-2 fw-bold display-6">Rp 654,321</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 12%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-dollar-sign"></i></div></div></div></div>
                        <div class="col-md-6"><div class="tab-stats-card"><div class="d-flex justify-content-between align-items-start"><div><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h2 class="mt-2 fw-bold display-6">Rp 210,987</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 8%</span> <span class="text-muted small ms-2">vs minggu lalu</span></div></div><div class="stat-icon"><i class="fas fa-credit-card"></i></div></div></div></div>
                    </div>
                </div>
            </div>

            <!-- ========== WIDGET STATISTIK LAINNYA ========== -->
            
            <!-- Row 1: Order Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pesanan Online</span><h2 class="mt-2 fw-bold display-6">237 <span class="fs-5 text-muted">/400</span></h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 36%</span> <span class="text-muted small ms-2">Pesanan Pengiriman</span></div></div>
                            <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pesanan Tertunda</span><h2 class="mt-2 fw-bold display-6">100 <span class="fs-5 text-muted">/500</span></h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 20%</span> <span class="text-muted small ms-2">Pesanan Pengiriman</span></div></div>
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pesanan Dikembalikan</span><h2 class="mt-2 fw-bold display-6">50 <span class="fs-5 text-muted">/400</span></h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 10%</span> <span class="text-muted small ms-2">Pesanan Dikembalikan</span></div></div>
                            <div class="stat-icon"><i class="fas fa-undo-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: User Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pengguna Terdaftar</span><h2 class="mt-2 fw-bold">1205</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 20%</span> <span class="text-muted small ms-2">Peningkatan Bulanan</span></div></div>
                            <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pengguna Harian</span><h2 class="mt-2 fw-bold">467</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 10%</span> <span class="text-muted small ms-2">Peningkatan Mingguan</span></div></div>
                            <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pengguna Premium</span><h2 class="mt-2 fw-bold">346</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 50%</span> <span class="text-muted small ms-2">Peningkatan Tahunan</span></div></div>
                            <div class="stat-icon"><i class="fas fa-crown"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Mixed Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Total Pengunjung</span><h2 class="mt-2 fw-bold display-5">235</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 20%</span> <span class="text-muted small ms-2">Lebih dari bulan lalu</span></div></div>
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><span class="text-muted text-uppercase small fw-semibold">Paket dalam perjalanan</span><h2 class="mt-2 fw-bold">25 <span class="fs-4 text-muted">/40</span></h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> +15%</span> <span class="text-muted small ms-2">bulan lalu</span></div></div>
                            <div class="stat-icon"><i class="fas fa-box"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Product Earn & Earnings Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pendapatan Produk</span><h2 class="mt-2 fw-bold">375</h2><div class="mt-2"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 36%</span></div></div>
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1"><span class="small">Produk Terjual</span><span class="small fw-bold">375</span></div>
                            <div class="progress progress-custom"><div class="progress-bar bg-primary" style="width: 75%"></div></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3 p-xl-4">
                        <div class="row g-3">
                            <div class="col-6"><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h3 class="mt-2 fw-bold">984,632</h3><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 10%</span></div>
                            <div class="col-6"><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h3 class="mt-2 fw-bold">134,276</h3><span class="badge-trend-up"><i class="fas fa-arrow-down me-1 text-danger"></i> 12%</span></div>
                            <div class="col-6"><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h3 class="mt-2 fw-bold">222,586</h3><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 30%</span></div>
                            <div class="col-6"><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h3 class="mt-2 fw-bold">344,624</h3><span class="badge-trend-up"><i class="fas fa-arrow-down me-1 text-danger"></i> 12%</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 5: Earnings Grid 4 Column -->
            <div class="row g-4 mb-4">
                <div class="col-md-3"><div class="card p-3 text-center"><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h3 class="mt-2 fw-bold">984,632</h3><span class="badge-trend-up d-inline-block mx-auto"><i class="fas fa-arrow-up me-1"></i> 10%</span></div></div>
                <div class="col-md-3"><div class="card p-3 text-center"><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h3 class="mt-2 fw-bold">134,276</h3><span class="badge-trend-up d-inline-block mx-auto"><i class="fas fa-arrow-down me-1 text-danger"></i> 12%</span></div></div>
                <div class="col-md-3"><div class="card p-3 text-center"><span class="text-muted text-uppercase small fw-semibold">Total Pendapatan</span><h3 class="mt-2 fw-bold">222,586</h3><span class="badge-trend-up d-inline-block mx-auto"><i class="fas fa-arrow-up me-1"></i> 30%</span></div></div>
                <div class="col-md-3"><div class="card p-3 text-center"><span class="text-muted text-uppercase small fw-semibold">Total Pengeluaran</span><h3 class="mt-2 fw-bold">344,624</h3><span class="badge-trend-up d-inline-block mx-auto"><i class="fas fa-arrow-down me-1 text-danger"></i> 12%</span></div></div>
            </div>

            <!-- Row 6: Pendapatan Card -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4">
                        <div class="d-flex justify-content-between">
                            <div><span class="text-muted text-uppercase small fw-semibold">Pendapatan</span><h2 class="mt-2 fw-bold display-6">3.15k</h2></div>
                            <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 7: Statistik Gabungan (Pengguna + Pendapatan Bulanan + Rilis) -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4 text-center">
                        <span class="text-muted text-uppercase small fw-semibold">Total Pengguna</span>
                        <h2 class="mt-2 fw-bold display-5">56,908</h2>
                        <span class="badge-trend-up d-inline-block mt-2"><i class="fas fa-arrow-up me-1"></i> 12.5%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4 text-center">
                        <span class="text-muted text-uppercase small fw-semibold">Pendapatan Bulanan</span>
                        <h2 class="mt-2 fw-bold display-5">Rp 3,569</h2>
                        <span class="badge-trend-up d-inline-block mt-2"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 p-xl-4 text-center">
                        <span class="text-muted text-uppercase small fw-semibold">Rilis Versi Baru</span>
                        <h2 class="mt-2 fw-bold display-5">350</h2>
                        <span class="badge bg-primary d-inline-block mt-2 px-3 py-2 rounded-pill">v2.63.3</span>
                        <p class="text-muted small mt-2 mb-0">Terbaru pada 29 Sep</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-5 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted" style="font-family: 'Inter', sans-serif; font-size: 0.8rem;">
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
    </script>
</body>
</html>