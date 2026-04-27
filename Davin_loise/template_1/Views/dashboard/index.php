<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">

    <style>
        body.dark-mode .card.h-100.border-0.shadow-sm,
        body.dark-mode .card-header.bg-white,
        body.dark-mode .card-footer.bg-white {
            background: #1e293b !important;
        }

        body.dark-mode .card-header.bg-white {
            border-bottom-color: #334155 !important;
        }

        body.dark-mode .card-footer.bg-white {
            border-top-color: #334155 !important;
        }

        body.dark-mode .list-group-item {
            background: transparent !important;
            border-color: #334155 !important;
        }

        body.dark-mode .list-group-item .text-muted {
            color: #94a3b8 !important;
        }

        body.dark-mode .list-group-item h6 {
            color: #e2e8f0 !important;
        }

        body.dark-mode .badge.bg-success.bg-opacity-10.text-success {
            background: rgba(52, 211, 153, 0.15) !important;
            color: #34d399 !important;
        }

        body.dark-mode .rounded-circle.bg-primary.bg-opacity-10 {
            background: rgba(129, 140, 248, 0.15) !important;
        }

        body.dark-mode .rounded-circle.bg-primary.bg-opacity-10 i {
            color: #818cf8 !important;
        }

        /* ========== FIX WARNA ANGKA DI MODE DARK ========== */
        body.dark-mode {
            --text-light: #e2e8f0;
            --text-primary-light: #818cf8;
            --text-success-light: #34d399;
            --text-warning-light: #fbbf24;
        }

        body.dark-mode .fw-bold,
        body.dark-mode .fw-semibold,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6,
        body.dark-mode .card h2,
        body.dark-mode .card h3,
        body.dark-mode .card .fw-bold,
        body.dark-mode .table-custom td,
        body.dark-mode .card-body .fw-bold {
            color: var(--text-light) !important;
        }

        /* Angka uang (Rp) jadi warna ungu terang */
        body.dark-mode .card-stat h2,
        body.dark-mode .card-stats h2,
        body.dark-mode .card-border h5,
        body.dark-mode .card-border h3,
        body.dark-mode .display-6 {
            color: var(--text-primary-light) !important;
        }

        /* Trend positif (hijau) */
        body.dark-mode .trend-up,
        body.dark-mode .text-success {
            color: var(--text-success-light) !important;
        }

        /* Trend negatif (merah) */
        body.dark-mode .trend-down,
        body.dark-mode .text-danger {
            color: #f87171 !important;
        }

        /* Total balance / earning utama (kuning) */
        body.dark-mode .card .text-center h3,
        body.dark-mode .total-earnings {
            color: var(--text-warning-light) !important;
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

        /* ========== STYLE SAMA SEPERTI FINANCE ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Public Sans', 'Inter', sans-serif;
            background: #f5f7fc;
        }

        .card-border {
            border-radius: 20px;
            border: 1px solid #e9ecef;
            transition: all 0.3s;
            background: white;
        }

        .card-border:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .trend-up {
            color: #28a745;
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

        /* ========== DARK MODE CARDS ========== */
        body.dark-mode .card,
        body.dark-mode .card-border {
            background: #1e293b !important;
            border-color: #334155 !important;
        }

        body.dark-mode .card-header {
            background: transparent !important;
            border-bottom-color: #334155 !important;
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

        body.dark-mode .bg-white {
            background: #1e293b !important;
        }

        body.dark-mode .border {
            border-color: #334155 !important;
        }

        body.dark-mode .btn-light {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        /* ========== CUSTOM SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        body.dark-mode ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        body.dark-mode ::-webkit-scrollbar-thumb {
            background: #475569;
        }

        body.dark-mode ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        * {
            scrollbar-width: thin;
        }

        body.dark-mode {
            scrollbar-color: #475569 #1e293b;
        }

        /* Dark mode untuk rating stars */
        body.dark-mode .rating-star .fas.fa-star,
        body.dark-mode .rating-star .fas.fa-star-half-alt {
            color: #fbbf24 !important;
            /* bintang aktif: kuning */
        }

        body.dark-mode .rating-star .far.fa-star {
            color: #475569 !important;
            /* bintang kosong: abu-abu gelap */
        }



        body.dark-mode .fs-2.text-muted {
            color: #94a3b8 !important;
            /* angka /5 jadi abu-abu */
        }

        body.dark-mode .progress-bar.bg-warning {
            background-color: #fbbf24 !important;
            /* progress bar rating */
        }

        body.dark-mode .progress {
            background-color: #334155 !important;
        }
    </style>
</head>

<body>
    <!-- Navbar dulu, baru sidebar (SAMA SEPERTI FINANCE) -->
    <?= view('layout/navbar') ?>
    <?= view('layout/sidebar_new') ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid px-4 py-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Analitik</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="page-header mb-4">
                <h2 class="fw-bold mb-0" style="color: #0f172a;">Beranda <span style="background: linear-gradient(135deg, #4f46e5, #7c3aed); background-clip: text; -webkit-background-clip: text; color: transparent;">Dashboard</span></h2>
                <p class="text-muted">Selamat datang kembali, Davin! Berikut ringkasan penjualan Anda</p>
            </div>

            <!-- Row 1: 3 Main Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card-border card p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Penjualan Harian</p>
                                <h2 class="mb-2 fw-bold">Rp <?= number_format($daily_sales, 0, ',', '.') ?></h2>
                                <span class="trend-up"><i class="fas fa-arrow-up"></i> <?= $daily_percent ?>%</span>
                                <small class="text-muted ms-2">dibanding hari sebelumnya</small>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="fas fa-calendar-day text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-border card p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Penjualan Bulanan</p>
                                <h2 class="mb-2 fw-bold">Rp <?= number_format($monthly_sales, 0, ',', '.') ?></h2>
                                <span class="trend-up"><i class="fas fa-arrow-up"></i> <?= $monthly_percent ?>%</span>
                                <small class="text-muted ms-2">dibanding bulan sebelumnya</small>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10">
                                <i class="fas fa-calendar-alt text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-border card p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Penjualan Tahunan</p>
                                <h2 class="mb-2 fw-bold">Rp <?= number_format($yearly_sales, 0, ',', '.') ?></h2>
                                <span class="trend-up"><i class="fas fa-arrow-up"></i> <?= $yearly_percent ?>%</span>
                                <small class="text-muted">dibanding tahun sebelumnya</small>
                            </div>
                            <div class="stat-icon bg-info bg-opacity-10">
                                <i class="fas fa-chart-line text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row: Stats + Chart -->
            <div class="row g-4 mb-4">
                <div class="col-md-5">
                    <div class="card-border card mb-4 p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Total Pendapatan</p>
                                <h2 class="mb-0 fw-bold">Rp <?= number_format($total_earnings, 0, ',', '.') ?></h2>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10">
                                <i class="fas fa-money-bill text-success fs-4"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-border card mb-4 p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Total Ide</p>
                                <h2 class="mb-0 fw-bold"><?= number_format($total_ideas, 0, ',', '.') ?></h2>
                            </div>
                            <div class="stat-icon bg-warning bg-opacity-10">
                                <i class="fas fa-lightbulb text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-border card p-3 p-xl-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Total Lokasi</p>
                                <h2 class="mb-0 fw-bold"><?= number_format($total_location) ?></h2>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card-border card h-100 p-3 p-xl-4">
                        <h5 class="mb-3 fw-bold">Pengguna dari Amerika Serikat</h5>
                        <canvas id="userChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Social Media Stats -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card card-stats h-100">
                        <div class="card-header bg-primary text-white">
                            <i class="fab fa-facebook-f me-2"></i> Facebook
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Total Suka</p>
                                    <h3 class="mb-0">12.281</h3>
                                </div>
                                <div class="stat-icon bg-danger bg-opacity-10">
                                    <i class="fas fa-heart text-danger"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Target</p>
                                    <h3 class="mb-0">35.098</h3>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10">
                                    <i class="fas fa-bullseye text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Interaksi</p>
                                    <h3 class="mb-0">3.539</h3>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10">
                                    <i class="fas fa-clock text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card card-stats h-100">
                        <div class="card-header" style="background: linear-gradient(45deg, #f09433, #d62976, #962fbf); color: white;">
                            <i class="fab fa-instagram me-2"></i> Instagram
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Total Suka</p>
                                    <h3 class="mb-0">15.432</h3>
                                </div>
                                <div class="stat-icon bg-danger bg-opacity-10">
                                    <i class="fas fa-heart text-danger"></i>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Target</p>
                                    <h3 class="mb-0">50.000</h3>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10">
                                    <i class="fas fa-bullseye text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Interaksi</p>
                                    <h3 class="mb-0">2.150</h3>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10">
                                    <i class="fas fa-clock text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card card-stats h-100">
                        <div class="card-header bg-dark text-white">
                            <i class="fab fa-tiktok me-2"></i> TikTok
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Total Suka</p>
                                    <h3 class="mb-0">28.901</h3>
                                </div>
                                <div class="stat-icon bg-danger bg-opacity-10">
                                    <i class="fas fa-heart text-danger"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <p class="text-muted mb-1">Target</p>
                                    <h3 class="mb-0">100.000</h3>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10">
                                    <i class="fas fa-bullseye text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Interaksi</p>
                                    <h3 class="mb-0">5.678</h3>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10">
                                    <i class="fas fa-clock text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users & Rating -->
            <div class="row mb-4">
                <div class="col-md-7 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4">
                            <h5 class="mb-0">
                                <i class="fas fa-users text-primary me-2"></i> Pengguna Terbaru
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <?php foreach ($recent_users as $user): ?>
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                                        <i class="fas fa-user text-primary fs-5"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-bold"><?= $user['name'] ?></h6>
                                                    <p class="text-muted mb-1 small">
                                                        <i class="fab fa-android me-1"></i> <?= $user['role'] ?>
                                                    </p>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i> <?= $user['time'] ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="badge bg-success bg-opacity-10 text-success p-2">
                                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-arrow-right me-1"></i> Lihat semua pengguna
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-star text-warning me-2"></i> Rating
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h1 class="display-2 fw-bold text-primary"><?= $rating ?><span class="fs-2 text-muted">/5</span></h1>
                                <div class="rating-star mt-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= floor($rating)): ?>
                                            <i class="fas fa-star fs-3"></i>
                                        <?php elseif ($i - $rating < 1 && $i - $rating > 0): ?>
                                            <i class="fas fa-star-half-alt fs-3"></i>
                                        <?php else: ?>
                                            <i class="far fa-star fs-3"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-muted mt-2">Berdasarkan 554 ulasan</p>
                            </div>

                            <?php foreach ($rating_details as $star => $count): ?>
                                <div class="d-flex align-items-center mb-2">
                                    <div style="width: 60px;">
                                        <span class="fw-bold"><?= $star ?></span>
                                        <i class="fas fa-star text-warning fa-xs"></i>
                                    </div>
                                    <div class="progress flex-grow-1 mx-2" style="height: 8px; border-radius: 10px;">
                                        <div class="progress-bar bg-warning" style="width: <?= ($count / array_sum($rating_details)) * 100 ?>%; border-radius: 10px;"></div>
                                    </div>
                                    <div style="width: 50px;" class="text-muted">
                                        <?= number_format($count) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <hr>
                            <div class="d-flex justify-content-around text-center mt-3">
                                <div>
                                    <h5 class="mb-0 text-success">4.8</h5>
                                    <small class="text-muted">Bulan Lalu</small>
                                </div>
                                <div>
                                    <h5 class="mb-0 text-danger">4.6</h5>
                                    <small class="text-muted">Bulan Ini</small>
                                </div>
                                <div>
                                    <h5 class="mb-0 text-primary">+0.2</h5>
                                    <small class="text-muted">Peningkatan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <footer class="mt-5 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted" style="font-family: 'Inter', sans-serif; font-size: 0.8rem;">
                    © 2026
                    <strong class="text-primary">Davin Loise</strong>
                    <span class="mx-2">•</span>
                    Hak Cipta Dilindungi.
                </p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pengguna dari Amerika Serikat',
                    data: [650, 720, 800, 750, 820, 900, 880, 950, 1020, 1100, 1150, 1200],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>

</html>