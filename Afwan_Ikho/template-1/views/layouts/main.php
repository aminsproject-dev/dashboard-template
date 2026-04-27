<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        (function() {
            // Baca dari localStorage sebelum DOM ready
            const isDark = localStorage.getItem('theme_dark') === 'true';
            const accent = localStorage.getItem('theme_accent') || '#6366f1';

            // Terapkan class ke html element
            if (isDark) {
                document.documentElement.classList.add('dark-theme');
            } else {
                document.documentElement.classList.remove('dark-theme');
            }

            // Terapkan warna aksen ke CSS variables
            document.documentElement.style.setProperty('--accent-primary', accent);

            // Hitung warna sidebar active
            function hexToRgba(hex, alpha) {
                const r = parseInt(hex.slice(1, 3), 16);
                const g = parseInt(hex.slice(3, 5), 16);
                const b = parseInt(hex.slice(5, 7), 16);
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;
            }
            document.documentElement.style.setProperty('--sidebar-active', hexToRgba(accent, 0.25));
            document.documentElement.style.setProperty('--sidebar-accent', accent);
        })();
    </script>
    <title><?= $pageTitle ?? 'Dashboard' ?> - OnlineShop Admin</title>

    <!-- CSS Kita -->
    <link rel="stylesheet" href="/assets/css/dashboard.css">

    <!-- Bootstrap Icons (gratis, CDN) untuk ikon-ikon UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Chart.js untuk grafik -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script> -->

    <!-- CSS dengan versioning -->
    <link rel="stylesheet" href="/assets/css/dashboard.css?v=<?= filemtime(FCPATH . 'assets/css/dashboard.css') ?>">


</head>

<body>

    <!-- Overlay: ditampilkan saat sidebar terbuka di mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-wrapper">

        <!-- ================================
         SIDEBAR
         ================================ -->
        <aside class="sidebar" id="sidebar">

            <!-- Logo / Brand -->
            <div class="sidebar-header">
                <div class="sidebar-logo-icon">🛍️</div>
                <div class="sidebar-logo-text">
                    <strong>OnlineShop</strong>
                    <span>Admin Panel</span>
                </div>
            </div>

            <!-- Navigasi Utama -->
            <nav class="sidebar-nav">

                <div class="sidebar-section-title">MENU UTAMA</div>

                <!-- Setiap nav-item: link dengan ikon + label -->
                <!-- Class 'active' menandai halaman yang sedang aktif -->
                <a href="/dashboard" class="nav-item <?= (uri_string() === 'dashboard' || uri_string() === '') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="nav-label">Dashboard</span>
                </a>

                <a href="/users" class="nav-item <?= str_starts_with(uri_string(), 'users') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-people"></i></span>
                    <span class="nav-label">Pengguna</span>
                    <!-- <span class="nav-badge">12</span> -->
                </a>

                <a href="/products" class="nav-item <?= str_starts_with(uri_string(), 'products') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-box-seam"></i></span>
                    <span class="nav-label">Produk</span>
                </a>

                <a href="/orders" class="nav-item <?= str_starts_with(uri_string(), 'orders') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-cart3"></i></span>
                    <span class="nav-label">Pesanan</span>
                    <!-- <span class="nav-badge">3</span>    -->
                </a>

                <div class="sidebar-section-title">LAPORAN</div>

                <a href="/analytics" class="nav-item <?= str_starts_with(uri_string(), 'analytics') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span>
                    <span class="nav-label">Analitik</span>
                </a>

                <div class="sidebar-section-title">SISTEM</div>

                <a href="/settings" class="nav-item <?= str_starts_with(uri_string(), 'settings') ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="bi bi-gear"></i></span>
                    <span class="nav-label">Pengaturan</span>
                </a>

                <a href="#" class="nav-item">
                    <span class="nav-icon"><i class="bi bi-question-circle"></i></span>
                    <span class="nav-label">Bantuan</span>
                </a>

            </nav>

            <!-- User Info (bawah sidebar) -->
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">AD</div>
                <div class="sidebar-user-info">
                    <strong>Admin</strong>
                    <small>Super Administrator</small>
                </div>
            </div>

        </aside>
        <!-- END SIDEBAR -->


        <!-- ================================
         MAIN CONTENT
         ================================ -->
        <div class="main-content">

            <!-- TOPBAR -->
            <header class="topbar">
                <!-- Tombol toggle sidebar -->
                <button class="topbar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                    <i class="bi bi-list" style="font-size:20px"></i>
                </button>

                <!-- Judul halaman saat ini -->
                <span class="topbar-title"><?= $pageTitle ?? 'Dashboard' ?></span>

                <div class="topbar-spacer"></div>

                <!-- Search Bar -->
                <div class="topbar-search">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>

                <!-- Tombol Dark Mode Toggle -->
                <button class="topbar-btn" id="darkModeBtn" title="Toggle Dark Mode">
                    <i class="bi bi-moon-stars"></i>
                </button>

                <!-- Tombol Notifikasi -->
                <!-- Tombol Notifikasi dengan Dropdown -->
                <div class="topbar-dropdown">
                    <button class="topbar-btn" id="notifBtn" title="Notifikasi">
                        <i class="bi bi-bell"></i>
                        <span class="badge" id="notifBadge">3</span>
                    </button>
                    <div class="dropdown-menu" id="notifDropdown">
                        <div class="dropdown-header">
                            <span>Notifikasi</span>
                            <button class="dropdown-mark-read" onclick="markAllRead()">Tandai dibaca</button>
                        </div>
                        <div class="dropdown-list">
                            <!-- Dummy notifikasi -->
                            <div class="dropdown-item unread">
                                <div class="dropdown-item-icon"><i class="bi bi-cart-check"></i></div>
                                <div class="dropdown-item-content">
                                    <strong>Pesanan baru #ORD-008</strong>
                                    <span>John Doe memesan Wireless Headphones</span>
                                    <small>2 menit lalu</small>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="dropdown-item-icon"><i class="bi bi-exclamation-triangle"></i></div>
                                <div class="dropdown-item-content">
                                    <strong>Stok menipis</strong>
                                    <span>Laptop Pro 15" tersisa 2 unit</span>
                                    <small>1 jam lalu</small>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="dropdown-item-icon"><i class="bi bi-person-plus"></i></div>
                                <div class="dropdown-item-content">
                                    <strong>Pengguna baru</strong>
                                    <span>Sarah Johnson mendaftar</span>
                                    <small>3 jam lalu</small>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>

                <!-- Avatar User dengan Dropdown -->
                <div class="topbar-dropdown">
                    <div class="topbar-user" id="userMenuBtn">
                        <div class="topbar-avatar">AD</div>
                        <span style="font-size:13px; font-weight:600; color:var(--text-primary)">Admin</span>
                        <i class="bi bi-chevron-down" style="font-size:11px; color:var(--text-muted)"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" id="userDropdown">
                        <div class="dropdown-item" onclick="showToast('Profil')">
                            <i class="bi bi-person-circle"></i> Profil
                        </div>
                        <div class="dropdown-item" onclick="showToast('Pengaturan')">
                            <i class="bi bi-gear"></i> Pengaturan
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item text-danger" onclick="showToast('Logout')">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </div>
                    </div>
                </div>
            </header>
            <!-- END TOPBAR -->

            <!-- Konten Halaman disuntikkan di sini -->
            <?= $this->renderSection('content') ?>

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END APP WRAPPER -->

    <!-- JavaScript Kita -->
    <!-- JS dengan versioning -->
    <script src="/assets/js/dashboard.js?v=<?= filemtime(FCPATH . 'assets/js/dashboard.js') ?>"></script>

    <!-- Script tambahan dari halaman tertentu -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>