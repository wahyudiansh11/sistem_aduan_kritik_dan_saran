<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - SIADRU</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --green:#0b3d2e;
      --green2:#0f5a43;
      --soft:#f6fbf8;
    }
    body{ background: var(--soft); }
    .topbar{
      background: linear-gradient(120deg, var(--green), var(--green2));
      color:#fff;
      padding: 18px 0;
    }
    .card{
      border:0;
      border-radius: 16px;
      box-shadow: 0 10px 24px rgba(15,23,42,.08);
    }
    .muted{ color:#6b7280; }
    canvas{ max-height: 320px; }
  </style>
</head>

<body>

  <div class="topbar">
    <div class="container d-flex justify-content-between align-items-center">
      <div>
        <div class="fw-bold fs-5">Dashboard SIADRU</div>
        <div class="small opacity-75">Ringkasan aduan & grafik</div>
      </div>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.aduan.index') }}" class="btn btn-light btn-sm">Data Aduan</a>
        <a href="/" class="btn btn-outline-light btn-sm">Landing</a>
      </div>
    </div>
  </div>

  <div class="container my-4">

    <!-- Filter range -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <div class="fw-semibold">Periode Grafik</div>
        <div class="muted small">Pilih rentang untuk grafik “Aduan per Hari”</div>
      </div>

      <form method="GET" class="d-flex gap-2 align-items-center">
        <select name="days" class="form-select form-select-sm" style="width:170px;">
          <option value="7"  {{ $days==7 ? 'selected' : '' }}>7 hari terakhir</option>
          <option value="14" {{ $days==14 ? 'selected' : '' }}>14 hari terakhir</option>
          <option value="30" {{ $days==30 ? 'selected' : '' }}>30 hari terakhir</option>
        </select>
        <button class="btn btn-success btn-sm" type="submit">Terapkan</button>
      </form>
    </div>

    <!-- Kartu ringkasan -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-3 mb-3">

      <div class="col">
        <div class="card p-3 h-100">
          <div class="muted small">Total Aduan</div>
          <div class="fs-3 fw-bold">{{ $totalAduan }}</div>
          <div class="small muted">Darurat: {{ $darurat }}</div>
        </div>
      </div>

      <div class="col">
        <div class="card p-3 h-100">
          <div class="muted small">Darurat</div>
          <div class="fs-3 fw-bold">{{ $darurat }}</div>
          <div class="small muted">Normal: {{ $normal }}</div>
        </div>
      </div>

      <div class="col">
        <div class="card p-3 h-100">
          <div class="muted small">Baru</div>
          <div class="fs-3 fw-bold">{{ $baru }}</div>
          <div class="small muted">Diproses: {{ $diproses }}</div>
        </div>
      </div>

      <div class="col">
        <div class="card p-3 h-100">
          <div class="muted small">Belum Selesai</div>
          <div class="fs-3 fw-bold">{{ $belumSelesai }}</div>
          <div class="small muted">Baru + Diproses</div>
        </div>
      </div>

      <div class="col">
        <div class="card p-3 h-100">
          <div class="muted small">Selesai</div>
          <div class="fs-3 fw-bold">{{ $selesai }}</div>
          <div class="small muted">Ditolak: {{ $ditolak }}</div>
        </div>
      </div>

    </div>

    <!-- Grafik -->
    <div class="row g-3">
      <div class="col-lg-8">
        <div class="card p-3">
          <div class="fw-semibold mb-1">Aduan per Hari ({{ $days }} hari terakhir)</div>
          <div class="muted small mb-2">Melihat tren masuknya aduan</div>
          <canvas id="chartHari"></canvas>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card p-3 mb-3">
          <div class="fw-semibold mb-1">Status Aduan</div>
          <div class="muted small mb-2">Komposisi status saat ini</div>
          <canvas id="chartStatus"></canvas>
        </div>

        <div class="card p-3">
          <div class="fw-semibold mb-1">Top Kategori</div>
          <div class="muted small mb-2">5 kategori terbanyak</div>
          <canvas id="chartKategori"></canvas>
        </div>
      </div>
    </div>
    

    <!-- Tabel Data Aduan (HARUS DI LUAR SCRIPT) -->
  <!-- Tabel Data Aduan -->
<div class="card p-3 mt-4">
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
    <div>
      <div class="fw-semibold">Data Aduan</div>
      <div class="muted small">Daftar aduan terbaru</div>
    </div>
    <a href="{{ route('admin.aduan.index') }}" class="btn btn-outline-success btn-sm">Lihat Semua</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0" style="min-width: 1000px;">
      <thead class="table-light">
        <tr>
          <th style="width:60px;">No</th>
          <th style="width:190px;">Kode Tiket</th>
          <th style="width:160px;">Tanggal</th>
          <th style="width:170px;">Kategori</th>
          <th style="width:110px;" class="text-center">Darurat</th>
          <th style="width:120px;" class="text-center">Status</th>
          <th>lokasi</th>
          <th style="width:90px;" class="text-center">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse($aduans as $i => $a)
          <tr>
            <td>{{ $aduans->firstItem() + $i }}</td>
            <td class="fw-semibold">{{ $a->kode_tiket ?? '-' }}</td>
            <td>{{ optional($a->created_at)->format('d-m-Y H:i') }}</td>
            <td>{{ ucwords($a->kategori ?? '-') }}</td>

            <td class="text-center">
              <span class="badge {{ ($a->darurat ?? 0) ? 'bg-danger' : 'bg-secondary' }}">
                {{ ($a->darurat ?? 0) ? 'Darurat' : 'Normal' }}
              </span>
            </td>

            <td class="text-center">
              @php
                $status = strtolower($a->status ?? 'baru');
                $badge = match($status) {
                  'baru' => 'bg-primary',
                  'diproses' => 'bg-warning text-dark',
                  'selesai' => 'bg-success',
                  'ditolak' => 'bg-danger',
                  default => 'bg-secondary'
                };
              @endphp
              <span class="badge {{ $badge }}">{{ ucfirst($status) }}</span>
            </td>

            <td>
              <div class="text-truncate" style="max-width:520px;" title="{{ $a->alamat ?? '' }}">
                {{ $a->lokasi ?? '-' }}
              </div>
            </td>

            <td class="text-center">
              <a href="{{ route('aduan.show.kode', $a->kode_tiket) }}" class="btn btn-sm btn-outline-secondary">
                Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center muted py-4">Belum ada data aduan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div class="muted small">
      Menampilkan {{ $aduans->firstItem() }} - {{ $aduans->lastItem() }} dari {{ $aduans->total() }} data
    </div>
    <div>
      {{ $aduans->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>


  </div>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <script>
    // DATA dari controller
    const labelsHari = @json($labelsHari);
    const dataHari   = @json($dataHari);

    const labelsStatus = @json($labelsStatus);
    const dataStatus   = @json($dataStatus);

    const labelsKategori = @json($labelsKategori);
    const dataKategori   = @json($dataKategori);

    // Grafik 1: Line aduan per hari
    new Chart(document.getElementById('chartHari'), {
      type: 'line',
      data: {
        labels: labelsHari,
        datasets: [{
          label: 'Jumlah Aduan',
          data: dataHari,
          tension: 0.35
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });

    // Grafik 2: Doughnut status
    new Chart(document.getElementById('chartStatus'), {
      type: 'doughnut',
      data: {
        labels: labelsStatus,
        datasets: [{ data: dataStatus }]
      },
      options: { responsive: true }
    });

    // Grafik 3: Bar top kategori
    new Chart(document.getElementById('chartKategori'), {
      type: 'bar',
      data: {
        labels: labelsKategori,
        datasets: [{
          label: 'Jumlah',
          data: dataKategori
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
