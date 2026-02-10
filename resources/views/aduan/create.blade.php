<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Kirim Aduan & Aspirasi - Dinkes Sumenep</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('image/logo.jpeg') }}">
    
  <style>
    :root {
      --primary: #059669; /* Hijau Kesehatan */
      --primary-hover: #047857;
      --bg-light: #f8fafc;
      --error: #dc2626;
    }

    body {
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      background-color: var(--bg-light);
      margin: 0;
      padding: 0;
      color: #334155;
      line-height: 1.6;
    }

    .container {
      max-width: 700px;
      margin: 40px auto;
      padding: 0 20px;
    }

    /* Header Branding */
    .branding {
      text-align: center;
      margin-bottom: 30px;
    }
    .branding img { height: 70px; margin-bottom: 10px; }
    .branding h1 { margin: 0; font-size: 22px; color: #1e293b; text-transform: uppercase; }
    .branding p { margin: 5px 0 0; color: #64748b; font-size: 14px; }

    /* Card Wrapper */
    .form-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
      border-top: 6px solid var(--primary);
    }

    h2 { margin-top: 0; font-size: 20px; color: var(--primary); display: flex; align-items: center; gap: 8px; }

    /* Alert Success/Error */
    .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
    .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    /* Form Styling */
    .form-group { margin-bottom: 20px; }
    label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #1e293b; }
    
    input[type="text"], 
    input[type="tel"], 
    select, 
    textarea {
      width: 100%;
      padding: 12px 14px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      font-size: 14px;
      box-sizing: border-box;
      transition: all 0.2s;
      outline: none;
    }

    input:focus, select:focus, textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    small { display: block; margin-top: 6px; color: #64748b; font-size: 12px; }

    /* Button Styling */
    .btn-lokasi {
      background: #fff;
      border: 1.5px solid var(--primary);
      color: var(--primary);
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      transition: 0.2s;
    }
    .btn-lokasi:hover { background: #f0fdf4; }

    .btn-submit {
      background: var(--primary);
      color: white;
      border: none;
      width: 100%;
      padding: 14px;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }
    .btn-submit:hover { background: var(--primary-hover); transform: translateY(-1px); }

    /* Emergency Section */
    #field-ambulans {
      background: #f1f5f9;
      border-left: 4px solid #3b82f6;
    }

    .btn-call {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      background: #2563eb;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
    }

    @media (max-width: 640px) {
      .form-card { padding: 20px; }
      .container { margin: 20px auto; }
    }

    /* =========================
   RESPONSIVE ENHANCEMENTS
   ========================= */

.form-card{
  overflow: hidden; /* biar aman kalau ada elemen melebar */
}

/* bikin beberapa baris form bisa 2 kolom di desktop */
.form-grid{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

/* input file biar rapi */
input[type="file"]{
  width:100%;
  padding: 10px;
  border: 1.5px dashed #cbd5e1;
  border-radius: 10px;
  background:#fff;
}

/* bar untuk maps */
.maps-row{
  display:flex;
  gap:10px;
  align-items: stretch;
}
.maps-row input{
  flex: 1;
  min-width: 0;
}
.maps-row button{
  flex: 0 0 auto;
}

/* card lebih enak di tablet */
@media (max-width: 900px){
  .container{ max-width: 760px; }
}

/* mobile */
@media (max-width: 640px){
  .container{
    margin: 18px auto;
    padding: 0 14px;
  }

  .branding img{ height: 58px; }
  .branding h1{ font-size: 18px; }
  .branding p{ font-size: 12px; }

  .form-card{
    padding: 18px;
    border-radius: 14px;
  }

  h2{ font-size: 18px; }

  /* grid jadi 1 kolom */
  .form-grid{
    grid-template-columns: 1fr;
    gap: 12px;
  }

  /* maps input + tombol jadi ke bawah */
  .maps-row{
    flex-direction: column;
  }
  .btn-lokasi{
    width: 100%;
    justify-content: center;
    padding: 10px 14px;
  }

  .btn-submit{
    font-size: 15px;
    padding: 13px;
  }

  textarea{ min-height: 110px; }
}

/* super kecil */
@media (max-width: 360px){
  .form-card{ padding: 16px; }
  input[type="text"], input[type="tel"], select, textarea{
    padding: 11px 12px;
  }
}

  </style>
</head>

<body>
  <div class="container">
    <div class="branding">
      <img src="{{ asset('image/logo.jpeg') }}" alt="Logo Sumenep">
      <h1>Dinas Kesehatan</h1>
      <p>Kabupaten Sumenep</p>
    </div>

    <div class="form-card">
      <h2>📩 Formulir Aduan & Saran</h2>
      <p style="font-size: 13px; color: #64748b; margin-bottom: 25px;">
        Gunakan form ini untuk menyampaikan keluhan pelayanan atau kebutuhan darurat medis.
      </p>

      @if(session('success'))
        <div class="alert alert-success">
          <b>Berhasil!</b> {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-error">
          <ul style="margin:0; padding-left:18px;">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data">
        @csrf

       <div class="form-grid">
  <div class="form-group">
    <label>Nama Pelapor *</label>
    <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Masukkan nama lengkap Anda" required>
  </div>

  <div class="form-group">
    <label>Nomor WhatsApp *</label>
    <input type="tel" name="wa" value="{{ old('wa') }}" placeholder="08xxxxxxxxxx" required>
    <small>Admin akan menghubungi Anda melalui nomor ini. Pastikan nomor anda benar</small>
  </div>
</div>


        <div class="form-group">
          <label>Apakah Ini Darurat? *</label>
          <select id="darurat" name="darurat" required>
            <option value="0" {{ old('darurat', '0') === '0' ? 'selected' : '' }}>Bukan Darurat (Kritik/Saran)</option>
            <option value="1" {{ old('darurat', '0') === '1' ? 'selected' : '' }}>YA (Gawat Darurat)</option>
          </select>
        </div>

        <div class="form-group">
          <label>Kategori *</label>
          <select id="kategori" name="kategori" required></select>
        </div>

        <div id="field-ambulans" style="margin-bottom:20px; display:none; padding:15px; border-radius:10px;">
          <label>🚑 Pilih Ambulans Terdekat *</label>
          <select id="ambulans_select" name="ambulans_id" style="margin-top:5px;"></select>
          
          <div style="margin-top:15px;">
            <label>Nomor Telepon Ambulans</label>
            <input id="ambulans_phone" type="text" name="no_ambulans" value="{{ old('no_ambulans') }}" readonly style="background:#fff;">
          </div>

          <div style="margin-top:15px;">
            <a id="call_ambulans" href="#" class="btn-call" style="opacity:.6; pointer-events:none;">
              📞 Hubungi Sekarang
            </a>
          </div>
        </div>

      <div class="maps-row" style="margin-bottom:8px;">
  <input type="text" name="maps_link" id="maps_link" placeholder="Link Google Maps" value="{{ old('maps_link') }}">
  <button type="button" id="btnLokasi" class="btn-lokasi">
    📍 GPS Saya
  </button>
</div>

          <small id="lokasiStatus">Khusus darurat, sangat disarankan klik "GPS Saya".</small>
        </div>
<div class="form-group">
  <label>Alamat Lengkap / Lokasi Kejadian *</label>
  <textarea name="lokasi"
            id="lokasi"
            placeholder="Contoh: Jl. Trunojoyo No. 10, depan Puskesmas"
            required>{{ old('lokasi') }}</textarea>
</div>


        <div class="form-group">
          <label>Isi Laporan / Pesan *</label>
          <textarea name="isi_aduan" rows="4" placeholder="Tuliskan detail aduan atau bantuan yang dibutuhkan..." required>{{ old('isi_aduan') }}</textarea>
        </div>

        <div class="form-group">
          <label>Lampiran Foto / Bukti *</label>
          <input type="file" name="lampiran" accept=".jpg,.jpeg,.png,.pdf" required style="font-size: 13px;">
          <small>Maksimal ukuran file 2MB (JPG, PNG, atau PDF).</small>
        </div>

        <button type="submit" class="btn-submit">KIRIM LAPORAN SEKARANG</button>
      </form>
    </div>

    <p style="text-align: center; font-size: 12px; color: #94a3b8; margin-top: 30px;">
      &copy; 2026 Dinas Kesehatan Kabupaten Sumenep. All Rights Reserved.
    </p>
  </div>

  <script>
  (function () {
    const daruratEl = document.getElementById('darurat');
    const kategoriEl = document.getElementById('kategori');
    const ambulansWrap = document.getElementById('field-ambulans');
    const ambulansSelect = document.getElementById('ambulans_select');
    const ambulansPhone = document.getElementById('ambulans_phone');
    const callBtn = document.getElementById('call_ambulans');

    const kategoriNormal = [
      { value: '', label: '-- Pilih Kategori --' },
      { value: 'pelayanan kesehatan', label: 'Pelayanan Kesehatan' },
      { value: 'fasilitas', label: 'Fasilitas Kesehatan' },
      { value: 'tenaga kerja', label: 'Petugas/Tenaga Medis' },
      { value: 'kelengkapan obat', label: 'Stok & Kelengkapan Obat' },
      { value: 'lainnya', label: 'Lain-lain' },
    ];

    const kategoriDarurat = [
      { value: '', label: '-- Pilih Jenis Kondisi Darurat --' },
      { value: 'kecelakaan', label: 'Kecelakaan Lalu Lintas' },
      { value: 'butuh ambulans', label: 'Penjemputan Pasien (Ambulans)' },
      { value: 'gawat darurat medis', label: 'Gawat Darurat Medis (Serangan Jantung/Lainnya)' },
      { value: 'keracunan massal', label: 'Kejadian Keracunan Massal' },
      { value: 'bencana', label: 'Bencana / Evakuasi' },
    ];

    const oldKategori = @json(old('kategori', ''));

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
      kategoriEl.value = data.some(x => x.value === oldKategori) ? oldKategori : '';
    }

    const ambulansList = [
      { id: '', nama: '-- Pilih Puskesmas Terdekat --', phone: '' },
      { id: 'puskesmas_sumenep', nama: 'Ambulans Puskesmas Sumenep', phone: '6287765312695' },
      { id: 'puskesmas_kalianget', nama: 'Ambulans Puskesmas Kalianget', phone: '628111222333' },
      { id: 'puskesmas_gapura', nama: 'Ambulans Puskesmas Gapura', phone: '628555666777' },
    ];

    const oldAmbulansId = @json(old('ambulans_id', ''));

    function renderAmbulans() {
      ambulansSelect.innerHTML = '';
      ambulansList.forEach(a => {
        const o = document.createElement('option');
        o.value = a.id;
        o.textContent = a.nama;
        ambulansSelect.appendChild(o);
      });
      ambulansSelect.value = ambulansList.some(x => x.id === oldAmbulansId) ? oldAmbulansId : '';
      updateAmbulansNumber(ambulansSelect.value);
    }

    function updateAmbulansNumber(selectedId) {
      const item = ambulansList.find(x => x.id === selectedId);
      const phone = item && item.phone ? item.phone : '';
      ambulansPhone.value = phone;
      if (phone) {
        callBtn.href = 'tel:' + phone;
        callBtn.style.opacity = '1';
        callBtn.style.pointerEvents = 'auto';
      } else {
        callBtn.style.opacity = '0.6';
        callBtn.style.pointerEvents = 'none';
      }
    }

    daruratEl.addEventListener('change', function () {
      renderKategori();
      const isDarurat = this.value === '1';
      ambulansWrap.style.display = isDarurat ? 'block' : 'none';
      ambulansSelect.required = isDarurat;
    });

    ambulansSelect.addEventListener('change', function () {
      updateAmbulansNumber(this.value);
    });

    renderKategori();
    renderAmbulans();

    // Geolocation
    const btnLokasi = document.getElementById('btnLokasi');
    btnLokasi.addEventListener('click', function () {
      if (!navigator.geolocation) return alert('Browser tidak mendukung lokasi');
      
      btnLokasi.textContent = '⏳ Mencari...';
      navigator.geolocation.getCurrentPosition(function (pos) {
        const link = `https://www.google.com/maps?q=${pos.coords.latitude},${pos.coords.longitude}`;
        document.getElementById('maps_link').value = link;
        document.getElementById('lokasiStatus').textContent = '✅ Lokasi berhasil dikunci.';
        btnLokasi.textContent = '📍 GPS Saya';
      }, function() {
        alert('Gagal mengambil lokasi. Pastikan izin lokasi aktif.');
        btnLokasi.textContent = '📍 GPS Saya';
      });
    });
  })();
  </script>
</body>
</html>