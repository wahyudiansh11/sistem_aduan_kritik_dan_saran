<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Form Aduan</title>

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
      --success:#059669;
      --successBg:#d1fae5;
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
    .notice ul{
      margin:8px 0 0 18px;
      padding:0;
    }

    form{ margin-top: 10px; }

    .grid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }
    @media (max-width: 720px){
      .grid{ grid-template-columns: 1fr; }
    }

    .field{ display:flex; flex-direction:column; gap:6px; }
    label{
      font-size: 13px;
      font-weight: 600;
      color:#0b1220;
    }
    .req{
      color: var(--danger);
      font-weight: 700;
      margin-left: 4px;
    }
    .hint{
      color: var(--muted);
      font-size: 12px;
      margin-top: 2px;
    }

    input, select, textarea{
      width:100%;
      border:1px solid var(--border);
      border-radius: 12px;
      padding: 10px 12px;
      font-size: 14px;
      background:#fff;
      outline:none;
      transition: border-color .15s ease, box-shadow .15s ease;
    }
    textarea{ resize: vertical; min-height: 120px; }

    input:focus, select:focus, textarea:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 4px rgba(37,99,235,.14);
    }

    .row{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:14px;
      padding: 12px 12px;
      border:1px solid var(--border);
      border-radius: 14px;
      background: #fbfdff;
    }
    .row .rowText{
      display:flex;
      flex-direction:column;
      gap:2px;
    }
    .row .rowTitle{
      font-weight:700;
      font-size: 13px;
    }
    .row .rowDesc{
      font-size:12px;
      color:var(--muted);
    }

    /* Toggle */
    .toggle{
      position:relative;
      width: 52px;
      height: 30px;
      border-radius: 999px;
      background: #e5e7eb;
      border:1px solid var(--border);
      cursor:pointer;
      flex: 0 0 auto;
      transition: background .2s ease;
    }
    .toggle[data-on="1"]{
      background: rgba(37,99,235,.25);
      border-color: rgba(37,99,235,.35);
    }
    .knob{
      position:absolute;
      top: 3px;
      left: 3px;
      width: 24px;
      height: 24px;
      border-radius: 999px;
      background:#fff;
      box-shadow: 0 8px 18px rgba(15,23,42,.12);
      transition: transform .2s ease;
    }
    .toggle[data-on="1"] .knob{
      transform: translateX(22px);
    }

    .actions{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px dashed var(--border);
    }
    .privacy{
      font-size: 12px;
      color: var(--muted);
    }

    button{
      border:0;
      border-radius: 12px;
      padding: 10px 14px;
      font-size: 14px;
      font-weight: 700;
      cursor:pointer;
      background: #2563eb;
      color:#fff;
      box-shadow: 0 14px 30px rgba(37,99,235,.22);
      transition: transform .05s ease, filter .15s ease;
      display:inline-flex;
      align-items:center;
      gap:10px;
    }
    button:hover{ filter: brightness(1.03); }
    button:active{ transform: translateY(1px); }

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
    }

    /* File input nicer */
    input[type="file"]{
      padding: 8px 10px;
      background:#fff;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="header">
      <div>
        <h2 class="title">Form Aduan</h2>
        <p class="subtitle">Sampaikan laporan Anda dengan jelas. Tim akan memproses sesuai prioritas.</p>
      </div>
      <div class="pill" id="priorityPill">Prioritas: Normal</div>
    </div>

    <div class="card">

      @if(session('success'))
        <div class="notice success">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="notice error">
          <strong>Periksa kembali input Anda:</strong>
          <ul>
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid">
          <div class="field">
            <label>Nama Pelapor <span class="req">*</span></label>
            <input name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Contoh: Budi Santoso" autocomplete="name">
          </div>

          <div class="field">
            <label>WA (opsional)</label>
            <input name="wa" value="{{ old('wa') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric" autocomplete="tel">
            <div class="hint">Biar kami bisa menghubungi Anda lebih cepat.</div>
          </div>
        </div>

        <!-- Darurat toggle (backend tetap pakai select) -->
        <div style="margin-top:14px;">
          <div class="row">
            <div class="rowText">
              <div class="rowTitle">Darurat <span class="req">*</span></div>
              <div class="rowDesc">Aktifkan jika butuh penanganan segera.</div>
            </div>

            <div class="toggle" id="daruratToggle" role="switch" aria-checked="false" tabindex="0" data-on="0">
              <div class="knob"></div>
            </div>
          </div>

          <!-- select tetap ada untuk kompatibilitas request lama -->
          <select id="darurat" name="darurat" style="display:none;">
            <option value="0" {{ old('darurat', '0') === "0" ? 'selected' : '' }}>Tidak</option>
            <option value="1" {{ old('darurat') === "1" ? 'selected' : '' }}>Ya</option>
          </select>
        </div>

        <div class="grid" style="margin-top:14px;">
          <div class="field">
            <label>Kategori <span class="req">*</span></label>
            <select id="kategori" name="kategori"></select>
            <div class="hint" id="kategoriHint">Kategori akan menyesuaikan pilihan darurat.</div>
          </div>

          <div class="field">
            <label>Lokasi <span class="req">*</span></label>
            <input name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Puskesmas A, Lantai 2" autocomplete="street-address">
          </div>
        </div>

        <div class="field" style="margin-top:14px;">
          <label>Isi Aduan <span class="req">*</span></label>
          <textarea name="isi_aduan" rows="5" placeholder="Jelaskan kejadian, waktu, dan detail yang relevan...">{{ old('isi_aduan') }}</textarea>
          <div class="hint">Tips: tulis kronologi singkat + apa yang Anda butuhkan.</div>
        </div>

        <div class="field" style="margin-top:14px;">
          <label>Lampiran (jpg/png/pdf, opsional)</label>
          <input type="file" name="lampiran" accept=".jpg,.jpeg,.png,.pdf">
          <div class="hint">Maksimal ukuran file sesuai aturan server Anda.</div>
        </div>

        <div class="actions">
          <div class="privacy">Dengan mengirim, Anda menyetujui data digunakan untuk tindak lanjut aduan.</div>
          <button type="submit" id="submitBtn">
            Kirim Aduan
            <span aria-hidden="true">→</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
  (function () {
    const daruratEl = document.getElementById('darurat');
    const kategoriEl = document.getElementById('kategori');

    const toggle = document.getElementById('daruratToggle');
    const pill = document.getElementById('priorityPill');
    const kategoriHint = document.getElementById('kategoriHint');

    // kategori normal (darurat = tidak)
    const kategoriNormal = [
      { value: '', label: '-- Pilih Kategori --' },
      { value: 'fasilitas', label: 'Fasilitas' },
      { value: 'tenaga kerja', label: 'Tenaga Kerja' },
      { value: 'kelengkapan obat', label: 'Kelengkapan Obat' },
      { value: 'pelayanan kesehatan', label: 'Pelayanan Kesehatan' },
    ];

    // kategori darurat (darurat = ya)
    const kategoriDarurat = [
      { value: '', label: '-- Pilih Kategori Darurat --' },
      { value: 'kecelakaan', label: 'Kecelakaan' },
      { value: 'butuh ambulans', label: 'Butuh Ambulans' },
      { value: 'gawat darurat', label: 'Gawat Darurat' },
      { value: 'bencana', label: 'Bencana / Evakuasi' },
      { value: 'lainnya darurat', label: 'Lainnya (Darurat)' },
    ];

    const oldKategori = @json(old('kategori', ''));
    const oldDarurat = @json(old('darurat', '0'));

    function setToggle(isOn){
      toggle.dataset.on = isOn ? "1" : "0";
      toggle.setAttribute('aria-checked', isOn ? 'true' : 'false');

      // sync ke select (biar backend tetap sama)
      daruratEl.value = isOn ? '1' : '0';

      // pill info
      pill.textContent = isOn ? 'Prioritas: Darurat' : 'Prioritas: Normal';

      // hint kategori
      kategoriHint.textContent = isOn
        ? 'Pilih kategori darurat agar penanganan lebih cepat.'
        : 'Kategori akan menyesuaikan pilihan darurat.';
    }

    function renderKategori() {
      const isDarurat = daruratEl.value === '1';
      const data = isDarurat ? kategoriDarurat : kategoriNormal;

      kategoriEl.innerHTML = '';
      data.forEach(opt => {
        const o = document.createElement('option');
        o.value = opt.value;
        o.textContent = opt.label;
        kategoriEl.appendChild(o);
      });

      const exists = data.some(x => x.value === oldKategori);
      kategoriEl.value = exists ? oldKategori : '';
    }

    function toggleClick(){
      const next = toggle.dataset.on !== "1";
      setToggle(next);
      renderKategori();
    }

    toggle.addEventListener('click', toggleClick);
    toggle.addEventListener('keydown', (e) => {
      if(e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        toggleClick();
      }
    });

    // initial state dari Laravel
    setToggle(String(oldDarurat) === "1");
    renderKategori();
  })();
  </script>
</body>
</html>
