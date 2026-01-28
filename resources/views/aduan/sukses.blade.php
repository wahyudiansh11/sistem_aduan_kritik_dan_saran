<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Aduan Terkirim</title>

  <style>
    :root{
      --bg: #f6f7fb;
      --card: #ffffff;
      --text: #0f172a;
      --muted:#64748b;
      --border:#e2e8f0;
      --focus:#2563eb;
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
      white-space: nowrap;
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
      border:1px solid rgba(5,150,105,.25);
      font-size:14px;
      background:var(--successBg);
      color:#065f46;
      display:flex;
      gap:10px;
      align-items:flex-start;
    }
    .notice .icon{
      width: 28px;
      height: 28px;
      border-radius: 999px;
      background: rgba(5,150,105,.18);
      display:grid;
      place-items:center;
      flex: 0 0 auto;
      margin-top: 1px;
    }

    .ticketBox{
      margin-top: 14px;
      border:1px solid var(--border);
      border-radius: 14px;
      background: #fbfdff;
      padding: 14px;
    }
    .ticketLabel{
      font-size: 12px;
      color: var(--muted);
      margin:0 0 8px;
    }
    .ticketRow{
      display:flex;
      align-items:center;
      gap:10px;
      flex-wrap: wrap;
    }
    .ticketCode{
      font-weight: 800;
      font-size: 18px;
      letter-spacing: .06em;
      padding: 10px 12px;
      border-radius: 12px;
      background: #f1f5f9;
      border:1px solid var(--border);
      display:inline-block;
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
      font-weight: 800;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:10px;
    }
    .btnPrimary{
      background:#2563eb;
      color:#fff;
      box-shadow: 0 14px 30px rgba(37,99,235,.22);
    }
    .btnPrimary:hover{ filter: brightness(1.03); }
    .btnGhost{
      background:#fff;
      color:#0f172a;
      border:1px solid var(--border);
    }
    .btnGhost:hover{ background:#f8fafc; }

    .copyBtn{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 12px;
      padding: 10px 12px;
      font-weight: 800;
      cursor:pointer;
    }
    .copyBtn:hover{ background:#f8fafc; }

    .muted{
      color: var(--muted);
      font-size: 13px;
      margin-top: 10px;
    }

    .srOnly{
      position:absolute;
      width:1px;height:1px;
      padding:0;margin:-1px;
      overflow:hidden;clip:rect(0,0,0,0);
      white-space:nowrap;border:0;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="header">
      <div>
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
            // fallback untuk http / browser lama
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
