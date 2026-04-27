<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-content">

    <div class="page-header">
        <h1>⚙️ Pengaturan</h1>
        <p>Sesuaikan tampilan dan preferensi panel admin</p>
    </div>

    <div class="settings-layout">

        <!-- Navigasi Settings (panel kiri) -->
        <div class="card" style="height:fit-content">
            <div class="card-body" style="padding:8px">
                <div class="settings-nav">
                    <div class="settings-nav-item active" onclick="showSettingsTab('theme', this)">
                        <i class="bi bi-palette"></i> Tema & Tampilan
                    </div>
                    <div class="settings-nav-item" onclick="showSettingsTab('account', this)">
                        <i class="bi bi-person-circle"></i> Akun
                    </div>
                    <div class="settings-nav-item" onclick="showSettingsTab('notifications', this)">
                        <i class="bi bi-bell"></i> Notifikasi
                    </div>
                    <div class="settings-nav-item" onclick="showSettingsTab('security', this)">
                        <i class="bi bi-shield-lock"></i> Keamanan
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Settings (panel kanan) -->
        <div>

            <!-- === TAB: TEMA & TAMPILAN === -->
            <div id="tab-theme" class="settings-tab">
                <div class="card" style="margin-bottom:16px">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-moon-stars icon"></i> Mode Gelap / Terang</div>
                    </div>
                    <div class="card-body">
                        <div class="setting-row">
                            <div class="setting-row-info">
                                <strong>Dark Mode</strong>
                                <span>Aktifkan tampilan gelap untuk kenyamanan di malam hari</span>
                            </div>
                            <div class="toggle-switch">
                                <!--
                                    Input checkbox tersembunyi, dikendalikan oleh label.
                                    ID harus sama antara input[id] dan label[for].
                                    State awal dicek dari localStorage lewat JS.
                                -->
                                <input type="checkbox" id="darkModeToggle"
                                    onchange="applyThemeMode(this.checked); showToast(this.checked ? '🌙 Dark mode aktif' : '☀️ Light mode aktif')">
                                <label for="darkModeToggle"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-bottom:16px">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-palette2 icon"></i> Warna Aksen</div>
                    </div>
                    <div class="card-body">
                        <p style="font-size:13px; color:var(--text-secondary); margin-bottom:16px">
                            Pilih warna utama yang digunakan di seluruh panel admin.
                        </p>
                        <!-- Palet warna pilihan -->
                        <div class="theme-colors">
                            <?php
                            // Data warna aksen yang tersedia
                            $accentColors = [
                                ['color' => '#6366f1', 'name' => 'Indigo'],
                                ['color' => '#8b5cf6', 'name' => 'Violet'],
                                ['color' => '#ec4899', 'name' => 'Pink'],
                                ['color' => '#ef4444', 'name' => 'Red'],
                                ['color' => '#f59e0b', 'name' => 'Amber'],
                                ['color' => '#10b981', 'name' => 'Emerald'],
                                ['color' => '#3b82f6', 'name' => 'Blue'],
                                ['color' => '#06b6d4', 'name' => 'Cyan'],
                            ];
                            foreach ($accentColors as $ac):
                            ?>
                            <button
                                class="theme-color-btn"
                                data-color="<?= $ac['color'] ?>"
                                style="background:<?= $ac['color'] ?>"
                                title="<?= $ac['name'] ?>"
                                onclick="applyAccentColor('<?= $ac['color'] ?>'); showToast('🎨 Warna diubah ke <?= $ac['name'] ?>')">
                            </button>
                            <?php endforeach; ?>
                        </div>

                        <!-- Script untuk menandai warna yang sedang aktif -->
                        <script>
                        // Saat halaman dimuat, tandai warna yang tersimpan
                        window.addEventListener('DOMContentLoaded', () => {
                            const saved = localStorage.getItem('theme_accent') || '#6366f1';
                            document.querySelectorAll('.theme-color-btn').forEach(btn => {
                                btn.classList.toggle('selected', btn.dataset.color === saved);
                            });
                        });
                        </script>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-layout-sidebar icon"></i> Sidebar</div>
                    </div>
                    <div class="card-body">
                        <div class="setting-row">
                            <div class="setting-row-info">
                                <strong>Auto-minimize di layar kecil</strong>
                                <span>Sidebar otomatis menyempit di layar tablet</span>
                            </div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="autoMinToggle" checked
                                    onchange="showToast('Pengaturan disimpan ✓')">
                                <label for="autoMinToggle"></label>
                            </div>
                        </div>
                        <div class="setting-row">
                            <div class="setting-row-info">
                                <strong>Tampilkan Badge Notifikasi</strong>
                                <span>Tampilkan angka notifikasi di item navigasi</span>
                            </div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="badgeToggle" checked
                                    onchange="showToast('Pengaturan disimpan ✓')">
                                <label for="badgeToggle"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === TAB: AKUN === -->
            <div id="tab-account" class="settings-tab" style="display:none">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-person-circle icon"></i> Informasi Akun</div>
                    </div>
                    <div class="card-body">
                        <!-- Avatar besar -->
                        <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid var(--border-color)">
                            <div style="width:72px; height:72px; background:linear-gradient(135deg,#6366f1,#8b5cf6); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:800; font-size:24px">
                                AD
                            </div>
                            <div>
                                <h3 style="font-size:16px; font-weight:700">Admin</h3>
                                <p style="font-size:13px; color:var(--text-muted)">admin@onlineshop.com</p>
                                <button class="btn btn-outline btn-sm" style="margin-top:8px" onclick="showToast('Fitur ganti foto akan segera hadir!')">
                                    <i class="bi bi-camera"></i> Ganti Foto
                                </button>
                            </div>
                        </div>

                        <!-- Form Profil -->
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-input" value="Administrator">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" value="admin@onlineshop.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon <small>Opsional</small></label>
                            <input type="tel" class="form-input" placeholder="+62 xxx xxxx xxxx">
                        </div>
                        <button class="btn btn-primary" onclick="showToast('Profil berhasil disimpan ✓')">
                            <i class="bi bi-check2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- === TAB: NOTIFIKASI === -->
            <div id="tab-notifications" class="settings-tab" style="display:none">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-bell icon"></i> Preferensi Notifikasi</div>
                    </div>
                    <div class="card-body">
                        <?php
                        $notifSettings = [
                            ['id' => 'n1', 'title' => 'Pesanan Baru', 'desc' => 'Notifikasi saat ada pesanan masuk'],
                            ['id' => 'n2', 'title' => 'Pesanan Dibatalkan', 'desc' => 'Notifikasi saat pelanggan membatalkan pesanan'],
                            ['id' => 'n3', 'title' => 'Stok Menipis', 'desc' => 'Peringatan saat stok produk di bawah 10 unit'],
                            ['id' => 'n4', 'title' => 'Pengguna Baru', 'desc' => 'Notifikasi saat ada registrasi pengguna baru'],
                            ['id' => 'n5', 'title' => 'Laporan Harian', 'desc' => 'Ringkasan penjualan dikirim setiap hari pukul 08.00'],
                        ];
                        foreach ($notifSettings as $ns):
                        ?>
                        <div class="setting-row">
                            <div class="setting-row-info">
                                <strong><?= $ns['title'] ?></strong>
                                <span><?= $ns['desc'] ?></span>
                            </div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="<?= $ns['id'] ?>" checked
                                    onchange="showToast('Notifikasi diperbarui ✓')">
                                <label for="<?= $ns['id'] ?>"></label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- === TAB: KEAMANAN === -->
            <div id="tab-security" class="settings-tab" style="display:none">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="bi bi-shield-lock icon"></i> Ganti Password</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-input" placeholder="Min. 8 karakter">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-input" placeholder="Ulangi password baru">
                        </div>
                        <button class="btn btn-primary" onclick="showToast('Password berhasil diubah ✓')">
                            <i class="bi bi-lock"></i> Ubah Password
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
/**
 * Fungsi untuk menampilkan tab settings yang dipilih
 * @param {string} tabId - ID tab yang ingin ditampilkan
 * @param {HTMLElement} clickedItem - Elemen nav yang di-klik (untuk update 'active' class)
 */
function showSettingsTab(tabId, clickedItem) {
    // Sembunyikan semua tab
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.style.display = 'none';
    });

    // Hapus 'active' dari semua nav item
    document.querySelectorAll('.settings-nav-item').forEach(item => {
        item.classList.remove('active');
    });

    // Tampilkan tab yang dipilih
    document.getElementById('tab-' + tabId).style.display = 'block';

    // Tandai nav item yang aktif
    clickedItem.classList.add('active');
}
</script>
<?= $this->endSection() ?>
