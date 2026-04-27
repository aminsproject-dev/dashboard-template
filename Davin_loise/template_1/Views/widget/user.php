<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'User Widgets' ?></title>

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

        /* Avatar Styles */
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }
        .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            font-size: 0.9rem;
        }
        .avatar-lg {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            font-size: 1.5rem;
        }

        /* Activity List */
        .activity-item {
            transition: all 0.3s ease;
            border-radius: 16px;
            cursor: pointer;
        }
        .activity-item:hover {
            background-color: #f8fafc;
            transform: translateX(5px);
        }

        /* Settings Item */
        .settings-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            cursor: pointer;
        }
        .settings-item:hover {
            background-color: #f8fafc;
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
        body.dark-mode .activity-item:hover {
            background-color: #334155;
        }
        body.dark-mode .settings-item:hover {
            background-color: #334155;
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

        /* Theme Switch (untuk preview) */
        .theme-option {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .theme-option:hover {
            transform: scale(1.05);
        }
        .theme-option.active {
            box-shadow: 0 0 0 2px #4f46e5, 0 0 0 4px rgba(79, 70, 229, 0.2);
        }

        @media (max-width: 768px) {
            .avatar-lg {
                width: 60px;
                height: 60px;
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
          
                    <li class="breadcrumb-item active" aria-current="page">Widget / Pengguna</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Widget Pengguna</h2>
                <p class="text-muted">Berbagai widget informasi dan aktivitas pengguna.</p>
            </div>

            <!-- Row 1: Profile Card & Activity -->
            <div class="row g-4 mb-4">
                <!-- Profile Card -->
                <div class="col-md-5">
                    <div class="card p-4">
                        <div class="text-center">
                            <div class="avatar-lg bg-primary mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Davin Loise</h4>
                            <p class="text-muted">Administrator</p>
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill"><i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i> Online</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill"><i class="fas fa-envelope me-1"></i> Verified</span>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-4">
                                    <h5 class="fw-bold mb-0">1,234</h5>
                                    <small class="text-muted">Posts</small>
                                </div>
                                <div class="col-4">
                                    <h5 class="fw-bold mb-0">56.9K</h5>
                                    <small class="text-muted">Followers</small>
                                </div>
                                <div class="col-4">
                                    <h5 class="fw-bold mb-0">892</h5>
                                    <small class="text-muted">Following</small>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-primary rounded-pill px-4"><i class="fas fa-envelope me-2"></i>Message</button>
                                <button class="btn btn-outline-secondary rounded-pill px-4"><i class="fas fa-user-plus me-2"></i>Follow</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity & Messages -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-clock text-primary me-2"></i>Aktivitas Terbaru</h5>
                            <a href="#" class="text-decoration-none small">Lihat semua <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        
                        <!-- Activity List -->
                        <div class="activity-item d-flex align-items-start p-3 mb-2">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fas fa-calendar-alt text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Today</h6>
                                <p class="text-muted small mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            </div>
                        </div>
                        
                        <div class="activity-item d-flex align-items-start p-3 mb-2">
                            <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fas fa-calendar-day text-success fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Yesterday</h6>
                                <p class="text-muted small mb-0">Jonny aber invites to join the challenge</p>
                            </div>
                        </div>
                        
                        <div class="activity-item d-flex align-items-start p-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fas fa-calendar-week text-info fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">This Week</h6>
                                <p class="text-muted small mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Messages & Notifications -->
            <div class="row g-4 mb-4">
                <!-- Messages Card -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-envelope text-primary me-2"></i>Pesan Masuk</h5>
                            <span class="badge bg-danger rounded-pill">3 Baru</span>
                        </div>
                        
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">John Doe</h6>
                                <small class="text-muted">Hey, how are you?</small>
                            </div>
                            <small class="text-muted">2 min ago</small>
                        </div>
                        
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=10b981&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">Jane Smith</h6>
                                <small class="text-muted">Meeting at 3 PM</small>
                            </div>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                        
                        <div class="d-flex align-items-center p-3">
                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=f59e0b&color=fff&rounded=true&size=40" class="rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-semibold">Mike Johnson</h6>
                                <small class="text-muted">Thanks for the update!</small>
                            </div>
                            <small class="text-muted">Yesterday</small>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <a href="#" class="text-decoration-none small">Lihat semua pesan <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Notifications & DM -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-bell text-primary me-2"></i>Notifikasi</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Mark all as read</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="activity-item d-flex align-items-center p-3 mb-2">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fab fa-twitter text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">DM on @williambond</p>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        
                        <div class="activity-item d-flex align-items-center p-3 mb-2">
                            <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fab fa-twitter text-danger fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">DM on @williambond 😍</p>
                                <small class="text-muted">5 hours ago</small>
                            </div>
                        </div>
                        
                        <div class="activity-item d-flex align-items-center p-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="fas fa-trophy text-warning fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">Achievement Unlocked!</p>
                                <small class="text-muted">Yesterday</small>
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