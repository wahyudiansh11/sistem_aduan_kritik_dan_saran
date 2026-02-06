<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Status Aduan #{{ $aduan->kode_tiket }} - Dinkes Sumenep</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    :root {
      --green: #0b3d2e;
      --green2: #059669; /* Emerald Green */
      --soft-bg: #f0fdf4;
      --shadow: 0 10px 25px rgba(0,0,0,0.05);
      --radius: 20px;
    }

    body {
      background-color: #f8fafc;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      color: #334155;
    }

    /* Header Branding */
    .branding-bar {
      background: white;
      border-bottom: 1px solid #e2e8f0;
      padding: 12px 0;
      margin-bottom: 30px;
    }

    /* Container Card */
    .main-card {
      border: none;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    .card-header-custom {
      background: white;
      border-bottom: 1px solid #f1f5f9;
      padding: 25px;
    }

    /* Info Box */
    .info-box {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 15px;
      padding: 15px;
      height: 100%;
      transition: all 0.2s;
    }
    .info-box:hover { border-color: var(--green2); }
    .info-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: 700; margin-bottom: 4px; }
    .info-value { font-size: 15px; font-weight: 600; color: #1e293b; }

    /* Status Badges */
    .status-badge {
      padding: 8px 16px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    /* Timeline Stepper */
    .timeline-steps { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; position: relative; }
    .timeline-steps::before { content: ""; position: absolute; top: 15px; left: 10%; right: 10%; height: 2px; background: #e2e8f0; z-index: 1; }
    .step { position: relative; z-index: 2; text-align: center; width: 25%; }
    .step-icon { width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; margin: 0 auto 8px; display: flex; align-items: center; justify-content: center; color: white; transition: 0.3s; }
    .step.active .step-icon { background: var(--green2); box-shadow: 0 0 0 5px rgba(5, 150, 105, 0.2); }
    .step.active .step-text { color: var(--green2); font-weight: 700; }
    .step-text { font-size: 11px; color: #94a3b8; }

    /* Button Custom */
    .btn-green { background-color: var(--green2); border-color: var(--green2); color: white; font-weight: 600; border-radius: 10px; padding: 10px 20px; }
    .btn-green:hover { background-color: #047857; color: white; }
    .btn-outline-green { border-color: var(--green2); color: var(--green2); font-weight: 600; border-radius: 10px; }
    .btn-outline-green:hover { background-color: var(--soft-bg); border-color: var(--green2); color: var(--green2); }
  </style>
</head>

<body>

<div class="branding-bar">
  <div class="container d-flex align-items-center">
    <img src="{{ asset('image/logo.jpeg') }}" alt="Logo Sumenep" height="40" class="me-3">
    <div>
      <div class="fw-bold text-uppercase" style="font-size: 13px; line-height: 1;">Dinas Kesehatan</div>
      <small class="text-secondary">Kabupaten Sumenep</small>
    </div>
  </div>
</div>

<div class="container pb-5" style="max-width: 900px;">
  
  <div class="row align-items-center mb-4">
    <div class="col">
      <h3 class="fw-bold mb-1">Rincian Aduan</h3>
      <p class="text-secondary mb-0">Tiket ID: <span class="text-dark fw-bold">#{{ $aduan->kode_tiket }}</span></p>
    </div>
    <div class="col-auto">
      @php
        $status = $aduan->status ?? 'baru';
        $statusStyle = match($status) {
          'baru' => ['bg' => 'bg-primary', 'label' => 'TERKIRIM'],
          'diproses' => ['bg' => 'bg-warning text-dark', 'label' => 'DIPROSES'],
          'selesai' => ['bg' => 'bg-success', 'label' => 'SELESAI'],
          'ditolak' => ['bg' => 'bg-danger', 'label' => 'DITOLAK'],
          default => ['bg' => 'bg-secondary', 'label' => 'PENDING'],
        };
      @endphp
      <span class="status-badge {{ $statusStyle['bg'] }} text-uppercase">
        <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> {{ $statusStyle['label'] }}
      </span>
    </div>
  </div>

  {{-- Timeline Progres --}}
  <div class="timeline-steps px-3">
    <div class="step {{ in_array($status, ['baru','diproses','selesai']) ? 'active' : '' }}">
      <div class="step-icon"><i class="bi bi-file-earmark-text"></i></div>
      <div class="step-text">Baru</div>
    </div>
    <div class="step {{ in_array($status, ['diproses','selesai']) ? 'active' : '' }}">
      <div class="step-icon"><i class="bi bi-gear"></i></div>
      <div class="step-text">Diproses</div>
    </div>
    <div class="step {{ $status == 'selesai' ? 'active' : '' }}">
      <div class="step-icon"><i class="bi bi-check-lg"></i></div>
      <div class="step-text">Selesai</div>
    </div>
  </div>

  <div class="card main-card">
    <div class="card-body p-4">
      
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <div class="info-box">
            <div class="info-label">Nama Pelapor</div>
            <div class="info-value">{{ $aduan->nama_pelapor }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-box">
            <div class="info-label">WhatsApp</div>
            <div class="info-value">
              @php
                $waClean = preg_replace('/[^0-9]/', '', $aduan->wa);
                if (str_starts_with($waClean, '0')) $waClean = '62' . substr($waClean, 1);
              @endphp
              <a href="https://wa.me/{{ $waClean }}" target="_blank" class="text-decoration-none text-success">
                {{ $aduan->wa }} <i class="bi bi-whatsapp ms-1"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-box">
            <div class="info-label">Kategori</div>
            <div class="info-value text-capitalize">{{ $aduan->kategori }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-box">
            <div class="info-label">Prioritas</div>
            <div class="info-value">
              @if($aduan->darurat)
                <span class="text-danger fw-bold"><i class="bi bi-lightning-fill"></i> Gawat Darurat</span>
              @else
                <span class="text-primary">Normal</span>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <div class="info-label">Lokasi Kejadian</div>
        <div class="p-3 bg-light rounded-3">
          <div class="fw-semibold mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $aduan->lokasi ?? '-' }}</div>
          @if($aduan->maps_link)
            <a href="{{ $aduan->maps_link }}" target="_blank" class="btn btn-sm btn-outline-green">
              <i class="bi bi-map"></i> Buka Peta Google
            </a>
          @endif
        </div>
      </div>

      <div class="mb-4">
        <div class="info-label">Isi Aduan / Laporan</div>
        <div class="p-3 bg-light rounded-3" style="white-space: pre-line;">
          {{ $aduan->isi_aduan }}
        </div>
      </div>

      @if($aduan->lampiran_path)
      <div class="mb-4">
        <div class="info-label">Lampiran Foto/Dokumen</div>
        <div class="p-3 border rounded-3 d-inline-block">
          @php
            $ext = strtolower(pathinfo($aduan->lampiran_path, PATHINFO_EXTENSION));
            $isImg = in_array($ext, ['jpg','jpeg','png','webp']);
          @endphp
          @if($isImg)
            <img src="{{ asset('storage/' . $aduan->lampiran_path) }}" class="img-fluid rounded mb-2 d-block" style="max-height: 200px;">
          @endif
          <a href="{{ asset('storage/' . $aduan->lampiran_path) }}" target="_blank" class="btn btn-sm btn-green">
            <i class="bi bi-download"></i> Lihat File Penuh
          </a>
        </div>
      </div>
      @endif

      {{-- TANGGAPAN ADMIN --}}
      <div class="mt-5">
        <div class="info-label mb-2">Tanggapan & Feedback Admin</div>
        @if($aduan->feedback_admin)
          <div class="p-4 rounded-3" style="background: var(--soft-bg); border-left: 5px solid var(--green2);">
            <div class="fw-bold text-success mb-2"><i class="bi bi-chat-left-quote-fill"></i> Balasan Admin:</div>
            <div class="text-dark">{{ $aduan->feedback_admin }}</div>
          </div>
        @else
          <div class="alert alert-warning border-0 rounded-3">
            <i class="bi bi-clock-history me-2"></i> Mohon bersabar, aduan Anda sedang menunggu peninjauan oleh tim Dinkes.
          </div>
        @endif
      </div>

      <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
        <div class="text-secondary" style="font-size: 12px;">
          <i class="bi bi-calendar3 me-1"></i> Dikirim pada: {{ $aduan->created_at->format('d M Y, H:i') }}
        </div>
        <div>
          <a href="{{ route('aduan.cek.form') }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-search"></i> Cek Tiket Lain
          </a>
          <button onclick="window.print()" class="btn btn-light border">
            <i class="bi bi-printer"></i> Cetak
          </button>
        </div>
      </div>

    </div>
  </div>

  <p class="text-center text-secondary mt-4" style="font-size: 13px;">
    © {{ date('Y') }} Dinas Kesehatan Kabupaten Sumenep
  </p>
</div>

</body>
</html>