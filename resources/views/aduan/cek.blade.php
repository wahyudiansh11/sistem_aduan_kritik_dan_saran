<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Cek Status Aduan</title>

  <style>
    :root{
      --bg: #f6f7fb;
      --card: #ffffff;
      --text: #0f172a;
      --muted:#64748b;
      --border:#e2e8f0;
      --focus:#2563eb;
      --danger:#dc2626;
      --dangerBg:#fee2e2;
      --shadow: 0 20px 50px rgba(15,23,42,.08);
      --radius: 16px;
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
      max-width: 820px;
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

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 20px;
    }

    .notice{
      border-radius: 14px;
      padding: 12px 14px;
      margin-bottom: 14px;
      border:1px solid transparent;
      font-size:14px;
    }
    .notice.error{
      background:var(--dangerBg);
      border-color: rgba(220,38,38,.25);
      color:#7f1d1d;
    }

    .field{
      display:flex;
      flex-direction:column;
      gap:6px;
      margin-top: 10px;
    }
    label{
      font-size: 13px;
      font-weight: 700;
      color:#0b1220;
    }
    .hint{
      color: var(--muted);
      font-size: 12px;
      margin-top: 2px;
    }

    input{
      width:100%;
      border:1px solid var(--border);
      border-radius: 12px;
      padding: 10px 12px;
      font-size: 14px;
      background:#fff;
      outline:none;
      transition: border-color .15s ease, box-shadow .15s ease;
    }
    input:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 4px rgba(37,99,235,.14);
    }

    .actions{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px dashed var(--border);
      flex-wrap: wrap;
    }

    .btn{
      border:0;
      border-radius: 12px;
      padding: 10px 14px;
      font-size: 14px;
      font-weight: 800;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:10px;
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

    .muted{
      color: var(--muted);
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="header">
      <div>
        <h2 class="title">Cek Status Aduan</h2>
        <p class="subtitle">Masukkan kode tiket untuk melihat status dan detail aduan Anda.</p>
      </div>
      <div class="pill">Layanan: Pelacakan Tiket</div>
    </div>

    <div class="card">
      @if($errors->any())
        <div class="notice error">
          <strong>Gagal memproses:</strong> {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('aduan.cek.submit') }}">
        @csrf

        <div class="field">
          <label>Kode Tiket</label>
          <input
            type="text"
            name="kode_tiket"
            placeholder="Contoh: ADU260126A1B2C3"
            value="{{ old('kode_tiket') }}"
            required
            autocomplete="off"
          >
          <div class="hint">Kode tiket ada di halaman “Aduan Terkirim”.</div>
        </div>

        <div class="actions">
          <div class="muted">Pastikan kode tiket benar (huruf/angka).</div>
          <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button class="btn btnPrimary" type="submit">
              Cek Status <span aria-hidden="true">→</span>
            </button>
            <a class="btn btnGhost" href="{{ route('aduan.create') }}">
              Kirim Aduan Baru
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
