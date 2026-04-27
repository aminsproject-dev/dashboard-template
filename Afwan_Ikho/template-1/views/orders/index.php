<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-content">

    <div class="page-header">
        <h1>📦 Manajemen Pesanan</h1>
        <p>Kelola semua pesanan pelanggan toko Anda</p>
    </div>

    <!-- Ringkasan statistik pesanan -->
    <div class="stats-grid" style="grid-template-columns: repeat(5, 1fr); margin-bottom:24px">
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Pesanan</div>
                <div class="stat-card-value"><?= $totalOrders ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.1); color:#6366f1">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Selesai</div>
                <div class="stat-card-value" style="color:#10b981"><?= $completedOrders ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-check-circle-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Diproses</div>
                <div class="stat-card-value" style="color:#3b82f6"><?= $processingOrders ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(59,130,246,0.1); color:#3b82f6">
                <i class="bi bi-hourglass-split"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Pending</div>
                <div class="stat-card-value" style="color:#f59e0b"><?= $pendingOrders ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(245,158,11,0.1); color:#f59e0b">
                <i class="bi bi-clock-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Revenue</div>
                <div class="stat-card-value" style="font-size:18px">$<?= number_format($totalRevenue) ?></div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="bi bi-table icon"></i>
                Daftar Pesanan
            </div>
            <div style="display:flex; gap:8px; align-items:center">
                <select id="statusFilter" class="form-input form-select" style="width:auto; padding:7px 32px 7px 12px; font-size:12px" onchange="filterOrders()">
                    <option value="all">Semua Status</option>
                    <option value="completed">Selesai</option>
                    <option value="processing">Diproses</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                <button class="btn btn-primary btn-sm" onclick="openOrderModal()">
                    <i class="bi bi-plus"></i> Tambah Pesanan
                </button>
            </div>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrapper">
                <table id="ordersTable">
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
                    <tbody id="ordersTableBody">
                        <?php foreach ($orders as $order): ?>
                        <tr data-status="<?= $order['status'] ?>">
                            <td class="td-id"><?= $order['id'] ?></td>
                            <td><?= $order['customer'] ?></td>
                            <td><?= $order['product'] ?></td>
                            <td>
                                <span class="badge-status <?= $order['status'] ?>">
                                    <?= $order['status'] === 'completed' ? 'Selesai' : ($order['status'] === 'processing' ? 'Diproses' : ($order['status'] === 'pending' ? 'Pending' : 'Dibatalkan')) ?>
                                </span>
                            </td>
                            <td style="font-family:'JetBrains Mono',monospace; font-weight:600">
                                $<?= number_format($order['amount'], 2) ?>
                            </td>
                            <td style="color:var(--text-muted)"><?= $order['date'] ?></td>
                            <td>
                                <div style="display:flex; gap:4px">
                                    <button class="btn btn-icon" title="Lihat Detail" onclick='openOrderDetailModal(<?= json_encode($order) ?>)'>
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-icon" title="Edit Status" onclick='editOrderStatusModal(<?= json_encode($order) ?>)'>
                                        <i class="bi bi-pencil"></i>
                                    </button>
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
                <input type="text" id="orderCustomer" class="form-input" placeholder="Masukkan nama pelanggan">
            </div>
            <div class="form-group">
                <label class="form-label">Pilih Produk</label>
                <select id="orderProduct" class="form-input form-select">
                    <option value="">-- Pilih Produk --</option>
                    <option value="Wireless Headphones">Wireless Headphones - $299</option>
                    <option value="Smart Watch">Smart Watch - $199</option>
                    <option value="Laptop Pro">Laptop Pro - $1299</option>
                    <option value="Tablet Air">Tablet Air - $499</option>
                    <option value="Gaming Mouse">Gaming Mouse - $79</option>
                    <option value="Mechanical Keyboard">Mechanical Keyboard - $149</option>
                    <option value="USB-C Hub">USB-C Hub - $59</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Jumlah Pembayaran ($)</label>
                <input type="number" id="orderAmount" class="form-input" placeholder="Masukkan jumlah">
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select id="orderPaymentMethod" class="form-input form-select">
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Alamat Pengiriman</label>
                <textarea id="orderAddress" class="form-input" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modalOrder')">Batal</button>
            <button class="btn btn-primary" onclick="confirmAddOrder()">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Detail Pesanan -->
<div id="modalOrderDetail" class="modal-overlay" style="display:none">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Detail Pesanan</h3>
            <button class="modal-close" onclick="closeModal('modalOrderDetail')">&times;</button>
        </div>
        <div class="modal-body" id="orderDetailContent">
            <!-- Isi detail akan diisi JavaScript -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modalOrderDetail')">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Edit Status Pesanan -->
<div id="modalEditStatus" class="modal-overlay" style="display:none">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Edit Status Pesanan</h3>
            <button class="modal-close" onclick="closeModal('modalEditStatus')">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="editOrderId">
            <div class="form-group">
                <label class="form-label">Order ID</label>
                <input type="text" id="editOrderIdDisplay" class="form-input" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Status Pesanan</label>
                <select id="editOrderStatus" class="form-input form-select">
                    <option value="pending">Pending</option>
                    <option value="processing">Diproses</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('modalEditStatus')">Batal</button>
            <button class="btn btn-primary" onclick="updateOrderStatus()">Update Status</button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<?= $this->endSection() ?>