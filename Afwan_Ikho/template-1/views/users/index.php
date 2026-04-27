<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-content">

    <div class="page-header">
        <h1>👥 Manajemen Pengguna</h1>
        <p>Kelola semua pengguna terdaftar di toko Anda</p>
    </div>

    <!-- Ringkasan statistik pengguna -->
    <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom:24px">
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Pengguna</div>
                <div class="stat-card-value"><?= $totalUsers ?></div>
                <div class="stat-card-change up"><i class="bi bi-arrow-up"></i> +12 minggu ini</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.1); color:#6366f1">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Pengguna Aktif</div>
                <div class="stat-card-value"><?= $activeUsers ?></div>
                <div class="stat-card-change up"><i class="bi bi-arrow-up"></i> +5 hari ini</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-person-check-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Pengguna Baru (Bulan Ini)</div>
                <div class="stat-card-value"><?= $newUsersThisMonth ?></div>
                <div class="stat-card-change up"><i class="bi bi-arrow-up"></i> +18% vs bulan lalu</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(59,130,246,0.1); color:#3b82f6">
                <i class="bi bi-person-plus-fill"></i>
            </div>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="bi bi-person-lines-fill icon"></i>
                Daftar Pengguna
            </div>
            <div style="display:flex; gap:8px; align-items:center">
                <!-- Filter dan tombol tambah -->
                <select id="userStatusFilter" class="form-input form-select" style="width:auto; padding:7px 32px 7px 12px; font-size:12px" onchange="filterUsers()">
                    <option value="Semua Status" selected>Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
                <button class="btn btn-primary btn-sm" onclick="openUserModal()">
                    <i class="bi bi-plus"></i> Tambah Pengguna
                </button>
            </div>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th>Total Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php foreach ($users as $i => $user): ?>
                            <tr>
                                <td class="td-id"><?= $i + 1 ?></td>
                                <td>
                                    <!-- Tampilkan avatar dengan inisial dan warna -->
                                    <div class="td-user">
                                        <div class="user-avatar-sm" style="background:<?= $user['color'] ?>">
                                            <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                        </div>
                                        <span style="font-weight:600"><?= $user['name'] ?></span>
                                    </div>
                                </td>
                                <td style="color:var(--text-secondary)"><?= $user['email'] ?></td>
                                <td>
                                    <span style="font-size:12px; padding:2px 8px; border-radius:4px; background:var(--bg-primary); color:var(--text-secondary); font-weight:500">
                                        <?= $user['role'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status <?= strtolower($user['status']) ?>">
                                        <?= $user['status'] ?>
                                    </span>
                                </td>
                                <td style="color:var(--text-muted); font-size:12px"><?= $user['joined'] ?></td>
                                <td style="font-family:'JetBrains Mono',monospace; font-size:12px; text-align:center">
                                    <?= $user['total_orders'] ?>
                                </td>
                                <td>
                                    <div style="display:flex; gap:4px">
                                        <button class="btn btn-icon" title="Lihat Profil" onclick="openUserDetailModal(
                                        '<?= $user['name'] ?>', 
                                        '<?= $user['email'] ?>', 
                                        '<?= $user['role'] ?>', 
                                        '<?= $user['status'] ?>', 
                                        '<?= $user['joined'] ?>', 
                                        '<?= $user['total_orders'] ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-icon" title="Edit" onclick="editUserModal(
                                        '<?= $user['name'] ?>', 
                                        '<?= $user['email'] ?>',
                                        '<?= $user['role'] ?>', 
                                        '<?= $user['status'] ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 20px; border-top:1px solid var(--border-color)">
                <span style="font-size:12px; color:var(--text-muted)" class="pagination-info">
                    Menampilkan 1-10 dari <?= $totalUsers ?> pengguna
                </span>
                <div style="display: flex; gap: 4px;" id="paginationControls">
                    <!-- Pagination controls akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>

        <!-- Modal Tambah Pengguna -->
        <div id="modalUser" class="modal-overlay" style="display:none">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>Tambah Pengguna Baru</h3>
                    <button class="modal-close" onclick="closeModal('modalUser')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" id="userName" class="form-input" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="userEmail" class="form-input" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select id="userRole" class="form-input form-select">
                            <option value="Customer">Customer</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="userStatus" class="form-input form-select">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" onclick="closeModal('modalUser')">Batal</button>
                    <button class="btn btn-primary" onclick="confirmUser()">Simpan</button>
                </div>
            </div>
        </div>

        <!-- Modal Detail Pengguna -->
        <div id="modalUserDetail" class="modal-overlay" style="display:none">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>Detail Pengguna</h3>
                    <button class="modal-close" onclick="closeModal('modalUserDetail')">&times;</button>
                </div>
                <div class="modal-body" id="userDetailContent">
                    <!-- Isi detail akan diisi JavaScript -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" onclick="editUser()">Edit</button>
                    <button class="btn btn-danger" onclick="deleteUser()">Hapus</button>
                    <button class="btn btn-outline" onclick="closeModal('modalUserDetail')">Tutup</button>
                </div>
            </div>
        </div>
        <script>
            // Data pengguna dari PHP (hanya untuk halaman users)
            window.allUsers = <?= json_encode($users) ?>;
            window.totalUsersAll = <?= $totalUsers ?>;

            // Inisialisasi pagination saat halaman dimuat
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof renderUserPagination === 'function') {
                    renderUserPagination();
                } else {
                    console.error('Fungsi pagination tidak ditemukan. Pastikan dashboard.js sudah dimuat.');
                }
            });
        </script>

    </div>

    <?= $this->endSection() ?>