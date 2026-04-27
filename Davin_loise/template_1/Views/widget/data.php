<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Data Widgets' ?></title>

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

        /* Team Member Item */
        .team-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            cursor: pointer;
        }
        .team-item:hover {
            background-color: #f8fafc;
            transform: translateX(5px);
        }

        /* Location Item */
        .location-item {
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        .location-item:hover {
            background-color: #f8fafc;
        }

        /* Report Item */
        .report-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            cursor: pointer;
        }
        .report-item:hover {
            background-color: #f8fafc;
            transform: translateX(5px);
        }

        /* Conversion Table */
        .conversion-table td {
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
        }
        .conversion-table tr:last-child td {
            border-bottom: none;
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
        body.dark-mode .team-item:hover {
            background-color: #334155;
        }
        body.dark-mode .location-item:hover {
            background-color: #334155;
        }
        body.dark-mode .report-item:hover {
            background-color: #334155;
        }
        body.dark-mode .conversion-table td {
            border-bottom-color: #334155;
        }
        body.dark-mode .border-bottom {
            border-bottom-color: #334155 !important;
        }
        body.dark-mode .badge-trend-up {
            background: rgba(52, 211, 153, 0.15) !important;
            color: #34d399 !important;
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
              
                    <li class="breadcrumb-item active" aria-current="page">Widget / Data</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Widget Data</h2>
                <p class="text-muted">Berbagai widget informasi data dan statistik.</p>
            </div>

            <!-- Row 1: Team Members & Conversion Rate -->
            <div class="row g-4 mb-4">
                <!-- Team Members -->
                <div class="col-md-5">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-users text-primary me-2"></i>Anggota Tim</h5>
                            <a href="#" class="text-decoration-none small">Lihat semua <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        
                        <div class="team-item d-flex align-items-center p-3 mb-2">
                            <img src="https://ui-avatars.com/api/?name=David+Jones&background=4f46e5&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">David Jones</h6>
                                <small class="text-muted">Project Leader</small>
                            </div>
                            <small class="text-muted">5 menit lalu</small>
                        </div>
                        
                        <div class="team-item d-flex align-items-center p-3 mb-2">
                            <img src="https://ui-avatars.com/api/?name=Robert+Smith&background=10b981&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">Robert Smith</h6>
                                <small class="text-muted">HR Manager</small>
                            </div>
                            <small class="text-muted">Kemarin</small>
                        </div>
                        
                        <div class="team-item d-flex align-items-center p-3">
                            <img src="https://ui-avatars.com/api/?name=John+Larry&background=f59e0b&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">John Larry</h6>
                                <small class="text-muted">Developer</small>
                            </div>
                            <small class="text-muted">1 jam lalu</small>
                        </div>
                    </div>
                </div>

                <!-- Conversion Rate -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-chart-line text-primary me-2"></i>Tingkat Konversi</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                    <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                                    <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="text-center mb-4">
                            <h1 class="display-2 fw-bold text-primary">5.63<span class="fs-2 text-muted">%</span></h1>
                            <span class="badge-trend-up mt-2 d-inline-block"><i class="fas fa-arrow-up me-1"></i> 3.4%</span>
                        </div>
                        
                        <table class="table conversion-table mb-0">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-shopping-cart text-primary me-2"></i> Ditambahkan ke Keranjang</td>
                                    <td class="text-end"><span class="fw-semibold">5</span> <small class="text-muted">kunjungan</small></td>
                                    <td class="text-end"><span class="fw-semibold">7.04</span> <small class="text-muted">%</small></td>
                                    <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 4.0%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-credit-card text-primary me-2"></i> Mencapai Checkout</td>
                                    <td class="text-end"><span class="fw-semibold">5</span> <small class="text-muted">kunjungan</small></td>
                                    <td class="text-end"><span class="fw-semibold">7.04</span> <small class="text-muted">%</small></td>
                                    <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 2.0%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-check-circle text-primary me-2"></i> Pembelian</td>
                                    <td class="text-end"><span class="fw-semibold">4</span> <small class="text-muted">pesanan</small></td>
                                    <td class="text-end"><span class="fw-semibold">5.63</span> <small class="text-muted">%</small></td>
                                    <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 1.4%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Row 2: Visits by Location & Quick Style Guide -->
            <div class="row g-4">
                <!-- Visits by Location -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-map-marker-alt text-primary me-2"></i>Kunjungan Berdasarkan Lokasi</h5>
                            <a href="#" class="text-decoration-none small">Lihat semua <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Jerman</td>
                                        <td class="text-end"><span class="fw-semibold">38</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 5.8%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Amerika Serikat</td>
                                        <td class="text-end"><span class="fw-semibold">928</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 51.2%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Australia</td>
                                        <td class="text-end"><span class="fw-semibold">674</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 17.1%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Inggris</td>
                                        <td class="text-end"><span class="fw-semibold">1,438</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 15.8%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Brasil</td>
                                        <td class="text-end"><span class="fw-semibold">90</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 9.8%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Jerman</td>
                                        <td class="text-end"><span class="fw-semibold">123</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 5.8%</span></td>
                                    </tr>
                                    <tr class="location-item">
                                        <td><i class="fas fa-flag text-primary me-2"></i> Amerika Serikat</td>
                                        <td class="text-end"><span class="fw-semibold">928</span> <small class="text-muted">kunjungan</small></td>
                                        <td class="text-end"><span class="badge-trend-up"><i class="fas fa-arrow-up me-1"></i> 51.2%</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Style Guide -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-pen-fancy text-primary me-2"></i>Panduan Gaya Cepat</h5>
                            <a href="#" class="text-decoration-none small">Lihat semua <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        
                        <!-- Report Item 1 - Done -->
                        <div class="report-item d-flex p-3 mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">Buat Laporan</h6>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Selesai</span>
                                </div>
                                <p class="text-muted small mb-0">Perjalanan ini sungguh menakjubkan dan merupakan pengalaman yang mengubah hidup!!</p>
                            </div>
                        </div>
                        
                        <!-- Report Item 2 - Running -->
                        <div class="report-item d-flex p-3 mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded-3">
                                    <i class="fas fa-spinner fa-pulse text-info fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">Buat Laporan</h6>
                                    <span class="badge bg-info bg-opacity-10 text-info rounded-pill">Berjalan</span>
                                </div>
                                <p class="text-muted small mb-0">Kursus gratis untuk semua pelanggan kami di Ruang Konferensi A1 - jam 9:00 pagi besok!</p>
                            </div>
                        </div>
                        
                        <!-- Report Item 3 - Pending -->
                        <div class="report-item d-flex p-3 mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-3">
                                    <i class="fas fa-clock text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">Buat Laporan</h6>
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Tertunda</span>
                                </div>
                                <p class="text-muted small mb-0">Kursus gratis untuk semua pelanggan kami di Ruang Konferensi A1 - jam 9:00 pagi besok!</p>
                            </div>
                        </div>
                        
                        <!-- Report Item 4 - Not Start -->
                        <div class="report-item d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-secondary bg-opacity-10 p-2 rounded-3">
                                    <i class="fas fa-hourglass-start text-secondary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">Buat Laporan</h6>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Belum Mulai</span>
                                </div>
                                <p class="text-muted small mb-0">Selamat Bahagia! Minuman gratis di Cafe-Bar sepanjang hari!</p>
                            </div>
                        </div>
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

        // Add scroll-top-btn styles
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