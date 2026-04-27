<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Helpdesk' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        /* ========== PERBAIKAN DARK MODE UNTUK HELPDESK ========== */

/* Customer Satisfaction Card */
body.dark-mode .satisfaction-card {
    background: #1e293b !important;
    border: 1px solid #334155 !important;
}

body.dark-mode .satisfaction-card .text-primary {
    color: #818cf8 !important;
}

body.dark-mode .satisfaction-card .btn-light {
    background: #334155 !important;
    border-color: #475569 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .satisfaction-card .btn-light:hover {
    background: #475569 !important;
}

/* Progress bar di satisfaction card */
body.dark-mode .satisfaction-card .progress {
    background-color: #334155 !important;
}

body.dark-mode .satisfaction-card .progress-bar {
    background-color: #38bdf8 !important;
}

/* Text di satisfaction card */
body.dark-mode .satisfaction-card .fw-bold {
    color: #e2e8f0 !important;
}

body.dark-mode .satisfaction-card .text-muted {
    color: #94a3b8 !important;
}

/* Latest Activity Card */
body.dark-mode .card.border-0.shadow-sm.rounded-4 {
    background: #1e293b !important;
    border: 1px solid #334155 !important;
}

body.dark-mode .card-header.bg-transparent {
    background: #1e293b !important;
    border-bottom-color: #334155 !important;
}

body.dark-mode .card-header.bg-transparent h5 {
    color: #e2e8f0 !important;
}

body.dark-mode .card-header.bg-transparent .btn-light {
    background: #334155 !important;
    border-color: #475569 !important;
    color: #e2e8f0 !important;
}

/* Activity items */
body.dark-mode .activity-item {
    background: transparent !important;
    border-bottom: 1px solid #334155 !important;
}

body.dark-mode .activity-item:hover {
    background: #334155 !important;
}

body.dark-mode .activity-item h6 {
    color: #e2e8f0 !important;
}

body.dark-mode .activity-item .text-muted {
    color: #94a3b8 !important;
}

/* Badge di activity */
body.dark-mode .badge.bg-primary {
    background: #4f46e5 !important;
    color: white !important;
}

body.dark-mode .badge.bg-success {
    background: #10b981 !important;
    color: white !important;
}

body.dark-mode .badge.bg-warning {
    background: #f59e0b !important;
    color: white !important;
}

body.dark-mode .badge.bg-danger {
    background: #ef4444 !important;
    color: white !important;
}

/* Icon background di activity */
body.dark-mode .bg-primary.bg-opacity-10 {
    background: rgba(79, 70, 229, 0.15) !important;
}

body.dark-mode .bg-success.bg-opacity-10 {
    background: rgba(16, 185, 129, 0.15) !important;
}

body.dark-mode .bg-warning.bg-opacity-10 {
    background: rgba(245, 158, 11, 0.15) !important;
}

body.dark-mode .bg-danger.bg-opacity-10 {
    background: rgba(239, 68, 68, 0.15) !important;
}

/* Icon colors */
body.dark-mode .activity-item .text-primary {
    color: #818cf8 !important;
}

body.dark-mode .activity-item .text-success {
    color: #34d399 !important;
}

body.dark-mode .activity-item .text-warning {
    color: #fbbf24 !important;
}

body.dark-mode .activity-item .text-danger {
    color: #f87171 !important;
}

/* Card footer */
body.dark-mode .card-footer.bg-transparent {
    background: #1e293b !important;
    border-top-color: #334155 !important;
}

body.dark-mode .card-footer a {
    color: #818cf8 !important;
}

body.dark-mode .card-footer a:hover {
    color: #a78bfa !important;
}

/* Social Media Sources Cards */
body.dark-mode .card.border-0.shadow-sm.rounded-4 .card-header {
    background: #1e293b !important;
    border-bottom-color: #334155 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .card-header h5 {
    color: #e2e8f0 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .card-body .text-muted {
    color: #94a3b8 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .card-body .fw-bold {
    color: #e2e8f0 !important;
}

/* Tickets Answered Card */
body.dark-mode .card.border-0.shadow-sm.rounded-4 .bg-primary {
    background: #4f46e5 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .text-primary {
    color: #818cf8 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .text-muted {
    color: #94a3b8 !important;
}

body.dark-mode .card.border-0.shadow-sm.rounded-4 .fw-bold {
    color: #e2e8f0 !important;
}

/* Dropdown menu di dark mode */
body.dark-mode .dropdown-menu {
    background: #1e293b !important;
    border-color: #334155 !important;
}

body.dark-mode .dropdown-item {
    color: #cbd5e1 !important;
}

body.dark-mode .dropdown-item:hover {
    background: #334155 !important;
    color: #e2e8f0 !important;
}

/* Scrollbar untuk latest-scroll */
body.dark-mode .latest-scroll::-webkit-scrollbar-track {
    background: #1e293b;
}

body.dark-mode .latest-scroll::-webkit-scrollbar-thumb {
    background: #475569;
}

body.dark-mode .latest-scroll::-webkit-scrollbar-thumb:hover {
    background: #64748b;
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

        /* Angka uang ($) jadi warna ungu terang */
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
@media (max-width: 768px) {
    .search-bar {
        width: auto;
        margin: 0 10px;
    }
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

        .card-border-top {
            border-top: 4px solid #7dd3fc;
            border-radius: 16px;
            transition: all 0.3s;
            background: white;
        }

        .card-border-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .satisfaction-card {
            background: white;
            border-radius: 24px;
            transition: all 0.3s;
        }

        .satisfaction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .latest-scroll {
            max-height: 380px;
            overflow-y: auto;
        }

        .activity-item {
            transition: all 0.3s;
            border-radius: 16px;
            cursor: pointer;
        }

        .activity-item:hover {
            background-color: #f0f9ff;
            transform: translateX(8px);
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
        body.dark-mode .satisfaction-card .d-flex.justify-content-between.align-items-center.mb-2 span {
    color: #e2e8f0 !important;
}

body.dark-mode .satisfaction-card .fw-bold {
    color: #e2e8f0 !important;
}

/* Warna icon lingkaran tetap di dark mode (biar tetap keliatan) */
body.dark-mode .satisfaction-card .fa-circle {
    opacity: 0.9;
}

/* Perbaikan untuk teks di progress bar */
body.dark-mode .satisfaction-card .text-muted {
    color: #94a3b8 !important;
}

/* Warna untuk teks persentase */
body.dark-mode .satisfaction-card .fw-bold {
    color: #cacaca !important;
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
                    <li class="breadcrumb-item active" aria-current="page">Dashboard Helpdesk</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0" style="color: #0f172a;">Dashboard Bantuan</h2>
                    <p class="text-muted mt-1">Kelola tiket dukungan dan kepuasan pelanggan</p>
                </div>
            </div>

            <!-- 3 Support Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-border-top border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h2 class="fw-bold mb-2">350</h2>
                                    <span class="text-info fw-semibold">Permintaan Dukungan</span>
                                    <p class="mb-0 mt-2 text-muted small">Jumlah total permintaan dukungan yang masuk.</p>
                                </div>
                                <div class="bg-info bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-headset text-info fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <div class="row text-center">
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">10</h5>
                                    <small class="text-muted">Terbuka</small>
                                </div>
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">5</h5>
                                    <small class="text-muted">Sedang Diproses</small>
                                </div>
                                <div class="col">
                                    <h5 class="mb-0 fw-bold">3</h5>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-border-top border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h2 class="fw-bold mb-2">500</h2>
                                    <span class="text-primary fw-semibold">Respon Agen</span>
                                    <p class="mb-0 mt-2 text-muted small">Jumlah total respons dari agen.</p>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-user-tie text-primary fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <div class="row text-center">
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">50</h5>
                                    <small class="text-muted">Terbuka</small>
                                </div>
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">75</h5>
                                    <small class="text-muted">Sedang Diproses</small>
                                </div>
                                <div class="col">
                                    <h5 class="mb-0 fw-bold">30</h5>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12">
                    <div class="card card-border-top border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h2 class="fw-bold mb-2">800</h2>
                                    <span class="text-success fw-semibold">Dukungan Selesai</span>
                                    <p class="mb-0 mt-2 text-muted small">Jumlah total tiket yang telah terselesaikan.</p>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-check-double text-success fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <div class="row text-center">
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">80</h5>
                                    <small class="text-muted">Terbuka</small>
                                </div>
                                <div class="col border-end">
                                    <h5 class="mb-0 fw-bold">60</h5>
                                    <small class="text-muted">Sedang Diproses</small>
                                </div>
                                <div class="col">
                                    <h5 class="mb-0 fw-bold">90</h5>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Satisfaction with PIE Chart -->
            <div class="row g-4 mb-4">
    <div class="col-xl-7 col-md-12">
        <div class="satisfaction-card p-4 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-start mb-">
                <div>
                    <h4 class="fw-bold text-primary mb-1">Kepuasan Pelanggan</h4>
                    <p class="text-muted small mt-2 mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        <a href="#" class="text-primary text-decoration-none">Pelajari lebih lanjut <i class="fas fa-arrow-right ms-1"></i></a>
                    </p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-chart-line me-1"></i> Bulan Ini
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                        <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                        <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                    </ul>
                </div>
            </div>

            <div class="row align-items-center mt-3">
                <div class="col-md-6 text-center">
                    <div id="satisfactionPieChart" style="height: 280px; width: 100%;"></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-circle" style="color: #38bdf8;"></i> Sangat Puas</span>
                            <span class="fw-bold">35.5%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 35.5%; background-color: #38bdf8;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-circle" style="color: #7dd3fc;"></i> Puas</span>
                            <span class="fw-bold">26.9%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 26.9%; background-color: #7dd3fc;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-circle" style="color: #bae6fd;"></i> Buruk</span>
                            <span class="fw-bold">21.5%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 21.5%; background-color: #bae6fd;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-circle" style="color: #e0f2fe;"></i> Sangat Buruk</span>
                            <span class="fw-bold">16.1%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 16.1%; background-color: #e0f2fe;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <!-- Latest Activity -->
                <div class="col-xl-5 col-md-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 d-flex align-items-center justify-content-between pt-4">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-clock text-primary me-2"></i>Aktivitas Terbaru
                            </h5>
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
                        <div class="latest-scroll">
                            <div class="card-body pt-0">
                                <div class="activity-item d-flex align-items-center p-3 mb-2">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                        <i class="fas fa-ticket-alt text-primary fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Tiket baru #12345 dibuat</h6>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> 5 menit yang lalu</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Baru</span>
                                </div>

                                <div class="activity-item d-flex align-items-center p-3 mb-2">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Tiket #12340 diselesaikan oleh Agen Mike</h6>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> 15 menit yang lalu</small>
                                    </div>
                                    <span class="badge bg-success rounded-pill">Selesai</span>
                                </div>

                                <div class="activity-item d-flex align-items-center p-3 mb-2">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                                        <i class="fas fa-comment text-warning fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Komentar baru pada tiket #12338</h6>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> 1 jam yang lalu</small>
                                    </div>
                                    <span class="badge bg-warning rounded-pill">Komentar</span>
                                </div>

                                <div class="activity-item d-flex align-items-center p-3 mb-2">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                                        <i class="fas fa-exclamation-triangle text-danger fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Tiket #12335 ditingkatkan ke agen senior</h6>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> Kemarin, 15:30</small>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">Ditingkatkan</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center pb-4">
                            <a href="#" class="text-primary text-decoration-none">Lihat semua Aktivitas <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Sources -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <h5 class="mb-0 fw-bold">
                                <i class="fab fa-facebook-f text-primary me-2"></i> Sumber Facebook
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Profil Halaman</span>
                                    <span class="fw-bold">25%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 25%;"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Favorit</span>
                                    <span class="fw-bold">85%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 85%;"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Like</span>
                                    <span class="fw-bold">65%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 pt-4">
                            <h5 class="mb-0 fw-bold">
                                <i class="fab fa-twitter text-info me-2"></i> Sumber Twitter
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Halaman Profil</span>
                                    <span class="fw-bold">85%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-info" style="width: 85%;"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Favorit</span>
                                    <span class="fw-bold">25%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-info" style="width: 25%;"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Suka Cuitan</span>
                                    <span class="fw-bold">65%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-info" style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Answered Card -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-4 bg-primary rounded-start-4 d-flex align-items-center justify-content-center" style="min-height: 120px;">
                                    <i class="fas fa-book-open text-white fs-1"></i>
                                </div>
                                <div class="col-8">
                                    <div class="p-3">
                                        <h2 class="fw-bold mb-1">379</h2>
                                        <p class="text-muted mb-0">Tiket <span class="text-primary fw-bold">Terjawab</span></p>
                                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var pieOptions = {
            series: [35.5, 26.9, 21.5, 16.1],
            chart: {
                type: 'pie',
                height: 280,
                toolbar: {
                    show: false
                }
            },
            labels: ['Sangat Buruk', 'Puas', 'Sangat Puas', 'Buruk'],
            colors: ['#38bdf8', '#7dd3fc', '#bae6fd', '#e0f2fe'],
            legend: {
                show: false
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold'
                },
                formatter: function(val, opts) {
                    return opts.w.config.series[opts.seriesIndex] + '%';
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + '%';
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#satisfactionPieChart"), pieOptions).render();
    </script>
</body>

</html>