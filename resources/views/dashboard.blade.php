<x-app-layout>
    <style>
        :root {
            --dinkes-green: #0b3d2e;
            --dinkes-green-light: #0f5a43;
            --bg-soft: #f8fafc;
        }

        .dashboard-wrapper {
            padding: 2rem 1.5rem;
            background-color: var(--bg-soft);
            min-height: 100vh;
        }

        /* Topbar Instansi Style */
        .dashboard-header {
            background: linear-gradient(135deg, var(--dinkes-green), var(--dinkes-green-light));
            border-radius: 16px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px -5px rgba(11, 61, 46, 0.2);
        }

        /* Card Stats */
        .stat-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            transition: transform 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0.5rem 0;
        }

        /* Chart Containers */
        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        canvas {
            max-height: 300px !important;
        }

        /* Table Style */
        .table-instansi {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .table-instansi th {
            background: #f8fafc;
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            padding: 1rem;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
        }
    </style>

    <div class="dashboard-wrapper">
        <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="h3 fw-bold m-0">Dashboard SIADRU</h1>
                <p class="m-0 opacity-75 small">Sistem Informasi Aduan & Respon Umum Dinkes Sumenep</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.aduan.index') }}" class="btn btn-light btn-sm fw-bold px-3 shadow-sm">
                    📂 Manajemen Aduan
                </a>
                <a href="/" class="btn btn-outline-light btn-sm px-3">Landing Page</a>
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold m-0 text-dark">Ringkasan Statistik</h5>
                <p class="text-muted small m-0">Data berdasarkan laporan masyarakat terbaru</p>
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="days" class="form-select form-select-sm border-0 shadow-sm px-3" style="border-radius: 8px;">
                    <option value="7"  {{ $days==7 ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="14" {{ $days==14 ? 'selected' : '' }}>14 Hari Terakhir</option>
                    <option value="30" {{ $days==30 ? 'selected' : '' }}>30 Hari Terakhir</option>
                </select>
                <button class="btn btn-success btn-sm px-3 fw-bold shadow-sm" style="border-radius: 8px;">Terapkan</button>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-3 mb-4">
            <div class="col">
                <div class="stat-card border-start border-primary border-4">
                    <div class="stat-label">Total Aduan</div>
                    <div class="stat-value">{{ $totalAduan }}</div>
                    <div class="small text-muted">Aspirasi masuk</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card border-start border-danger border-4">
                    <div class="stat-label text-danger">Status Darurat</div>
                    <div class="stat-value text-danger">{{ $darurat }}</div>
                    <div class="small text-muted">Perlu respon cepat</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card border-start border-warning border-4">
                    <div class="stat-label">Sedang Diproses</div>
                    <div class="stat-value">{{ $diproses }}</div>
                    <div class="small text-muted">Dalam penanganan</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card border-start border-success border-4">
                    <div class="stat-label text-success">Total Selesai</div>
                    <div class="stat-value text-success">{{ $selesai }}</div>
                    <div class="small text-muted">Terselesaikan</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card border-start border-secondary border-4">
                    <div class="stat-label">Belum Selesai</div>
                    <div class="stat-value">{{ $belumSelesai }}</div>
                    <div class="small text-muted">Baru + Diproses</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="fw-bold text-dark mb-3">Tren Aduan Harian</div>
                    <canvas id="chartHari"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chart-card mb-4">
                    <div class="fw-bold text-dark mb-3">Komposisi Status</div>
                    <canvas id="chartStatus"></canvas>
                </div>
                <div class="chart-card">
                    <div class="fw-bold text-dark mb-3">Top Kategori</div>
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>

        <div class="table-instansi">
            <div class="p-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold m-0 text-dark">Data Aduan Terkini</h6>
                <a href="{{ route('admin.aduan.index') }}" class="btn btn-link text-success btn-sm fw-bold text-decoration-none">Lihat Semua →</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Tiket</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th class="text-center">Tingkat</th>
                            <th class="text-center">Status</th>
                            <th>Lokasi Kejadian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aduans as $i => $a)
                        <tr>
                            <td class="small">{{ $aduans->firstItem() + $i }}</td>
                            <td class="fw-bold text-dark small">{{ $a->kode_tiket ?? '-' }}</td>
                            <td class="small">{{ optional($a->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="small">{{ ucwords($a->kategori ?? '-') }}</td>
                            <td class="text-center">
                                <span class="badge {{ ($a->darurat ?? 0) ? 'bg-danger' : 'bg-secondary' }}" style="font-size: 9px;">
                                    {{ ($a->darurat ?? 0) ? 'DARURAT' : 'NORMAL' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $status = strtolower($a->status ?? 'baru');
                                    $color = match($status) {
                                        'baru' => 'bg-primary',
                                        'diproses' => 'bg-warning text-dark',
                                        'selesai' => 'bg-success',
                                        'ditolak' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $color }} badge-status">{{ strtoupper($status) }}</span>
                            </td>
                            <td class="small text-muted">{{ Str::limit($a->lokasi, 40) ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada data aduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3 bg-light border-top">
                {{ $aduans->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const labelsHari = @json($labelsHari);
        const dataHari   = @json($dataHari);
        const labelsStatus = @json($labelsStatus);
        const dataStatus   = @json($dataStatus);
        const labelsKategori = @json($labelsKategori);
        const dataKategori   = @json($dataKategori);

        // Chart Harian
        new Chart(document.getElementById('chartHari'), {
            type: 'line',
            data: {
                labels: labelsHari,
                datasets: [{
                    label: 'Jumlah Aduan',
                    data: dataHari,
                    borderColor: '#0b3d2e',
                    backgroundColor: 'rgba(11, 61, 46, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Chart Status
        new Chart(document.getElementById('chartStatus'), {
            type: 'doughnut',
            data: {
                labels: labelsStatus,
                datasets: [{ 
                    data: dataStatus,
                    backgroundColor: ['#0d6efd', '#ffc107', '#198754', '#dc3545', '#6c757d']
                }]
            },
            options: { responsive: true, cutout: '70%' }
        });

        // Chart Kategori
        new Chart(document.getElementById('chartKategori'), {
            type: 'bar',
            data: {
                labels: labelsKategori,
                datasets: [{
                    label: 'Aduan',
                    data: dataKategori,
                    backgroundColor: '#0f5a43'
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });
    </script>
</x-app-layout>