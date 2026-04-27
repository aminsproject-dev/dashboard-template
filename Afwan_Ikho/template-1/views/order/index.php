<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-header">
        <h1>📊 Analitik</h1>
        <p>Laporan performa penjualan dan tren toko Anda</p>
    </div>
    <!-- KPI Analytics -->
    <div class="analytics-stat-row">
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Penjualan (6 Bln)</div>
                <div class="stat-card-value">$<?= number_format($kpi['total_sales']) ?></div>
                <div class="stat-card-change up"><i class="bi bi-arrow-up"></i> +24% vs periode lalu</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.1); color:#6366f1">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Total Pesanan</div>
                <div class="stat-card-value"><?= number_format($kpi['total_orders']) ?></div>
                <div class="stat-card-change up"><i class="bi bi-arrow-up"></i> +18% vs periode lalu</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.1); color:#10b981">
                <i class="bi bi-bag-check-fill"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <div class="stat-card-label">Rata-rata Nilai Order</div>
                <div class="stat-card-value">$<?= number_format($kpi['avg_order']) ?></div>
                <div class="stat-card-change down"><i class="bi bi-arrow-down"></i> -4% vs periode lalu</div>
            </div>
            <div class="stat-card-icon" style="background:rgba(245,158,11,0.1); color:#f59e0b">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-grid" style="margin-bottom:24px">

        <!-- Bar Chart: Penjualan per Kategori -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="bi bi-bar-chart-fill icon"></i>
                    Penjualan per Kategori
                </div>
                <span style="font-size:12px; color:var(--text-muted)">6 bulan terakhir</span>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height:240px">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Produk -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="bi bi-trophy-fill icon"></i>
                    Produk Terlaris
                </div>
            </div>
            <div class="card-body" style="padding-top:8px">
                <?php foreach ($topProducts as $i => $p): ?>
                <div class="top-product-item">
                    <!-- Warna rank berbeda untuk posisi 1, 2, 3 -->
                    <div class="top-product-rank <?= $i === 0 ? 'gold' : ($i === 1 ? 'silver' : ($i === 2 ? 'bronze' : '')) ?>">
                        <?= $i + 1 ?>
                    </div>
                    <div class="product-img-thumb" style="width:32px; height:32px; font-size:14px">
                        <?= $p['icon'] ?>
                    </div>
                    <div class="top-product-info">
                        <strong><?= $p['name'] ?></strong>
                        <span><?= $p['sold'] ?> terjual</span>
                    </div>
                    <div class="top-product-rev">$<?= number_format($p['revenue']) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <!-- Revenue vs Orders Comparison -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="bi bi-graph-up icon"></i>
                Perbandingan Revenue & Pesanan
            </div>
            <span style="font-size:12px; color:var(--text-muted)">Jan - Jun 2024</span>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:280px">
                <canvas id="compareChart"></canvas>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready - checking mode:', document.compatMode);
    
    if (document.compatMode === 'BackCompat') {
        console.error('⚠️ Page is in Quirks Mode!');
        return;
    }
    
    console.log('✅ Page in Standards Mode');
    
    // Cek apakah Chart.js sudah load
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js not loaded!');
        return;
    }
    
    console.log('✅ Chart.js loaded, version:', Chart.version);
    
    // ============================================================
    // 1. BAR CHART - Penjualan per Kategori
    // ============================================================
    const categoryCanvas = document.getElementById('categoryChart');
    if (categoryCanvas) {
        console.log('Creating bar chart...');
        
        try {
            new Chart(categoryCanvas, {
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
                            'rgba(239,68,68,0.8)'
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
                                label: function(context) {
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
            console.log('✅ Bar chart created successfully');
        } catch(e) {
            console.error('❌ Error creating bar chart:', e);
        }
    } else {
        console.warn('⚠️ Canvas #categoryChart not found');
    }
    
    // ============================================================
    // 2. LINE CHART - Revenue vs Orders Comparison
    // ============================================================
    const compareCanvas = document.getElementById('compareChart');
    if (compareCanvas) {
        console.log('Creating line chart...');
        
        try {
            new Chart(compareCanvas, {
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
                                label: function(context) {
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
                                callback: function(val) {
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
            console.log('✅ Line chart created successfully');
        } catch(e) {
            console.error('❌ Error creating line chart:', e);
        }
    } else {
        console.warn('⚠️ Canvas #compareChart not found');
    }
});
</script>
<?= $this->endSection() ?>