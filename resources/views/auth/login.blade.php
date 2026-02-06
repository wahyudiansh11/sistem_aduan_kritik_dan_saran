<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - Dinas Kesehatan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
  <div class="row justify-content-center align-items-center" style="min-height:100vh;">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

          <div class="text-center mb-3">
            <img src="{{ asset('image/logo.jpeg') }}" style="height:60px;" alt="Logo">
            <h4 class="mt-3 mb-1 fw-bold">Login Admin</h4>
            <div class="text-secondary small">Sistem Aduan Kritik & Saran</div>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
              </div>
            </div>

            <button class="btn btn-primary w-100 rounded-pill py-2" type="submit">
              Masuk
            </button>

            <div class="text-center mt-3">
              <a href="{{ url('/') }}" class="text-decoration-none small">← Kembali ke Landing Page</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
