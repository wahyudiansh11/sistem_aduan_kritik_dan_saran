<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cek Status Aduan</title>
</head>
<body style="font-family:sans-serif; max-width:700px; margin:40px auto;">

<h2>Cek Status Aduan</h2>

@if($errors->any())
  <div style="background:#fee2e2; padding:10px; margin-bottom:10px;">
    {{ $errors->first() }}
  </div>
@endif

<form method="POST" action="{{ route('aduan.cek.submit') }}">
  @csrf

  <label>Kode Tiket</label><br>
  <input
    type="text"
    name="kode_tiket"
    style="width:100%; padding:10px;"
    placeholder="Contoh: ADU260126A1B2C3"
    value="{{ old('kode_tiket') }}"
    required
  >

  <button style="margin-top:10px; padding:10px 14px;">
    Cek
  </button>
</form>

</body>
</html>
