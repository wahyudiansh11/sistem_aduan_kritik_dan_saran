<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Aduan</title>
</head>
<body style="font-family: sans-serif; max-width: 720px; margin: 40px auto;">

<h2>Form Aduan</h2>

@if(session('success'))
    <p style="background:#d1fae5; padding:10px;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <div style="background:#fee2e2; padding:10px;">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data">
    @csrf

    <div style="margin-bottom:10px;">
        <label>Nama Pelapor *</label><br>
        <input name="nama_pelapor" value="{{ old('nama_pelapor') }}" style="width:100%; padding:8px;">
    </div>

    <div style="margin-bottom:10px;">
        <label>WA (opsional)</label><br>
        <input name="wa" value="{{ old('wa') }}" style="width:100%; padding:8px;">
    </div>

    <div style="margin-bottom:10px;">
        <label>Darurat? *</label><br>
        <select id="darurat" name="darurat" style="width:100%; padding:8px;">
            <option value="0" {{ old('darurat', '0') === "0" ? 'selected' : '' }}>Tidak</option>
            <option value="1" {{ old('darurat') === "1" ? 'selected' : '' }}>Ya</option>
        </select>
    </div>

    <div style="margin-bottom:10px;">
        <label>Kategori *</label><br>
        <select id="kategori" name="kategori" style="width:100%; padding:8px;">
            <!-- opsi akan diisi oleh JS -->
        </select>
        <small style="color:#6b7280;">Kategori akan menyesuaikan pilihan darurat.</small>
    </div>

    <div style="margin-bottom:10px;">
        <label>Lokasi *</label><br>
        <input name="lokasi" value="{{ old('lokasi') }}" style="width:100%; padding:8px;">
    </div>

    <div style="margin-bottom:10px;">
        <label>Isi Aduan *</label><br>
        <textarea name="isi_aduan" rows="5" style="width:100%; padding:8px;">{{ old('isi_aduan') }}</textarea>
    </div>

    <div style="margin-bottom:10px;">
        <label>Lampiran (jpg/png/pdf, opsional)</label><br>
        <input type="file" name="lampiran">
    </div>

    <button type="submit" style="padding:10px 14px;">Kirim Aduan</button>
</form>

<script>
(function () {
    const daruratEl = document.getElementById('darurat');
    const kategoriEl = document.getElementById('kategori');

    // kategori normal (darurat = tidak)
    const kategoriNormal = [
        { value: '', label: '-- Pilih Kategori --' },
        { value: 'fasilitas', label: 'Fasilitas' },
        { value: 'tenaga kerja', label: 'Tenaga Kerja' },
        { value: 'kelengkapan obat', label: 'Kelengkapan Obat' },
        { value: 'pelayanan kesehatan', label: 'Pelayanan Kesehatan' },
    ];

    // kategori darurat (darurat = ya) -> kamu bisa tambah/ubah sesuka hati
    const kategoriDarurat = [
        { value: '', label: '-- Pilih Kategori Darurat --' },
        { value: 'kecelakaan', label: 'Kecelakaan' },
        { value: 'butuh ambulans', label: 'Butuh Ambulans' },
        { value: 'gawat darurat', label: 'Gawat Darurat' },
        { value: 'bencana', label: 'Bencana / Evakuasi' },
        { value: 'lainnya darurat', label: 'Lainnya (Darurat)' },
    ];

    // old value dari Laravel
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

        // kalau oldKategori cocok, pilih. Kalau tidak cocok (misal ganti darurat),
        // otomatis balik ke pilihan placeholder.
        const exists = data.some(x => x.value === oldKategori);
        kategoriEl.value = exists ? oldKategori : '';
    }

    daruratEl.addEventListener('change', renderKategori);

    // initial load
    renderKategori();
})();
</script>

</body>
</html>
