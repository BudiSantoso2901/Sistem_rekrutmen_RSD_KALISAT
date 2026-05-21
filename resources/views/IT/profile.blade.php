@extends('Layouts.app')

@section('title', 'Profil Admin')
@section('page-title', 'Profil Admin')
@section('breadcrumb', 'SIREKRUT / Profil Admin')

@section('extra-styles')
    <style>
        /* ═══════════════════════════════════════════
           PROFILE PAGE — SIREKRUT
           Font: Sora (display) + DM Sans (body)
        ═══════════════════════════════════════════ */
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap');

        :root {
            --g900: #052e1c;
            --g800: #0d4f35;
            --g700: #116040;
            --g600: #1a7a52;
            --g500: #22a06b;
            --g400: #2ecc7a;
            --g300: #5de8a0;
            --g100: #e0f7ec;
            --g50: #f0faf5;

            --ink: #0a3324;
            --ink-mid: #2e6b4f;
            --ink-soft: #5a9478;
            --ink-pale: #a8ccbc;

            --surface: #ffffff;
            --surface2: #f7fbf9;
            --border: #d0ede0;

            --red: #e53e3e;
            --red-bg: #fff5f5;
            --amber: #d97706;
            --amber-bg: #fffbeb;

            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --radius-xs: 5px;

            --shadow-card: 0 4px 24px rgba(13, 79, 53, .10), 0 1px 4px rgba(13, 79, 53, .06);
            --shadow-btn: 0 4px 16px rgba(34, 160, 107, .30);

            --transition: all .22s cubic-bezier(.4, 0, .2, 1);
        }

        * {
            box-sizing: border-box;
        }

        .profile-page {
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            padding: 8px 0 40px;
            max-width: 960px;
        }

        /* ── Page intro bar ── */
        .profile-intro {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 28px;
            background: linear-gradient(135deg, var(--g800) 0%, var(--g600) 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .profile-intro::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg, transparent, transparent 12px,
                    rgba(255, 255, 255, .025) 12px, rgba(255, 255, 255, .025) 24px);
        }

        .profile-intro::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
        }

        .pi-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: 2.5px solid rgba(255, 255, 255, .35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .pi-text {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .pi-name {
            font-family: 'Sora', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .pi-meta {
            font-size: .82rem;
            color: rgba(255, 255, 255, .65);
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pi-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pi-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 100px;
            padding: 3px 12px;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .9);
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }

        .pi-role-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--g300);
            animation: blink 2s ease infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .4;
            }
        }

        /* ── Two-column grid ── */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 700px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Card ── */
        .pcard {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: var(--transition);
        }

        .pcard:hover {
            box-shadow: 0 8px 32px rgba(13, 79, 53, .13), 0 2px 8px rgba(13, 79, 53, .07);
            transform: translateY(-1px);
        }

        .pcard-header {
            background: var(--g50);
            border-bottom: 1.5px solid var(--border);
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pcard-icon {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            background: var(--g100);
            border: 1px solid rgba(34, 160, 107, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .pcard-title {
            font-family: 'Sora', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
        }

        .pcard-body {
            padding: 22px;
        }

        /* ── Info rows ── */
        .info-row {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 10px 0;
            border-bottom: 1px solid #edf6f1;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-row:first-child {
            padding-top: 0;
        }

        .info-label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        .info-value {
            font-size: .9rem;
            font-weight: 500;
            color: var(--ink);
        }

        .info-value.mono {
            font-family: 'Courier New', monospace;
            font-size: .85rem;
            background: var(--g50);
            padding: 3px 8px;
            border-radius: var(--radius-xs);
            border: 1px solid var(--border);
            display: inline-block;
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--g100);
            color: var(--g700);
            border: 1px solid rgba(34, 160, 107, .25);
            padding: 2px 10px;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .badge-rs {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #eef7ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
            padding: 2px 10px;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 600;
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group:last-of-type {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--ink-mid);
            margin-bottom: 6px;
        }

        .form-label .required {
            color: var(--red);
            margin-left: 2px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            font-size: .95rem;
            pointer-events: none;
            line-height: 1;
        }

        .form-input {
            width: 100%;
            padding: 10px 40px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: .9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--surface2);
            transition: var(--transition);
            outline: none;
        }

        .form-input:focus {
            border-color: var(--g500);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(34, 160, 107, .12);
        }

        .form-input.is-invalid {
            border-color: var(--red);
            background: var(--red-bg);
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(229, 62, 62, .12);
        }

        /* Eye toggle button */
        .btn-eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            font-size: .9rem;
            padding: 4px;
            border-radius: var(--radius-xs);
            transition: color .15s;
            line-height: 1;
        }

        .btn-eye:hover {
            color: var(--g600);
        }

        .invalid-feedback {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: .75rem;
            color: var(--red);
            margin-top: 5px;
            font-weight: 500;
        }

        /* ── Password strength meter ── */
        .strength-meter {
            margin-top: 8px;
        }

        .strength-bars {
            display: flex;
            gap: 4px;
            height: 4px;
            margin-bottom: 4px;
        }

        .strength-bar {
            flex: 1;
            border-radius: 100px;
            background: var(--border);
            transition: background .3s ease;
        }

        .strength-bar.active-weak {
            background: var(--red);
        }

        .strength-bar.active-fair {
            background: var(--amber);
        }

        .strength-bar.active-good {
            background: var(--g400);
        }

        .strength-bar.active-strong {
            background: var(--g600);
        }

        .strength-label {
            font-size: .7rem;
            font-weight: 600;
            color: var(--ink-soft);
            transition: color .3s;
        }

        /* ── Password requirements checklist ── */
        .pwd-checks {
            margin-top: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 12px;
        }

        .pwd-check {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            color: var(--ink-pale);
            transition: color .2s;
        }

        .pwd-check.pass {
            color: var(--g600);
        }

        .pwd-check-icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1.5px solid currentColor;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .55rem;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .pwd-check.pass .pwd-check-icon {
            background: var(--g400);
            border-color: var(--g400);
            color: #fff;
        }

        /* ── Divider ── */
        .form-divider {
            height: 1px;
            background: var(--border);
            margin: 18px 0;
        }

        /* ── Submit button ── */
        .btn-submit {
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--g700) 0%, var(--g500) 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'Sora', sans-serif;
            font-size: .9rem;
            font-weight: 700;
            letter-spacing: .02em;
            cursor: pointer;
            box-shadow: var(--shadow-btn);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0);
            transition: background .2s;
        }

        .btn-submit:hover::before {
            background: rgba(255, 255, 255, .08);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(34, 160, 107, .38);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-submit.loading .spinner {
            display: block;
        }

        .btn-submit.loading .btn-text {
            display: none;
        }

        /* ── Alert / Toast ── */
        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: .88rem;
            font-weight: 500;
            animation: slideIn .35s cubic-bezier(.22, 1, .36, 1);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success-box {
            background: #f0fdf6;
            border: 1.5px solid rgba(34, 160, 107, .3);
            border-left: 4px solid var(--g500);
            color: var(--g800);
        }

        .alert-error-box {
            background: var(--red-bg);
            border: 1.5px solid rgba(229, 62, 62, .25);
            border-left: 4px solid var(--red);
            color: #c53030;
        }

        .alert-icon-wrap {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 800;
            flex-shrink: 0;
            color: #fff;
        }

        .alert-success-box .alert-icon-wrap {
            background: var(--g500);
        }

        .alert-error-box .alert-icon-wrap {
            background: var(--red);
        }

        /* ── Security tips ── */
        .security-tips {
            background: var(--amber-bg);
            border: 1.5px solid rgba(217, 119, 6, .2);
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            margin-top: 16px;
        }

        .security-tips-title {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .security-tips ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .security-tips li {
            font-size: .75rem;
            color: #92400e;
            display: flex;
            align-items: flex-start;
            gap: 5px;
            line-height: 1.4;
        }

        .security-tips li::before {
            content: '→';
            color: var(--amber);
            flex-shrink: 0;
            font-weight: 700;
        }

        /* ── Last changed info ── */
        .last-changed {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .75rem;
            color: var(--ink-soft);
            padding: 10px 14px;
            background: var(--g50);
            border: 1px solid var(--border);
            border-radius: var(--radius-xs);
            margin-bottom: 18px;
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .profile-intro {
                flex-wrap: wrap;
                gap: 12px;
                padding: 16px 18px;
            }

            .pi-role-badge {
                width: 100%;
                justify-content: center;
            }

            .pcard-body {
                padding: 18px;
            }

            .pwd-checks {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="profile-page">

        {{-- ── INTRO BAR ── --}}
        <div class="profile-intro">
            <div class="pi-avatar">
                {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
            <div class="pi-text">
                <div class="pi-name">{{ $user->name }}</div>
                <div class="pi-meta">
                    <span>✉ {{ $user->email }}</span>
                    @if ($user->rumahSakit)
                        <span>🏥 {{ $user->rumahSakit->nama_rs }}</span>
                    @endif
                </div>
            </div>
            <div class="pi-role-badge">
                <span class="pi-role-dot"></span>
                {{ ucfirst($user->role) }}
            </div>
        </div>

        {{-- ── ALERT SUCCESS ── --}}
        @if (session('success'))
            <div class="alert-box alert-success-box">
                <div class="alert-icon-wrap">✓</div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="profile-grid">

            {{-- ══════════════════════════════
             KOLOM KIRI: Informasi Akun
        ══════════════════════════════ --}}
            <div>
                {{-- Card: Informasi Akun --}}
                <div class="pcard" style="margin-bottom:24px;">
                    <div class="pcard-header">
                        <div class="pcard-icon">👤</div>
                        <span class="pcard-title">Informasi Akun</span>
                    </div>
                    <div class="pcard-body">
                        <div class="info-row">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value">{{ $user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Username</span>
                            <span class="info-value mono">{{ $user->username }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Role</span>
                            <span class="info-value">
                                <span class="badge-role">● {{ ucfirst($user->role) }}</span>
                            </span>
                        </div>
                        @if ($user->rumahSakit)
                            <div class="info-row">
                                <span class="info-label">Rumah Sakit</span>
                                <span class="info-value">
                                    <span class="badge-rs">🏥 {{ $user->rumahSakit->nama_rs }}</span>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Kode RS</span>
                                <span class="info-value mono">{{ $user->rumahSakit->kode_rs }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">Akun Dibuat</span>
                            <span
                                class="info-value">{{ $user->created_at ? $user->created_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Terakhir Diperbarui</span>
                            <span
                                class="info-value">{{ $user->updated_at ? $user->updated_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Card: Tips Keamanan --}}
                <div class="pcard">
                    <div class="pcard-header">
                        <div class="pcard-icon">🛡️</div>
                        <span class="pcard-title">Tips Keamanan Akun</span>
                    </div>
                    <div class="pcard-body">
                        <div class="security-tips">
                            <div class="security-tips-title">⚠ Rekomendasi</div>
                            <ul>
                                <li>Gunakan password minimal 8 karakter dengan kombinasi huruf besar, kecil, dan angka.</li>
                                <li>Jangan bagikan password kepada siapapun termasuk tim IT.</li>
                                <li>Ganti password secara berkala setiap 3 bulan.</li>
                                <li>Jangan gunakan password yang sama dengan akun lain.</li>
                                <li>Pastikan logout setelah selesai menggunakan sistem.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════
             KOLOM KANAN: Ganti Password
        ══════════════════════════════ --}}
            <div>
                <div class="pcard">
                    <div class="pcard-header">
                        <div class="pcard-icon">🔐</div>
                        <span class="pcard-title">Ganti Password</span>
                    </div>
                    <div class="pcard-body">

                        <div class="last-changed">
                            🕐 &nbsp;Password terakhir diperbarui:
                            <strong>{{ $user->updated_at ? $user->updated_at->diffForHumans() : 'Belum pernah diubah' }}</strong>
                        </div>

                        {{-- Error global --}}
                        @if ($errors->any())
                            <div class="alert-box alert-error-box" style="margin-bottom:16px;">
                                <div class="alert-icon-wrap">✕</div>
                                <div>
                                    @foreach ($errors->all() as $err)
                                        <div>{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" id="formGantiPassword">
                            @csrf
                            @method('POST')

                            {{-- Password Saat Ini --}}
                            <div class="form-group">
                                <label class="form-label" for="current_password">
                                    Password Saat Ini <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <span class="input-icon">🔑</span>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-input {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                        placeholder="Masukkan password saat ini" autocomplete="current-password" required>
                                    <button type="button" class="btn-eye"
                                        onclick="togglePassword('current_password', this)"
                                        aria-label="Tampilkan password">👁</button>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback">⚠ {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-divider"></div>

                            {{-- Password Baru --}}
                            <div class="form-group">
                                <label class="form-label" for="password">
                                    Password Baru <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <span class="input-icon">🔒</span>
                                    <input type="password" id="password" name="password"
                                        class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        placeholder="Masukkan password baru" autocomplete="new-password"
                                        oninput="checkStrength(this.value)" required>
                                    <button type="button" class="btn-eye" onclick="togglePassword('password', this)"
                                        aria-label="Tampilkan password">👁</button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">⚠ {{ $message }}</div>
                                @enderror

                                {{-- Strength meter --}}
                                <div class="strength-meter" id="strengthMeter" style="display:none;">
                                    <div class="strength-bars">
                                        <div class="strength-bar" id="sb1"></div>
                                        <div class="strength-bar" id="sb2"></div>
                                        <div class="strength-bar" id="sb3"></div>
                                        <div class="strength-bar" id="sb4"></div>
                                    </div>
                                    <div class="strength-label" id="strengthLabel">–</div>
                                </div>

                                {{-- Checklist --}}
                                <div class="pwd-checks">
                                    <div class="pwd-check" id="chk-len">
                                        <div class="pwd-check-icon">✓</div>
                                        <span>Min. 8 karakter</span>
                                    </div>
                                    <div class="pwd-check" id="chk-upper">
                                        <div class="pwd-check-icon">✓</div>
                                        <span>Huruf kapital</span>
                                    </div>
                                    <div class="pwd-check" id="chk-lower">
                                        <div class="pwd-check-icon">✓</div>
                                        <span>Huruf kecil</span>
                                    </div>
                                    <div class="pwd-check" id="chk-num">
                                        <div class="pwd-check-icon">✓</div>
                                        <span>Angka</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">
                                    Konfirmasi Password Baru <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <span class="input-icon">🔒</span>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-input" placeholder="Ulangi password baru" autocomplete="new-password"
                                        oninput="checkMatch()" required>
                                    <button type="button" class="btn-eye"
                                        onclick="togglePassword('password_confirmation', this)"
                                        aria-label="Tampilkan password">👁</button>
                                </div>
                                <div class="invalid-feedback" id="matchFeedback" style="display:none;">
                                    ⚠ Password konfirmasi tidak cocok
                                </div>
                                <div class="invalid-feedback" id="matchOk" style="display:none;color:var(--g600);">
                                    ✓ Password cocok
                                </div>
                            </div>

                            <div class="form-divider"></div>

                            <button type="submit" class="btn-submit" id="btnSubmit">
                                <div class="spinner"></div>
                                <span class="btn-text">🔐 &nbsp; Perbarui Password</span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>{{-- /profile-grid --}}
    </div>{{-- /profile-page --}}
@endsection

@push('scripts')
    <script>
        /* ── Toggle show/hide password ── */
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.textContent = isHidden ? '🙈' : '👁';
        }

        /* ── Strength meter ── */
        function checkStrength(val) {
            const meter = document.getElementById('strengthMeter');
            const label = document.getElementById('strengthLabel');
            const bars = [1, 2, 3, 4].map(i => document.getElementById('sb' + i));

            if (!val) {
                meter.style.display = 'none';
                return;
            }
            meter.style.display = 'block';

            const checks = [
                val.length >= 8,
                /[A-Z]/.test(val),
                /[a-z]/.test(val),
                /[0-9]/.test(val),
            ];
            const score = checks.filter(Boolean).length;

            const levels = [{
                    cls: 'active-weak',
                    txt: '🔴 Sangat Lemah',
                    count: 1
                },
                {
                    cls: 'active-fair',
                    txt: '🟡 Cukup',
                    count: 2
                },
                {
                    cls: 'active-good',
                    txt: '🟢 Baik',
                    count: 3
                },
                {
                    cls: 'active-strong',
                    txt: '✅ Kuat',
                    count: 4
                },
            ];
            const level = levels[score - 1] || levels[0];

            bars.forEach((bar, i) => {
                bar.className = 'strength-bar';
                if (i < score) bar.classList.add(level.cls);
            });
            label.textContent = level.txt;
            label.style.color = score <= 1 ? 'var(--red)' : score === 2 ? 'var(--amber)' : 'var(--g600)';

            /* also update checklists */
            document.getElementById('chk-len').classList.toggle('pass', val.length >= 8);
            document.getElementById('chk-upper').classList.toggle('pass', /[A-Z]/.test(val));
            document.getElementById('chk-lower').classList.toggle('pass', /[a-z]/.test(val));
            document.getElementById('chk-num').classList.toggle('pass', /[0-9]/.test(val));

            checkMatch();
        }

        /* ── Match check ── */
        function checkMatch() {
            const pwd = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;
            const ok = document.getElementById('matchOk');
            const err = document.getElementById('matchFeedback');
            const conf_input = document.getElementById('password_confirmation');

            if (!conf) {
                ok.style.display = 'none';
                err.style.display = 'none';
                return;
            }

            if (pwd === conf) {
                ok.style.display = 'flex';
                err.style.display = 'none';
                conf_input.classList.remove('is-invalid');
            } else {
                ok.style.display = 'none';
                err.style.display = 'flex';
                conf_input.classList.add('is-invalid');
            }
        }

        /* ── Submit with spinner ── */
        document.getElementById('formGantiPassword').addEventListener('submit', function(e) {
            const btn = document.getElementById('btnSubmit');
            const pwd = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;

            if (pwd !== conf) {
                e.preventDefault();
                document.getElementById('matchFeedback').style.display = 'flex';
                document.getElementById('password_confirmation').classList.add('is-invalid');
                document.getElementById('password_confirmation').focus();
                return;
            }
            btn.classList.add('loading');
            btn.disabled = true;
        });

        /* ── Auto-dismiss success alert ── */
        const successAlert = document.querySelector('.alert-success-box');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'opacity .5s, transform .5s';
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-8px)';
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }
    </script>
@endpush
