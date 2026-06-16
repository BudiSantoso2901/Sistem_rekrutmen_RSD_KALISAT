<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#0d4f35">
    <title>{{ $pelamar->nama }} — Hasil Scan SIREKRUT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ════════════════════════════════════════
   SIREKRUT — Hasil Scan Standalone
   Mobile-first · Green system
════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --g900: #031e13;
            --g800: #0d4f35;
            --g700: #116040;
            --g600: #1a7a52;
            --g500: #22a06b;
            --g400: #2ecc7a;
            --g300: #7edfa9;
            --g100: #d6f5e6;
            --g50: #f0faf5;
            --ink: #0a1f14;
            --ink-2: #1a3528;
            --ink-mid: #2e6b4f;
            --ink-soft: #5a8a72;
            --surface: #fff;
            --bg: #f0f7f3;
            --border: #c4e0d2;
            --red: #e53e3e;
            --red-bg: #fff5f5;
            --amber: #d97706;
            --amber-bg: #fefce8;
            --blue-bg: #eff6ff;
            --blue: #2563eb;
            --r: 14px;
            --r-sm: 9px;
        }

        html,
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
            overscroll-behavior-y: contain;
            -webkit-tap-highlight-color: transparent;
        }

        /* ── Topbar ── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--g800);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .22);
        }

        .topbar-back {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-size: .88rem;
            flex-shrink: 0;
            transition: background .15s;
        }

        .topbar-back:hover {
            background: rgba(255, 255, 255, .22);
        }

        .topbar-info {
            flex: 1;
            min-width: 0;
        }

        .topbar-name {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .topbar-sub {
            font-size: .68rem;
            color: rgba(255, 255, 255, .55);
            margin-top: 1px;
        }

        .topbar-status {
            flex-shrink: 0;
        }

        /* ── Main ── */
        .main {
            padding: 14px 14px 32px;
            max-width: 560px;
            margin: 0 auto;
        }

        /* ── Hero card — pas foto + identity ── */
        .hero-card {
            background: linear-gradient(135deg, var(--g800) 0%, var(--g600) 100%);
            border-radius: var(--r);
            overflow: hidden;
            margin-bottom: 14px;
            position: relative;
            box-shadow: 0 8px 30px rgba(13, 79, 53, .22);
        }

        .hero-card::before {
            content: '';
            position: absolute;
            right: -30px;
            top: -30px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            pointer-events: none;
        }

        .hero-inner {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 18px;
            position: relative;
            z-index: 1;
        }

        /* Pas Foto */
        .pas-foto-wrap {
            flex-shrink: 0;
            position: relative;
        }

        .pas-foto {
            width: 220px;
            height: 250px;
            border-radius: 14px;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, .35);
            display: block;
            background: rgba(255, 255, 255, .1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
            transition: all .3s ease;
            cursor: pointer;
        }

        .pas-foto:hover {
            transform: scale(1.05);
            border-color: rgba(255, 255, 255, .8);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .35);
        }

        .pas-foto-placeholder {
            width: 220px;
            height: 250px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .12);
            border: 2px dashed rgba(255, 255, 255, .25);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: rgba(255, 255, 255, .5);
            font-size: .75rem;
        }

        .pas-foto-placeholder i {
            font-size: 2rem;
        }

        .pas-foto-badge {
            position: absolute;
            bottom: -8px;
            right: -8px;
            background: #22c55e;
            border: 3px solid white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .2);
        }

        /* Hero text */
        .hero-text {
            flex: 1;
            min-width: 0;
        }

        .hero-nama {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 5px;
        }

        .hero-nomor {
            font-family: 'DM Mono', monospace;
            font-size: .72rem;
            font-weight: 500;
            color: var(--g300);
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 5px;
            padding: 2px 8px;
            display: inline-block;
            margin-bottom: 8px;
            letter-spacing: .04em;
        }

        .hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .hero-tag {
            font-size: .67rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 100px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            color: rgba(255, 255, 255, .85);
        }

        .hero-tag.gold {
            background: rgba(212, 160, 23, .25);
            border-color: rgba(244, 168, 39, .35);
            color: #fde68a;
        }

        /* Progress strip */
        .hero-progress {
            background: rgba(0, 0, 0, .25);
            padding: 12px 18px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .prog-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .prog-label {
            font-size: .72rem;
            color: rgba(255, 255, 255, .6);
        }

        .prog-pct {
            font-size: .78rem;
            font-weight: 700;
            color: var(--g300);
        }

        .prog-track {
            height: 6px;
            background: rgba(255, 255, 255, .15);
            border-radius: 100px;
            overflow: hidden;
        }

        .prog-fill {
            height: 100%;
            border-radius: 100px;
            background: linear-gradient(90deg, var(--g400), var(--g300));
            transition: width .9s cubic-bezier(.22, 1, .36, 1);
        }

        /* ── Info section card ── */
        .scard {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            margin-bottom: 12px;
            box-shadow: 0 2px 10px rgba(13, 79, 53, .06);
        }

        .scard-head {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 15px;
            background: var(--g50);
            border-bottom: 1.5px solid var(--border);
        }

        .scard-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: var(--g100);
            border: 1px solid rgba(34, 160, 107, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            color: var(--g700);
            flex-shrink: 0;
        }

        .scard-title {
            font-size: .86rem;
            font-weight: 700;
            color: var(--ink);
            flex: 1;
        }

        .scard-count {
            font-size: .7rem;
            font-weight: 700;
            background: var(--g100);
            color: var(--g700);
            border: 1px solid rgba(34, 160, 107, .2);
            padding: 2px 8px;
            border-radius: 100px;
        }

        .scard-body {
            padding: 0;
        }

        /* ── Info rows ── */
        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(196, 224, 210, .4);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: var(--g50);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            color: var(--g600);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .info-row-body {
            flex: 1;
            min-width: 0;
        }

        .info-row-label {
            font-size: .67rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 2px;
        }

        .info-row-val {
            font-size: .88rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.4;
            word-break: break-word;
        }

        .info-row-val.mono {
            font-family: 'DM Mono', monospace;
            font-size: .82rem;
        }

        /* ── Badge pills ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 9px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
        }

        .pill-green {
            background: var(--g100);
            color: var(--g700);
            border: 1px solid rgba(34, 160, 107, .25);
        }

        .pill-blue {
            background: var(--blue-bg);
            color: var(--blue);
            border: 1px solid #bfdbfe;
        }

        .pill-amber {
            background: var(--amber-bg);
            color: var(--amber);
            border: 1px solid rgba(217, 119, 6, .25);
        }

        .pill-red {
            background: var(--red-bg);
            color: var(--red);
            border: 1px solid rgba(229, 62, 62, .25);
        }

        .pill-grey {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }

        /* ── Dokumen list ── */
        .dok-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .dok-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(196, 224, 210, .4);
            transition: background .12s;
        }

        .dok-item:last-child {
            border-bottom: none;
        }

        .dok-item:active {
            background: var(--g50);
        }

        .dok-icon-wrap {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            flex-shrink: 0;
        }

        .dok-icon-wrap.uploaded {
            background: #d1fae5;
            color: #065f46;
        }

        .dok-icon-wrap.missing {
            background: #fee2e2;
            color: #991b1b;
        }

        .dok-icon-wrap.optional {
            background: #f3f4f6;
            color: #6b7280;
        }

        .dok-body {
            flex: 1;
            min-width: 0;
        }

        .dok-label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.3;
        }

        .dok-meta {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 2px;
            flex-wrap: wrap;
        }

        .dok-tag {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .05em;
            padding: 1px 6px;
            border-radius: 4px;
        }

        .dok-tag.wajib {
            background: #fee2e2;
            color: #991b1b;
        }

        .dok-tag.opsional {
            background: #fef9c3;
            color: #92400e;
        }

        .dok-tag.nakes {
            background: #dbeafe;
            color: #1e40af;
        }

        .dok-hint {
            font-size: .68rem;
            color: var(--ink-soft);
        }

        .dok-action {
            flex-shrink: 0;
        }

        .btn-view {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 11px;
            border-radius: 7px;
            background: var(--g50);
            border: 1.5px solid var(--border);
            color: var(--g700);
            font-size: .75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .15s;
            white-space: nowrap;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-view:hover {
            background: var(--g100);
            border-color: var(--g500);
        }

        .btn-view:active {
            transform: scale(.96);
        }

        .btn-missing {
            font-size: .72rem;
            color: var(--ink-soft);
            font-style: italic;
        }

        /* ── Kuis table ── */
        .kuis-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .kuis-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 15px;
            border-bottom: 1px solid rgba(196, 224, 210, .4);
            transition: background .12s;
        }

        .kuis-item:last-child {
            border-bottom: none;
        }

        .nilai-ring {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            font-weight: 700;
            border: 2.5px solid currentColor;
            flex-shrink: 0;
        }

        .nilai-ring.lulus {
            color: #065f46;
            background: #d1fae5;
        }

        .nilai-ring.mid {
            color: var(--amber);
            background: var(--amber-bg);
        }

        .nilai-ring.gagal {
            color: #991b1b;
            background: var(--red-bg);
        }

        .kuis-body {
            flex: 1;
            min-width: 0;
        }

        .kuis-name {
            font-size: .85rem;
            font-weight: 600;
            color: var(--ink);
        }

        .kuis-action {
            flex-shrink: 0;
        }

        /* ── Action bar ── */
        .action-bar {
            display: flex;
            gap: 8px;
            padding: 12px 14px;
            background: var(--surface);
            border-top: 1.5px solid var(--border);
            position: sticky;
            bottom: 0;
            z-index: 50;
            padding-bottom: calc(12px + env(safe-area-inset-bottom));
            max-width: 560px;
            margin: 0 auto;
        }

        .btn-act {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px;
            border-radius: var(--r);
            font-family: 'DM Sans', sans-serif;
            font-size: .84rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: all .18s;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-act:active {
            transform: scale(.97);
        }

        .btn-act-outline {
            background: var(--surface);
            border-color: var(--border);
            color: var(--ink-mid);
        }

        .btn-act-outline:hover {
            border-color: var(--g500);
            color: var(--g700);
            background: var(--g50);
        }

        .btn-act-primary {
            background: linear-gradient(135deg, var(--g700), var(--g500));
            color: #fff;
            box-shadow: 0 4px 16px rgba(34, 160, 107, .28);
        }

        .btn-act-primary:hover {
            box-shadow: 0 6px 22px rgba(34, 160, 107, .38);
            transform: translateY(-1px);
        }

        /* ── Empty state ── */
        .empty {
            text-align: center;
            padding: 28px 16px;
            color: var(--ink-soft);
        }

        .empty i {
            font-size: 1.8rem;
            margin-bottom: 8px;
            opacity: .3;
            display: block;
        }

        .empty p {
            font-size: .82rem;
        }

        /* ── Scan timestamp ── */
        .scan-ts {
            text-align: center;
            font-size: .7rem;
            color: var(--ink-soft);
            padding: 10px 0 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .scan-ts-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--g400);
            animation: blink 2s ease infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .3;
            }
        }
    </style>
</head>

<body>
    @php
        /* ── Jenis file definition (mirror dari controller) ── */
        $jenisFileDef = [
            'cv' => [
                'label' => 'Curriculum Vitae (CV)',
                'icon' => 'fa-user',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'ijazah_transkrip' => [
                'label' => 'Ijazah & Transkrip Nilai',
                'icon' => 'fa-graduation-cap',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'ktp' => [
                'label' => 'Fotokopi KTP',
                'icon' => 'fa-id-card',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'pas_foto' => [
                'label' => 'Pas Foto Terbaru',
                'icon' => 'fa-image',
                'required' => true,
                'hint' => 'JPEG/PNG · Maks. 1 MB',
            ],
            'str_sip' => [
                'label' => 'STR / SIP (Tenaga Kesehatan)',
                'icon' => 'fa-file-medical',
                'required' => null,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'sertifikat' => [
                'label' => 'Sertifikat Pelatihan',
                'icon' => 'fa-certificate',
                'required' => false,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'surat_pengalaman' => [
                'label' => 'Surat Pengalaman Kerja',
                'icon' => 'fa-briefcase',
                'required' => false,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'skck' => [
                'label' => 'SKCK',
                'icon' => 'fa-shield-halved',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'surat_sehat' => [
                'label' => 'Surat Keterangan Sehat',
                'icon' => 'fa-stethoscope',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'surat_pernyataan' => [
                'label' => 'Surat Pernyataan Keaslian',
                'icon' => 'fa-file-signature',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'surat_lamaran' => [
                'label' => 'Surat Lamaran Pekerjaan',
                'icon' => 'fa-file-signature',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
            'surat_tidak_menuntut_diangkat_asn' => [
                'label' => 'Surat Pernyataan Tidak Menuntut ASN',
                'icon' => 'fa-file-signature',
                'required' => true,
                'hint' => 'PDF · Maks. 1 MB',
            ],
        ];

        /* Resolve STR berdasarkan jenis_pelamar */
        foreach ($jenisFileDef as $k => &$m) {
            if ($k === 'str_sip') {
                $m['required'] = $pelamar->jenis_pelamar === 'nakes';
            }
        }
        unset($m);

        $uploadedMap = $pelamar->files->keyBy('jenis_file');
        $pasFoto = $uploadedMap->get('pas_foto');
        $pasFotoUrl = $pasFoto ? asset('storage/' . $pasFoto->file_path) : null;

        $requiredKeys = collect($jenisFileDef)->where('required', true)->keys();
        $doneKeys = $requiredKeys->filter(fn($k) => $uploadedMap->has($k));
        $totalWajib = $requiredKeys->count();
        $totalDone = $doneKeys->count();
        $progress = $totalWajib > 0 ? round(($totalDone / $totalWajib) * 100) : 0;

        /* Status style helper */
        $statusMap = [
            'terdaftar' => ['label' => 'Terdaftar', 'cls' => 'pill-blue'],
            'pending' => ['label' => 'Pending', 'cls' => 'pill-amber'],
            'lulus' => ['label' => 'Lulus', 'cls' => 'pill-green'],
            'gagal' => ['label' => 'Gagal', 'cls' => 'pill-red'],
        ];
        $st = $pelamar->status_pelamar ?? 'terdaftar';
        $stMap = $statusMap[$st] ?? ['label' => ucfirst($st), 'cls' => 'pill-grey'];
    @endphp

    {{-- ── TOPBAR ── --}}
    <div class="topbar">
        <a href="{{ route('admin.scan.index') }}" class="topbar-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="topbar-info">
            <div class="topbar-name">{{ $pelamar->nama }}</div>
            <div class="topbar-sub">{{ $pelamar->nomer_peserta }} ·
                {{ $pelamar->rumahSakit->nama_rs ?? 'RS tidak ditemukan' }}</div>
        </div>
        {{-- <span class="pill {{ $stMap['cls'] }} topbar-status">{{ $stMap['label'] }}</span> --}}
    </div>

    <div class="main">

        {{-- ── HERO: PAS FOTO + IDENTITY ── --}}
        <div class="hero-card">
            <div class="hero-inner">
                <div class="pas-foto-wrap">
                    @if ($pasFotoUrl)
                        <img src="{{ $pasFotoUrl }}" alt="Pas Foto {{ $pelamar->nama }}" class="pas-foto"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="pas-foto-placeholder" style="display:none;">
                            <i class="fa-solid fa-user"></i>
                            <span>Foto tidak dapat dimuat</span>
                        </div>
                    @else
                        <div class="pas-foto-placeholder">
                            <i class="fa-solid fa-user"></i>
                            <span>Belum ada foto</span>
                        </div>
                    @endif
                    @if ($pasFotoUrl)
                        <div class="pas-foto-badge"><i class="fa-solid fa-check"></i></div>
                    @endif
                </div>
                <div class="hero-text">
                    <div class="hero-nama">{{ $pelamar->nama }}</div>
                    <div class="hero-nomor">{{ $pelamar->nomer_peserta }}</div>
                    <div class="hero-tags">
                        <span class="hero-tag">{{ $pelamar->posisi->nama_posisi ?? '—' }}</span>
                        <span class="hero-tag">{{ $pelamar->jenjang }}</span>
                        <span class="hero-tag {{ $pelamar->jenis_pelamar === 'nakes' ? 'gold' : '' }}">
                            {{ $pelamar->jenis_pelamar === 'nakes' ? 'Nakes' : 'Non-Nakes' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="hero-progress">
                <div class="prog-row">
                    <span class="prog-label">Kelengkapan Berkas Wajib</span>
                    <span class="prog-pct">{{ $totalDone }}/{{ $totalWajib }} · {{ $progress }}%</span>
                </div>
                <div class="prog-track">
                    <div class="prog-fill" id="progFill" style="width:0%"></div>
                </div>
            </div>
        </div>

        {{-- ── DATA PRIBADI ── --}}
        <div class="scard">
            <div class="scard-head">
                <div class="scard-icon"><i class="fa-solid fa-user"></i></div>
                <span class="scard-title">Data Pribadi</span>
            </div>
            <div class="scard-body">
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-id-badge"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">NIK</div>
                        <div class="info-row-val mono">{{ $pelamar->nik ?? '—' }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-venus-mars"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Jenis Kelamin</div>
                        <div class="info-row-val">{{ $pelamar->jenis_kelamin ?? '—' }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Email</div>
                        <div class="info-row-val">{{ $pelamar->email }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">No. Telepon</div>
                        <div class="info-row-val mono">{{ $pelamar->no_hp }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Kota Domisili</div>
                        <div class="info-row-val">{{ $pelamar->kota_domisili }}</div>
                    </div>
                </div>
                @if ($pelamar->alamat)
                    <div class="info-row">
                        <div class="info-row-icon"><i class="fa-solid fa-house"></i></div>
                        <div class="info-row-body">
                            <div class="info-row-label">Alamat</div>
                            <div class="info-row-val">{{ $pelamar->alamat }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- ── DATA LAMARAN ── --}}
        <div class="scard">
            <div class="scard-head">
                <div class="scard-icon"><i class="fa-solid fa-briefcase"></i></div>
                <span class="scard-title">Data Lamaran</span>
            </div>
            <div class="scard-body">
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-hospital"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Rumah Sakit</div>
                        <div class="info-row-val">{{ $pelamar->rumahSakit->nama_rs ?? '—' }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-person-digging"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Posisi Dilamar</div>
                        <div class="info-row-val">{{ $pelamar->posisi->nama_posisi ?? '—' }}</div>
                    </div>
                </div>
                @if ($pelamar->no_ijasah)
                    <div class="info-row">
                        <div class="info-row-icon"><i class="fa-solid fa-scroll"></i></div>
                        <div class="info-row-body">
                            <div class="info-row-label">No. Ijazah</div>
                            <div class="info-row-val mono">{{ $pelamar->no_ijasah }}</div>
                        </div>
                    </div>
                @endif
                @if ($pelamar->no_str)
                    <div class="info-row">
                        <div class="info-row-icon"><i class="fa-solid fa-file-medical"></i></div>
                        <div class="info-row-body">
                            <div class="info-row-label">No. STR</div>
                            <div class="info-row-val mono">{{ $pelamar->no_str }}</div>
                        </div>
                    </div>
                @endif
                <div class="info-row">
                    <div class="info-row-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="info-row-body">
                        <div class="info-row-label">Pengalaman Kerja</div>
                        <div class="info-row-val">{{ $pelamar->pengalaman_kerja ?? 'Tidak ada' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── BERKAS DOKUMEN ── --}}
        <div class="scard">
            <div class="scard-head">
                <div class="scard-icon"><i class="fa-solid fa-folder-open"></i></div>
                <span class="scard-title">Berkas Dokumen</span>
                <span class="scard-count">{{ $totalDone }}/{{ $totalWajib }} wajib</span>
            </div>
            <div class="scard-body dok-list">
                @foreach ($jenisFileDef as $key => $meta)
                    {{-- Sembunyikan STR jika non-nakes dan belum diupload --}}
                    @if ($key === 'str_sip' && $pelamar->jenis_pelamar === 'non_nakes' && !$uploadedMap->has($key))
                        @continue
                    @endif
                    @php
                        $file = $uploadedMap->get($key);
                        $uploaded = $file !== null;
                        $isReq = $meta['required'];
                        $iconWrap = $uploaded ? 'uploaded' : ($isReq ? 'missing' : 'optional');
                    @endphp
                    <div class="dok-item">
                        <div class="dok-icon-wrap {{ $iconWrap }}">
                            <i class="fa-solid {{ $uploaded ? 'fa-check' : ($isReq ? 'fa-xmark' : 'fa-minus') }}"></i>
                        </div>
                        <div class="dok-body">
                            <div class="dok-label">{{ $meta['label'] }}</div>
                            <div class="dok-meta">
                                @if ($key === 'str_sip')
                                    <span class="dok-tag nakes">Nakes</span>
                                @elseif($isReq)
                                    <span class="dok-tag wajib">Wajib</span>
                                @else
                                    <span class="dok-tag opsional">Opsional</span>
                                @endif
                                <span class="dok-hint">{{ $meta['hint'] }}</span>
                            </div>
                        </div>
                        <div class="dok-action">
                            @if ($uploaded)
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                    class="btn-view">
                                    <i class="fa-solid fa-eye"></i> Lihat
                                </a>
                            @else
                                <span class="btn-missing">Belum ada</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Scan timestamp ── --}}
        <div class="scan-ts">
            <span class="scan-ts-dot"></span>
            Data discan pada {{ now()->translatedFormat('d F Y, H:i') }}
        </div>

    </div>

    {{-- ── ACTION BAR ── --}}
    <div class="action-bar">
        <a href="{{ route('admin.scan.index') }}" class="btn-act btn-act-outline">
            <i class="fa-solid fa-camera"></i> Scan Lagi
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* Animate progress bar */
            const fill = document.getElementById('progFill');
            if (fill) {
                setTimeout(() => {
                    fill.style.width = '{{ $progress }}%';
                }, 150);
            }
        });
    </script>
</body>

</html>
