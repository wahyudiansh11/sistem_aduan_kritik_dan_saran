<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="/image/logo.jpeg">
    <title>SIADRU | Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --gov-primary: #064e3b;
            --gov-secondary: #059669;
            --gov-accent: #fbbf24;
            --gov-surface: #ffffff;
            --gov-bg: #f1f5f9;
            --gov-text-main: #0f172a;
            --gov-text-muted: #64748b;
            --sidebar-width: 270px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--gov-bg);
            color: var(--gov-text-main);
            overflow-x: hidden;
        }

        /* Sidebar */
        .gov-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--gov-primary);
            color: white;
            z-index: 1050;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .gov-brand {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .gov-brand img {
            height: 45px;
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.2));
        }

        .brand-name {
            font-size: 0.85rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: 0.5px;
            color: #fff;
        }

        .nav-group-label {
            padding: 20px 25px 10px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
        }

        .gov-nav-link {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .gov-nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .gov-nav-link.active {
            background: rgba(255,255,255,0.1);
            color: var(--gov-accent);
            border-left: 4px solid var(--gov-accent);
            font-weight: 700;
        }

        .gov-nav-link i { font-size: 1.1rem; }

        /* Main */
        .gov-main {
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .gov-header {
            height: 70px;
            background: var(--gov-surface);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-search {
            background: var(--gov-bg);
            border-radius: 10px;
            padding: 5px 15px;
            width: 300px;
            display: flex;
            align-items: center;
        }

        .header-search input {
            background: transparent;
            border: none;
            padding-left: 10px;
            font-size: 0.85rem;
            width: 100%;
        }

        .header-search input:focus { outline: none; }

        .gov-container {
            padding: 30px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            color: var(--gov-text-main);
        }

        .gov-card {
            background: var(--gov-surface);
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            padding: 25px;
        }

        /* Mini Sidebar */
        body.mini-sidebar .gov-sidebar { width: 80px; }
        body.mini-sidebar .gov-main { margin-left: 80px; }
        body.mini-sidebar .nav-text,
        body.mini-sidebar .brand-name,
        body.mini-sidebar .nav-group-label { display: none; }
        body.mini-sidebar .gov-nav-link { justify-content: center; border-left: 0; }

        /* Mobile */
        @media (max-width: 992px) {
            .gov-sidebar { transform: translateX(-100%); }
            .gov-main { margin-left: 0; }
            body.show-mobile-sidebar .gov-sidebar { transform: translateX(0); width: 280px; }
        }

        /* Overlay mobile */
        .sidebar-overlay{
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
            z-index: 1040;
        }

        @media (max-width: 992px){
            body.show-mobile-sidebar .sidebar-overlay{
                opacity: 1;
                pointer-events: auto;
            }
            body.show-mobile-sidebar{
                overflow: hidden;
            }
        }
    </style>
</head>

<body>

    <aside class="gov-sidebar" id="sidebar">
        <div class="gov-brand d-flex align-items-center gap-3">
            <img src="/image/logo.jpeg" alt="Logo">
            <div class="brand-name">
                <div>SIADRU</div>
                <div style="font-size: 0.6rem; color: var(--gov-accent); font-weight: 500;">DINKES SUMENEP</div>
            </div>
        </div>

        <div class="flex-grow-1 overflow-auto">
            <div class="nav-group-label">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="gov-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <div class="nav-group-label">Pelayanan Masyarakat</div>
            <a href="{{ route('admin.aduan.index') }}" class="gov-nav-link {{ request()->routeIs('admin.aduan.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                <span class="nav-text">Monitoring Aduan</span>
            </a>
        </div>

        <div class="p-3">
            <div class="gov-card p-3 mb-3 bg-white bg-opacity-10 border-0 shadow-none text-white-50" style="border-radius: 12px;">
                <div style="font-size: 0.7rem; font-weight: 700;">STATUS SERVER</div>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span style="font-size: 0.75rem; color: white;">Operasional Normal</span>
                </div>
            </div>

            <!-- Logout Desktop/Sidebar -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light border-white border-opacity-25 w-100 d-flex align-items-center justify-content-center gap-2" style="border-radius: 10px;">
                    <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="gov-main">
        <header class="gov-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-block d-none" id="miniToggle" style="border-radius: 10px;">
                    <i class="bi bi-text-indent-left fs-5"></i>
                </button>
                <button class="btn btn-light d-lg-none" id="mobileToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <form action="{{ route('dashboard') }}" method="GET" class="w-full max-w-md">
</form>

            </div>

            <div class="d-flex align-items-center gap-3">

                <!-- ✅ LOGOUT MOBILE: muncul hanya di mobile -->
                <form method="POST" action="{{ route('logout') }}" class="d-lg-none">
                    @csrf
                    <button type="submit"
                        class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"
                        style="border-radius:8px;">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>

                <div class="vr mx-2 d-none d-sm-block"></div>

                <div class="d-flex align-items-center gap-3 cursor-pointer">
                    <div class="text-end d-none d-sm-block">
                        <div class="fw-bold" style="font-size: 0.85rem; line-height: 1;">{{ Auth::user()->name }}</div>
                        <small class="text-muted" style="font-size: 0.7rem;">Administrator Dinkes</small>
                    </div>
                    <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; font-weight: 800;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="gov-container">
            <div class="page-header d-flex justify-content-between align-items-center">
                <div>
                    @php
                        $routeName = Route::currentRouteName();
                        $titles = [
                            'dashboard' => 'Dashboard Utama',
                            'admin.aduan.index' => 'Manajemen Pengaduan',
                        ];
                    @endphp
                    <h1>{{ $titles[$routeName] ?? 'Panel Sistem' }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0" style="font-size: 0.75rem;">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Sistem</a></li>
                            <li class="breadcrumb-item active fw-bold text-success">{{ $titles[$routeName] ?? 'Aplikasi' }}</li>
                        </ol>
                    </nav>
                </div>
                <div id="realtime-clock" class="fw-bold text-muted d-none d-md-block" style="font-size: 0.9rem; letter-spacing: 1px;">
                    --:--:--
                </div>
            </div>

            <div class="gov-card">
                {{ $slot }}
            </div>
        </main>

        <footer class="p-4 text-center border-top bg-white">
            <small class="text-muted">
                Copyright &copy; {{ date('Y') }} <strong>Dinas Kesehatan Kab. Sumenep</strong>.
                <span class="mx-2">|</span> Versi 2.1.0-Stabil
            </small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Realtime Clock
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour12: false });
            const el = document.getElementById('realtime-clock');
            if (el) el.innerText = time + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Mini Sidebar Toggle
        const miniToggle = document.getElementById('miniToggle');
        if (miniToggle) {
            miniToggle.addEventListener('click', () => {
                document.body.classList.toggle('mini-sidebar');
                const icon = miniToggle.querySelector('i');
                if (icon) {
                    icon.classList.toggle('bi-text-indent-left');
                    icon.classList.toggle('bi-text-indent-right');
                }
            });
        }

        // Mobile Sidebar Toggle + Overlay Close
        const mobileToggle = document.getElementById('mobileToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebar = document.getElementById('sidebar');

        function openSidebar() {
            document.body.classList.add('show-mobile-sidebar');
        }

        function closeSidebar() {
            document.body.classList.remove('show-mobile-sidebar');
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                document.body.classList.contains('show-mobile-sidebar') ? closeSidebar() : openSidebar();
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Klik menu -> tutup di mobile
        if (sidebar) {
            sidebar.querySelectorAll('a.gov-nav-link').forEach(a => {
                a.addEventListener('click', () => {
                    if (window.innerWidth <= 992) closeSidebar();
                });
            });
        }

        // ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        // Resize cleanup
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) closeSidebar();
        });
    </script>
</body>
</html>
