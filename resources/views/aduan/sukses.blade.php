<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Aduan Terkirim</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('image/logo.jpeg') }}">

  <style>
    :root{
      /* DINKES THEME */
      --primary: #0E7A3A;        /* hijau dinkes */
      --primaryHover:#0B6330;
      --accent:#F4B400;         /* opsional (emas) */
      --bg:#F6FBF7;
      --card:#FFFFFF;

      --text:#0F172A;
      --muted:#475569;
      --border:#E5E7EB;

      --success:#16A34A;
      --successBg:#DCFCE7;
      --successBorder:#86EFAC;

      --shadow: 0 18px 45px rgba(2,6,23,.08);
      --radius: 16px;
      --focus: rgba(14,122,58,.25);
    }

    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text);
      background:
        radial-gradient(900px 360px at 20% -10%, rgba(14,122,58,.16), transparent 60%),
        radial-gradient(700px 320px at 110% 10%, rgba(244,180,0,.10), transparent 55%),
        linear-gradient(180deg, #ffffff, var(--bg));
      line-height:1.45;
    }

    /* top strip ala instansi */
    .topbar{
      height: 8px;
      background: linear-gradient(90deg, var(--primary), #1aa24f);
    }

    .wrap{
      max-width: 860px;
      margin: 44px auto;
      padding: 0 18px;
    }

    .header{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:16px;
      margin-bottom:16px;
    }

    .brand{
      display:flex;
      align-items:center;
      gap:12px;
      margin-bottom:10px;
    }
    .logo{
  width:44px;
  height:44px;
  border-radius:14px;
  background:#ffffff;
  border:1px solid rgba(14,122,58,.25);
  display:flex;
  align-items:center;
  justify-content:center;
}

.logo img{
  width:100%;
  height:100%;
  object-fit: contain;
  padding:6px;      /* biar logo nggak nempel */
}

    }
    .brandText .org{
      font-size:12px;
      color: var(--muted);
      font-weight:700;
      text-transform: uppercase;
      letter-spacing:.08em;
    }
    .brandText .app{
      font-size:14px;
      font-weight:900;
      color: var(--text);
      margin-top:2px;
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
      padding: 7px 12px;
      border-radius: 999px;
      background: var(--successBg);
      border:1px solid var(--successBorder);
      font-size: 12px;
      color:#166534;
      font-weight:800;
      white-space: nowrap;
    }

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    /* aksen garis hijau kiri pada card */
    .card::before{
      content:"";
      position:absolute;
      left:0; top:0; bottom:0;
      width: 6px;
      background: linear-gradient(180deg, var(--primary), #1aa24f);
    }

    .notice{
      border-radius: 14px;
      padding: 12px 14px;
      margin-bottom: 14px;
      border:1px solid var(--successBorder);
      font-size:14px;
      background:var(--successBg);
      color:#14532d;
      display:flex;
      gap:10px;
      align-items:flex-start;
    }
    .notice .icon{
      width: 30px;
      height: 30px;
      border-radius: 999px;
      background: rgba(22,163,74,.18);
      display:grid;
      place-items:center;
      flex: 0 0 auto;
      margin-top: 1px;
      color:#166534;
      font-weight: 900;
    }

    .ticketBox{
      margin-top: 14px;
      border:1px solid var(--border);
      border-radius: 14px;
      background: #ffffff;
      padding: 14px;
    }

    .ticketLabel{
      font-size: 12px;
      color: var(--muted);
      margin:0 0 8px;
      font-weight:800;
      letter-spacing:.04em;
      text-transform: uppercase;
    }

    .ticketRow{
      display:flex;
      align-items:center;
      gap:10px;
      flex-wrap: wrap;
    }

    .ticketCode{
      font-weight: 900;
      font-size: 18px;
      letter-spacing: .08em;
      padding: 10px 12px;
      border-radius: 12px;
      background: rgba(14,122,58,.06);
      border:1px solid rgba(14,122,58,.20);
      display:inline-block;
      color: #0b3d1e;
    }

    .btnRow{
      display:flex;
      gap:10px;
      flex-wrap: wrap;
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px dashed var(--border);
    }

    .btn{
      border:0;
      border-radius: 12px;
      padding: 10px 14px;
      font-size: 14px;
      font-weight: 900;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:10px;
      transition: transform .05s ease, filter .15s ease, background .15s ease, border-color .15s ease;
    }
    .btn:active{ transform: translateY(1px); }

    .btnPrimary{
      background: var(--primary);
      color:#fff;
      box-shadow: 0 14px 30px rgba(14,122,58,.20);
    }
    .btnPrimary:hover{ background: var(--primaryHover); }

    .btnGhost{
      background:#fff;
      color: var(--primary);
      border:1px solid rgba(14,122,58,.25);
    }
    .btnGhost:hover{
      background: rgba(14,122,58,.06);
      border-color: rgba(14,122,58,.35);
    }

    .copyBtn{
      background:#fff;
      border:1px solid rgba(14,122,58,.25);
      border-radius: 12px;
      padding: 10px 12px;
      font-weight: 900;
      cursor:pointer;
      color: var(--primary);
      transition: background .15s ease, border-color .15s ease;
    }
    .copyBtn:hover{
      background: rgba(14,122,58,.06);
      border-color: rgba(14,122,58,.35);
    }

    .muted{
      color: var(--muted);
      font-size: 13px;
      margin-top: 10px;
    }

    /* fokus aksesibilitas */
    :is(.btn, .copyBtn):focus{
      outline: 3px solid var(--focus);
      outline-offset: 2px;
    }

    .srOnly{
      position:absolute;
      width:1px;height:1px;
      padding:0;margin:-1px;
      overflow:hidden;clip:rect(0,0,0,0);
      white-space:nowrap;border:0;
    }

    @media (max-width:520px){
      .title{ font-size: 24px; }
      .logo{ width:40px; height:40px; border-radius: 12px; }
    }
  </style>
</head>

<body>
  <div class="topbar" aria-hidden="true"></div>

  <div class="wrap">
    <div class="header">
      <div>
        <!-- Branding kecil ala instansi -->
        <div class="brand">
          <!-- Ganti isi logo ini dengan <img src="..."> kalau sudah punya logo dinkes -->
          <div class="logo" aria-hidden="true"><img src="{{ asset('image/logo.jpeg') }}" ></div>
          <div class="brandText">
            <div class="org">DINAS KESEHATAN</div>
            <div class="app">Layanan Pengaduan</div>
          </div>
        </div>

        <h2 class="title">Aduan Terkirim</h2>
        <p class="subtitle">Terima kasih. Simpan kode tiket untuk cek status aduan Anda.</p>
      </div>

      <div class="pill">Status: Terkirim ✅</div>
    </div>

    <div class="card">
      <div class="notice">
        <div class="icon" aria-hidden="true">✓</div>
        <div>
          <strong>Aduan berhasil dikirim.</strong><br>
          Gunakan kode tiket di bawah untuk memantau status aduan.
        </div>
      </div>

      <div class="ticketBox">
        <p class="ticketLabel">Kode Tiket</p>
        <div class="ticketRow">
          <div class="ticketCode" id="ticketCode">{{ $kode }}</div>
          <button type="button" class="copyBtn" id="copyBtn" aria-describedby="copyHelp">
            Salin Kode
          </button>
          <span class="srOnly" id="copyHelp">Menyalin kode tiket ke clipboard</span>
        </div>
        <div class="muted" id="copyStatus" aria-live="polite"></div>
      </div>

      <div class="btnRow">
        <a class="btn btnPrimary" href="{{ route('aduan.cek.form') }}">
          Cek Status Aduan <span aria-hidden="true">→</span>
        </a>
        <a class="btn btnGhost" href="{{ route('aduan.create') }}">
          Kirim Aduan Lagi
        </a>
      </div>

      <p class="muted">
        Tips: screenshot halaman ini atau catat kode tiket agar tidak hilang.
      </p>
    </div>
  </div>

  <script>
    (function(){
      const codeEl = document.getElementById('ticketCode');
      const btn = document.getElementById('copyBtn');
      const status = document.getElementById('copyStatus');

      async function copyText(){
        const text = (codeEl && codeEl.textContent) ? codeEl.textContent.trim() : '';
        if(!text){
          status.textContent = 'Kode tiket tidak ditemukan.';
          return;
        }

        try{
          if(navigator.clipboard && window.isSecureContext){
            await navigator.clipboard.writeText(text);
          }else{
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
          }
          status.textContent = 'Kode tiket berhasil disalin ✅';
        }catch(e){
          status.textContent = 'Gagal menyalin. Silakan salin manual.';
        }
      }

      btn.addEventListener('click', copyText);
    })();
  </script>
</body>
</html>
