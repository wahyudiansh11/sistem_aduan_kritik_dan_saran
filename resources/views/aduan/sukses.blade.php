<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aduan Terkirim</title>
</head>
<body style="font-family:sans-serif; max-width:700px; margin:40px auto;">

  <h2>Aduan berhasil dikirim ✅</h2>

  <p>Simpan <b>kode tiket</b> ini untuk cek status aduan kamu:</p>

  <h3 style="background:#f3f4f6; padding:12px; display:inline-block; border-radius:8px;">
    {{ $kode }}
  </h3>

  <p style="margin-top:20px;">
    Cek status aduan di halaman ini:
    <a href="{{ route('aduan.cek.form') }}">Cek Status Aduan</a>
  </p>

  <p style="margin-top:10px;">
    <a href="{{ route('aduan.create') }}">Kirim aduan lagi</a>
  </p>

</body>
</html>
