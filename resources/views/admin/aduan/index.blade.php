<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin - Aduan</title>

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
      max-width: 1200px;
      margin: 48px auto;
      padding: 0 18px;
    }

    .header{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:16px;
      margin-bottom:16px;
      flex-wrap: wrap;
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

    .topnav{
      display:flex;
      gap:10px;
      flex-wrap: wrap;
      align-items:center;
      justify-content:flex-end;
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
      font-weight: 800;
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
      white-space: nowrap;
    }
    .btnPrimary{
      background:#2563eb;
      color:#fff;
      box-shadow: 0 14px 30px rgba(37,99,235,.22);
    }
    .btnPrimary:hover{ filter: brightness(1.03); }

    .btnGhost{
      background:#fff;
      color:#0f172a;
      border:1px solid var(--border);
    }
    .btnGhost:hover{ background:#f8fafc; }

    .btnDanger{
      background:#fff;
      color:#991b1b;
      border:1px solid rgba(220,38,38,.25);
    }
    .btnDanger:hover{ background: #fff5f5; }

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
    }

    .notice{
      border-radius: 14px;
      padding: 12px 14px;
      margin-bottom: 12px;
      border:1px solid transparent;
      font-size:14px;
    }
    .notice.success{
      background:var(--successBg);
      border-color: rgba(5,150,105,.25);
      color:#065f46;
    }
    .notice.error{
      background:var(--dangerBg);
      border-color: rgba(220,38,38,.25);
      color:#7f1d1d;
    }

    /* Filter bar */
    .filterBar{
      display:flex;
      gap:10px;
      flex-wrap: wrap;
      align-items:end;
      padding: 12px;
      border: 1px solid var(--border);
      border-radius: 14px;
      background: #fbfdff;
      margin-bottom: 12px;
    }
    .field{
      display:flex;
      flex-direction:column;
      gap:6px;
      min-width: 180px;
    }
    label{
      font-size: 12px;
      color: var(--muted);
      font-weight: 800;
    }
    select, textarea{
      border:1px solid var(--border);
      border-radius: 12px;
      padding: 10px 12px;
      font-size: 14px;
      background:#fff;
      outline:none;
      transition: border-color .15s ease, box-shadow .15s ease;
    }
    select:focus, textarea:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 4px rgba(37,99,235,.14);
    }

    /* Table */
    .tableWrap{
      width: 100%;
      overflow:auto;
      border:1px solid var(--border);
      border-radius: 14px;
      background:#fff;
    }
    table{
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 1100px;
    }
    thead th{
      position: sticky;
      top: 0;
      z-index: 2;
      background: #f1f5f9;
      border-bottom: 1px solid var(--border);
      font-size: 12px;
      color:#0f172a;
      text-align:left;
      padding: 10px 10px;
      white-space: nowrap;
    }
    tbody td{
      border-bottom: 1px solid var(--border);
      padding: 10px 10px;
      vertical-align: top;
      font-size: 13px;
    }
    tbody tr:hover td{
      background: #fbfdff;
    }
    .muted{ color: var(--muted); font-size: 12px; }

    .badge{
      display:inline-flex;
      align-items:center;
      gap:6px;
      padding: 6px 10px;
      border-radius: 999px;
      border:1px solid transparent;
      font-size: 11px;
      font-weight: 900;
      letter-spacing: .02em;
      text-transform: uppercase;
      white-space: nowrap;
    }
    .badge.neutral{ background: var(--neutralBg); border-color: rgba(15,23,42,.08); color:#0f172a; }
    .badge.info{ background: var(--infoBg); border-color: rgba(14,165,233,.25); color:#075985; }
    .badge.warn{ background: var(--warnBg); border-color: rgba(180,83,9,.25); color:#78350f; }
    .badge.success{ background: var(--successBg); border-color: rgba(5,150,105,.25); color:#065f46; }
    .badge.danger{ background: var(--dangerBg); border-color: rgba(220,38,38,.25); color:#7f1d1d; }

    .clip{
      max-width: 260px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      display:block;
    }

    /* Inline update form inside table */
    .inlineForm{
      display:flex;
      flex-direction:column;
      gap:8px;
      min-width: 260px;
    }
    .inlineForm textarea{
      min-height: 78px;
      resize: vertical;
    }
    .inlineForm .rowBtns{
      display:flex;
      gap:10px;
      justify-content:flex-end;
      flex-wrap: wrap;
    }

    .pagination{
      margin-top: 14px;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="header">
      <div>
        <h2 class="title">Admin - Data Aduan</h2>
        <p class="subtitle">Kelola tiket aduan, filter data, dan berikan tanggapan admin.</p>
      </div>

      <div class="topnav">
        <a class="btn btnGhost" href="/aduan">+ Buat Aduan (Publik)</a>
        <a class="btn btnGhost" href="/dashboard">Dashboard</a>
        <a class="btn btnDanger" href="/logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
      </div>
    </div>

    <form id="logout-form" action="/logout" method="POST" style="display:none;">
      @csrf
    </form>

    <div class="card">
      @if(session('success'))
        <div class="notice success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="notice error">{{ $errors->first() }}</div>
      @endif

      <!-- FILTER -->
      <form method="GET" action="{{ route('admin.aduan.index') }}" class="filterBar">
        <div class="field">
          <label>Kategori</label>
          <select name="kategori">
            <option value="">Semua</option>
            @foreach($kategoriList as $key => $label)
              <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label>Status</label>
          <select name="status">
            <option value="">Semua</option>
            @foreach($statusList as $key => $label)
              <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label>Darurat</label>
          <select name="darurat">
            <option value="">Semua</option>
            <option value="1" {{ request('darurat') === "1" ? 'selected' : '' }}>Ya</option>
            <option value="0" {{ request('darurat') === "0" ? 'selected' : '' }}>Tidak</option>
          </select>
        </div>

        <div style="display:flex; gap:10px; align-items:end; flex-wrap:wrap;">
          <button class="btn btnPrimary" type="submit">Filter →</button>
          <a class="btn btnGhost" href="{{ route('admin.aduan.index') }}">Reset</a>
        </div>

        <div class="pill" style="margin-left:auto;">
          Total (halaman ini): {{ $aduans->count() }}
        </div>
      </form>

      @php
        // helper badge untuk status
        $statusToClass = function($st){
          $s = strtolower($st ?? '');
          if (in_array($s, ['baru','terkirim','pending','menunggu'])) return 'info';
          if (in_array($s, ['diproses','proses','on progress','in_progress'])) return 'warn';
          if (in_array($s, ['selesai','done','closed','completed'])) return 'success';
          if (in_array($s, ['ditolak','batal','canceled','rejected'])) return 'danger';
          return 'neutral';
        };
      @endphp

      <div class="tableWrap" role="region" aria-label="Tabel data aduan">
        <table>
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>WA</th>
              <th>Darurat</th>
              <th>Kategori</th>
              <th>Lokasi</th>
              <th>Isi Aduan</th>
              <th>Status</th>
              <th>Feedback Admin</th>
              <th>Lampiran</th>
              <th>Ubah Status</th>
            </tr>
          </thead>

          <tbody>
            @forelse($aduans as $a)
              @php
                $badgeClass = $statusToClass($a->status);
                $kat = $kategoriList[$a->kategori] ?? ucwords(str_replace('_',' ', $a->kategori));
              @endphp
              <tr>
                <td class="muted">{{ $a->created_at->format('d-m-Y H:i') }}</td>
                <td><strong>{{ $a->nama_pelapor }}</strong></td>

                <td>
                  @if($a->wa)
                    <a href="https://wa.me/62{{ ltrim($a->wa, '0') }}" target="_blank" rel="noopener"
                       style="color:#2563eb; font-weight:800; text-decoration:none;">
                      {{ $a->wa }} ↗
                    </a>
                  @else
                    <span class="muted">-</span>
                  @endif
                </td>

                <td>
                  @if($a->darurat)
                    <span class="badge danger">DARURAT</span>
                  @else
                    <span class="badge neutral">NORMAL</span>
                  @endif
                </td>

                <td>{{ $kat }}</td>
                <td>{{ $a->lokasi ?? '-' }}</td>

                <td>
                  <span class="clip" title="{{ $a->isi_aduan }}">{{ $a->isi_aduan }}</span>
                </td>

                <td>
                  <span class="badge {{ $badgeClass }}">{{ strtoupper($a->status) }}</span>
                </td>

                <td>
                  @if($a->feedback_admin)
                    <span class="clip" title="{{ $a->feedback_admin }}">{{ $a->feedback_admin }}</span>
                  @else
                    <span class="muted">-</span>
                  @endif
                </td>

                <td>
                  @if($a->lampiran_path)
                    <a class="btn btnGhost" style="padding:8px 10px; font-size:12px;"
                       href="{{ asset('storage/'.$a->lampiran_path) }}" target="_blank" rel="noopener">
                      Lihat ↗
                    </a>
                  @else
                    <span class="muted">-</span>
                  @endif
                </td>

                <td>
                  <form class="inlineForm" method="POST" action="{{ route('admin.aduan.status', $a) }}">
                    @csrf
                    @method('PATCH')

                    <select name="status">
                      <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }}>Baru</option>
                      <option value="diproses" {{ $a->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                      <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                      <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <textarea name="feedback_admin" placeholder="Tulis tanggapan admin...">{{ $a->feedback_admin }}</textarea>

                    <div class="rowBtns">
                      <button class="btn btnPrimary" type="submit" style="padding:10px 12px; font-size:13px;">
                        Simpan
                      </button>
                    </div>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="11" style="text-align:center; padding: 18px;">
                  <span class="muted">Belum ada data.</span>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="pagination">
        {{ $aduans->links() }}
      </div>
    </div>
  </div>
</body>
</html>
