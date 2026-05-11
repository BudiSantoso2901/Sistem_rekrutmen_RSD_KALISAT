<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">
    <title>@yield('title', 'SIREKRUT') — RSD Kalisat</title>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.min.css">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --teal: #0d7a6e;
            --teal-dk: #085e54;
            --teal-lt: #e6f4f2;
            --teal-mid: #b2dcd7;
            --gold: #c9922a;
            --gold-lt: #fdf3e3;
            --ink: #162130;
            --ink2: #2e3d4f;
            --muted: #6b7e93;
            --line: #dce4ed;
            --bg: #f0f4f8;
            --white: #ffffff;
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --red: #c0392b;
            --green: #1a7f5a;
            --amber: #b45309;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
            display: flex;
        }

        /* ════════════════════════════════
           SIDEBAR
        ════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 200;
            transition: transform .3s cubic-bezier(.22, 1, .36, 1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 20px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, .15);
            object-fit: contain;
            background: rgba(255, 255, 255, .06);
            padding: 3px;
        }

        .sidebar-brand-text {
            line-height: 1.25;
        }

        .sidebar-brand-name {
            font-size: .88rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.2px;
        }

        .sidebar-brand-sub {
            font-size: .65rem;
            color: var(--teal-mid);
            font-weight: 500;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .sidebar-section {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .3);
            padding: 20px 20px 6px;
        }

        .sidebar nav {
            padding: 4px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255, 255, 255, .65);
            font-size: .85rem;
            font-weight: 500;
            text-decoration: none;
            transition: background .2s, color .2s;
            margin-bottom: 2px;
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
            font-size: .82rem;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            box-shadow: 0 4px 14px rgba(13, 122, 110, .4);
        }

        .sidebar-link .badge-count {
            margin-left: auto;
            background: var(--gold);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            border-radius: 20px;
            padding: 2px 7px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .06);
        }

        .sidebar-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: .8rem;
            font-weight: 600;
            color: #fff;
        }

        .sidebar-user-role {
            font-size: .68rem;
            color: var(--teal-mid);
        }

        .sidebar-logout {
            margin-left: auto;
            background: none;
            border: none;
            color: rgba(255, 255, 255, .4);
            cursor: pointer;
            font-size: .8rem;
            padding: 4px;
            transition: color .2s;
        }

        .sidebar-logout:hover {
            color: #fc8181;
        }

        /* ════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════ */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.1rem;
            color: var(--ink);
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
        }

        .topbar-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.15rem;
            color: var(--ink);
            letter-spacing: -.3px;
        }

        .topbar-breadcrumb {
            font-size: .75rem;
            color: var(--muted);
            margin-left: 2px;
        }

        .topbar-breadcrumb span {
            color: var(--teal);
            font-weight: 600;
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-date {
            font-size: .75rem;
            color: var(--muted);
            background: var(--bg);
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
        }

        /* PAGE BODY */
        .page-body {
            padding: 28px;
            flex: 1;
        }

        /* ── TOAST flash ── */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .toast {
            background: var(--white);
            border-left: 4px solid var(--teal);
            border-radius: 10px;
            padding: 12px 16px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .12);
            font-size: .82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 260px;
            animation: toastIn .35s cubic-bezier(.22, 1, .36, 1) both;
        }

        .toast.error {
            border-color: var(--red);
        }

        .toast.success {
            border-color: var(--green);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes toastOut {
            to {
                opacity: 0;
                transform: translateX(40px);
            }
        }

        /* ── OVERLAY sidebar mobile ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            z-index: 190;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrap {
                margin-left: 0;
            }

            .topbar-toggle {
                display: flex;
            }

            .sidebar-overlay.open {
                display: block;
            }

            .page-body {
                padding: 16px;
            }
        }
    </style>
    @yield('extra-styles')
    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('Lambang-kabupaten-jember.png') }}" alt="sistem rekrutmen ">
            <div class="sidebar-brand-text">
                <div class="sidebar-brand-name">Sistem Rekrutmen Pegawai</div>
                <div class="sidebar-brand-sub">SIREKRUT</div>
            </div>
        </div>

        <nav>
            <div class="sidebar-section">Utama</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <div class="sidebar-section">Rekrutmen</div>
            <a href="{{ route('sdm.pelamar') }}"
                class="sidebar-link {{ request()->routeIs('sdm.pelamar*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Data Pelamar
                {{-- badge jumlah pending --}}
                @php $pending = \App\Models\Pelamar::where('status_pelamar','pending')->count() @endphp
                @if ($pending > 0)
                    <span class="badge-count">{{ $pending }}</span>
                @endif
            </a>
            <a href="{{ route('sdm.posisi.index') }}"
                class="sidebar-link {{ request()->routeIs('sdm.posisi.index') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i> Posisi Lowongan
            </a>
            <a href="{{ route('sdm.kuis.index') }}"
            class="sidebar-link {{ request()->routeIs('sdm.kuis.index') ? 'active' : '' }} ">
                <i class="fa-solid fa-question-circle"></i> Kuis Rekrutmen
            </a>
            <a href="{{ route('hasil-kuis.index') }}"
                class="sidebar-link  {{ request()->routeIs('hasil-kuis.index') ? 'active' : '' }} ">
                <i class="fa-solid fa-clipboard-question"></i> Hasil Kuis
            </a>

            <div class="sidebar-section">Profile</div>
            <a href="" class="sidebar-link ">
                <i class="fa-solid fa-chart-bar"></i> Profile
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
                </div>
                <div>
                    <div class="sidebar-user-name">{{ Auth::user()->name ?? 'SDM Officer' }}</div>
                    <div class="sidebar-user-role">{{ Auth::user()->role ?? 'SDM' }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin-left:auto">
                    @csrf
                    <button type="submit" class="sidebar-logout" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- MAIN WRAP --}}
    <div class="main-wrap">
        <header class="topbar">
            <button class="topbar-toggle" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-breadcrumb">@yield('breadcrumb', 'SIREKRUT / <span>Dashboard</span>')</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-date" id="liveClock"></div>
            </div>
        </header>

        <main class="page-body">

            {{-- Flash Messages --}}
            <div class="toast-container" id="toastContainer"></div>
            @if (session('success'))
                <script>
                    window._flashSuccess = @json(session('success'));
                </script>
            @endif
            @if (session('error'))
                <script>
                    window._flashError = @json(session('error'));
                </script>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.all.min.js"></script>

    <script>
        // Live clock
        function updateClock() {
            const now = new Date();
            const opts = {
                weekday: 'short',
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('liveClock').textContent = now.toLocaleDateString('id-ID', opts);
        }
        updateClock();
        setInterval(updateClock, 30000);

        // Sidebar mobile toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });

        // Toast helper
        function showToast(msg, type = 'success') {
            const box = document.createElement('div');
            box.className = `toast ${type}`;
            const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
            const color = type === 'success' ? '#1a7f5a' : '#c0392b';
            box.innerHTML = `<i class="fa-solid ${icon}" style="color:${color}"></i> ${msg}`;
            document.getElementById('toastContainer').appendChild(box);
            setTimeout(() => {
                box.style.animation = 'toastOut .3s forwards';
                setTimeout(() => box.remove(), 300);
            }, 3500);
        }
        // Show flash if any
        if (window._flashSuccess) showToast(window._flashSuccess, 'success');
        if (window._flashError) showToast(window._flashError, 'error');

        // Axios / fetch CSRF setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    </script>

    @stack('scripts')
</body>

</html>
