<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lacak Tiket Aduan - Dinkes Sumenep</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="icon" type="image/jpeg" href="{{ asset('image/logo.jpeg') }}">

  <style>
    :root {
      --bg: #f8fafc;
      --card: #ffffff;
      --text: #1e293b;
      --muted: #64748b;
      --border: #e2e8f0;

      /* IDENTITAS VISUAL SIADRU / DINKES */
      --primary: #0f5a43;
      --primary-hover: #0a4231;
      --primary-soft: rgba(15,90,67,0.08);

      --danger: #dc2626;
      --danger-bg: #fef2f2;

      --shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05);
      --radius: 20px;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      color: var(--text);
      background: 
        radial-gradient(circle at top left, rgba(15,90,67,0.05), transparent 400px),
        radial-gradient(circle at bottom right, rgba(34,197,94,0.05), transparent 400px),
        var(--bg);
      line-height: 1.6;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .wrap {
      width: 100%;
      max-width: 550px;
      padding: 24px;
    }

    .branding {
      text-align: center;
      margin-bottom: 32px;
    }

    .branding img {
      height: 60px;
      margin-bottom: 12px;
    }

    .header {
      text-align: center;
      margin-bottom: 24px;
    }

    .title {
      margin: 0;
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.025em;
      color: var(--primary);
    }

    .subtitle {
      margin: 8px 0 0;
      color: var(--muted);
      font-size: 14px;
    }

    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 32px;
    }

    .notice {
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .notice.error {
      background: var(--danger-bg);
      border-color: rgba(220,38,38,0.2);
      color: #991b1b;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      font-size: 13px;
      font-weight: 700;
      color: var(--text);
      text-transform: uppercase;
      letter-spacing: 0.025em;
    }

    input {
      width: 100%;
      border: 2px solid var(--border);
      border-radius: 12px;
      padding: 14px 16px;
      font-size: 16px;
      font-family: 'Monaco', 'Consolas', monospace; /* Font mono agar kode tiket mudah dibaca */
      background: #fcfcfc;
      outline: none;
      transition: all 0.2s ease;
    }

    input:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 4px var(--primary-soft);
    }

    input::placeholder {
      font-family: sans-serif;
      font-size: 14px;
      letter-spacing: normal;
    }

    .hint {
      color: var(--muted);
      font-size: 12px;
      line-height: 1.5;
      background: #f1f5f9;
      padding: 10px;
      border-radius: 8px;
      margin-top: 12px;
    }

    .actions {
      margin-top: 24px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .btn {
      border: 0;
      border-radius: 12px;
      padding: 14px 20px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s;
    }

    .btnPrimary {
      background: var(--primary);
      color: #fff;
    }

    .btnPrimary:hover {
      background: var(--primary-hover);
      transform: translateY(-1px);
      box-shadow: 0 10px 15px -3px rgba(15,90,67,0.25);
    }

    .btnGhost {
      background: transparent;
      color: var(--primary);
      border: 2px solid var(--primary-soft);
    }

    .btnGhost:hover {
      background: var(--primary-soft);
    }

    footer {
      text-align: center;
      margin-top: 32px;
      font-size: 12px;
      color: var(--muted);
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="branding">
      <img src="{{ asset('image/logo.jpeg') }}" alt="Logo Kabupaten Sumenep">
    </div>

    <div class="header">
      <h2 class="title">Lacak Aduan Anda</h2>
      <p class="subtitle">Pantau perkembangan laporan Anda secara real-time.</p>
    </div>

    <div class="card">
      @if($errors->any())
        <div class="notice error">
          <i class="bi bi-exclamation-circle-fill"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('aduan.cek.submit') }}">
        @csrf

        <div class="field">
          <label for="kode_tiket">Kode Tiket</label>
          <input
            type="text"
            id="kode_tiket"
            name="kode_tiket"
            placeholder="Masukkan Kode Tiket (Contoh: ADU...)"
            value="{{ old('kode_tiket') }}"
            required
            autocomplete="off"
            spellcheck="false"
          >
        </div>

        <div class="hint">
          <i class="bi bi-info-circle"></i>
          Kode tiket diberikan sesaat setelah Anda mengirim aduan. Pastikan penulisan huruf besar dan angka sudah benar. Mohon simpan baik-baik kode tiket.
        </div>

        <div class="actions">
          <button class="btn btnPrimary" type="submit">
            <i class="bi bi-search"></i> Lacak Status Aduan
          </button>
          
          <a class="btn btnGhost" href="{{ route('aduan.create') }}">
            <i class="bi bi-plus-circle"></i> Buat Aduan Baru
          </a>
        </div>
      </form>
    </div>

    <footer>
      &copy; {{ date('Y') }} Dinas Kesehatan Kabupaten Sumenep. <br>
      Pusat Layanan Aduan Masyarakat.
    </footer>
  </div>
</body>
</html>