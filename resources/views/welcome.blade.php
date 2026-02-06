<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIADRU - Dinas Kesehatan Sumenep</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  {{-- Google Font --}}
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
  :root{
    --green: #064e3b;      /* Hijau Tua Botol (Khas Instansi) */
    --green2: #10b981;     /* Hijau Emerald (Aksen) */
    --soft: #f8fafc;       /* Background Abu Sangat Muda */
    --text: #1e293b;
    --muted: #64748b;
    --radius: 20px;
    --shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
  }

  body{
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text);
    background: #fff;
    line-height: 1.6;
  }

  /* Navbar */
  .navbar-custom{
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 12px 0;
  }
  .brand-logo{ height:45px; width:auto; border-radius: 6px; }
  .brand-text{ font-size: 14px; line-height: 1.2; color: var(--green); }

  /* Hero Section */
  .hero{
    color:#fff;
    position: relative;
    overflow:hidden;
    padding: 100px 0 150px;
    background: linear-gradient(135deg, rgba(6, 78, 59, 0.95) 0%, rgba(6, 78, 59, 0.7) 100%),
                url("{{ asset('image/project.jpg') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  .hero::after{
    content:"";
    position:absolute;
    left:0; right:0; bottom:-1px;
    height:100px;
    background: #fff;
    clip-path: ellipse(50% 100% at 50% 100%);
  }

  .hero-badge{
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    backdrop-filter: blur(5px);
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 100px;
    display: inline-flex;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .hero-title{
    font-weight: 800;
    letter-spacing: -2px;
    line-height: 1;
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: 25px;
  }

  .hero-card{
    background: #fff;
    border-radius: var(--radius);
    box-shadow: 0 30px 60px -12px rgba(0,0,0,0.25);
    overflow: hidden;
    position: relative;
    z-index: 2;
    border: 8px solid #fff;
  }

  .hero-card .carousel-item img{
    width: 100%;
    height: 450px;
    object-fit: cover;
  }

  /* Buttons */
  .btn-cta{
    border-radius: 100px;
    padding: 15px 35px;
    font-weight: 700;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    transition: all 0.3s;
  }
  .btn-cta:hover{ transform: translateY(-3px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); }

  .btn-outline-light2{
    border: 2px solid rgba(255,255,255,0.5);
    color: #fff;
    border-radius: 100px;
    padding: 15px 35px;
    font-weight: 700;
    transition: all 0.3s;
  }
  .btn-outline-light2:hover{ background: #fff; color: var(--green); }

  /* Feature / Layanan */
  .section{ padding: 100px 0; }
  .section-soft{ background: var(--soft); }

  .feature{
    background: #fff;
    border-radius: var(--radius);
    padding: 35px;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.03);
    box-shadow: var(--shadow);
    text-align: center;
  }
  .feature:hover{ transform: translateY(-10px); border-color: var(--green2); }
  
  .feature .ic{
    width: 70px; height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center; justify-content: center;
    background: var(--soft);
    color: var(--green2);
    font-size: 30px;
    margin: 0 auto 20px;
    transition: all 0.3s;
  }
  .feature:hover .ic{ background: var(--green2); color: #fff; }

  /* Gallery / Program */
  .gallery-card{
    border-radius: var(--radius);
    overflow: hidden;
    background: #fff;
    box-shadow: var(--shadow);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }
  .gallery-card img{ height: 250px; object-fit: cover; width: 100%; transition: 0.5s; }
  .gallery-card:hover img{ transform: scale(1.1); }
  .gallery-card .p-4{ background: #fff; position: relative; z-index: 2; }

  /* Stats Card */
  .stat-card{
    background: #fff;
    border-radius: var(--radius);
    padding: 30px;
    box-shadow: var(--shadow);
    border-bottom: 4px solid var(--green2);
  }
  .stat-card h3{ font-weight: 800; color: var(--green); font-size: 32px; }

  /* Footer */
  footer{
    background: #062c22;
    padding: 80px 0 40px;
  }

  /* Responsive */
  @media (max-width: 768px){
    .hero{ padding: 60px 0 100px; text-align: center; }
    .hero-title{ font-size: 32px; }
    .hero-card .carousel-item img{ height: 300px; }
  }

  /* =========================
   MOBILE: HERO TEXT LEFT
   ========================= */
@media (max-width: 768px){
  .hero{
    text-align: left !important;
  }

  .hero .hero-badge{
    justify-content: flex-start;
  }

  .hero .hero-title{
    text-align: left;
    letter-spacing: -1px;
  }

  .hero .lead{
    text-align: left;
    font-size: 0.95rem;
  }

  .hero .d-flex{
    justify-content: flex-start !important;
  }
}

  
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container py-1">
    <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
      <img src="{{ asset('image/logo.jpeg') }}" alt="Logo Dinkes" class="brand-logo">
      <div class="brand-text d-none d-md-block fw-bold uppercase">
        DINAS KESEHATAN, P2KB<br>
        <span class="text-muted fw-normal">Kabupaten Sumenep</span>
      </div>
      <span class="brand-text d-block d-md-none fw-bold">DINKES SUMENEP</span>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-lg-3">
        <li class="nav-item"><a class="nav-link fw-semibold" href="#layanan">Layanan</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#program">Program</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#kontak">Kontak</a></li>
      </ul>

      <div class="d-flex gap-2 ms-lg-4 mt-3 mt-lg-0">
        <a href="{{ route('aduan.cek.form') }}" class="btn btn-outline-success btn-sm rounded-pill px-4 fw-bold">
          Cek Tiket
        </a>
        <a href="{{ route('aduan.create') }}" class="btn btn-success btn-sm rounded-pill px-4 fw-bold shadow-sm">
          Buat Aduan
        </a>
      </div>
    </div>
  </div>
</nav>

{{-- HERO --}}
<header class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="hero-badge mb-4">
          <i class="bi bi-shield-check-fill me-2"></i> Layanan Pengaduan Resmi
        </div>

        <h1 class="hero-title">
          SIADRU <br>
          <span style="color: var(--green2);">Dinkes Sumenep</span>
        </h1>

        <p class="lead mb-5" style="font-size: 1.1rem; opacity: 0.9;">
          Portal digital terpadu untuk menyampaikan aduan, kritik, dan saran demi kualitas pelayanan kesehatan Sumenep yang lebih prima, transparan, dan akuntabel.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-5">
          <a href="{{ route('aduan.create') }}" class="btn btn-light btn-cta">
            <i class="bi bi-plus-circle me-2"></i> Buat Aduan
          </a>
          <a href="{{ route('aduan.cek.form') }}" class="btn btn-outline-light2">
            <i class="bi bi-search me-2"></i> Lacak Tiket
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="hero-card">
          <div id="dinkesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('image/project.jpg') }}" alt="Foto 1">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('image/foto.jpeg') }}" alt="Foto 2">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('image/program3.jpg') }}" alt="Foto 3">
              </div>
            </div>
            <button class="carousel-control-prev" data-bs-target="#dinkesCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" data-bs-target="#dinkesCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

{{-- STATISTICS --}}
<section class="py-5 bg-white position-relative" style="margin-top: -60px; z-index: 5;">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-6 col-lg-3"><div class="stat-card text-center"><h3>24/7</h3><p class="text-muted mb-0">Akses Layanan</p></div></div>
      <div class="col-6 col-lg-3"><div class="stat-card text-center"><h3>100%</h3><p class="text-muted mb-0">Tercatat Sistem</p></div></div>
      <div class="col-6 col-lg-3"><div class="stat-card text-center"><h3>1x24h</h3><p class="text-muted mb-0">Respon Awal</p></div></div>
      <div class="col-6 col-lg-3"><div class="stat-card text-center"><h3>Publik</h3><p class="text-muted mb-0">Transparansi Data</p></div></div>
    </div>
  </div>
</section>

{{-- LAYANAN --}}
<section id="layanan" class="section">
  <div class="container text-center mb-5">
    <h2 class="fw-extrabold mb-3">Kategori Aduan</h2>
    <p class="text-muted mx-auto" style="max-width: 600px;">Kami melayani berbagai kategori pengaduan untuk meningkatkan kualitas kesehatan masyarakat.</p>
  </div>
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature">
          <div class="ic"><i class="bi bi-hospital"></i></div>
          <h5 class="fw-bold">Fasilitas</h5>
          <p class="text-muted small">Keluhan terkait sarana prasarana dan kebersihan gedung kesehatan.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature">
          <div class="ic"><i class="bi bi-people"></i></div>
          <h5 class="fw-bold">Tenaga Medis</h5>
          <p class="text-muted small">Masukan terkait sikap, etika, dan profesionalisme petugas.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature">
          <div class="ic" style="background: #fff5f5; color: #e53e3e;"><i class="bi bi-exclamation-triangle"></i></div>
          <h5 class="fw-bold">Gawat Darurat</h5>
          <p class="text-muted small">Laporan kejadian mendesak yang membutuhkan respon segera.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- PROGRAM --}}
<section id="program" class="section section-soft">
  <div class="container text-center mb-5">
    <h2 class="fw-extrabold mb-3">Program Unggulan</h2>
    <p class="text-muted">Inisiatif Dinas Kesehatan Sumenep untuk masyarakat.</p>
  </div>
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="gallery-card">
          <img src="{{ asset('image/posyandu.png') }}" alt="Posyandu">
          <div class="p-4">
            <h6 class="fw-bold">Layanan Posyandu Terpadu</h6>
            <p class="text-muted small mb-0">Pemeriksaan gizi dan tumbuh kembang balita secara rutin.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-card">
          <img src="{{ asset('image/vaksinasi.png') }}" alt="Vaksin">
          <div class="p-4">
            <h6 class="fw-bold">Imunisasi Nasional</h6>
            <p class="text-muted small mb-0">Perlindungan kesehatan anak melalui program vaksinasi gratis.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-card">
          <img src="{{ asset('image/gawat.png') }}" alt="Darurat">
          <div class="p-4">
            <h6 class="fw-bold">Call Center 119</h6>
            <p class="text-muted small mb-0">Layanan ambulans dan kedaruratan medis cepat 24 jam.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- KONTAK & MAPS --}}
<section id="kontak" class="section bg-white">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 30px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.896740679815!2d113.8447881!3d-7.0094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd9e6912389d4d1%3A0xe744e2e28741639d!2sDinas%20Kesehatan%20Kabupaten%20Sumenep!5e0!3m2!1sid!2sid!4v1700000000000" 
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="p-4 rounded-4 shadow-sm text-white" style="background: var(--green); border-radius: 30px !important;">
          <h3 class="fw-bold mb-4">Hubungi Kami</h3>
          <ul class="list-unstyled">
            <li class="mb-4 d-flex gap-3"><i class="bi bi-geo-alt fs-4"></i> <span>Jl. Jokotole No. 05 Sumenep, Jawa Timur</span></li>
            <li class="mb-4 d-flex gap-3"><i class="bi bi-telephone fs-4"></i> <span>(0328) 662122</span></li>
            <li class="mb-4 d-flex gap-3"><i class="bi bi-envelope fs-4"></i> <span>dinkessumenep@gmail.com</span></li>
          </ul>
          <a href="mailto:dinkessumenep@gmail.com" class="btn btn-warning w-100 fw-bold py-3 rounded-pill mt-3 shadow-sm">Kirim Pesan</a>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="text-white text-center">
  <div class="container">
    <img src="{{ asset('image/logo.jpeg') }}" width="60" class="mb-4 shadow-sm rounded">
    <h5 class="fw-bold mb-2">Dinas Kesehatan Kabupaten Sumenep</h5>
    <p class="opacity-50 small mb-4">Melayani dengan Hati untuk Masyarakat Sumenep Sehat</p>
    <div class="d-flex justify-content-center gap-3 mb-5">
      <a href="#" class="btn btn-outline-light rounded-circle" style="width:45px; height:45px;"><i class="bi bi-youtube"></i></a>
      <a href="https://www.instagram.com/dinkes_sumenep?igsh=MXhqZjE3ang1Y2ZrMg==" class="btn btn-outline-light rounded-circle" style="width:45px; height:45px;"><i class="bi bi-instagram"></i></a>
      <a href="https://www.tiktok.com/@dinkes.p2kb.sumen?_r=1&_d=ek4jf4970m3314&sec_uid=MS4wLjABAAAAOCmffVGXwX2KB0vL5TxG_IiGGlJzb47IM97vGBuXyiN3YVWitiyPCyALtiwDiM6O&share_author_id=7322728876340970501&sharer_language=id&source=h5_t&u_code=cm28amj6dikj65&timestamp=1770345926&user_id=6532814912384745474&sec_user_id=MS4wLjABAAAAJJneXRATa9YlASiVjSuxmHvavwD9V-Po3OdOXlB1NwV9krL-7N9VYFKk-PJ6dO3c&item_author_type=2&utm_source=copy&utm_campaign=client_share&utm_medium=android&share_iid=7576497344938673928&share_link_id=8d01a020-a054-4d45-bf04-ae857c4cfeba&share_app_id=1180&ugbiz_name=ACCOUNT&social_share_type=5&enable_checksum=1" class="btn btn-outline-light rounded-circle" style="width:45px; height:45px;"><i class="bi bi-tiktok"></i></a>
    </div>
    <p class="small opacity-25">© {{ date('Y') }} SIADRU Sumenep. All Rights Reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>