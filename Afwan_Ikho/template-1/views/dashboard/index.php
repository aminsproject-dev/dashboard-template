<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-content">

    <!-- Header Halaman -->
    <div class="page-header">
        <h1>👋 Selamat datang, Admin!</h1>
        <p>Monitor bisnis dan performa toko Anda</p>
    </div>

    <!-- ===========================
         STAT CARDS
         4 kartu metrik utama
         =========================== -->
    <div class="stats-grid">

        <!-- Total Users -->
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Pengguna</div>
                <div class="stat-card-value"><?= number_format($stats['total_users']) ?></div>
                <div class="stat-card-change up">
                    <i class="bi bi-arrow-up"></i> +12% dari bulan lalu
                </div>
            </div>
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.1); color:#6366f1">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>

        <!-- Revenue -->
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Revenue</div>
                <div class="stat-card-value">$<?= number_format($stats['revenue']) ?></div>
                <div class="stat-card-change up">
                    <i class="bi bi-arrow-up"></i> +8% dari bulan lalu
                </div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>

        <!-- Active Orders -->
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Pesanan Aktif</div>
                <div class="stat-card-value"><?= $stats['active_orders'] ?></div>
                <div class="stat-card-change neutral">
                    <i class="bi bi-dash"></i> 0% perubahan
                </div>
            </div>
            <div class="stat-card-icon" style="background:rgba(245,158,11,0.1); color:#f59e0b">
                <i class="bi bi-cart-check-fill"></i>
            </div>
        </div>

        <!-- Conversion -->
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Konversi</div>
                <div class="stat-card-value"><?= $stats['conversion'] ?>%</div>
                <div class="stat-card-change down">
                    <i class="bi bi-arrow-down"></i> -3% dari bulan lalu
                </div>
            </div>
            <div class="stat-card-icon" style="background:rgba(239,68,68,0.1); color:#ef4444">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>

    </div>
    <!-- END STAT CARDS -->


    <!-- ===========================
         CHARTS SECTION
         Line chart + Donut chart
         =========================== -->
    <div class="charts-grid">

        <!-- Monthly Revenue Chart -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="bi bi-bar-chart-fill icon"></i>
                    Revenue Bulanan
                </div>
                <div style="display:flex; gap:8px">
                    <button class="btn btn-outline btn-sm">Export</button>
                    <button class="btn btn-outline btn-sm">Minggu Ini</button>
                </div>
            </div>
            <div class="card-body">
                <!-- Canvas untuk Chart.js -->
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Traffic Sources Donut Chart -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="bi bi-pie-chart-fill icon"></i>
                    Sumber Traffic
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height:200px">
                    <canvas id="trafficChart"></canvas>
                </div>
                <!-- Legenda custom di bawah chart -->
                <div style="margin-top:16px">
                    <?php foreach ($trafficSources as $source): ?>
                        <div class="legend-item">
                            <div class="legend-dot" style="background:<?= $source['color'] ?>"></div>
                            <span><?= $source['label'] ?></span>
                            <span class="legend-value"><?= $source['value'] ?>%</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    <!-- END CHARTS -->


    <!-- ===========================
         RECENT ORDERS TABLE
         Tabel pesanan terbaru
         =========================== -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="bi bi-table icon"></i>
                Pesanan Terbaru
            </div>
            <button class="btn btn-primary btn-sm" onclick="openOrderModal()">
                <i class="bi bi-plus"></i> Tambah Pesanan
            </button>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td class="td-id"><?= $order['id'] ?></td>
                                <td><?= $order['customer'] ?></td>
                                <td><?= $order['product'] ?></td>
                                <td>
                                    <!-- Badge status dengan class berbeda sesuai status -->
                                    <span class="badge-status <?= strtolower($order['status']) ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                                <td style="font-family:'JetBrains Mono',monospace; font-weight:600">
                                    $<?= number_format($order['amount'], 2) ?>
                                </td>
                                <td style="color:var(--text-muted)"><?= $order['date'] ?></td>
                                <td>
                                    <button class="btn btn-icon" title="Lihat Detail" onclick="openDetailModal(
                                    '<?= $order['id'] ?>',
                                    '<?= $order['customer'] ?>',
                                    '<?= $order['product'] ?>',
                                    '<?= $order['status'] ?>',
                                    '<?= $order['amount'] ?>',
                                    '<?= $order['date'] ?>')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END RECENT ORDERS -->
    <!-- Modal Tambah Pesanan -->
    <div id="modalOrder" class="modal-overlay" style="display:none">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Tambah Pesanan Baru</h3>
                <button class="modal-close" onclick="closeModal('modalOrder')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" id="customerName" class="form-input" placeholder="Masukkan nama pelanggan">
                </div>
                <div class="form-group">
                    <label class="form-label">Pilih Produk</label>
                    <select id="productSelect" class="form-input form-select">
                        <option value="">-- Pilih Produk --</option>
                        <option value="Wireless Headphones">Wireless Headphones</option>
                        <option value="Smart Watch">Smart Watch </option>
                        <option value="Laptop Pro">Laptop Pro </option>
                        <option value="Tablet Air">Tablet Air </option>
                        <option value="Gaming Mouse">Gaming Mouse </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Pembayaran</label>
                    <input type="number" id="paymentAmount" class="form-input" placeholder="Masukkan jumlah">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal('modalOrder')">Batal</button>
                <button class="btn btn-primary" onclick="confirmOrder()">Konfirmasi</button>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    <div id="modalDetail" class="modal-overlay" style="display:none">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Detail Pesanan</h3>
                <button class="modal-close" onclick="closeModal('modalDetail')">&times;</button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Isi detail akan diisi JavaScript -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="editOrder()">Edit</button>
                <button class="btn btn-danger" onclick="deleteOrder()">Hapus</button>
                <button class="btn btn-outline" onclick="closeModal('modalDetail')">Tutup</button>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<!-- Load Chart.js hanya untuk halaman yang butuh -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Inisialisasi chart setelah DOM siap
    (function() {
        // Fungsi untuk inisialisasi chart
        function initCharts() {
            const revenueLabels = <?= json_encode($revenueLabels) ?>;
            const revenueData = <?= json_encode($revenueData) ?>;

            if (typeof initRevenueChart === 'function') {
                initRevenueChart(revenueLabels, revenueData);
            }

            const trafficLabels = <?= json_encode(array_column($trafficSources, 'label')) ?>;
            const trafficValues = <?= json_encode(array_column($trafficSources, 'value')) ?>;
            const trafficColors = <?= json_encode(array_column($trafficSources, 'color')) ?>;

            if (typeof initTrafficChart === 'function') {
                initTrafficChart(trafficLabels, trafficValues, trafficColors);
            }
        }

        // Jalankan saat DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCharts);
        } else {
            initCharts();
        }
    })();

    // Resize chart saat sidebar toggle
    document.addEventListener('sidebarToggled', function() {
        setTimeout(() => {
            if (window.allCharts) {
                window.allCharts.forEach(chart => {
                    if (chart && chart.resize) chart.resize();
                });
            }
        }, 300);
    });
</script>
<?= $this->endSection() ?>