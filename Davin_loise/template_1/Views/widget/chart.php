<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Chart Widgets' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .card {
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
        body.dark-mode .border-bottom {
            border-bottom-color: #334155 !important;
        }
        body.dark-mode .border-top {
            border-top-color: #334155 !important;
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
        
        .card {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @media (max-width: 768px) {
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
                 
                    <li class="breadcrumb-item active" aria-current="page">Widget / Grafik</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Widget Grafik</h2>
                <p class="text-muted">Berbagai widget grafik untuk analisis data Anda.</p>
            </div>

            <!-- Row 1: Earnings Chart & User Activities -->
            <div class="row g-4 mb-4">
                <!-- Earnings Area Chart -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-chart-line text-primary me-2"></i>Pendapatan</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                                    <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                    <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mb-3">
                            <div>
                                <h2 class="display-5 fw-bold mb-0">$894.39</h2>
                                <span class="badge-trend-up mt-2 d-inline-block"><i class="fas fa-arrow-up me-1"></i> +$200.10</span>
                                <span class="text-muted small ms-2">36% Pesanan Pengiriman</span>
                            </div>
                            <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                        </div>
                        <div id="earningsChart" style="height: 250px; width: 100%;"></div>
                    </div>
                </div>

                <!-- User Activities & Yearly Summary -->
                <div class="col-md-5">
                    <div class="card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-users text-primary me-2"></i>Aktivitas Pengguna</h5>
                            <span class="badge bg-primary rounded-pill">Sales</span>
                        </div>
                        <div class="text-center mb-3">
                            <h2 class="display-4 fw-bold text-primary">$2356.4</h2>
                        </div>
                        <div id="userActivityChart" style="height: 150px; width: 100%;"></div>
                        <hr class="my-3">
                        <div class="row text-center">
                            <div class="col-4">
                                <h6 class="text-muted small mb-1">Invoiced</h6>
                                <h5 class="fw-bold mb-0">$2356.4</h5>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted small mb-1">Profit</h6>
                                <h5 class="fw-bold text-success mb-0">$1935.6</h5>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted small mb-1">Expenses</h6>
                                <h5 class="fw-bold text-danger mb-0">$468.9</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Overview & Total Sales -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-chart-pie text-primary me-2"></i>Ringkasan Tahunan</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">2023</a></li>
                                    <li><a class="dropdown-item" href="#">2024</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="overviewChart" style="height: 280px; width: 100%;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-chart-simple text-primary me-2"></i>Total Penjualan</h5>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="text-center p-3 border rounded-3">
                                    <h3 class="fw-bold mb-1">$82.99</h3>
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                                    <p class="text-muted small mb-0 mt-2">Online store</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 text-center">
                                    <h4 class="fw-bold mb-1">$50.99</h4>
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                                </div>
                                <div class="text-center">
                                    <h4 class="fw-bold mb-1">$32.00</h4>
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                                </div>
                            </div>
                        </div>
                        <div id="totalSalesChart" style="height: 150px; width: 100%; margin-top: 15px;"></div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Team Performance & Stats Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i>Kinerja Tim</h5>
                        <div class="text-center mb-3">
                            <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 5% lebih baik minggu ini</span>
                        </div>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <h3 class="fw-bold mb-0">56</h3>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <h3 class="fw-bold mb-0">34</h3>
                                    <small class="text-muted">Persentase</small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small">Progres Tim</span>
                                <span class="small fw-bold">56%</span>
                            </div>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-primary" style="width: 56%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-chart-pie text-primary me-2"></i>Ringkasan</h5>
                        <div class="row g-3 text-center">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-mobile-alt fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">10+</h5>
                                    <small class="text-muted">Aplikasi</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-puzzle-piece fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">150+</h5>
                                    <small class="text-muted">Widget</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-file-alt fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">50+</h5>
                                    <small class="text-muted">Formulir</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-cubes fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">200+</h5>
                                    <small class="text-muted">Komponen</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-file-code fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">150+</h5>
                                    <small class="text-muted">Halaman</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3">
                                    <i class="fas fa-cog fs-2 text-primary mb-2"></i>
                                    <h5 class="fw-bold mb-0">5</h5>
                                    <small class="text-muted">Lainnya</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-star text-primary me-2"></i>Rating Proyek</h5>
                        <div class="text-center mb-3">
                            <h1 class="display-2 fw-bold text-primary">4.5<span class="fs-2 text-muted">/5</span></h1>
                            <div class="mt-2">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                            <span class="badge-trend-up mt-2 d-inline-block"><i class="fas fa-arrow-up me-1"></i> 36%</span>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small">Kepuasan Pelanggan</span>
                                <span class="small fw-bold">90%</span>
                            </div>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-warning" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Transactions & Reports -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <i class="fas fa-credit-card fs-1 text-primary mb-3"></i>
                        <h5 class="text-muted mb-1">Transaksi</h5>
                        <h2 class="fw-bold mb-2">$59.48</h2>
                        <span class="badge-trend-up d-inline-block mx-auto"><i class="fas fa-arrow-up me-1"></i> 36%</span>
                        <hr class="my-3">
                        <div>
                            <h6 class="text-muted mb-1">Pesanan Dibatalkan</h6>
                            <h4 class="fw-bold mb-0">3.15k</h4>
                        </div>
                        <hr class="my-3">
                        <div>
                            <h6 class="text-muted mb-1">Total Pesanan</h6>
                            <h4 class="fw-bold mb-0">3.15k</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i>Laporan</h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-chart-line fs-3 text-primary mb-2"></i>
                                    <h6 class="text-muted mb-1">Pengunjung</h6>
                                    <h3 class="fw-bold mb-1">$82.99</h3>
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-clock fs-3 text-primary mb-2"></i>
                                    <h6 class="text-muted mb-1">Rata-rata waktu</h6>
                                    <h3 class="fw-bold mb-1">00:03:45</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-user-plus fs-3 text-primary mb-2"></i>
                                    <h6 class="text-muted mb-1">Pengunjung Baru</h6>
                                    <h3 class="fw-bold mb-1">$3,569</h3>
                                    <span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.6%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-gift fs-3 text-primary mb-2"></i>
                                    <h6 class="text-muted mb-1">Total Hadiah</h6>
                                    <h3 class="fw-bold mb-1">9,000</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 5: Bitcoin & Tasks -->
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <i class="fab fa-bitcoin fs-1 text-warning mb-3"></i>
                        <h5 class="fw-bold mb-2">Bitcoin</h5>
                        <span class="badge-trend-up d-inline-block mx-auto mb-3"><i class="fas fa-arrow-up me-1"></i> 0.73%</span>
                        <h3 class="fw-bold mb-0">£5678.09</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <i class="fas fa-tasks fs-1 text-primary mb-3"></i>
                        <h5 class="fw-bold mb-2">Total Tugas</h5>
                        <span class="badge-trend-up d-inline-block mx-auto mb-3"><i class="fas fa-arrow-up me-1"></i> 0.73%</span>
                        <h3 class="fw-bold mb-0">£5678.09</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <i class="fas fa-chart-line fs-1 text-success mb-3"></i>
                        <h5 class="fw-bold mb-2">Total Tugas</h5>
                        <span class="badge-trend-up d-inline-block mx-auto mb-3"><i class="fas fa-arrow-up me-1"></i> 0.73%</span>
                        <h3 class="fw-bold mb-0">£5678.09</h3>
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
        // ========== EARNINGS AREA CHART ==========
        var earningsOptions = {
            series: [{
                name: 'Pendapatan',
                data: [31, 40, 28, 51, 42, 85, 77, 60, 55, 68, 45, 70]
            }],
            chart: {
                type: 'area',
                height: 250,
                toolbar: { show: false },
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            stroke: { curve: 'smooth', width: 2 },
            colors: ['#4f46e5'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                labels: { style: { colors: '#64748b', fontSize: '11px' } }
            },
            yaxis: {
                labels: { formatter: function(val) { return '$' + val + 'k'; }, style: { colors: '#64748b' } }
            },
            tooltip: { y: { formatter: function(val) { return '$' + val + 'k'; } } },
            grid: { borderColor: '#e2e8f0', strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#earningsChart"), earningsOptions).render();

        // ========== USER ACTIVITY BAR CHART ==========
        var userActivityOptions = {
            series: [{
                name: 'Aktivitas',
                data: [44, 55, 41, 67, 22, 43]
            }],
            chart: {
                type: 'bar',
                height: 150,
                toolbar: { show: false },
                sparkline: { enabled: true }
            },
            plotOptions: { bar: { columnWidth: '60%', borderRadius: 6 } },
            colors: ['#10b981'],
            tooltip: { y: { formatter: function(val) { return val + ' aktivitas'; } } }
        };
        new ApexCharts(document.querySelector("#userActivityChart"), userActivityOptions).render();

        // ========== OVERVIEW DONUT CHART ==========
        var overviewOptions = {
            series: [1935.6, 468.9, 2356.4],
            chart: { type: 'donut', height: 250, toolbar: { show: false } },
            labels: ['Profit', 'Expenses', 'Invoiced'],
            colors: ['#10b981', '#ef4444', '#4f46e5'],
            legend: { position: 'bottom', labels: { colors: '#64748b' } },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: { show: true, fontSize: '14px', fontWeight: 600 },
                            value: { show: true, fontSize: '18px', fontWeight: 'bold', formatter: function(val) { return '$' + val + 'k'; } }
                        }
                    }
                }
            },
            tooltip: { y: { formatter: function(val) { return '$' + val + 'k'; } } }
        };
        new ApexCharts(document.querySelector("#overviewChart"), overviewOptions).render();

        // ========== TOTAL SALES LINE CHART ==========
        var totalSalesOptions = {
            series: [{
                name: 'Penjualan',
                data: [28, 45, 35, 50, 30, 60, 45, 55, 40, 65, 48, 70]
            }],
            chart: {
                type: 'line',
                height: 150,
                toolbar: { show: false },
                sparkline: { enabled: true }
            },
            stroke: { curve: 'smooth', width: 2 },
            colors: ['#f59e0b'],
            tooltip: { y: { formatter: function(val) { return '$' + val + 'k'; } } }
        };
        new ApexCharts(document.querySelector("#totalSalesChart"), totalSalesOptions).render();

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
            body.dark-mode .apexcharts-text,
            body.dark-mode .apexcharts-legend-text {
                fill: #e2e8f0 !important;
                color: #e2e8f0 !important;
            }
            body.dark-mode .apexcharts-tooltip {
                background: #1e293b !important;
                border-color: #334155 !important;
                color: #e2e8f0 !important;
            }
            body.dark-mode .apexcharts-tooltip-title {
                background: #0f172a !important;
                border-bottom-color: #334155 !important;
            }
            body.dark-mode .apexcharts-grid line {
                stroke: #334155 !important;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>