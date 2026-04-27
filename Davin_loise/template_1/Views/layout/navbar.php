<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center gap-3">
            <!-- Tombol Toggle Sidebar -->
            <button class="sidebar-toggle-nav" id="sidebarToggleBtn" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">
                <i class="fas fa-chart-line me-2"></i>LCORP
            </a>
        </div>

        <div class="search-bar mx-auto d-none d-md-block" style="width: 320px;">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-0" placeholder="Search...">
                <button class="btn btn-link" type="button">
                    <kbd>Ctrl+K</kbd>
                </button>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <!-- Theme Switch -->
            <div class="theme-switch-wrapper">
                <label class="theme-switch">
                    <input type="checkbox" id="themeToggleCheckbox">
                    <span class="slider">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                    </span>
                </label>
            </div>

            <!-- Notifications Dropdown -->
            <div class="dropdown">
                <button class="btn btn-link position-relative text-dark p-0" data-bs-toggle="dropdown">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0" style="width: 340px;">
                    <div class="p-3 border-bottom" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                        <h6 class="mb-0 fw-bold text-white">Notifications</h6>
                    </div>
                    <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
                        <a href="#" class="dropdown-item d-flex align-items-center gap-3 p-3 border-bottom">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                <i class="fas fa-user-plus text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 small fw-semibold">New user registered</p>
                                <small class="text-muted">5 minutes ago</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex align-items-center gap-3 p-3 border-bottom">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                <i class="fas fa-chart-line text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 small fw-semibold">Sales increased by 25%</p>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex align-items-center gap-3 p-3">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 small fw-semibold">System update available</p>
                                <small class="text-muted">3 hours ago</small>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 text-center border-top">
                        <a href="#" class="text-decoration-none small">View all notifications</a>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle d-flex align-items-center gap-2 text-dark text-decoration-none p-0" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Davin+Loise&background=4f46e5&color=fff&rounded=true&size=40" class="rounded-circle" width="40" height="40">
                    <span class="d-none d-sm-inline fw-semibold">Davin Loise</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    /* ========== NAVBAR STYLES ========== */
    .navbar {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        padding: 0.75rem 1.5rem;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .navbar-brand {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent !important;
        font-weight: 800;
    }

    .sidebar-toggle-nav {
        background: transparent;
        border: none;
        color: #475569;
        font-size: 1.2rem;
        padding: 0.5rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .sidebar-toggle-nav:hover {
        background: #f1f5f9;
        color: #4f46e5;
    }

    /* ========== SEARCH BAR STYLES (LIGHT MODE) ========== */
    .search-bar .input-group {
        background: #f1f5f9;
        border-radius: 40px;
        transition: all 0.3s ease;
    }

    .search-bar .input-group:focus-within {
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .search-bar input {
        background: transparent;
        border: none;
        padding: 10px 0;
        outline: none;
    }

    .search-bar input:focus {
        box-shadow: none;
        background: transparent;
    }

    .search-bar .input-group-text {
        background: transparent;
        border: none;
        color: #64748b;
    }

    .search-bar .btn-link {
        text-decoration: none;
        padding: 0 8px;
    }

    .search-bar kbd {
        background: #e2e8f0;
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 0.7rem;
        font-weight: 500;
        color: #475569;
    }

    /* ========== THEME SWITCH ========== */
    .theme-switch-wrapper {
        display: flex;
        align-items: center;
    }

    .theme-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .theme-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .theme-switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e2e8f0;
        transition: 0.3s;
        border-radius: 34px;
    }

    .theme-switch .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    .theme-switch .slider .fa-sun,
    .theme-switch .slider .fa-moon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10px;
        color: #64748b;
    }

    .theme-switch .slider .fa-sun {
        left: 8px;
    }

    .theme-switch .slider .fa-moon {
        right: 8px;
    }

    .theme-switch input:checked+.slider {
        background-color: #4f46e5;
    }

    .theme-switch input:checked+.slider:before {
        transform: translateX(26px);
    }

    /* ========== DARK MODE STYLES ========== */
    body.dark-mode {
        background: #0f172a;
    }

    body.dark-mode .navbar {
        background: rgba(30, 41, 59, 0.98) !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    body.dark-mode .navbar-brand {
        background: linear-gradient(135deg, #818cf8, #a78bfa);
        -webkit-background-clip: text;
        background-clip: text;
    }

    body.dark-mode .sidebar-toggle-nav {
        color: #cbd5e1;
    }

    body.dark-mode .sidebar-toggle-nav:hover {
        background: #334155;
        color: #818cf8;
    }

    /* ========== SEARCH BAR DARK MODE (DIPERBAIKI) ========== */
    body.dark-mode .search-bar .input-group {
        background: #1e293b !important;
        border: 1px solid #334155 !important;
        border-radius: 40px !important;
        transition: all 0.3s ease-in-out !important;
    }

    /* Hover effect */
    body.dark-mode .search-bar .input-group:hover {
        background: #0f172a !important;
        border-color: #4f46e5 !important;
    }

    /* Focus effect */
    body.dark-mode .search-bar .input-group:focus-within {
        background: #0f172a !important;
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2) !important;
    }

    /* Input text */
    body.dark-mode .search-bar input {
        color: #94a3b8 !important;
        transition: color 0.3s ease !important;
    }

    body.dark-mode .search-bar .input-group:focus-within input,
    body.dark-mode .search-bar input:focus {
        color: #ffffff !important;
    }

    /* Placeholder */
    body.dark-mode .search-bar input::placeholder {
        color: #64748b !important;
        transition: color 0.3s ease !important;
    }

    body.dark-mode .search-bar .input-group:focus-within input::placeholder {
        color: #94a3b8 !important;
    }

    /* Icon search */
    body.dark-mode .search-bar .input-group-text i {
        color: #64748b !important;
        transition: color 0.3s ease !important;
    }

    body.dark-mode .search-bar .input-group:focus-within .input-group-text i {
        color: #818cf8 !important;
    }

    /* Kbd button */
    body.dark-mode .search-bar kbd {
        background: #0f172a !important;
        color: #94a3b8 !important;
        border: 1px solid #334155 !important;
        transition: all 0.3s ease !important;
    }

    body.dark-mode .search-bar .input-group:focus-within kbd {
        background: #1e293b !important;
        color: #818cf8 !important;
        border-color: #4f46e5 !important;
    }

    /* Button link */
    body.dark-mode .search-bar .btn-link {
        color: #94a3b8 !important;
        transition: color 0.3s ease !important;
    }

    body.dark-mode .search-bar .input-group:focus-within .btn-link {
        color: #818cf8 !important;
    }

    /* Dropdown dark mode */
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

    body.dark-mode .border-bottom,
    body.dark-mode .border-top {
        border-color: #334155 !important;
    }

    body.dark-mode .text-muted {
        color: #94a3b8 !important;
    }

    body.dark-mode .text-dark {
        color: #e2e8f0 !important;
    }

    body.dark-mode .btn-link {
        color: #cbd5e1 !important;
    }

    body.dark-mode .btn-link:hover {
        color: #818cf8 !important;
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

    /* ========== RESPONSIVE ========== */
    @media (max-width: 992px) {
        .search-bar {
            width: 250px !important;
        }
    }

    @media (max-width: 768px) {
        .search-bar {
            width: auto !important;
            margin: 0 10px;
        }
        
        .navbar-brand span {
            display: none;
        }
    }
</style>

<script>
    // Theme toggle
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

    // Search shortcut Ctrl+K
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-bar input');
            if (searchInput) {
                searchInput.focus();
            }
        }
    });
</script>