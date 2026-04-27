<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Affiliate' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        /* ========== DARK MODE KHUSUS UNTUK AFFILIATE.PHP ========== */

        /* Card stats di dark mode */
        body.dark-mode .card-stat {
            background: #1e293b !important;
            border: 1px solid #334155 !important;
        }

        /* Badge trend up di dark mode */
        body.dark-mode .badge-trend-up {
            background: rgba(52, 211, 153, 0.15) !important;
            color: #34d399 !important;
        }

        /* Stat icon di dark mode */
        body.dark-mode .stat-icon {
            background: rgba(129, 140, 248, 0.15) !important;
            color: #818cf8 !important;
        }

        /* Table custom di dark mode */
        body.dark-mode .table-custom td {
            color: #e2e8f0 !important;
            border-bottom-color: #334155 !important;
        }

        body.dark-mode .table-custom th {
            color: #94a3b8 !important;
            border-bottom-color: #334155 !important;
        }

        /* Affiliate avatar di dark mode */
        body.dark-mode .affiliate-avatar {
            background: rgba(129, 140, 248, 0.15) !important;
            color: #818cf8 !important;
        }

        /* Progress bar affiliate di dark mode */
        body.dark-mode .progress-affiliate {
            background-color: #334155 !important;
        }

        body.dark-mode .progress-affiliate .progress-bar {
            background: #818cf8 !important;
        }

        /* Badge bg-light di dark mode */
        body.dark-mode .badge.bg-light {
            background: #334155 !important;
            color: #e2e8f0 !important;
            border: none !important;
        }

        /* Top visitor item di dark mode */
        body.dark-mode .top-visitor-item {
            background: transparent !important;
        }

        body.dark-mode .top-visitor-item:hover {
            background: #334155 !important;
        }

        body.dark-mode .top-visitor-item .text-dark {
            color: #fbbf24 !important;
        }

        body.dark-mode .top-visitor-item .fw-semibold {
            color: #e2e8f0 !important;
        }

        /* Alert di card footer dark mode */
        body.dark-mode .alert.alert-light {
            background: #334155 !important;
            border: none !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .alert.alert-light strong {
            color: #fbbf24 !important;
        }

        body.dark-mode .alert.alert-light .text-primary {
            color: #818cf8 !important;
        }

        /* Recent affiliate activities dark mode */
        body.dark-mode .card-stat.card .row.g-3 .col-md-4 {
            color: #e2e8f0 !important;
        }

        body.dark-mode .card-stat.card .row.g-3 .col-md-4 span {
            color: #e2e8f0 !important;
        }

        body.dark-mode .card-stat.card .row.g-3 .col-md-4 strong {
            color: #fbbf24 !important;
        }

        /* Icon di recent activities */
        body.dark-mode .card-stat.card .row.g-3 .col-md-4 .fa-user-plus {
            color: #818cf8 !important;
        }

        body.dark-mode .card-stat.card .row.g-3 .col-md-4 .fa-chart-line {
            color: #34d399 !important;
        }

        body.dark-mode .card-stat.card .row.g-3 .col-md-4 .fa-trophy {
            color: #fbbf24 !important;
        }

        /* HR line di dark mode */
        body.dark-mode .card-stat.card hr {
            border-color: #334155 !important;
            opacity: 1;
        }

        /* Card header clean di dark mode */
        body.dark-mode .card-header-clean {
            border-bottom-color: #334155 !important;
        }

        body.dark-mode .section-title {
            color: #e2e8f0 !important;
        }

        /* Chart canvas di dark mode (background transparan) */
        body.dark-mode canvas {
            filter: brightness(0.9);
        }

        /* Breadcrumb di dark mode (sudah ada, tapi pastikan) */
        body.dark-mode .breadcrumb-item a {
            color: #94a3b8 !important;
        }

        body.dark-mode .breadcrumb-item.active {
            color: #818cf8 !important;
        }

        /* Text muted tambahan */
        body.dark-mode .text-muted.small {
            color: #94a3b8 !important;
        }

        /* Badge trend up di tabel */
        body.dark-mode .badge-trend-up i {
            color: #34d399 !important;
        }

        /* Footer di dark mode */
        body.dark-mode footer .text-muted {
            color: #94a3b8 !important;
        }

        body.dark-mode footer .text-primary {
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

        body.dark-mode .search-bar .input-group {
            background: #1e293b !important;
            border: 1px solid #334155 !important;
        }

        body.dark-mode .search-bar .input-group:focus-within {
            background: #0f172a !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2) !important;
        }

        body.dark-mode .search-bar input {
            background: transparent !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .search-bar input::placeholder {
            color: #64748b !important;
        }

        body.dark-mode .search-bar .input-group-text {
            background: transparent !important;
            border: none !important;
            color: #94a3b8 !important;
        }

        body.dark-mode .search-bar kbd {
            background: #0f172a !important;
            color: #94a3b8 !important;
            border: 1px solid #334155 !important;
        }

        body.dark-mode .search-bar .btn-link {
            color: #94a3b8 !important;
        }

        body.dark-mode .search-bar .btn-link:hover {
            color: #818cf8 !important;
        }

        /* Perbaikan agar search bar tidak terpotong */
        .search-bar {
            width: 320px;
        }

        .search-bar .input-group {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .search-bar input {
            flex: 1;
            min-width: 0;
        }

        .search-bar .btn-link {
            white-space: nowrap;
        }

        @media (max-width: 992px) {
            .search-bar {
                width: 250px;
            }
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

        @media (max-width: 768px) {
            .search-bar {
                width: auto;
                margin: 0 10px;
            }
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fc;
            scroll-behavior: smooth;
        }

        .card-stat {
            border: none;
            border-radius: 1.5rem;
            background: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02), 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .card-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            background: rgba(99, 102, 241, 0.12);
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

        .table-custom th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #5b6e8c;
            border-bottom-width: 1px;
            padding: 1rem 0.5rem 0.8rem 0.5rem;
        }

        .table-custom td {
            vertical-align: middle;
            padding: 0.9rem 0.5rem;
            font-weight: 500;
            color: #1e293b;
            border-bottom: 1px solid #edf2f7;
        }

        .affiliate-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #4f46e5;
            margin-right: 12px;
        }

        .progress-affiliate {
            height: 6px;
            border-radius: 12px;
            background-color: #e2e8f0;
        }

        .progress-affiliate .progress-bar {
            background: #4f46e5;
            border-radius: 12px;
        }

        .card-header-clean {
            background: transparent;
            border-bottom: 1px solid #eef2ff;
            padding: 1.2rem 1.5rem;
            font-weight: 700;
        }

        .top-visitor-item:hover {
            background: #f8fafd;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: -0.2px;
            color: #0f172a;
        }

        /* Dark Mode untuk Cards */
        body.dark-mode .card,
        body.dark-mode .card-stat {
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
    </style>
</head>

<body>
    <?= view('layout/navbar') ?>
    <?= view('layout/sidebar_new') ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-xl py-4 py-lg-5">
            <!-- Header -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-1">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">
                                Afiliasi
                            </li>
                        </ol>
                    </nav>
                    <h1 class="display-6 fw-bold" style="color: #0f172a;">Afiliasi <span style="background: linear-gradient(135deg, #4f46e5, #7c3aed); background-clip: text; -webkit-background-clip: text; color: transparent;">Dashboard</span></h1>
                    <p class="text-muted mt-1">Pantau referral, pendapatan & performer terbaik — semua dalam satu tampilan.</p>
                </div>
            </div>

            <!-- Stats Cards (3 card) -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card-stat card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase small fw-semibold">Referral</span>
                                <h2 class="mt-2 fw-bold display-6">Rp <?= $stats['referrals']['value'] ?></h2>
                                <div class="mt-2 d-flex align-items-center flex-wrap gap-1">
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> <?= $stats['referrals']['growth'] ?></span>
                                    <span class="text-muted small">dibanding bulan lalu</span>
                                </div>
                            </div>
                            <div class="stat-icon"><i class="fas fa-<?= $stats['referrals']['icon'] ?>"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-stat card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase small fw-semibold">Tingkat Konversi</span>
                                <h2 class="mt-2 fw-bold display-6"><?= $stats['conversion']['value'] ?></h2>
                                <div class="mt-2 d-flex align-items-center flex-wrap gap-1">
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> <?= $stats['conversion']['growth'] ?></span>
                                    <span class="text-muted small">dibanding sebelumnya</span>
                                </div>
                            </div>
                            <div class="stat-icon"><i class="fas fa-<?= $stats['conversion']['icon'] ?>"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-stat card p-3 p-xl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase small fw-semibold">Kunjungan</span>
                                <h2 class="mt-2 fw-bold display-6"><?= $stats['visits']['value'] ?></h2>
                                <div class="mt-2 d-flex align-items-center flex-wrap gap-1">
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> <?= $stats['visits']['growth'] ?></span>
                                    <span class="text-muted small">dibanding minggu lalu</span>
                                </div>
                            </div>
                            <div class="stat-icon"><i class="fas fa-<?= $stats['visits']['icon'] ?>"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Afiliasi - FULL WIDTH -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card-stat card h-100">
                        <div class="card-header-clean d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <span class="section-title"><i class="fas fa-trophy me-2 text-warning"></i>Daftar Afiliasi</span>
                            <a href="#" class="text-decoration-none small fw-semibold">Lihat semua <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Afiliasi</th>
                                            <th>Kampanye</th>
                                            <th>Pendapatan</th>
                                            <th>Pertumbuhan</th>
                                            <th>Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($affiliates as $aff): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="affiliate-avatar"><i class="fas fa-<?= $aff['avatar'] ?>"></i></div>
                                                        <span class="fw-semibold"><?= $aff['name'] ?></span>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-light text-dark px-3 py-2 rounded-pill"><?= $aff['campaign'] ?></span></td>
                                                <td class="fw-bold">Rp <?= number_format($aff['earnings']) ?></td>
                                                <td><span class="badge-trend-up"><i class="fas fa-arrow-up"></i> <?= $aff['growth'] ?>%</span></td>
                                                <td style="width: 120px;">
                                                    <div class="progress progress-affiliate">
                                                        <div class="progress-bar" style="width: <?= $aff['progress'] ?>%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pengunjung Teratas - DI BAWAH -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card-stat card h-100">
                        <div class="card-header-clean">
                            <span class="section-title"><i class="fas fa-crown me-2 text-warning"></i>Pengunjung Teratas</span>
                            <p class="text-muted small mb-0 mt-1">Pendapatan & engagement tertinggi</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <?php foreach ($topVisitors as $visitor): ?>
                                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center py-3 top-visitor-item px-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="affiliate-avatar bg-warning bg-opacity-10">
                                                <i class="fas fa-<?= $visitor['avatar'] ?> text-warning"></i>
                                            </div>
                                            <span class="fw-semibold"><?= $visitor['name'] ?></span>
                                        </div>
                                        <div class="text-end">
                                            <span class="fw-bold text-dark">Rp <?= number_format($visitor['earnings']) ?></span>
                                            <span class="badge-trend-up ms-2">+<?= $visitor['growth'] ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-3 pb-3">
                            <div class="alert alert-light border-0 rounded-3 p-3 mb-0 small d-flex align-items-center gap-2">
                                <i class="fas fa-chart-line text-primary fs-6"></i>
                                <span>Afiliasi teratas <strong>Adeline</strong> mencatat peningkatan trafik tertinggi, yaitu <strong class="text-success">+32%</strong> minggu ini.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row mt-2 g-4">
                <div class="col-12">
                    <div class="card-stat card p-3 p-lg-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0"><i class="fas fa-fire-flame me-2 text-danger"></i>Aktivitas Afiliasi Terbaru</h6>
                            </div>
                            <div class="mt-2 mt-sm-0">
                                <span class="text-muted small"><i class="far fa-clock me-1"></i> Diperbarui 5 menit lalu</span>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row g-3">
                            <div class="col-md-4 d-flex align-items-center gap-2">
                                <i class="fas fa-user-plus text-primary"></i>
                                <span>Afiliasi baru: <strong>Sarah K.</strong> bergabung</span>
                            </div>
                            <div class="col-md-4 d-flex align-items-center gap-2">
                                <i class="fas fa-chart-line text-success"></i>
                                <span>Rekor konversi: <strong class="text-success">+12%</strong> kemarin</span>
                            </div>
                            <div class="col-md-4 d-flex align-items-center gap-2">
                                <i class="fas fa-trophy text-warning"></i>
                                <span>Peraih pendapatan tertinggi <strong>Adeline</strong> mencapai <strong>Rp 1,8 juta</strong></span>
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
                    All rights reserved.
                </p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>