<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Status Aduan</title>

  <style>
    :root{
      --bg: #f6f7fb;
      --card: #ffffff;
      --text: #0f172a;
      --muted:#64748b;
      --border:#e2e8f0;
      --focus:#2563eb;

      --shadow: 0 20px 50px rgba(15,23,42,.08);
      --radius: 16px;

      --success:#059669; --successBg:#d1fae5;
      --warn:#b45309;    --warnBg:#fef3c7;
      --info:#0ea5e9;    --infoBg:#e0f2fe;
      --danger:#dc2626;  --dangerBg:#fee2e2;
      --neutralBg:#f1f5f9;
    }
    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text);
      background:
        radial-gradient(1200px 600px at 20% -10%, rgba(37,99,235,.18), transparent 60%),
        radial-gradient(900px 500px at 110% 10%, rgba(16,185,129,.14), transparent 55%),
        var(--bg);
      line-height:1.45;
    }

    .wrap{
      max-width: 900px;
      margin: 48px auto;
      padding: 0 18px;
    }

    .header{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:16px;
      margin-bottom:16px;
    }
    .title{
      margin:0;
      font-size: 28px;
      letter-spacing: -0.02em;
    }
    .subtitle{
      margin:6px 0 0;
      color:var(--muted);
      font-size:14px;
    }

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 20px;
    }

    .pill{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 6px 10px;
      border-radius: 999px;
      background: #f1f5f9;
      border:1px solid var(--border);
      font-size: 12px;
      color:#0f172a;
      white-space: nowrap;
    }

    .metaGrid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 10px;
    }
    @media (max-width: 760px){
      .metaGrid{ grid-template-columns: 1fr; }
    }

    .metaItem{
      border:1px solid var(--border);
      border-radius: 14px;
      background:#fbfdff;
      padding: 12px 12px;
      display:flex;
      flex-direction:column;
      gap:4px;
    }
    .metaLabel{
      font-size: 12px;
      color: var(--muted);
    }
    .metaValue{
      font-weight: 800;
      font-size: 14px;
      word-break: break-word;
    }
    .metaValue a{
      color:#2563eb;
      text-decoration:none;
      font-weight:800;
    }
    .metaValue a:hover{ text-decoration: underline; }

    .badge{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 6px 10px;
      border-radius: 999px;
      border:1px solid transparent;
      font-size: 12px;
      font-weight: 900;
      letter-spacing: .02em;
      text-transform: uppercase;
      width: fit-content;
    }
    .badge.neutral{ background: var(--neutralBg); border-color: rgba(15,23,42,.08); color:#0f172a; }
    .badge.info{ background: var(--infoBg); border-color: rgba(14,165,233,.25); color:#075985; }
    .badge.warn{ background: var(--warnBg); border-color: rgba(180,83,9,.25); color:#78350f; }
    .badge.success{ background: var(--successBg); border-color: rgba(5,150,105,.25); color:#065f46; }
    .badge.danger{ background: var(--dangerBg); border-color: rgba(220,38,38,.25); color:#7f1d1d; }

    .section{
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px dashed var(--border);
    }
    .sectionTitle{
      margin:0 0 10px;
      font-size: 14px;
      font-weight: 900;
      letter-spacing: -0.01em;
    }

    .box{
      border:1px solid var(--border);
      border-radius: 14px;
      background: #fbfdff;
      padding: 14px;
      white-space: pre-wrap;
      word-break: break-word;
      font-size: 14px;
    }
    .box.info{ background: #ecfeff; border-color: rgba(14,165,233,.30); }
    .box.warn{ background: #fef9c3; border-color: rgba(250,204,21,.35); }

    .actions{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      margin-top: 18px;
      padding-top: 14px;
      border-top: 1px dashed var(--border);
      flex-wrap: wrap;
    }
    .btn{
      border:0;
      border-radius: 12px;
      padding: 10px 14px;
      font-size: 14px;
      font-weight: 900;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:10px;
    }
    .btnGhost{
      background:#fff;
      color:#0f172a;
      border:1px solid var(--border);
    }
    .btnGhost:hover{ background:#f8fafc; }

    .btnPrimary{
      background:#2563eb;
      color:#fff;
      box-shadow: 0 14px 30px rgba(37,99,235,.22);
    }
    .btnPrimary:hover{ filter: brightness(1.03); }

    .muted{
      color: var(--muted);
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="wrap">
    @php
      // Mapping status -> style badge (sesuaikan dengan value status di DB kamu)
      $st = strtolower($aduan->status ?? '');
      $badgeClass = 'neutral';
      $badgeText  = $aduan->status;

      if (in_array($st, ['terkirim','baru','pending','menunggu'])) $badgeClass = 'info';
      if (in_array($st, ['diproses','proses','on progress','in_progress'])) $badgeClass = 'warn';
      if (in_array($st, ['selesai','done','closed','completed'])) $badgeClass = 'success';
      if (in_array($st, ['ditolak','batal','canceled','rejected'])) $badgeClass = 'danger';

      // Kategori tampil rapi
      $kategoriNice = ucwords(str_replace('_',' ', $aduan->kategori ?? '-'));
    @endphp

    <div class="header">
      <div>
        <h2 class="title">Status Aduan</h2>
        <p class="subtitle">Detail tiket dan perkembangan penanganan aduan Anda.</p>
      </div>

      <div class="pill">
        <span class="badge {{ $badgeClass }}">{{ strtoupper($badgeText) }}</span>
      </div>
    </div>

    <div class="card">
      <div class="metaGrid">
        <div class="metaItem">
          <div class="metaLabel">Kode Tiket</div>
          <div class="metaValue">{{ $aduan->kode_tiket }}</div>
        </div>

        <div class="metaItem">
          <div class="metaLabel">Nama Pelapor</div>
          <div class="metaValue">{{ $aduan->nama_pelapor }}</div>
        </div>

        <div class="metaItem">
          <div class="metaLabel">Nomor WhatsApp</div>
          <div class="metaValue">
            @if($aduan->wa)
              <a href="https://wa.me/62{{ ltrim($aduan->wa, '0') }}" target="_blank" rel="noopener">
                {{ $aduan->wa }} <span aria-hidden="true">↗</span>
              </a>
            @else
              -
            @endif
          </div>
        </div>

        <div class="metaItem">
          <div class="metaLabel">Kategori</div>
          <div class="metaValue">{{ $kategoriNice }}</div>
        </div>
      </div>

      <div class="section">
        <h3 class="sectionTitle">Isi Aduan</h3>
        <div class="box">{{ $aduan->isi_aduan }}</div>
        <p class="muted" style="margin:10px 0 0;">
          Pastikan informasi sudah benar. Jika ada detail tambahan, kirim aduan baru atau hubungi admin.
        </p>
      </div>

      <div class="section">
        <h3 class="sectionTitle">Tanggapan Admin</h3>

        @if(!empty($aduan->feedback_admin))
          <div class="box info">{{ $aduan->feedback_admin }}</div>
        @else
          <div class="box warn">Belum ada tanggapan dari admin.</div>
        @endif
      </div>

      <div class="actions">
        <div class="muted">Simpan kode tiket untuk pengecekan berikutnya.</div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
          <a class="btn btnGhost" href="{{ route('aduan.cek.form') }}">
            ← Kembali Cek Aduan
          </a>
          <a class="btn btnPrimary" href="{{ route('aduan.create') }}">
            Kirim Aduan Baru <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
