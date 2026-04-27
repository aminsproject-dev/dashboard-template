/**
 * OnlineShop Admin Dashboard - Main JavaScript
 * File: public/assets/js/dashboard.js
 *
 * File ini mengelola:
 * 1. Toggle sidebar (minimize/maximize & mobile open/close)
 * 2. Sistem tema (dark/light + warna aksen)
 * 3. Chart dengan Chart.js
 * 4. Toast notifikasi
 */

// ============================================================
// 1. SIDEBAR TOGGLE
// Fungsi untuk minimize/maximize sidebar desktop
// dan open/close sidebar di mobile
// ============================================================

const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const toggleBtn = document.getElementById('sidebarToggle');
let allCharts = [];
window.allCharts = allCharts; // Simpan di global
/**
 * Cek apakah layar sedang dalam mode mobile (lebar < 768px)
 */
function isMobile() {
    return window.innerWidth < 768;
}

// caching
if (localStorage.getItem('assets_cached') !== 'true') {
    // Preload asset setelah load pertama
    window.addEventListener('load', function () {
        setTimeout(() => {
            localStorage.setItem('assets_cached', 'true');
        }, 3000);
    });
}
// Cegah error jika DOM belum siap
document.addEventListener('DOMContentLoaded', function () {
    console.log('Dashboard JS loaded - DOM ready');
});

// Cegah double initialization
if (window.dashboardInitialized) {
    console.warn('Dashboard already initialized, skipping...');
} else {
    window.dashboardInitialized = true;
    console.log('Dashboard JS initialized once');
}
/**
 * Toggle sidebar berdasarkan mode:
 * - Desktop: minimize (hanya tampilkan ikon)
 * - Mobile: buka/tutup penuh dengan overlay
 */
function toggleSidebar() {
    if (isMobile()) {
        sidebar.classList.toggle('mobile-open');
        sidebarOverlay.classList.toggle('active');
    } else {
        sidebar.classList.toggle('minimized');
        const isMinimized = sidebar.classList.contains('minimized');
        localStorage.setItem('sidebar_minimized', isMinimized);
    }

    // Hanya resize, jangan destroy
    setTimeout(() => {
        // Resize semua chart
        if (window.allCharts && window.allCharts.length) {
            window.allCharts.forEach(chart => {
                if (chart && typeof chart.resize === 'function') {
                    chart.resize();
                }
            });
        }

        // Force resize khusus untuk chart.js
        const charts = Chart.instances;
        if (charts) {
            Object.values(charts).forEach(chart => {
                if (chart && chart.resize) chart.resize();
            });
        }
    }, 300);
}

function forceResizeRevenueChart() {
    const canvas = document.getElementById('revenueChart');
    if (canvas && canvas.chart) {
        // Force resize dengan sedikit delay
        setTimeout(() => {
            canvas.chart.resize();
            // Double check dengan trigger resize lagi
            setTimeout(() => {
                canvas.chart.resize();
            }, 100);
        }, 50);
    }
}

// Tutup sidebar saat overlay di-klik (mode mobile)
if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    });
}

// Pasang event listener ke tombol toggle
if (toggleBtn) {
    toggleBtn.addEventListener('click', toggleSidebar);
}

// Saat halaman dimuat, cek localStorage apakah sidebar sebelumnya diminimize
window.addEventListener('DOMContentLoaded', () => {
    const wasMinimized = localStorage.getItem('sidebar_minimized') === 'true';
    if (wasMinimized && !isMobile()) {
        sidebar.classList.add('minimized');
    }
});

// Saat layar di-resize, reset state sidebar untuk menghindari konflik
window.addEventListener('resize', () => {
    if (!isMobile()) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});


// ============================================================
// 2. SISTEM TEMA
// Mengelola dark/light mode dan warna aksen (accent color)
// ============================================================

/**
 * Terapkan dark/light mode
 * @param {boolean} isDark - true untuk dark mode
 */
function applyThemeMode(isDark) {
    if (isDark) {
        document.documentElement.classList.add('dark-theme');
    } else {
        document.documentElement.classList.remove('dark-theme');
    }
    localStorage.setItem('theme_dark', isDark);
}

/**
 * Terapkan warna aksen ke seluruh halaman menggunakan CSS variables
 * @param {string} color - kode hex warna, misal '#6366f1'
 */
function applyAccentColor(color) {
    // Warna aksen utama
    document.documentElement.style.setProperty('--accent-primary', color);
    // Hitung sidebar active color berdasarkan aksen (dengan transparansi)
    document.documentElement.style.setProperty('--sidebar-active', hexToRgba(color, 0.25));
    document.documentElement.style.setProperty('--sidebar-accent', color);
    localStorage.setItem('theme_accent', color);

    // Update visual tombol selected di halaman settings
    document.querySelectorAll('.theme-color-btn').forEach(btn => {
        btn.classList.toggle('selected', btn.dataset.color === color);
    });
}

/**
 * Helper: konversi hex ke rgba string
 * @param {string} hex - warna hex (misal '#6366f1')
 * @param {number} alpha - nilai transparansi 0-1
 */
function hexToRgba(hex, alpha) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

// Load preferensi tema dari localStorage saat halaman dimuat
window.addEventListener('DOMContentLoaded', () => {
    const isDark = localStorage.getItem('theme_dark') === 'true';
    const accent = localStorage.getItem('theme_accent') || '#6366f1';

    applyThemeMode(isDark);
    applyAccentColor(accent);

    // Update state toggle dark mode di halaman settings (jika ada)
    const darkToggle = document.getElementById('darkModeToggle');
    if (darkToggle) darkToggle.checked = isDark;
});

// Tombol toggle dark mode di topbar
const darkModeBtn = document.getElementById('darkModeBtn');
if (darkModeBtn) {
    darkModeBtn.addEventListener('click', () => {
        const isDark = !document.documentElement.classList.contains('dark-theme');
        applyThemeMode(isDark);
        const darkToggle = document.getElementById('darkModeToggle');
        if (darkToggle) darkToggle.checked = isDark;
    });
}

// Expose fungsi ke global agar bisa dipanggil dari HTML
window.applyThemeMode = applyThemeMode;
window.applyAccentColor = applyAccentColor;


// ============================================================
// 3. CHART.JS - Monthly Revenue Line Chart
// ============================================================

/**
 * Inisialisasi line chart untuk monthly revenue
 * Dipanggil dari view dashboard dengan melempar data
 * @param {string[]} labels - array nama bulan
 * @param {number[]} data - array nilai revenue
 */
function initRevenueChart(labels, data) {
    const ctx = document.getElementById('revenueChart');
    if (!ctx) return;

    // Hapus chart lama jika ada (tapi hati-hati)
    if (ctx.chart) {
        try {
            ctx.chart.destroy();
        } catch (e) {
            console.log('Chart already destroyed');
        }
    }

    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 260);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.25)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue',
                data: data,
                borderColor: '#6366f1',
                borderWidth: 2.5,
                backgroundColor: gradient,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' $' + ctx.raw.toLocaleString()
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(100,116,139,0.1)' },
                    ticks: {
                        color: '#94a3b8',
                        callback: val => '$' + (val >= 1000 ? (val / 1000).toFixed(0) + 'k' : val)
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            }
        }
    });

    // Simpan chart instance
    ctx.chart = chart;
    if (!window.allCharts) window.allCharts = [];
    window.allCharts.push(chart);

    return chart;
}
// ============================================================
// 4. CHART.JS - Traffic Sources Donut Chart
// ============================================================

/**
 * Inisialisasi donut chart untuk traffic sources
 */
function initTrafficChart(labels, data, colors) {
    const ctx = document.getElementById('trafficChart');
    if (!ctx) return;

    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors,
                borderWidth: 0,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Simpan chart instance
    window.allCharts.push(chart);
    return chart;
}

// ============================================================
// 5. CHART.JS - Analytics Charts (FIXED)
// ============================================================

function initAnalyticsCharts() {
    console.log('Initializing analytics charts...');

    // Pastikan Chart.js sudah loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded yet');
        return;
    }

    // Bar chart penjualan per kategori
    const catCtx = document.getElementById('categoryChart');
    if (catCtx) {
        // Destroy existing chart if any
        if (catCtx.chart) {
            catCtx.chart.destroy();
        }

        const chart = new Chart(catCtx, {
            type: 'bar',
            data: {
                labels: ['Electronics', 'Accessories', 'Computers', 'Audio', 'Gaming', 'Wearables'],
                datasets: [{
                    label: 'Units Sold',
                    data: [145, 98, 67, 120, 89, 54],
                    backgroundColor: [
                        'rgba(99,102,241,0.8)',
                        'rgba(139,92,246,0.8)',
                        'rgba(59,130,246,0.8)',
                        'rgba(16,185,129,0.8)',
                        'rgba(245,158,11,0.8)',
                        'rgba(239,68,68,0.8)',
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(100,116,139,0.1)' },
                        ticks: { color: '#94a3b8' }
                    },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });
        catCtx.chart = chart;
        if (!window.allCharts) window.allCharts = [];
        window.allCharts.push(chart);
    }

    // Line chart perbandingan dua metrik
    const compareCtx = document.getElementById('compareChart');
    if (compareCtx) {
        if (compareCtx.chart) {
            compareCtx.chart.destroy();
        }

        const chart = new Chart(compareCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Revenue ($)',
                        data: [4200, 4800, 5900, 6100, 7200, 8249],
                        borderColor: '#6366f1',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 3,
                        borderWidth: 2.5,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Orders',
                        data: [38, 45, 52, 48, 61, 64],
                        borderColor: '#10b981',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 3,
                        borderWidth: 2.5,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: '#94a3b8', font: { size: 12, weight: '500' } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                let value = context.raw;
                                if (context.dataset.label.includes('Revenue')) {
                                    return label + ': $' + value.toLocaleString();
                                }
                                return label + ': ' + value;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        position: 'left',
                        title: { display: true, text: 'Revenue ($)', color: '#6366f1' },
                        grid: { color: 'rgba(100,116,139,0.1)' },
                        ticks: { color: '#94a3b8', callback: v => '$' + v.toLocaleString() }
                    },
                    y1: {
                        position: 'right',
                        title: { display: true, text: 'Orders', color: '#10b981' },
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });
        compareCtx.chart = chart;
        if (!window.allCharts) window.allCharts = [];
        window.allCharts.push(chart);
    }

    console.log('Analytics charts initialized:', window.allCharts?.length || 0);
}

// Export ke global
window.initAnalyticsCharts = initAnalyticsCharts;
// ============================================================
// 6. TOAST NOTIFICATION
// Tampilkan notifikasi kecil di pojok kanan bawah
// ============================================================

/**
 * Tampilkan toast notification
 * @param {string} message - Pesan yang ditampilkan
 * @param {number} duration - Durasi tampil dalam ms (default 3000)
 */
function showToast(message, duration = 3000) {
    // Buat elemen toast
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    document.body.appendChild(toast);

    // Tampilkan dengan sedikit delay agar transisi CSS terpicu
    setTimeout(() => toast.classList.add('show'), 50);

    // Sembunyikan dan hapus setelah durasi selesai
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, duration);
}

// ============================================================
// 7. ANALYTICS PAGE CHARTS
// ============================================================

function initAnalyticsCharts() {
    console.log('Initializing analytics charts...');

    // Pastikan Chart.js tersedia
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded yet, retrying in 500ms...');
        setTimeout(initAnalyticsCharts, 500);
        return;
    }

    // === BAR CHART: Penjualan per Kategori ===
    const categoryCanvas = document.getElementById('categoryChart');
    if (categoryCanvas) {
        // Destroy existing chart instance
        if (categoryCanvas.chartInstance) {
            categoryCanvas.chartInstance.destroy();
        }

        const ctx = categoryCanvas.getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Electronics', 'Accessories', 'Computers', 'Audio', 'Gaming', 'Wearables'],
                datasets: [{
                    label: 'Units Sold',
                    data: [145, 98, 67, 120, 89, 54],
                    backgroundColor: [
                        'rgba(99,102,241,0.8)',
                        'rgba(139,92,246,0.8)',
                        'rgba(59,130,246,0.8)',
                        'rgba(16,185,129,0.8)',
                        'rgba(245,158,11,0.8)',
                        'rgba(239,68,68,0.8)',
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.raw + ' units sold';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(100,116,139,0.1)' },
                        title: {
                            display: true,
                            text: 'Units Sold',
                            color: '#94a3b8',
                            font: { size: 11 }
                        },
                        ticks: { color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });

        // Simpan instance untuk cleanup nanti
        categoryCanvas.chartInstance = chart;

        // Simpan ke global array untuk resize
        if (!window.allCharts) window.allCharts = [];
        window.allCharts.push(chart);

        console.log('Category chart initialized');
    } else {
        console.warn('Canvas #categoryChart not found');
    }

    // === LINE CHART: Revenue vs Orders Comparison ===
    const compareCanvas = document.getElementById('compareChart');
    if (compareCanvas) {
        // Destroy existing chart instance
        if (compareCanvas.chartInstance) {
            compareCanvas.chartInstance.destroy();
        }

        const ctx = compareCanvas.getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Revenue ($)',
                        data: [4200, 4800, 5900, 6100, 7200, 8249],
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.05)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Orders',
                        data: [38, 45, 52, 48, 61, 64],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.05)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#94a3b8',
                            font: { size: 12, weight: '500' },
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                let value = context.raw;
                                if (context.dataset.label.includes('Revenue')) {
                                    return label + ': $' + value.toLocaleString();
                                }
                                return label + ': ' + value;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Revenue ($)',
                            color: '#6366f1',
                            font: { size: 11, weight: '500' }
                        },
                        grid: { color: 'rgba(100,116,139,0.1)' },
                        ticks: {
                            color: '#94a3b8',
                            callback: function (val) {
                                return '$' + val.toLocaleString();
                            }
                        }
                    },
                    y1: {
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Number of Orders',
                            color: '#10b981',
                            font: { size: 11, weight: '500' }
                        },
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });

        // Simpan instance
        compareCanvas.chartInstance = chart;

        // Simpan ke global array
        if (!window.allCharts) window.allCharts = [];
        window.allCharts.push(chart);

        console.log('Comparison chart initialized');
    } else {
        console.warn('Canvas #compareChart not found');
    }

    console.log('Analytics charts initialization complete');
}
// ============================================================
// 8. DROPDOWN MENU (Notifikasi & User)
// ============================================================

// Tutup semua dropdown saat klik di luar
document.addEventListener('click', function (event) {
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (notifBtn && notifDropdown && !notifBtn.contains(event.target) && !notifDropdown.contains(event.target)) {
        notifDropdown.classList.remove('show');
    }
    if (userMenuBtn && userDropdown && !userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
        userDropdown.classList.remove('show');
    }
});

// Toggle notifikasi dropdown
const notifBtn = document.getElementById('notifBtn');
if (notifBtn) {
    notifBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const dropdown = document.getElementById('notifDropdown');
        dropdown.classList.toggle('show');
        // Tutup dropdown user jika terbuka
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdown) userDropdown.classList.remove('show');
    });
}

// Toggle user dropdown
const userMenuBtn = document.getElementById('userMenuBtn');
if (userMenuBtn) {
    userMenuBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
        // Tutup dropdown notifikasi jika terbuka
        const notifDropdown = document.getElementById('notifDropdown');
        if (notifDropdown) notifDropdown.classList.remove('show');
    });
}

// Fungsi untuk menandai semua notifikasi telah dibaca (contoh)
function markAllRead() {
    const unreadItems = document.querySelectorAll('#notifDropdown .dropdown-item.unread');
    unreadItems.forEach(item => {
        item.classList.remove('unread');
    });
    const badge = document.getElementById('notifBadge');
    if (badge) {
        const remainingUnread = document.querySelectorAll('#notifDropdown .dropdown-item.unread').length;
        if (remainingUnread === 0) {
            badge.style.display = 'none';
        } else {
            badge.textContent = remainingUnread;
        }
    }
    showToast('Semua notifikasi telah ditandai dibaca');
}

// Inisialisasi badge notifikasi (jumlah awal)
window.addEventListener('DOMContentLoaded', () => {
    const badge = document.getElementById('notifBadge');
    if (badge) {
        const unreadCount = document.querySelectorAll('#notifDropdown .dropdown-item.unread').length;
        if (unreadCount === 0) {
            badge.style.display = 'none';
        } else {
            badge.textContent = unreadCount;
        }
    }
});
// ============================================================
// 9. MODAL FUNCTIONS
// ============================================================

function openOrderModal() {
    document.getElementById('modalOrder').style.display = 'flex';
}

// Update fungsi closeModal yang sudah ada, tambahkan reset untuk order modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }

    // Reset form berdasarkan modal yang ditutup
    if (modalId === 'modalOrder') {
        const customer = document.getElementById('orderCustomer');
        const product = document.getElementById('orderProduct');
        const amount = document.getElementById('orderAmount');
        const paymentMethod = document.getElementById('orderPaymentMethod');
        const address = document.getElementById('orderAddress');

        if (customer) customer.value = '';
        if (product) product.value = '';
        if (amount) amount.value = '';
        if (paymentMethod) paymentMethod.value = 'Credit Card';
        if (address) address.value = '';
    }

    if (modalId === 'modalUser') {
        const userName = document.getElementById('userName');
        const userEmail = document.getElementById('userEmail');
        const userRole = document.getElementById('userRole');
        const userStatus = document.getElementById('userStatus');
        if (userName) userName.value = '';
        if (userEmail) userEmail.value = '';
        if (userRole) userRole.value = 'Customer';
        if (userStatus) userStatus.value = 'active';
    }

    if (modalId === 'modalProduct') {
        const productName = document.getElementById('productName');
        const productSku = document.getElementById('productSku');
        const productCategory = document.getElementById('productCategory');
        const productPrice = document.getElementById('productPrice');
        const productStock = document.getElementById('productStock');
        if (productName) productName.value = '';
        if (productSku) productSku.value = '';
        if (productCategory) productCategory.value = 'Electronics';
        if (productPrice) productPrice.value = '';
        if (productStock) productStock.value = '';
    }
}

function confirmOrder() {
    const customer = document.getElementById('customerName').value;
    const product = document.getElementById('productSelect').value;
    const amount = document.getElementById('paymentAmount').value;

    if (!customer || !product || !amount) {
        showToast('⚠️ Semua field harus diisi!');
        return;
    }

    showToast(`✅ Pesanan untuk ${customer} berhasil ditambahkan!`);
    closeModal('modalOrder');
}

function openDetailModal(id, customer, product, status, amount, date) {
    const content = `
        <div class="detail-row"><strong>Order ID:</strong> ${id}</div>
        <div class="detail-row"><strong>Pelanggan:</strong> ${customer}</div>
        <div class="detail-row"><strong>Produk:</strong> ${product}</div>
        <div class="detail-row"><strong>Status:</strong> <span class="badge-status ${status}">${status}</span></div>
        <div class="detail-row"><strong>Jumlah:</strong> $${amount}</div>
        <div class="detail-row"><strong>Tanggal:</strong> ${date}</div>
    `;
    document.getElementById('detailContent').innerHTML = content;
    document.getElementById('modalDetail').style.display = 'flex';
}
// ============================================================
// 10. USER MODAL FUNCTIONS  + paginations
// ============================================================

function openUserModal() {
    document.getElementById('modalUser').style.display = 'flex';
}

function confirmUser() {
    const name = document.getElementById('userName').value;
    const email = document.getElementById('userEmail').value;
    const role = document.getElementById('userRole').value;
    const status = document.getElementById('userStatus').value;

    if (!name || !email) {
        showToast('⚠️ Nama dan Email harus diisi!');
        return;
    }

    showToast(`✅ Pengguna ${name} berhasil ditambahkan! (Role: ${role}, Status: ${status === 'active' ? 'Aktif' : 'Nonaktif'})`);
    closeModal('modalUser');
}

function openUserDetailModal(name, email, role, status, joined, totalOrders) {
    const statusText = status === 'active' ? 'Aktif' : 'Nonaktif';
    const statusClass = status;

    const content = `
        <div class="detail-row"><strong>Nama:</strong> ${name}</div>
        <div class="detail-row"><strong>Email:</strong> ${email}</div>
        <div class="detail-row"><strong>Role:</strong> ${role}</div>
        <div class="detail-row"><strong>Status:</strong> <span class="badge-status ${statusClass}">${statusText}</span></div>
        <div class="detail-row"><strong>Bergabung:</strong> ${joined}</div>
        <div class="detail-row"><strong>Total Order:</strong> ${totalOrders} pesanan</div>
    `;
    document.getElementById('userDetailContent').innerHTML = content;
    document.getElementById('modalUserDetail').style.display = 'flex';
}

function editUser() {
    showToast('✏️ Edit pengguna (fitur akan datang)');
    closeModal('modalUserDetail');
}

function deleteUser() {
    showToast('🗑️ Pengguna dihapus (fitur akan datang)');
    closeModal('modalUserDetail');
}

function editUserModal(name, email, role, status) {
    // Buka modal edit dengan data yang sudah ada
    document.getElementById('modalUser').style.display = 'flex';
    document.getElementById('userName').value = name;
    document.getElementById('userEmail').value = email;
    document.getElementById('userRole').value = role;
    document.getElementById('userStatus').value = status;
    showToast(`✏️ Edit pengguna: ${name}`);
}

function editOrder() {
    showToast('✏️ Edit pesanan (fitur akan datang)');
    closeModal('modalDetail');
}

function deleteOrder() {
    showToast('🗑️ Pesanan dihapus (fitur akan datang)');
    closeModal('modalDetail');
}

/**
 * Konfigurasi pagination
 */
const paginationConfig = {
    itemsPerPage: 10,  // Jumlah item per halaman
    currentPage: 1,     // Halaman saat ini
    totalItems: 0,      // Total item (diisi dari data)
    data: []            // Data yang akan dipaginasi
};
const filterState = {
    status: 'all'  // 'all', 'active', 'inactive'
};
// DITAMBAHKAN - Fungsi baru untuk memfilter data
function filterUsersData(data, status) {
    if (status === 'Semua Status' || status === 'all') {
        return data;
    }
    const statusMap = {
        'Aktif': 'active',
        'Nonaktif': 'inactive'
    };

    const filterValue = statusMap[status] || status;
    return data.filter(user => user.status === filterValue);
}
/**
 * Inisialisasi pagination untuk halaman users
 * Fungsi ini akan dipanggil otomatis saat halaman users dimuat
 */
function initUserPagination() {
    const userTableBody = document.getElementById('userTableBody');
    if (!userTableBody) return;

    if (typeof window.allUsers !== 'undefined') {
        filterState.status = 'all';

        const filterSelect = document.getElementById('userStatusFilter');
        if (filterSelect) {
            filterSelect.value = 'Semua Status';
        }

        paginationConfig.data = window.allUsers;
        paginationConfig.totalItems = window.allUsers.length;

        renderUserPage(1);
        renderPaginationControls();
    }
}


/**
 * Render data untuk halaman tertentu
 * @param {number} page - Nomor halaman yang akan ditampilkan
 */
function renderUserPage(page) {
    const tbody = document.getElementById('userTableBody');
    if (!tbody) return;

    const config = paginationConfig;
    const startIndex = (page - 1) * config.itemsPerPage;
    const endIndex = Math.min(startIndex + config.itemsPerPage, config.totalItems);
    const pageData = config.data.slice(startIndex, endIndex);

    if (pageData.length === 0) {
        tbody.innerHTML = `
        <tr>
            <td colspan="8" style="text-align:center; padding:40px; color:var(--text-muted)">
                <i class="bi bi-person-x" style="font-size:24px; margin-bottom:8px; display:block"></i>
                Tidak ada pengguna yang sesuai dengan filter
            </td>
        </tr>
    `;
        return;
    }
    // Update current page
    config.currentPage = page;

    // Generate HTML untuk tabel
    let html = '';
    pageData.forEach((user, index) => {
        const globalIndex = startIndex + index;
        const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);

        html += `
            <tr>
                <td class="td-id">${globalIndex + 1}</td>
                <td>
                    <div class="td-user">
                        <div class="user-avatar-sm" style="background:${user.color}">
                            ${initials}
                        </div>
                        <span style="font-weight:600">${user.name}</span>
                    </div>
                </td>
                <td style="color:var(--text-secondary)">${user.email}</td>
                <td>
                    <span style="font-size:12px; padding:2px 8px; border-radius:4px; background:var(--bg-primary); color:var(--text-secondary); font-weight:500">
                        ${user.role}
                    </span>
                </td>
                <td>
                    <span class="badge-status ${user.status.toLowerCase()}">
                        ${user.status === 'active' ? 'Aktif' : 'Nonaktif'}
                    </span>
                </td>
                <td style="color:var(--text-muted); font-size:12px">${user.joined}</td>
                <td style="font-family:'JetBrains Mono',monospace; font-size:12px; text-align:center">
                    ${user.total_orders}
                </td>
                <td>
                    <div style="display:flex; gap:4px">
                        <button class="btn btn-icon" title="Lihat Profil" onclick="openUserDetailModal(
                            '${user.name.replace(/'/g, "\\'")}', 
                            '${user.email.replace(/'/g, "\\'")}', 
                            '${user.role}', 
                            '${user.status}', 
                            '${user.joined}', 
                            '${user.total_orders}')">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-icon" title="Edit" onclick="editUserModal(
                            '${user.name.replace(/'/g, "\\'")}', 
                            '${user.email.replace(/'/g, "\\'")}',
                            '${user.role}', 
                            '${user.status}')">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = html;

    // Update info pagination
    updatePaginationInfo();
}

/**
 * Render tombol navigasi pagination
 */
function renderPaginationControls() {
    const container = document.getElementById('paginationControls');
    if (!container) return;

    const config = paginationConfig;
    const totalPages = Math.ceil(config.totalItems / config.itemsPerPage);
    const currentPage = config.currentPage;

    let html = '';

    // Tombol Previous
    html += `
        <button class="pagination-btn" onclick="goToPage(${currentPage - 1})" 
                ${currentPage === 1 ? 'disabled' : ''}>
            <i class="bi bi-chevron-left"></i>
        </button>
    `;

    // Nomor halaman
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    // Halaman pertama dan ellipsis
    if (startPage > 1) {
        html += `<button class="pagination-btn" onclick="goToPage(1)">1</button>`;
        if (startPage > 2) {
            html += `<span class="pagination-ellipsis">...</span>`;
        }
    }

    // Nomor halaman
    for (let i = startPage; i <= endPage; i++) {
        html += `
                <button class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                        onclick="goToPage(${i})">
                    ${i}
                </button>
            `;
    }

    // Halaman terakhir dan ellipsis
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            html += `<span class="pagination-ellipsis">...</span>`;
        }
        html += `<button class="pagination-btn" onclick="goToPage(${totalPages})">${totalPages}</button>`;
    }

    // Tombol Next
    html += `
        <button class="pagination-btn" onclick="goToPage(${currentPage + 1})" 
                ${currentPage === totalPages ? 'disabled' : ''}>
            <i class="bi bi-chevron-right"></i>
        </button>
    `;

    container.innerHTML = html;
}

/**
 * Pindah ke halaman tertentu
 * @param {number} page - Nomor halaman tujuan
 */
function goToPage(page) {
    const config = paginationConfig;
    const totalPages = Math.ceil(config.totalItems / config.itemsPerPage);

    // Validasi halaman
    if (page < 1 || page > totalPages) return;

    // Render halaman dengan data yang ada di config (sudah terfilter)
    renderUserPage(page);
    renderPaginationControls();
}
/**
 * Update informasi pagination (Menampilkan X-Y dari Z)
 */
function updatePaginationInfo() {
    const config = paginationConfig;
    if (config.totalItems === 0) {
        const infoElement = document.querySelector('.pagination-info');
        if (infoElement) {
            infoElement.textContent = `Tidak ada data yang ditampilkan`;
        }
        return;
    }
    const startItem = (config.currentPage - 1) * config.itemsPerPage + 1;
    const endItem = Math.min(config.currentPage * config.itemsPerPage, config.totalItems);

    // Cari elemen info pagination dan update
    const infoElement = document.querySelector('.pagination-info');
    if (infoElement) {
        infoElement.textContent = `Menampilkan ${startItem}-${endItem} dari ${config.totalItems} pengguna`;
    } else {
        // Buat elemen baru jika belum ada
        const container = document.querySelector('#paginationControls')?.parentElement;
        if (container) {
            const existingSpan = container.querySelector('span');
            if (existingSpan) {
                existingSpan.textContent = `Menampilkan ${startItem}-${endItem} dari ${config.totalItems} pengguna`;
            }
        }
    }
}

/**
 * Fungsi untuk render ulang pagination (dipanggil dari view)
 */
function renderUserPagination() {
    initUserPagination();
}

/**
 * filter function
 */

function filterUsers() {
    const filterSelect = document.getElementById('userStatusFilter');
    if (!filterSelect) return;

    filterState.status = filterSelect.value;
    paginationConfig.currentPage = 1;  // Reset ke halaman 1
    renderFilteredUsers();             // Render ulang dengan data terfilter
}
function renderFilteredUsers() {
    const allData = window.allUsers || [];
    const filteredData = filterUsersData(allData, filterState.status);

    paginationConfig.data = filteredData;
    paginationConfig.totalItems = filteredData.length;

    renderUserPage(1);
    renderPaginationControls();
}

// ============================================================
// 11. PRODUCT MODAL FUNCTIONS
// ============================================================

// Variabel untuk menyimpan data produk (simulasi database)
// let productsData = <?= json_encode($products) ?>;

function openProductModal() {
    document.getElementById('modalProduct').style.display = 'flex';
}



function confirmProduct() {
    const name = document.getElementById('productName').value;
    const sku = document.getElementById('productSku').value;
    const category = document.getElementById('productCategory').value;
    const price = parseFloat(document.getElementById('productPrice').value);
    const stock = parseInt(document.getElementById('productStock').value);

    if (!name || !sku || !price || isNaN(stock)) {
        showToast('⚠️ Semua field harus diisi dengan benar!');
        return;
    }

    showToast(`✅ Produk "${name}" berhasil ditambahkan! (Harga: $${price}, Stok: ${stock})`);
    closeModal('modalProduct');
}

function openProductDetailModal(product) {
    const status = product.stock > 0 ? 'Tersedia' : 'Habis';
    const statusClass = product.stock > 0 ? 'active' : 'cancelled';
    const ratingStars = '★'.repeat(Math.floor(product.rating)) + '☆'.repeat(5 - Math.floor(product.rating));

    const content = `
        <div class="detail-row"><strong><img src="${product.image}" alt="${product.name}" style="width:360px; height:360px; object-fit:cover; border-radius:4px; margin-right:12px; vertical-align:middle"></div>
        <div class="detail-row"><strong>Nama Produk:</strong> ${product.name}</div>
        <div class="detail-row"><strong>SKU:</strong> ${product.sku}</div>
        <div class="detail-row"><strong>Kategori:</strong> ${product.category}</div>
        <div class="detail-row"><strong>Harga:</strong> $${product.price.toLocaleString()}</div>
        <div class="detail-row"><strong>Stok:</strong> ${product.stock} unit</div>
        <div class="detail-row"><strong>Terjual:</strong> ${product.sold} unit</div>
        <div class="detail-row"><strong>Rating:</strong> ${product.rating} ${ratingStars}</div>
        <div class="detail-row"><strong>Status:</strong> <span class="badge-status ${statusClass}">${status}</span></div>
    `;
    document.getElementById('productDetailContent').innerHTML = content;
    document.getElementById('modalProductDetail').style.display = 'flex';
}

function openProductEditModal(index, product) {
    document.getElementById('editProductIndex').value = index;
    document.getElementById('editProductName').value = product.name;
    document.getElementById('editProductSku').value = product.sku;
    document.getElementById('editProductCategory').value = product.category;
    document.getElementById('editProductPrice').value = product.price;
    document.getElementById('editProductStock').value = product.stock;
    document.getElementById('modalProductEdit').style.display = 'flex';
}

function updateProduct() {
    const index = document.getElementById('editProductIndex').value;
    const name = document.getElementById('editProductName').value;
    const sku = document.getElementById('editProductSku').value;
    const category = document.getElementById('editProductCategory').value;
    const price = parseFloat(document.getElementById('editProductPrice').value);
    const stock = parseInt(document.getElementById('editProductStock').value);

    if (!name || !sku || !price || isNaN(stock)) {
        showToast('⚠️ Semua field harus diisi dengan benar!');
        return;
    }

    showToast(`✏️ Produk "${name}" berhasil diupdate! (Harga: $${price}, Stok: ${stock})`);
    closeModal('modalProductEdit');
}

function deleteProductConfirm(index, productName) {
    if (confirm(`Apakah Anda yakin ingin menghapus produk "${productName}"?`)) {
        showToast(`🗑️ Produk "${productName}" dihapus (fitur akan datang)`);
    }
}

function editProduct() {
    showToast('✏️ Edit produk (gunakan tombol pensil di tabel)');
    closeModal('modalProductDetail');
}

function deleteProduct() {
    showToast('🗑️ Hapus produk (fitur akan datang)');
    closeModal('modalProductDetail');
}
// ============================================================
// 12. ORDER MODAL FUNCTIONS
// ============================================================

// Filter pesanan berdasarkan status
function filterOrders() {
    const filter = document.getElementById('statusFilter');
    if (!filter) return;

    const filterValue = filter.value;
    const rows = document.querySelectorAll('#ordersTableBody tr');

    rows.forEach(row => {
        if (filterValue === 'all' || row.dataset.status === filterValue) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Open modal tambah pesanan
function openOrderModal() {
    const modal = document.getElementById('modalOrder');
    if (modal) modal.style.display = 'flex';
}

// Konfirmasi tambah pesanan
function confirmAddOrder() {
    const customer = document.getElementById('orderCustomer');
    const product = document.getElementById('orderProduct');
    const amount = document.getElementById('orderAmount');
    const paymentMethod = document.getElementById('orderPaymentMethod');
    const address = document.getElementById('orderAddress');

    if (!customer || !product || !amount) {
        showToast('⚠️ Nama, Produk, dan Jumlah harus diisi!');
        return;
    }

    const customerName = customer.value;
    const productName = product.value;
    const amountValue = amount.value;

    showToast(`✅ Pesanan untuk ${customerName} berhasil ditambahkan! (Produk: ${productName}, Total: $${amountValue})`);
    closeModal('modalOrder');

    // Reset form
    if (customer) customer.value = '';
    if (product) product.value = '';
    if (amount) amount.value = '';
    if (paymentMethod) paymentMethod.value = 'Credit Card';
    if (address) address.value = '';
}

// Open modal detail pesanan
function openOrderDetailModal(order) {
    const statusText = order.status === 'completed' ? 'Selesai' :
        (order.status === 'processing' ? 'Diproses' :
            (order.status === 'pending' ? 'Pending' : 'Dibatalkan'));

    const content = `
        <div class="detail-row"><strong>Order ID:</strong> ${order.id}</div>
        <div class="detail-row"><strong>Pelanggan:</strong> ${order.customer}</div>
        <div class="detail-row"><strong>Produk:</strong> ${order.product}</div>
        <div class="detail-row"><strong>Status:</strong> <span class="badge-status ${order.status}">${statusText}</span></div>
        <div class="detail-row"><strong>Jumlah:</strong> $${parseFloat(order.amount).toLocaleString()}</div>
        <div class="detail-row"><strong>Tanggal:</strong> ${order.date}</div>
        <div class="detail-row"><strong>Metode Pembayaran:</strong> ${order.payment_method || '-'}</div>
        <div class="detail-row"><strong>Alamat Pengiriman:</strong> ${order.shipping_address || '-'}</div>
    `;
    const detailContent = document.getElementById('orderDetailContent');
    if (detailContent) detailContent.innerHTML = content;

    const modal = document.getElementById('modalOrderDetail');
    if (modal) modal.style.display = 'flex';
}

// Open modal edit status
function editOrderStatusModal(order) {
    const editId = document.getElementById('editOrderId');
    const editIdDisplay = document.getElementById('editOrderIdDisplay');
    const editStatus = document.getElementById('editOrderStatus');

    if (editId) editId.value = order.id;
    if (editIdDisplay) editIdDisplay.value = order.id;
    if (editStatus) editStatus.value = order.status;

    const modal = document.getElementById('modalEditStatus');
    if (modal) modal.style.display = 'flex';
}

// Update status pesanan
function updateOrderStatus() {
    const orderId = document.getElementById('editOrderId');
    const newStatus = document.getElementById('editOrderStatus');

    if (!orderId || !newStatus) return;

    const statusText = newStatus.value === 'completed' ? 'Selesai' :
        (newStatus.value === 'processing' ? 'Diproses' :
            (newStatus.value === 'pending' ? 'Pending' : 'Dibatalkan'));

    showToast(`✏️ Status pesanan ${orderId.value} diubah menjadi ${statusText}`);
    closeModal('modalEditStatus');
}

// Export ke global
window.filterOrders = filterOrders;
window.openOrderModal = openOrderModal;
window.confirmAddOrder = confirmAddOrder;
window.openOrderDetailModal = openOrderDetailModal;
window.editOrderStatusModal = editOrderStatusModal;
window.updateOrderStatus = updateOrderStatus;
window.filterUsers = filterUsers;        // DITAMBAHKAN
window.filterState = filterState;        // DITAMBAHKAN

// Expose ke global
window.showToast = showToast;
window.initRevenueChart = initRevenueChart;
window.initTrafficChart = initTrafficChart;
window.initAnalyticsCharts = initAnalyticsCharts;
window.forceResizeRevenueChart = forceResizeRevenueChart;
window.initAnalyticsCharts = initAnalyticsCharts;

window.initUserPagination = initUserPagination;
window.renderUserPagination = renderUserPagination;
window.goToPage = goToPage;
window.renderUserPage = renderUserPage;
//resize
window.addEventListener('resize', () => {
    setTimeout(() => {
        if (window.allCharts && window.allCharts.length) {
            window.allCharts.forEach(chart => {
                if (chart && typeof chart.resize === 'function') {
                    chart.resize();
                }
            });
        }
    }, 100);
});