<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Invoice' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
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
/* ========== CUSTOM SCROLLBAR ========== */
/* Light Mode */
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

/* Dark Mode */
body.dark-mode ::-webkit-scrollbar-track {
    background: #1e293b;
}

body.dark-mode ::-webkit-scrollbar-thumb {
    background: #475569;
}

body.dark-mode ::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

/* Firefox */
* {
    scrollbar-width: thin;
}

body.dark-mode {
    scrollbar-color: #475569 #1e293b;
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

@media (max-width: 768px) {
    .search-bar {
        width: auto;
        margin: 0 10px;
    }
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
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            margin-top: 70px;
        }

        /* Dark Mode untuk Cards dan Elemen Lain di View */
        body.dark-mode .card,
        body.dark-mode .card-stat,
        body.dark-mode .card-border,
        body.dark-mode .card-stats {
            background: #1e293b !important;
            border-color: #334155 !important;
        }

        body.dark-mode .card-header {
            background: transparent !important;
            border-bottom-color: #334155 !important;
        }

        body.dark-mode .card-footer {
            background: transparent !important;
            border-top-color: #334155 !important;
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

        body.dark-mode .table,
        body.dark-mode .table-custom td,
        body.dark-mode .table-custom th {
            color: #e2e8f0;
            border-color: #334155;
        }

        body.dark-mode .list-group-item {
            background: transparent;
            color: #e2e8f0;
            border-color: #334155;
        }

        body.dark-mode .list-group-item:hover {
            background: #334155;
        }

        body.dark-mode .progress {
            background-color: #334155;
        }

        body.dark-mode .border {
            border-color: #334155 !important;
        }

        body.dark-mode .btn-light {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        body.dark-mode .btn-light:hover {
            background: #475569;
            color: white;
        }

        body.dark-mode .alert-light {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        body.dark-mode .badge.bg-light {
            background: #334155 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .badge.bg-white {
            background: #334155 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .breadcrumb-item a {
            color: #94a3b8;
        }

        body.dark-mode .breadcrumb-item.active {
            color: #818cf8;
        }

        body.dark-mode .breadcrumb-item+.breadcrumb-item::before {
            color: #64748b;
        }

        body.dark-mode .dropdown-menu {
            background: #1e293b;
            border-color: #334155;
        }

        body.dark-mode .dropdown-item {
            color: #cbd5e1;
        }

        body.dark-mode .dropdown-item:hover {
            background: #334155;
            color: #e2e8f0;
        }

        body.dark-mode .modal-content {
            background: #1e293b;
            border-color: #334155;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #334155;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background: #0f172a;
            color: #e2e8f0;
        }

        body.dark-mode .input-group-text {
            background: #334155;
            border-color: #475569;
            color: #cbd5e1;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        .main-content {
            margin-left: 280px;
            padding: 0;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            margin-top: 70px;
        }

        /* Saat sidebar collapsed (hilang), main content melebar ke kiri */
        .main-content.expanded {
            margin-left: 0;
        }

        /* Responsive untuk mobile */
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
            font-family: 'Public Sans', 'Inter', sans-serif;
            background: #f5f7fc;
        }

        .card-border {
            border-radius: 16px;
            border: 1px solid #e9ecef;
            transition: all 0.3s;
            background: white;
        }

        .card-border:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        .avtar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .trend-up {
            color: #10b981;
        }

        .trend-down {
            color: #ef4444;
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
    </style>
</head>

<body>
    <?= view('layout/navbar') ?><!-- Sidebar -->
    <?= view('layout/sidebar_new') ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid px-4 py-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard Invoice</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="page-header mb-4">
                <h2 class="fw-bold mb-0" style="color: #0f172a;">Dashboard Invoice</h2>
                <p class="text-muted">Kelola invoice, pembayaran, dan laporan keuangan</p>
            </div>

            <!-- Row 1: 4 Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-border">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Total</h6>
                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                    <i class="fas fa-arrow-up text-warning"></i> 20.3%
                                </p>
                            </div>
                            <h5 class="mb-2 mt-3 fw-bold">Rp 5,678.09</h5>
                            <div class="d-flex align-items-center gap-1">
                                <h5 class="mb-0">3</h5>
                                <p class="mb-0 text-muted">invoice</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-border">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Dibayar</h6>
                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                    <i class="fas fa-arrow-down text-danger"></i> -8.73%
                                </p>
                            </div>
                            <h5 class="mb-2 mt-3 fw-bold">Rp 5,678.09</h5>
                            <div class="d-flex align-items-center gap-1">
                                <h5 class="mb-0">5</h5>
                                <p class="mb-0 text-muted">invoice</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-border">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Tertunda</h6>
                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                    <i class="fas fa-arrow-up text-success"></i> 10.73%
                                </p>
                            </div>
                            <h5 class="mb-2 mt-3 fw-bold">Rp 5,678.09</h5>
                            <div class="d-flex align-items-center gap-1">
                                <h5 class="mb-0">20</h5>
                                <p class="mb-0 text-muted">invoice</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-border">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Jatuh Tempo</h6>
                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                    <i class="fas fa-arrow-down text-primary"></i> -4.73%
                                </p>
                            </div>
                            <h5 class="mb-2 mt-3 fw-bold">Rp 5,678.09</h5>
                            <div class="d-flex align-items-center gap-1">
                                <h5 class="mb-0">5</h5>
                                <p class="mb-0 text-muted">invoice</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Chart & Menu Icons -->
            <div class="row g-4 mb-4">
                <div class="col-lg-9">
                    <div class="card card-border">
                        <div class="card-body">
                            <div id="invoiceChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-border">
                        <div class="card-body">
                            <div class="row g-3 text-center">
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-primary rounded-circle mx-auto mb-2">
                                                <i class="fas fa-file-invoice text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Semua Invoice</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-info rounded-circle mx-auto mb-2">
                                                <i class="fas fa-chart-line text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Laporan</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-success rounded-circle mx-auto mb-2">
                                                <i class="fas fa-dollar-sign text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Dibayar</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-warning rounded-circle mx-auto mb-2">
                                                <i class="fas fa-clock text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Tertunda</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-danger rounded-circle mx-auto mb-2">
                                                <i class="fas fa-times-circle text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Dibatalkan</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-0 shadow-none mb-0">
                                        <div class="card-body py-4 px-2 bg-light rounded-3">
                                            <div class="avtar bg-secondary rounded-circle mx-auto mb-2">
                                                <i class="fas fa-pen-fancy text-white"></i>
                                            </div>
                                            <h6 class="mb-0 mt-2">Draf</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Recent Invoice, Total Expenses, Notification -->
            <div class="row g-4">
                <!-- Recent Invoice -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-border">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold">Invoice Terbaru</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Mingguan</a></li>
                                        <li><a class="dropdown-item" href="#">Bulanan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="avatar" class="rounded-circle" width="40" height="40">
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <h6 class="mb-1">David Jones <span class="text-muted">- #790841</span></h6>
                                            <p class="mb-0 text-primary fw-bold">Rp 329.20</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">5 menit lalu</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="avatar" class="rounded-circle" width="40" height="40">
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <h6 class="mb-1">Jenny Jones <span class="text-muted">- #790841</span></h6>
                                            <p class="mb-0 text-primary fw-bold">Rp 329.20</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">1 hari lalu</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="avatar" class="rounded-circle" width="40" height="40">
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <h6 class="mb-1">Harry Ben <span class="text-muted">- #790841</span></h6>
                                            <p class="mb-0 text-primary fw-bold">Rp 329.20</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">3 minggu lalu</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="avatar" class="rounded-circle" width="40" height="40">
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <h6 class="mb-1">Jenifer Vintage <span class="text-muted">- #790841</span></h6>
                                            <p class="mb-0 text-primary fw-bold">Rp 329.20</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">3 minggu lalu</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 pt-3">
                                    <div class="d-grid">
                                        <button class="btn btn-outline-secondary rounded-pill">Lihat Semua</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Total Expenses -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-border">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold">Total Pengeluaran</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Mingguan</a></li>
                                        <li><a class="dropdown-item" href="#">Bulanan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="expensesChart" style="height: 200px;"></div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2 pending-item" style="cursor: pointer;">
                                    <h6 class="mb-0"><i class="fas fa-circle text-warning me-2"></i> Tertunda</h6>
                                    <p class="mb-0 fw-bold">Rp 3,202</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 paid-item" style="cursor: pointer;">
                                    <h6 class="mb-0"><i class="fas fa-circle text-success me-2"></i> Dibayar</h6>
                                    <p class="mb-0 fw-bold">Rp 45,050</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 overdue-item" style="cursor: pointer;">
                                    <h6 class="mb-0"><i class="fas fa-circle text-danger me-2"></i> Jatuh Tempo</h6>
                                    <p class="mb-0 fw-bold">Rp 25,000</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center draft-item" style="cursor: pointer;">
                                    <h6 class="mb-0"><i class="fas fa-circle text-secondary me-2"></i> Draf</h6>
                                    <p class="mb-0 fw-bold">Rp 7,694</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification -->
                <div class="col-xl-4 col-md-12">
                    <div class="card card-border">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold">Notifikasi</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Mingguan</a></li>
                                        <li><a class="dropdown-item" href="#">Bulanan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar bg-light-success rounded-circle me-3">
                                            <i class="fas fa-download text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Johnny mengirimi Anda invoice sebesar <strong class="text-primary">Rp 1,000</strong>.</h6>
                                            <small class="text-muted">2 Agustus</small>
                                        </div>
                                        <a href="#" class="text-muted"><i class="fas fa-link"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar bg-light-primary rounded-circle me-3">
                                            <i class="fas fa-file-invoice text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Mengirim invoice kepada Aida Bugg sebesar <strong class="text-primary">Rp 200</strong>.</h6>
                                            <small class="text-muted">7 jam lalu</small>
                                        </div>
                                        <a href="#" class="text-muted"><i class="fas fa-link"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar bg-light-danger rounded-circle me-3">
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Terjadi kegagalan pada pengaturan Anda</h6>
                                            <small class="text-muted">7 jam lalu</small>
                                        </div>
                                        <a href="#" class="text-muted"><i class="fas fa-link"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 pt-3">
                                    <div class="d-grid">
                                        <button class="btn btn-outline-secondary rounded-pill">Lihat Semua</button>
                                    </div>
                                </li>
                            </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Invoice Chart
        var invoiceOptions = {
            series: [{
                name: 'Pendapatan',
                data: [31, 40, 28, 51, 42, 85, 77, 60, 55, 68, 45, 70]
            }, {
                name: 'Pengeluaran',
                data: [11, 32, 45, 32, 34, 52, 41, 38, 44, 58, 35, 48]
            }],
            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                }
            },
            colors: ['#4f46e5', '#f59e0b'],
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.1
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
            },
            tooltip: {
                shared: true
            }
        };
        new ApexCharts(document.querySelector("#invoiceChart"), invoiceOptions).render();

        // Expenses Chart (Donut)
        var expensesOptions = {
            series: [3202, 45050, 25000, 7694],
            chart: {
                type: 'donut',
                height: 200
            },
            labels: ['Tertunda', 'Dibayar', 'Jatuh Tempo', 'Draf'],
            colors: ['#f59e0b', '#10b981', '#ef4444', '#6c757d'],
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '14px',
                                fontWeight: 600,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '18px',
                                fontWeight: 'bold',
                                color: '#1e293b',
                                offsetY: 10,
                                formatter: function(val) {
                                    return 'Rp ' + val.toLocaleString();
                                }
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '12px',
                                color: '#6c757d',
                                formatter: function(w) {
                                    var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    return 'Rp ' + total.toLocaleString();
                                }
                            }
                        }
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return 'Rp ' + val.toLocaleString();
                    }
                }
            }
        };

        var expensesChart = new ApexCharts(document.querySelector("#expensesChart"), expensesOptions);
        expensesChart.render();

        function updateCenterText(label, value) {
            expensesChart.updateOptions({
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                name: {
                                    formatter: function() {
                                        return label;
                                    }
                                },
                                value: {
                                    formatter: function() {
                                        return 'Rp ' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

        document.querySelector('.pending-item').addEventListener('click', function() {
            updateCenterText('Tertunda', 3202);
        });
        document.querySelector('.paid-item').addEventListener('click', function() {
            updateCenterText('Dibayar', 45050);
        });
        document.querySelector('.overdue-item').addEventListener('click', function() {
            updateCenterText('Jatuh Tempo', 25000);
        });
        document.querySelector('.draft-item').addEventListener('click', function() {
            updateCenterText('Draf', 7694);
        });
    </script>
</body>

</html>