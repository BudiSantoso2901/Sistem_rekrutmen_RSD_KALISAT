<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SIREKRUT</title>
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
            --teal-dk: #095e54;
            --teal-lt: #e6f4f2;
            --gold: #c9922a;
            --gold-lt: #fdf3e3;
            --red: #c0392b;
            --ink: #1a2735;
            --muted: #5a6a7a;
            --line: #d4dce6;
            --white: #ffffff;
            --bg: #f2f6f9;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── animated background blobs ── */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
            animation: float 10s ease-in-out infinite alternate;
            pointer-events: none;
        }

        body::before {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, #0d7a6e66, transparent);
            top: -120px;
            left: -120px;
        }

        body::after {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #c9922a55, transparent);
            bottom: -100px;
            right: -100px;
            animation-delay: -4s;
        }

        @keyframes float {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(40px, 30px) scale(1.08);
            }
        }

        /* ── card ── */
        .card {
            position: relative;
            z-index: 2;
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(13, 122, 110, .12), 0 4px 16px rgba(0, 0, 0, .06);
            width: min(460px, calc(100vw - 32px));
            padding: 48px 44px 40px;
            animation: slideUp .55s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(36px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── logo + header ── */
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .brand img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            border-radius: 12px;
            border: 2px solid var(--teal-lt);
            padding: 4px;
            background: var(--white);
            box-shadow: 0 2px 8px rgba(13, 122, 110, .15);
            transition: transform .3s;
        }

        .brand img:hover {
            transform: rotate(-4deg) scale(1.05);
        }

        .brand-text {
            line-height: 1.2;
        }

        .brand-name {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.3px;
        }

        .brand-sub {
            font-size: .72rem;
            font-weight: 500;
            color: var(--teal);
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* ── divider ── */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, var(--teal) 0%, var(--line) 100%);
            margin-bottom: 28px;
            border-radius: 2px;
        }

        /* ── heading ── */
        .heading {
            margin-bottom: 24px;
        }

        .heading h1 {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.4px;
        }

        .heading p {
            font-size: .82rem;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ── alerts ── */
        .alert {
            border-radius: 10px;
            padding: 11px 14px;
            font-size: .82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            animation: fadeIn .3s ease both;
        }

        .alert-error {
            background: #fdf0ef;
            color: var(--red);
            border: 1px solid #f5c6c2;
        }

        .alert-success {
            background: var(--teal-lt);
            color: var(--teal-dk);
            border: 1px solid #b2d9d5;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* ── form ── */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: .78rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: .3px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .88rem;
            pointer-events: none;
            transition: color .25s;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px 12px 40px;
            font-family: inherit;
            font-size: .88rem;
            font-weight: 500;
            color: var(--ink);
            background: var(--bg);
            border: 1.5px solid var(--line);
            border-radius: 10px;
            outline: none;
            transition: border-color .25s, box-shadow .25s, background .25s;
        }

        input:focus {
            border-color: var(--teal);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(13, 122, 110, .12);
        }

        input:focus+.input-icon,
        .input-wrap:focus-within .input-icon {
            color: var(--teal);
        }

        /* icon inside right (password toggle) */
        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: .88rem;
            padding: 4px;
            transition: color .2s;
        }

        .toggle-pw:hover {
            color: var(--teal);
        }

        /* error text */
        .field-error {
            font-size: .75rem;
            color: var(--red);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── submit btn ── */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dk) 100%);
            color: var(--white);
            font-family: inherit;
            font-size: .92rem;
            font-weight: 700;
            letter-spacing: .3px;
            border: none;
            border-radius: 11px;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s, filter .2s;
            box-shadow: 0 4px 18px rgba(13, 122, 110, .35);
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .12), transparent);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(13, 122, 110, .42);
        }

        .btn-login:active {
            transform: translateY(0);
            filter: brightness(.94);
        }

        .btn-login .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2.5px solid rgba(255, 255, 255, .4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin-right: 8px;
            vertical-align: middle;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-login.loading .spinner {
            display: inline-block;
        }

        .btn-login.loading .btn-text {
            opacity: .7;
        }

        /* ── footer note ── */
        .footer-note {
            text-align: center;
            font-size: .73rem;
            color: var(--muted);
            margin-top: 24px;
            line-height: 1.6;
        }

        .footer-note strong {
            color: var(--teal);
        }

        /* ── responsive ── */
        @media (max-width: 480px) {
            .card {
                padding: 36px 24px 30px;
            }

            .heading h1 {
                font-size: 1.3rem;
            }
        }

        /* ── ripple ── */
        .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            background: rgba(255, 255, 255, .3);
            animation: ripple .55s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <div class="card">

        {{-- brand --}}
        <div class="brand">
            <img src="{{ asset('Lambang-kabupaten-jember.png') }}" alt="Logo RSD Kalisat">
            <div class="brand-text">
                <div class="brand-name"></div>
                <div class="brand-sub">Sistem Rekrutmen Pegawai</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="heading">
            <h1>Selamat Datang</h1>
            <p>Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        {{-- session / validation alerts --}}
        @if (session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.proses') }}" id="loginForm" novalidate>
            @csrf

            {{-- username --}}
            <div class="form-group">
                <label for="username"><i class="fa-solid fa-user"
                        style="margin-right:5px;color:var(--teal)"></i>Username</label>
                <div class="input-wrap">
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        placeholder="Masukkan username" autocomplete="username" autofocus>
                    <i class="fa-solid fa-user input-icon"></i>
                </div>
                @error('username')
                    <div class="field-error"><i class="fa-solid fa-triangle-exclamation"></i>{{ $message }}</div>
                @enderror
            </div>

            {{-- password --}}
            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"
                        style="margin-right:5px;color:var(--teal)"></i>Password</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" placeholder="Min. 6 karakter"
                        autocomplete="current-password">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <button type="button" class="toggle-pw" id="togglePw" title="Tampilkan password">
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="field-error"><i class="fa-solid fa-triangle-exclamation"></i>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <span class="spinner" id="spinner"></span>
                <span class="btn-text">Masuk</span>
            </button>
        </form>

        <div class="footer-note">
            &copy; {{ date('Y') }} <strong></strong> &mdash; Kabupaten Jember<br>
            Hak akses RSD Jember
        </div>
    </div>

    <script>
        // password toggle
        const togglePw = document.getElementById('togglePw');
        const pwInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        togglePw.addEventListener('click', () => {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            toggleIcon.className = isHidden ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
        });

        // loading state + ripple on submit
        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        form.addEventListener('submit', (e) => {
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });

        // ripple effect
        loginBtn.addEventListener('click', function(e) {
            const rect = loginBtn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            const rip = document.createElement('span');
            rip.classList.add('ripple');
            rip.style.cssText = `width:${size}px;height:${size}px;left:${x}px;top:${y}px`;
            loginBtn.appendChild(rip);
            setTimeout(() => rip.remove(), 600);
        });

        // auto-focus UX: clear error highlight on type
        document.querySelectorAll('input').forEach(inp => {
            inp.addEventListener('input', () => {
                inp.style.borderColor = '';
            });
        });
    </script>
</body>

</html>
