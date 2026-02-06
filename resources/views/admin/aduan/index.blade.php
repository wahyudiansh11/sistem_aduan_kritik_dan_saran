<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin - E-Aduan Dinkes Sumenep</title>

  <style>
    :root {
      --primary: #059669; 
      --primary-dark: #065f46;
      --bg-light: #f8fafc;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      margin: 0;
      background: var(--bg-light);
      color: #1e293b;
    }

    .wrap {
      max-width: 1400px;
      margin: 0 auto;
      padding: 24px;
    }

    /* Branding & Header */
    .branding { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
    .branding img { height: 50px; }
    .branding h1 { margin: 0; font-size: 18px; text-transform: uppercase; color: var(--primary-dark); }

    .header {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      border-left: 6px solid var(--primary);
    }

    /* Buttons */
    .btn {
      padding: 8px 16px;
      border: 1px solid #e2e8f0;
      background: #fff;
      text-decoration: none;
      color: #334155;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }
    .btnPrimary { background: var(--primary); border-color: var(--primary); color: #fff; }
    .btnDanger { color: #dc2626; border-color: #fecaca; }

    /* Card & Table */
    .card {
      margin-top: 24px;
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .cardHead { padding: 16px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; }
    
    .filter { padding: 20px; }
    .filterRow { display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end; }
    
    input, select, textarea {
      padding: 8px 12px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 13px;
      outline: none;
    }

    table { width: 100%; border-collapse: collapse; font-size: 13px; }
    th { background: #f1f5f9; padding: 12px 15px; text-align: left; color: #475569; text-transform: uppercase; font-size: 11px; }
    td { padding: 15px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }

    /* Badges */
    .badge { padding: 4px 10px; border-radius: 999px; font-size: 10px; font-weight: 700; text-transform: uppercase; display: inline-block; }
    .badgeSuccess { background: #dcfce7; color: #166534; }
    .badgeWarn { background: #fef9c3; color: #854d0e; }
    .badgeDanger { background: #fee2e2; color: #991b1b; }
    .badgeNeutral { background: #f1f5f9; color: #475569; }

    /* FIX PAGINATION RAKSASA */
    .pagination-wrapper { padding: 20px; border-top: 1px solid #e2e8f0; background: #fff; }
    .pagination-wrapper svg { width: 20px !important; height: 20px !important; }
    .pagination-wrapper nav div:first-child { display: none; } /* Sembunyikan text "Showing..." jika terlalu lebar */
    .pagination-wrapper nav div:last-child { display: flex; justify-content: center; gap: 5px; }
    .pagination-wrapper span, .pagination-wrapper a { border-radius: 6px !important; }

    /* Form Tindakan */
    .inlineForm { display: flex; flex-direction: column; gap: 8px; width: 200px; }
    .ticketCode { font-family: monospace; font-weight: 700; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; color: var(--primary-dark); font-size: 11px; }

    /* =========================
       RESPONSIVE PATCH
       ========================= */

    /* Tablet */
    @media (max-width: 1024px){
      .wrap{ padding: 16px; }
      .header{ padding: 16px; }
      .cardHead{ flex-direction: column; align-items: flex-start; gap: 10px; }
      .pagination-wrapper{ padding: 14px; }
    }

    /* HP */
    @media (max-width: 768px){
      .branding{ flex-direction: row; gap: 12px; }
      .branding img{ height: 42px; }
      .branding h1{ font-size: 16px; }

      .header{
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
      }

      .topnav{
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
      }
      .topnav .btn,
      .topnav form button{
        width: 100%;
        justify-content: center;
      }
      .topnav form{ width: 100%; }

      /* Filter: jadi 1 kolom */
      .filterRow{
        flex-direction: column;
        align-items: stretch;
      }
      .filterRow > div{ width: 100%; }
      .filter select,
      .filter input{
        width: 100% !important;
      }

      /* Tabel -> Card */
      table, thead, tbody, th, td, tr{ display:block; }
      thead{ display:none; }

      tbody tr{
        background:#fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        margin: 14px 14px;
        padding: 14px;
        box-shadow: 0 2px 10px rgba(2,6,23,.06);
      }

      td{
        border: none;
        padding: 10px 0;
      }

      /* setiap td punya label */
      td::before{
        content: attr(data-label);
        display:block;
        font-size: 11px;
        font-weight: 800;
        color:#64748b;
        text-transform: uppercase;
        margin-bottom: 6px;
      }

      /* rapikan form tindakan */
      .inlineForm{ width: 100%; }
      .inlineForm select,
      .inlineForm textarea,
      .inlineForm button{
        width: 100% !important;
      }

      /* pagination jangan melebar */
      .pagination-wrapper nav div:last-child{
        flex-wrap: wrap;
        gap: 6px;
      }
    }

    /* HP kecil */
    @media (max-width: 420px){
      .topnav{ grid-template-columns: 1fr; }
      .branding{ flex-direction: column; align-items: flex-start; }
    }
  </style>
</head>

<body>
  <div class="wrap">
    
    <div class="branding">
      <img src="{{ asset('image/logo.jpeg') }}" alt="Logo Sumenep">
      <div>
        <h1>Dinas Kesehatan</h1>
        <p style="margin:0; color: #64748b; font-size: 14px; font-weight: bold;">Kabupaten Sumenep</p>
      </div>
    </div>

    <div class="header">
      <div>
        <h2 style="margin:0; font-size: 20px;">Panel Manajemen Aduan</h2>
        <p style="margin:5px 0 0; color: #64748b; font-size: 13px;">Ringkasan aduan dan laporan masyarakat terbaru.</p>
      </div>
      <div class="topnav">
        <a class="btn" href="/aduan" target="_blank">🌐 Web Publik</a>
        <a class="btn btnPrimary" href="/dashboard">📊 Dashboard</a>
        <form action="/logout" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btnDanger">⎋ Keluar</button>
        </form>
      </div>
    </div>

    @if(session('success'))
      <div style="margin-top:15px; padding:12px 15px; background:#dcfce7; color:#166534; border-radius:10px; border:1px solid #bbf7d0; font-size:14px;">
        ✅ {{ session('success') }}
      </div>
    @endif

    <div class="card">
      <div class="cardHead">
        <span style="font-weight: 700; color: #334155; font-size: 14px;">🔍 Filter Data</span>
        <span class="badge badgeNeutral">Total: {{ $aduans->total() }}</span>
      </div>

      <div class="filter">
        <form method="GET" action="{{ route('admin.aduan.index') }}">
          <div class="filterRow">
            <div style="flex: 1; min-width: 200px;">
              <label style="display:block; font-size:11px; font-weight:700; margin-bottom:5px;">Cari Aduan</label>
              <input type="text" name="q" value="{{ request('q') }}" placeholder="Tiket / Nama / Isi..." style="width:100%;">
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; margin-bottom:5px;">Status</label>
              <select name="status" style="width:150px;">
                <option value="">Semua Status</option>
                @foreach($statusList as $key => $label)
                  <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <button class="btn btnPrimary" type="submit">Filter</button>
              <a class="btn" href="{{ route('admin.aduan.index') }}">Reset</a>
            </div>
          </div>
        </form>
      </div>

      <div style="overflow-x: auto;">
        <table>
          <thead>
            <tr>
              <th width="20%">Info Pelapor</th>
              <th width="40%">Isi Aduan</th>
              <th width="15%">Status</th>
              <th width="25%">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @forelse($aduans as $a)
            <tr>
              <td data-label="Info Pelapor">
                <div style="font-weight: 700; margin-bottom: 4px;">{{ $a->nama_pelapor }}</div>
                <div style="font-size: 11px; color: #64748b; line-height: 1.5;">
                    📅 {{ $a->created_at->format('d M Y') }}<br>
                    📱 <a href="https://wa.me/{{ $a->wa }}" target="_blank" style="color: #059669; text-decoration: none; font-weight: 600;">{{ $a->wa }}</a>
                </div>
                <div style="margin-top: 8px;"><span class="ticketCode">{{ $a->kode_tiket }}</span></div>
              </td>

              <td data-label="Isi Aduan">
                <div style="margin-bottom: 8px;">
                  <span class="badge badgeNeutral">{{ $kategoriList[$a->kategori] ?? $a->kategori }}</span>
                  @if($a->darurat) <span class="badge badgeDanger">⚠️ DARURAT</span> @endif
                </div>
                <div style="line-height: 1.5; color: #475569;">{{ Str::limit($a->isi_aduan, 150) }}</div>
                @if($a->lampiran_path)
                  <a href="{{ asset('storage/'.$a->lampiran_path) }}" target="_blank" style="display: inline-block; margin-top: 8px; font-size: 11px; color: var(--primary); font-weight: bold; text-decoration: none;">📂 Lihat Lampiran</a>
                @endif
              </td>

              <td data-label="Status">
                @php
                  $statusClass = match($a->status){
                    'selesai' => 'badgeSuccess',
                    'diproses' => 'badgeWarn',
                    'ditolak' => 'badgeDanger',
                    default => 'badgeNeutral'
                  };
                @endphp
                <span class="badge {{ $statusClass }}">{{ $a->status }}</span>
              </td>

              <td data-label="Tindakan">
                <form class="inlineForm" method="POST" action="{{ route('admin.aduan.status', $a) }}">
                  @csrf
                  @method('PATCH')
                  <select name="status" style="width: 100%; margin-bottom: 5px;">
                    <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diproses" {{ $a->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                  </select>
                  <textarea name="feedback_admin" rows="2" placeholder="Tanggapan admin..." style="margin-bottom: 5px;">{{ $a->feedback_admin }}</textarea>
                  <button type="submit" class="btn btnPrimary" style="justify-content: center; font-size: 11px;">Update</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" style="text-align: center; padding: 40px; color: #94a3b8;">Data tidak ditemukan.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="pagination-wrapper">
        {{ $aduans->links() }}
      </div>
    </div>
  </div>
</body>
</html>
