<x-app-layout>

@php
    $persen = $totalAduan > 0 ? round(($selesai / $totalAduan) * 100) : 0;
@endphp

<style>
    :root {
        --dinkes-green: #0b3d2e;
        --bg-soft: #f8fafc;
    }

    .dashboard-wrapper {
        padding: 2rem 1.5rem;
        background-color: var(--bg-soft);
        min-height: 100vh;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .chart-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .table-instansi {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    .chart-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.25rem 1.25rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.04);
}

canvas { width: 100% !important; }
.hero-card {
    background: var(--dinkes-green);
    border-radius: 18px;
    padding: 28px;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.10);
}

.hero-title { font-size: 24px; font-weight: 800; margin: 0; }
.hero-sub { opacity: .9; margin-top: 6px; }
.hero-actions .btn {
    border-radius: 12px;
    padding: 10px 16px;
    font-weight: 700;
}
.hero-actions .btn-light {
    background: #fff;
    color: var(--dinkes-green);
    border: 0;
}
.hero-actions .btn-outline-light {
    border: 2px solid rgba(255,255,255,.65);
    color: #fff;
}
.hero-actions .btn-outline-light:hover {
    background: rgba(255,255,255,.12);
}

</style>

{{-- HERO CARD --}}
<div class="hero-card mb-4">
    <div class="row align-items-center g-3">
        <div class="col-lg-7">
            <h3 class="hero-title">Dashboard SIADRU</h3>
            <div class="hero-sub">
                Sistem Informasi Aduan & Respon Umum Dinkes Sumenep
            </div>
        </div>

        <div class="col-lg-5">
            <div class="hero-actions d-flex gap-2 justify-content-lg-end flex-wrap">
                <a href="{{ route('admin.aduan.index') }}" class="btn btn-light">
                    Manajemen Aduan
                </a>
                <a href="{{ url('/') }}" class="btn btn-outline-light">
                    Landing Page
                </a>
            </div>
        </div>
    </div>
</div>


<div class="dashboard-wrapper">

    {{-- FILTER DAYS --}}
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h5 class="fw-bold m-0 text-dark">Ringkasan Statistik</h5>
        </div>

        <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2">
            <input type="hidden" name="status" value="{{ request('status') }}">

            <select name="days" class="form-select form-select-sm">
                <option value="7"  {{ $days==7 ? 'selected' : '' }}>7 Hari</option>
                <option value="14" {{ $days==14 ? 'selected' : '' }}>14 Hari</option>
                <option value="30" {{ $days==30 ? 'selected' : '' }}>30 Hari</option>
            </select>

            <button class="btn btn-success btn-sm fw-bold">Terapkan</button>
        </form>
    </div>

    {{-- STAT CARDS --}}
    
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="fw-bold">Total Aduan</div>
                <h3>{{ $totalAduan }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="fw-bold">Selesai</div>
                <h3 class="text-success">{{ $selesai }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="fw-bold">Diproses</div>
                <h3 class="text-warning">{{ $diproses }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="fw-bold">Darurat</div>
                <h3 class="text-danger">{{ $darurat }}</h3>
            </div>
        </div>
    </div>

    {{-- PROGRESS --}}
    {{-- CHART SECTION --}}
<div class="row g-3 mb-4">

    {{-- Tren Aduan Harian --}}
    <div class="col-12">
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="fw-bold">Tren Aduan Harian</div>
                <small class="text-muted">{{ $days }} hari terakhir</small>
            </div>
            <canvas id="chartHari" style="height: 320px;"></canvas>
        </div>
    </div>

    
    {{-- Komposisi Status --}}
    <div class="col-12 col-lg-4">
        <div class="chart-card h-100">
            <div class="fw-bold mb-2">Komposisi Status</div>
            <canvas id="chartStatus" style="height: 280px;"></canvas>
        </div>
    </div>

    {{-- Top Kategori --}}
    <div class="col-12 col-lg-4">
        <div class="chart-card h-100">
            <div class="fw-bold mb-2">Top Kategori</div>
            <canvas id="chartKategori" style="height: 280px;"></canvas>
        </div>
    </div>

    {{-- Progress Penyelesaian --}}
    <div class="col-12 col-lg-4">
        <div class="chart-card h-100">
            <div class="fw-bold mb-2">Progress Penyelesaian</div>
            <h2 class="text-success">{{ $persen }}%</h2>
            <div class="progress">
                <div class="progress-bar bg-success" style="width: {{ $persen }}%"></div>
            </div>
            <small>{{ $selesai }} dari {{ $totalAduan }} aduan selesai</small>
        </div>
    </div>

</div>

    {{-- TABLE --}}
    <div class="table-instansi">

        {{-- HEADER --}}
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="fw-bold m-0">Data Aduan Terkini</h6>

            <div class="d-flex gap-2">
                <a href="{{ route('dashboard.export.excel', request()->only(['status'])) }}"
                   class="btn btn-success btn-sm fw-bold">
                    Export Excel
                </a>

                <a href="{{ route('admin.aduan.index') }}"
                   class="btn btn-outline-secondary btn-sm fw-bold">
                    Lihat Semua →
                </a>
            </div>
        </div>

        {{-- FILTER STATUS --}}
        <div class="p-3 border-bottom">
            <form method="GET" action="{{ route('dashboard') }}" class="row g-2 align-items-end">

                <input type="hidden" name="days" value="{{ request('days', $days) }}">

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Filter Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- Semua Status --</option>
                        <option value="baru" @selected(request('status')=='baru')>Baru</option>
                        <option value="diproses" @selected(request('status')=='diproses')>Diproses</option>
                        <option value="selesai" @selected(request('status')=='selesai')>Selesai</option>
                        <option value="ditolak" @selected(request('status')=='ditolak')>Ditolak</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-sm w-100 fw-bold">
                        Filter
                    </button>

                    <a href="{{ route('dashboard', ['days' => request('days', $days)]) }}"
                       class="btn btn-outline-secondary btn-sm w-100 fw-bold">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        {{-- TABLE --}}
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
                        <td>{{ $aduans->firstItem() + $i }}</td>
                        <td class="fw-bold">{{ $a->kode_tiket }}</td>
                        <td>{{ optional($a->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ ucwords($a->kategori) }}</td>
                        <td class="text-center">
                            <span class="badge {{ $a->darurat ? 'bg-danger' : 'bg-secondary' }}">
                                {{ $a->darurat ? 'DARURAT' : 'NORMAL' }}
                            </span>
                        </td>
                        <td class="text-center">
                            @php
                                $color = match(strtolower($a->status)) {
                                    'baru' => 'bg-primary',
                                    'diproses' => 'bg-warning text-dark',
                                    'selesai' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $color }}">
                                {{ strtoupper($a->status) }}
                            </span>
                        </td>
                        <td>{{ Str::limit($a->lokasi, 40) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 bg-light">
            {{ $aduans->withQueryString()->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    const labelsHari = @json($labelsHari ?? []);
    const dataHari   = @json($dataHari ?? []);

    const labelsStatus = @json($labelsStatus ?? []);
    const dataStatus   = @json($dataStatus ?? []);

    const labelsKategori = @json($labelsKategori ?? []);
    const dataKategori   = @json($dataKategori ?? []);

   
    // Komposisi Status
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: labelsStatus,
            datasets: [{
                data: dataStatus,
                backgroundColor: ['#0d6efd', '#ffc107', '#6c757d', '#198754', '#dc3545'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Top Kategori
    new Chart(document.getElementById('chartKategori'), {
        type: 'bar',
        data: {
            labels: labelsKategori,
            datasets: [{
                label: 'Total Aduan',
                data: dataKategori,
                backgroundColor: [
    '#FF0000', // Kecelakaan
    '#FFD41D', // Tenaga Kerja
    '#0d6efd', // Fasilitas
    '#6f42c1', // Emergency
    '#20c997'  // Lainnya
],

                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });
     // Tren Harian
    new Chart(document.getElementById('chartHari'), {
        type: 'line',
        data: {
            labels: labelsHari,
            datasets: [{
                label: 'Jumlah Aduan',
                data: dataHari,
                borderColor: '#0b3d2e',
                backgroundColor: 'rgba(11, 61, 46, 0.12)',
                fill: true,
                tension: 0.35,
                pointRadius: 3,
                pointBackgroundColor: '#0b3d2e'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

</script>

</x-app-layout>
