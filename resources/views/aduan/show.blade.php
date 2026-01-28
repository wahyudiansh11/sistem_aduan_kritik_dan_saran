<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Status Aduan</title>
</head>
<body style="font-family:sans-serif; max-width:700px; margin:40px auto;">

<h2>Status Aduan</h2>

<p><b>Kode Tiket:</b> {{ $aduan->kode_tiket }}</p>
<p><b>Nama Pelapor:</b> {{ $aduan->nama_pelapor }}</p>
@if($aduan->wa)
    <p><strong>Nomor WhatsApp:</strong>
        <a href="https://wa.me/62{{ ltrim($aduan->wa, '0') }}" target="_blank">
            {{ $aduan->wa }}
        </a>
    </p>
@else
    <p><strong>Nomor WhatsApp:</strong> -</p>
@endif
<p><b>Kategori:</b> {{ ucwords($aduan->kategori) }}</p>
<p><b>Status:</b> <span style="padding:4px 8px; background:#e5e7eb;">
  {{ strtoupper($aduan->status) }}
</span></p>

<hr>

<h3>Isi Aduan</h3>
<div style="background:#f9fafb; padding:12px; border:1px solid #e5e7eb;">
  {{ $aduan->isi_aduan }}
</div>

<hr>

<h3>Tanggapan Admin</h3>

@if(!empty($aduan->feedback_admin))
  <div style="background:#ecfeff; padding:12px; border:1px solid #a5f3fc;">
    {{ $aduan->feedback_admin }}
  </div>
@else
  <div style="background:#fef9c3; padding:12px; border:1px solid #fde68a;">
    Belum ada tanggapan dari admin.
  </div>
@endif

<p style="margin-top:20px;">
  <a href="{{ route('aduan.cek.form') }}">← Kembali cek aduan</a>
</p>

</body>
</html>
