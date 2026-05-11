<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran – SIREKRUT</title>
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,400;9..144,600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #0d6e4e;
            --primary-light: #14a372;
            --primary-pale: #e4f7f0;
            --accent: #f4a827;
            --accent-light: #fde9b8;
            --danger: #e85d5d;
            --text-dark: #1a2e25;
            --text-mid: #3d5246;
            --text-muted: #7a9488;
            --bg: #f5faf7;
            --white: #ffffff;
            --border: #c8e6d8;
            --shadow: 0 4px 24px rgba(13, 110, 78, 0.10);
            --shadow-lg: 0 12px 48px rgba(13, 110, 78, 0.16);
            --radius: 16px;
            --radius-sm: 8px;
            --radius-xl: 32px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            padding: 32px 16px 48px;
            position: relative;
            overflow-x: hidden;
            color: var(--text-dark);
        }

        /* ─── BACKGROUND ANIMATION ─── */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.22;
            animation: float-orb linear infinite;
        }

        .orb-1 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, #14a372 0%, #0d6e4e 100%);
            top: -180px;
            left: -140px;
            animation-duration: 22s;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, #f4a827 0%, #e8850d 100%);
            top: 30%;
            right: -120px;
            animation-duration: 28s;
            animation-delay: -8s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #3ecf97 0%, #0d6e4e 100%);
            bottom: -80px;
            left: 20%;
            animation-duration: 18s;
            animation-delay: -4s;
        }

        @keyframes float-orb {
            0% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(30px, -40px) scale(1.05);
            }

            50% {
                transform: translate(-20px, 30px) scale(0.95);
            }

            75% {
                transform: translate(40px, 20px) scale(1.03);
            }

            100% {
                transform: translate(0, 0) scale(1);
            }
        }

        /* Grid lines overlay */
        .grid-overlay {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image:
                linear-gradient(rgba(13, 110, 78, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(13, 110, 78, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        /* Floating medical cross icons */
        .float-icon {
            position: fixed;
            font-size: 18px;
            opacity: 0.07;
            color: var(--primary);
            animation: drift linear infinite;
            pointer-events: none;
            z-index: 0;
            user-select: none;
        }

        @keyframes drift {
            0% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.07;
            }

            90% {
                opacity: 0.07;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ─── LAYOUT ─── */
        .wrapper {
            position: relative;
            z-index: 1;
            max-width: 860px;
            margin: 0 auto;
        }

        /* ─── ALERT ─── */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--white);
            border: 1.5px solid var(--primary-light);
            color: var(--primary);
            padding: 14px 20px;
            border-radius: var(--radius);
            margin-bottom: 28px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: var(--shadow);
            animation: slide-down 0.5s cubic-bezier(.22, .68, 0, 1.2) both;
        }

        .alert-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-pale);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── CARD ─── */
        .card-main {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: rise-up 0.7s cubic-bezier(.22, .68, 0, 1.2) 0.1s both;
        }

        @keyframes rise-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── HERO HEADER ─── */
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, #0a5a3f 60%, #1c7a58 100%);
            padding: 40px 32px 36px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .card-header::before {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -120px;
            right: -80px;
        }

        .card-header::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -80px;
            left: -40px;
        }

        /* ECG decorative line */
        .ecg-line {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 36px;
            opacity: 0.18;
        }

        .hospital-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 100px;
            padding: 6px 16px;
            margin-bottom: 20px;
            color: #c7f0df;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse-dot 1.8s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.6);
                opacity: 0.6;
            }
        }

        .trophy-ring {
            width: 72px;
            height: 72px;
            background: rgba(255, 255, 255, 0.12);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 32px;
            animation: pop-in 0.6s cubic-bezier(.22, .68, 0, 1.2) 0.4s both;
        }

        @keyframes pop-in {
            from {
                opacity: 0;
                transform: scale(0.3);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .card-header h1 {
            font-family: 'Fraunces', serif;
            color: #fff;
            font-size: clamp(22px, 4vw, 30px);
            font-weight: 600;
            margin-bottom: 8px;
            position: relative;
        }

        .card-header p {
            color: #a8d8c4;
            font-size: 14px;
            position: relative;
        }

        /* ─── CARD BODY ─── */
        .card-body {
            padding: 32px;
        }

        /* ─── SECTION ─── */
        .section {
            margin-bottom: 28px;
            animation: fade-in-up 0.5s ease both;
        }

        .section:nth-child(1) {
            animation-delay: 0.2s;
        }

        .section:nth-child(2) {
            animation-delay: 0.35s;
        }

        .section:nth-child(3) {
            animation-delay: 0.5s;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .icon-green {
            background: var(--primary-pale);
        }

        .icon-blue {
            background: #e0f0ff;
        }

        .icon-amber {
            background: var(--accent-light);
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ─── ACCOUNT BOX ─── */
        .account-box {
            background: linear-gradient(135deg, var(--primary-pale) 0%, #d8f4e9 100%);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .account-box::before {
            content: '⊕';
            position: absolute;
            right: 20px;
            top: 16px;
            font-size: 64px;
            color: var(--primary);
            opacity: 0.06;
            line-height: 1;
        }

        .account-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
        }

        .account-field {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
        }

        .account-field label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .account-field .value {
            font-size: 15px;
            font-weight: 600;
            color: var(--primary);
            word-break: break-all;
        }

        .nomor-peserta-field {
            grid-column: 1 / -1;
            background: var(--primary);
            border-color: transparent;
        }

        .nomor-peserta-field label {
            color: #7ec9a9;
        }

        .nomor-peserta-field .value {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: var(--white);
            letter-spacing: 0.04em;
        }

        /* ─── DATA TABLE ─── */
        .data-box {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .data-row {
            display: grid;
            grid-template-columns: 160px 1fr;
            align-items: center;
            padding: 13px 20px;
            border-bottom: 1px solid #eef5f0;
            transition: background 0.15s;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .data-row:hover {
            background: var(--primary-pale);
        }

        .data-row .key {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .data-row .val {
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .pill {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 3px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        /* ─── FILE ITEMS ─── */
        .files-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
        }

        .file-item:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
            border-color: var(--primary-light);
        }

        .file-type-badge {
            background: var(--primary);
            color: var(--white);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.07em;
            padding: 5px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .file-name {
            flex: 1;
            font-size: 13px;
            color: var(--text-mid);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.15s, opacity 0.15s;
            border: none;
        }

        .btn:hover {
            opacity: 0.85;
            transform: scale(0.97);
        }

        .btn:active {
            transform: scale(0.94);
        }

        .btn-view {
            background: #e0f0ff;
            color: #1a6bbf;
        }

        .btn-download {
            background: var(--primary-pale);
            color: var(--primary);
        }

        .empty-files {
            text-align: center;
            padding: 28px;
            color: var(--text-muted);
            font-size: 14px;
            background: var(--bg);
            border-radius: var(--radius-sm);
        }

        /* ─── FOOTER ACTIONS ─── */
        .card-footer {
            background: #f8fbf9;
            border-top: 1px solid var(--border);
            padding: 24px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-note {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: var(--white);
            padding: 11px 24px;
            border-radius: 100px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(13, 110, 78, 0.28);
            transition: transform 0.18s, box-shadow 0.18s;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 110, 78, 0.36);
        }

        /* ─── PRINT HINT ─── */
        .print-hint {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: var(--text-muted);
            animation: fade-in-up 0.5s ease 0.8s both;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 600px) {
            .card-body {
                padding: 20px 16px;
            }

            .card-footer {
                padding: 18px 16px;
            }

            .card-header {
                padding: 28px 20px 24px;
            }

            .data-row {
                grid-template-columns: 120px 1fr;
            }

            .file-item {
                flex-wrap: wrap;
            }

            .file-name {
                width: 100%;
            }
        }

        @media print {

            .bg-canvas,
            .grid-overlay,
            .float-icon,
            .btn-home {
                display: none !important;
            }

            .card-main {
                box-shadow: none;
            }

            body {
                background: white;
            }
        }
    </style>
</head>

<body>

    <!-- Animated background -->
    <div class="bg-canvas">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <div class="grid-overlay"></div>

    <!-- Floating medical symbols -->
    <script>
        const symbols = ['✚', '⊕', '♥', '✚', '⊕'];
        const positions = [
            [8, 10],
            [20, 70],
            [70, 20],
            [85, 55],
            [45, 85],
            [60, 5],
            [15, 45]
        ];
        positions.forEach(([left, top], i) => {
            const el = document.createElement('div');
            el.className = 'float-icon';
            el.textContent = symbols[i % symbols.length];
            el.style.left = left + '%';
            el.style.top = (top + 100) + '%';
            el.style.animationDuration = (14 + i * 3) + 's';
            el.style.animationDelay = (i * 2) + 's';
            document.querySelector('.bg-canvas').appendChild(el);
        });
    </script>

    <div class="wrapper">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert-success">
                <div class="alert-icon">✓</div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card-main">

            <!-- ── HEADER ── -->
            <div class="card-header">
                <div class="hospital-badge">
                    <div class="badge-dot"></div>
                   Rekrutmen Pegawai
                </div>
                <div class="trophy-ring">🎉</div>
                <h1>Pendaftaran Berhasil!</h1>
                <p>Data Anda telah tercatat. Simpan informasi akun di bawah ini.</p>

                <!-- ECG decorative SVG -->
                <svg class="ecg-line" viewBox="0 0 900 36" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <polyline fill="none" stroke="#ffffff" stroke-width="2"
                        points="0,18 80,18 100,18 120,4 130,32 140,8 150,28 160,18 240,18 320,18 340,4 350,32 360,8 370,28 380,18 460,18 540,18 560,4 570,32 580,8 590,28 600,18 680,18 760,18 780,4 790,32 800,8 810,28 820,18 900,18" />
                </svg>
            </div>

            <!-- ── BODY ── -->
            <div class="card-body">

                <!-- AKUN -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon icon-green">🔐</div>
                        <span class="section-title">Informasi Akun</span>
                    </div>
                    <div class="account-box">
                        <div class="account-grid">
                            <div class="account-field nomor-peserta-field">
                                <label>Nomor Peserta</label>
                                <div class="value">{{ $nomor_peserta }} </div>
                            </div>
                            <div class="account-field">
                                <label>Username</label>
                                <div class="value">{{ $username }}</div>
                            </div>
                            <div class="account-field">
                                <label>Password</label>
                                <div class="value">{{ session('pelamar_auth.password') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA PELAMAR -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon icon-blue">📄</div>
                        <span class="section-title">Data Pelamar</span>
                    </div>
                    <div class="data-box">
                        <div class="data-row">
                            <span class="key">Nama Lengkap</span>
                            <span class="val">{{ $pelamar->nama }}</span>
                        </div>
                        <div class="data-row">
                            <span class="key">Email</span>
                            <span class="val">{{ $pelamar->email }}</span>
                        </div>
                        <div class="data-row">
                            <span class="key">No. Telepon</span>
                            <span class="val">{{ $pelamar->no_hp }}</span>
                        </div>
                        <div class="data-row">
                            <span class="key">Posisi Dilamar</span>
                            <span class="val">
                                <span class="pill">{{ $pelamar->posisi->nama_posisi ?? '-' }}</span>
                            </span>
                        </div>
                        <div class="data-row">
                            <span class="key">Jenjang</span>
                            <span class="val">{{ $pelamar->jenjang }}</span>
                        </div>
                        <div class="data-row">
                            <span class="key">Kota Domisili</span>
                            <span class="val">{{ $pelamar->kota_domisili }}</span>
                        </div>
                    </div>
                </div>

                <!-- BERKAS -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon icon-amber">📂</div>
                        <span class="section-title">Berkas Upload</span>
                    </div>
                    <div class="files-list">
                        @forelse($pelamar->files as $file)
                            <div class="file-item">
                                <span class="file-type-badge">{{ strtoupper($file->jenis_file) }}</span>
                                <span class="file-name">{{ basename($file->file_path) }}</span>
                                <div class="file-actions">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                        class="btn btn-view">
                                        👁 Lihat
                                    </a>
                                    <a href="{{ asset('storage/' . $file->file_path) }}" download
                                        class="btn btn-download">
                                        ⬇ Unduh
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="empty-files">Tidak ada berkas yang diunggah.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- ── FOOTER ── -->
            <div class="card-footer">
                <div class="footer-note">
                    <span>📋</span>
                    <span>Harap simpan nomor peserta Anda untuk keperluan seleksi.</span>
                </div>
                <a href="{{ url('/') }}" class="btn-home">
                    ← Kembali Beranda
                </a>
                 <a href="{{ route('login') }}" class="btn-home">
                    Halaman Login →
                </a>


            </div>

            <p class="print-hint">Tekan Ctrl+P untuk mencetak halaman ini sebagai bukti pendaftaran.</p>

        </div>

</body>

</html>
