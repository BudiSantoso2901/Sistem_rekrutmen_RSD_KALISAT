<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#0d4f35">
    <title>Scan Kartu Pelamar — SIREKRUT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ════════════════════════════════════════
   SIREKRUT SCAN — Standalone
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
            --r: 14px;
            --r-sm: 9px;
            --r-xs: 5px;
        }

        html,
        body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
            overscroll-behavior: none;
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
            padding: 14px 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .2);
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
            font-size: .9rem;
            transition: background .15s;
            flex-shrink: 0;
        }

        .topbar-back:hover {
            background: rgba(255, 255, 255, .2);
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            flex: 1;
        }

        .topbar-subtitle {
            font-size: .72rem;
            color: rgba(255, 255, 255, .6);
            font-weight: 400;
        }

        .topbar-badge {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 100px;
            padding: 3px 10px;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--g300);
            flex-shrink: 0;
        }

        /* ── Main scroll area ── */
        .main {
            padding: 16px 14px 100px;
            max-width: 520px;
            margin: 0 auto;
        }

        /* ── Alert ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            border-radius: var(--r-sm);
            font-size: .83rem;
            font-weight: 500;
            margin-bottom: 14px;
            line-height: 1.45;
            animation: alertIn .3s ease;
        }

        @keyframes alertIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background: var(--red-bg);
            border-left: 3px solid var(--red);
            color: #c53030;
        }

        .alert-info {
            background: var(--g50);
            border-left: 3px solid var(--g500);
            color: var(--ink-mid);
        }

        .alert-icon {
            font-size: .95rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Section card ── */
        .scard {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(13, 79, 53, .06);
        }

        .scard-head {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            background: var(--g50);
            border-bottom: 1.5px solid var(--border);
        }

        .scard-head-icon {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: var(--g100);
            border: 1px solid rgba(34, 160, 107, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            color: var(--g700);
            flex-shrink: 0;
        }

        .scard-head-title {
            font-size: .88rem;
            font-weight: 700;
            color: var(--ink);
            flex: 1;
        }

        .scard-head-badge {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 100px;
            background: var(--g100);
            color: var(--g700);
            border: 1px solid rgba(34, 160, 107, .2);
        }

        .scard-body {
            padding: 16px;
        }

        /* ── Viewfinder ── */
        .viewfinder {
            position: relative;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: #0a1f14;
            aspect-ratio: 4/3;
            margin-bottom: 14px;
        }

        #scanVideo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Corner guide */
        .vf-guide {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .vf-corner {
            position: absolute;
            width: 26px;
            height: 26px;
            border-color: var(--g400);
            border-style: solid;
        }

        .vf-corner.tl {
            top: 12px;
            left: 12px;
            border-width: 3px 0 0 3px;
            border-radius: 3px 0 0 0;
        }

        .vf-corner.tr {
            top: 12px;
            right: 12px;
            border-width: 3px 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .vf-corner.bl {
            bottom: 12px;
            left: 12px;
            border-width: 0 0 3px 3px;
            border-radius: 0 0 0 3px;
        }

        .vf-corner.br {
            bottom: 12px;
            right: 12px;
            border-width: 0 3px 3px 0;
            border-radius: 0 0 3px 0;
        }

        /* Scan beam */
        .vf-beam {
            position: absolute;
            left: 12px;
            right: 12px;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--g400) 30%, var(--g300) 50%, var(--g400) 70%, transparent 100%);
            box-shadow: 0 0 8px var(--g400);
            top: 12px;
            display: none;
            animation: beam 2.2s cubic-bezier(.4, 0, .6, 1) infinite;
        }

        @keyframes beam {
            0% {
                top: 12px;
                opacity: 1;
            }

            50% {
                top: calc(100% - 12px);
                opacity: .8;
            }

            100% {
                top: 12px;
                opacity: 1;
            }
        }

        /* Placeholder when camera off */
        .vf-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #0a1f14;
            color: rgba(255, 255, 255, .35);
            font-size: .82rem;
            text-align: center;
            padding: 20px;
        }

        .vf-placeholder i {
            font-size: 2.2rem;
            opacity: .3;
            margin-bottom: 4px;
        }

        /* Status chip */
        .vf-chip {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 100px;
            padding: 4px 12px;
            font-size: .68rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .75);
            white-space: nowrap;
            pointer-events: none;
            transition: all .3s;
        }

        .vf-chip.on {
            background: rgba(34, 160, 107, .35);
            border-color: rgba(46, 204, 122, .4);
            color: var(--g300);
        }

        .vf-chip.hit {
            background: rgba(46, 204, 122, .55);
            border-color: var(--g300);
            color: #fff;
            transform: translateX(-50%) scale(1.05);
        }

        /* Flash overlay */
        .vf-flash {
            position: absolute;
            inset: 0;
            background: rgba(46, 204, 122, .3);
            pointer-events: none;
            opacity: 0;
        }

        .vf-flash.pop {
            animation: flashPop .5s ease forwards;
        }

        @keyframes flashPop {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        /* ── Camera controls ── */
        .cam-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 8px;
        }

        .cam-controls .btn-full {
            grid-column: 1 / -1;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border-radius: var(--r-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .84rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid var(--border);
            background: var(--surface);
            color: var(--ink-mid);
            transition: all .18s ease;
            white-space: nowrap;
            width: 100%;
        }

        .btn:hover:not(:disabled) {
            border-color: var(--g500);
            color: var(--g700);
            background: var(--g50);
        }

        .btn:active:not(:disabled) {
            transform: scale(.97);
        }

        .btn:disabled {
            opacity: .42;
            cursor: not-allowed;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--g700) 0%, var(--g500) 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 4px 14px rgba(34, 160, 107, .28);
        }

        .btn-primary:hover:not(:disabled) {
            box-shadow: 0 6px 20px rgba(34, 160, 107, .38);
            transform: translateY(-1px);
            background: linear-gradient(135deg, var(--g700) 0%, var(--g500) 100%);
            color: #fff;
            border-color: transparent;
        }

        .btn-danger {
            border-color: var(--red);
            color: var(--red);
        }

        .btn-danger:hover:not(:disabled) {
            background: var(--red-bg);
        }

        .btn .spin {
            display: none;
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn.loading .spin {
            display: block;
        }

        .btn.loading .btn-txt {
            display: none;
        }

        .cam-hint {
            text-align: center;
            font-size: .72rem;
            color: var(--ink-soft);
            margin-top: 4px;
            line-height: 1.5;
        }

        /* ── Divider ── */
        .or-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 4px 0 16px;
            font-size: .75rem;
            font-weight: 600;
            color: var(--ink-soft);
        }

        .or-row::before,
        .or-row::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── Input ── */
        .field-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            font-size: .85rem;
            pointer-events: none;
        }

        .scan-input {
            width: 100%;
            padding: 12px 40px 12px 38px;
            border: 1.5px solid var(--border);
            border-radius: var(--r-sm);
            font-family: 'DM Mono', monospace;
            font-size: .88rem;
            color: var(--ink);
            background: #fafcfb;
            outline: none;
            transition: all .2s;
            -webkit-appearance: none;
        }

        .scan-input:focus {
            border-color: var(--g500);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(34, 160, 107, .12);
        }

        .scan-input.err {
            border-color: var(--red);
            background: var(--red-bg);
        }

        .input-clear {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            font-size: .8rem;
            padding: 4px;
            display: none;
            transition: color .15s;
        }

        .input-clear.show {
            display: block;
        }

        .input-clear:hover {
            color: var(--red);
        }

        /* ── History ── */
        .history-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 14px 0 8px;
        }

        .history-label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        .btn-clear-all {
            background: none;
            border: none;
            font-size: .7rem;
            color: var(--red);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            padding: 2px 4px;
            border-radius: 4px;
            transition: background .15s;
        }

        .btn-clear-all:hover {
            background: var(--red-bg);
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .h-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            background: var(--g50);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            cursor: pointer;
            transition: all .15s;
            -webkit-tap-highlight-color: transparent;
        }

        .h-item:hover {
            background: var(--g100);
            border-color: var(--g400);
        }

        .h-item:active {
            transform: scale(.98);
        }

        .h-code {
            font-family: 'DM Mono', monospace;
            font-size: .8rem;
            font-weight: 500;
            color: var(--ink);
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .h-time {
            font-size: .68rem;
            color: var(--ink-soft);
            flex-shrink: 0;
        }

        .h-del {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            font-size: .72rem;
            padding: 2px 5px;
            border-radius: 4px;
            transition: color .15s;
            flex-shrink: 0;
        }

        .h-del:hover {
            color: var(--red);
            background: var(--red-bg);
        }

        .h-empty {
            font-size: .78rem;
            color: var(--ink-soft);
            text-align: center;
            padding: 14px 0;
            font-style: italic;
        }

        /* ── Bottom action bar ── */
        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: var(--surface);
            border-top: 1.5px solid var(--border);
            padding: 12px 14px;
            padding-bottom: calc(12px + env(safe-area-inset-bottom));
            max-width: 520px;
            margin: 0 auto;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }

        .btn-search {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--g800) 0%, var(--g500) 100%);
            color: #fff;
            border: none;
            border-radius: var(--r);
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            box-shadow: 0 4px 20px rgba(34, 160, 107, .32);
            transition: all .2s;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-search:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(34, 160, 107, .42);
        }

        .btn-search:active:not(:disabled) {
            transform: scale(.98);
        }

        .btn-search .spin {
            display: none;
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        .btn-search.loading .spin {
            display: block;
        }

        .btn-search.loading .btn-txt {
            display: none;
        }

        /* ── Engine notice ── */
        .engine-notice {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            background: var(--amber-bg);
            border: 1px solid rgba(217, 119, 6, .2);
            border-radius: var(--r-sm);
            font-size: .75rem;
            color: #92400e;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    {{-- ── TOPBAR ── --}}
    <div class="topbar">
        <a href="{{ route('login') }}" class="topbar-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="topbar-title">
            Scan Kartu Peserta
            <div class="topbar-subtitle">SIREKRUT — Sistem Rekrutmen</div>
        </div>
        <span class="topbar-badge">Admin</span>
    </div>

    <div class="main">

        {{-- Session alerts --}}
        @if (session('scan_error'))
            <div class="alert alert-error">
                <span class="alert-icon">⚠</span>
                <span>{{ session('scan_error') }}</span>
            </div>
        @endif

        {{-- Live error --}}
        <div class="alert alert-error" id="liveError" style="display:none;">
            <span class="alert-icon">⚠</span>
            <span id="liveErrorMsg"></span>
        </div>

        {{-- ── CAMERA CARD ── --}}
        <div class="scard">
            <div class="scard-head">
                <div class="scard-head-icon"><i class="fa-solid fa-camera"></i></div>
                <span class="scard-head-title">Scan via Kamera</span>
                <span class="scard-head-badge" id="engineBadge">–</span>
            </div>
            <div class="scard-body">

                <div class="viewfinder" id="viewfinder">
                    <video id="scanVideo" playsinline muted autoplay></video>
                    <div class="vf-guide">
                        <div class="vf-corner tl"></div>
                        <div class="vf-corner tr"></div>
                        <div class="vf-corner bl"></div>
                        <div class="vf-corner br"></div>
                        <div class="vf-beam" id="vfBeam"></div>
                    </div>
                    <div class="vf-placeholder" id="vfPh">
                        <i class="fa-solid fa-camera"></i>
                        <span>Ketuk tombol di bawah untuk<br>mengaktifkan kamera</span>
                    </div>
                    <div class="vf-chip" id="vfChip">Kamera belum aktif</div>
                    <div class="vf-flash" id="vfFlash"></div>
                </div>

                <div class="cam-controls">
                    <button class="btn btn-primary" id="btnStart">
                        <i class="fa-solid fa-play"></i>
                        <span class="btn-txt">Aktifkan</span>
                    </button>
                    <button class="btn btn-danger" id="btnStop" disabled>
                        <i class="fa-solid fa-stop"></i>
                        <span class="btn-txt">Hentikan</span>
                    </button>
                    <button class="btn" id="btnFlip" disabled>
                        <i class="fa-solid fa-rotate"></i>
                        <span class="btn-txt">Ganti Kamera</span>
                    </button>
                </div>

                <p class="cam-hint">Mendukung QR Code & Barcode (Chrome/Edge). Gunakan input manual untuk browser lain.
                </p>
                <div class="engine-notice" id="engineNotice" style="display:none;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span id="engineNoticeText"></span>
                </div>
            </div>
        </div>

        {{-- ── MANUAL INPUT CARD ── --}}
        <div class="scard">
            <div class="scard-head">
                <div class="scard-head-icon"><i class="fa-solid fa-keyboard"></i></div>
                <span class="scard-head-title">Input Manual</span>
            </div>
            <div class="scard-body">
                <form id="scanForm" action="{{ route('admin.scan.cari') }}" method="GET">
                    <label class="field-label" for="scanInput">Nomor Peserta atau Token</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="q" id="scanInput" class="scan-input"
                            placeholder="Contoh: 2024-RS01-001" autocomplete="off" inputmode="text">
                        <button type="button" class="input-clear" id="inputClear">✕</button>
                    </div>
                </form>

                {{-- Riwayat --}}
                <div class="history-head">
                    <span class="history-label">🕐 Riwayat Scan</span>
                    <button class="btn-clear-all" id="btnClearAll" style="display:none;">Hapus Semua</button>
                </div>
                <div class="history-list" id="historyList">
                    <div class="h-empty" id="hEmpty">Belum ada riwayat.</div>
                </div>
            </div>
        </div>

    </div>

    {{-- Bottom bar --}}
    <div class="bottom-bar">
        <button class="btn-search" id="btnSearch" type="button">
            <div class="spin"></div>
            <i class="fa-solid fa-magnifying-glass btn-txt"></i>
            <span class="btn-txt">Cari Pelamar</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
        (function() {
            'use strict';

            /* ── DOM ── */
            const video = document.getElementById('scanVideo');
            const vfPh = document.getElementById('vfPh');
            const vfChip = document.getElementById('vfChip');
            const vfBeam = document.getElementById('vfBeam');
            const vfFlash = document.getElementById('vfFlash');
            const btnStart = document.getElementById('btnStart');
            const btnStop = document.getElementById('btnStop');
            const btnFlip = document.getElementById('btnFlip');
            const scanInput = document.getElementById('scanInput');
            const inputClear = document.getElementById('inputClear');
            const scanForm = document.getElementById('scanForm');
            const btnSearch = document.getElementById('btnSearch');
            const liveError = document.getElementById('liveError');
            const liveErrMsg = document.getElementById('liveErrorMsg');
            const hList = document.getElementById('historyList');
            const hEmpty = document.getElementById('hEmpty');
            const btnClearAll = document.getElementById('btnClearAll');
            const engineBadge = document.getElementById('engineBadge');
            const engineNote = document.getElementById('engineNotice');
            const engineNoteT = document.getElementById('engineNoticeText');

            /* ── State ── */
            let stream = null,
                rafId = null,
                scanning = false;
            let devices = [],
                devIdx = 0;
            let detector = null;
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d', {
                willReadFrequently: true
            });

            /* ── Engine detection ── */
            async function initEngine() {
                if ('BarcodeDetector' in window) {
                    try {
                        const fmts = await BarcodeDetector.getSupportedFormats();
                        detector = new BarcodeDetector({
                            formats: fmts
                        });
                        engineBadge.textContent = 'Native';
                        engineBadge.style.background = '#d1fae5';
                        engineBadge.style.color = '#065f46';
                        return 'native';
                    } catch (e) {}
                }
                if (typeof jsQR !== 'undefined') {
                    engineBadge.textContent = 'jsQR';
                    engineBadge.style.background = '#fef9c3';
                    engineBadge.style.color = '#92400e';
                    engineNote.style.display = 'flex';
                    engineNoteT.textContent =
                        'Browser ini hanya mendukung QR Code. Untuk barcode lain, gunakan input manual.';
                    return 'jsqr';
                }
                engineBadge.textContent = 'Manual';
                engineBadge.style.background = '#fee2e2';
                engineBadge.style.color = '#991b1b';
                engineNote.style.display = 'flex';
                engineNoteT.textContent = 'Deteksi otomatis tidak tersedia. Gunakan input manual di bawah.';
                return 'none';
            }

            /* ── Camera ── */
            async function startCam() {
                hideErr();
                vfChip.textContent = 'Menginisialisasi…';
                vfChip.className = 'vf-chip';
                try {
                    const allDevs = await navigator.mediaDevices.enumerateDevices();
                    devices = allDevs.filter(d => d.kind === 'videoinput');
                    if (!devices.length) throw new Error('Tidak ada kamera pada perangkat ini.');
                    const devId = devices[devIdx]?.deviceId;
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            ...(devId ? {
                                deviceId: {
                                    exact: devId
                                }
                            } : {
                                facingMode: 'environment'
                            }),
                            width: {
                                ideal: 1280
                            },
                            height: {
                                ideal: 720
                            }
                        }
                    });
                    video.srcObject = stream;
                    await video.play();
                    vfPh.style.display = 'none';
                    vfBeam.style.display = 'block';
                    vfChip.textContent = '● Kamera aktif';
                    vfChip.className = 'vf-chip on';
                    scanning = true;
                    btnStart.disabled = true;
                    btnStop.disabled = false;
                    btnFlip.disabled = devices.length < 2;
                    const eng = await initEngine();
                    loop(eng);
                } catch (e) {
                    let msg = e.message;
                    if (e.name === 'NotAllowedError') msg = 'Izin kamera ditolak. Aktifkan di pengaturan browser.';
                    if (e.name === 'NotFoundError') msg = 'Kamera tidak ditemukan.';
                    if (e.name === 'NotReadableError') msg = 'Kamera digunakan aplikasi lain.';
                    showErr(msg);
                    vfChip.textContent = '● ' + msg;
                    vfChip.className = 'vf-chip';
                }
            }

            function stopCam() {
                scanning = false;
                if (rafId) {
                    cancelAnimationFrame(rafId);
                    rafId = null;
                }
                if (stream) {
                    stream.getTracks().forEach(t => t.stop());
                    stream = null;
                }
                video.srcObject = null;
                vfPh.style.display = 'flex';
                vfBeam.style.display = 'none';
                vfChip.textContent = 'Kamera belum aktif';
                vfChip.className = 'vf-chip';
                btnStart.disabled = false;
                btnStop.disabled = true;
                btnFlip.disabled = true;
            }
            async function flipCam() {
                if (!devices.length) return;
                devIdx = (devIdx + 1) % devices.length;
                stopCam();
                await startCam();
            }
            btnStart.addEventListener('click', startCam);
            btnStop.addEventListener('click', stopCam);
            btnFlip.addEventListener('click', flipCam);

            /* ── Decode loop ── */
            function loop(eng) {
                rafId = requestAnimationFrame(() => decode(eng));
            }
            async function decode(eng) {
                if (!scanning || !stream) return;
                if (video.readyState < video.HAVE_ENOUGH_DATA) return loop(eng);
                canvas.width = video.videoWidth || 640;
                canvas.height = video.videoHeight || 480;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                let code = null;
                try {
                    if (eng === 'native' && detector) {
                        const res = await detector.detect(canvas);
                        if (res.length) code = res[0].rawValue;
                    } else if (eng === 'jsqr') {
                        const img = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        const res = jsQR(img.data, img.width, img.height, {
                            inversionAttempts: 'dontInvert'
                        });
                        if (res) code = res.data;
                    }
                } catch (e) {}
                if (code) {
                    onDetected(code);
                    return;
                }
                loop(eng);
            }

            function onDetected(code) {
                scanning = false;
                if (rafId) {
                    cancelAnimationFrame(rafId);
                    rafId = null;
                }
                vfChip.textContent = '✓ Terdeteksi!';
                vfChip.className = 'vf-chip hit';
                vfBeam.style.display = 'none';
                vfFlash.className = 'vf-flash pop';
                stopCam();
                addHistory(code);
                doSearch(code);
            }

            /* ── Search ── */
            function doSearch(code) {
                if (!code) {
                    showErr('Masukkan nomor peserta terlebih dahulu.');
                    return;
                }
                scanInput.value = code;
                inputClear.classList.add('show');
                btnSearch.classList.add('loading');
                btnSearch.disabled = true;
                hideErr();
                fetch(`{{ route('admin.scan.cari') }}?q=${encodeURIComponent(code)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success && d.redirect) {
                            window.location.href = d.redirect;
                        } else {
                            showErr(d.message || 'Pelamar tidak ditemukan.');
                            reset();
                        }
                    })
                    .catch(() => {
                        showErr('Kesalahan jaringan. Coba lagi.');
                        reset();
                    });
            }

            function reset() {
                btnSearch.classList.remove('loading');
                btnSearch.disabled = false;
            }

            btnSearch.addEventListener('click', () => doSearch(scanInput.value.trim()));
            scanForm.addEventListener('submit', e => {
                e.preventDefault();
                doSearch(scanInput.value.trim());
            });
            scanInput.addEventListener('input', function() {
                this.classList.remove('err');
                inputClear.classList.toggle('show', this.value.length > 0);
            });
            inputClear.addEventListener('click', () => {
                scanInput.value = '';
                scanInput.classList.remove('err');
                inputClear.classList.remove('show');
                scanInput.focus();
            });

            /* ── Error helpers ── */
            function showErr(msg) {
                liveErrMsg.textContent = msg;
                liveError.style.display = 'flex';
                clearTimeout(liveError._t);
                liveError._t = setTimeout(() => liveError.style.display = 'none', 7000);
            }

            function hideErr() {
                liveError.style.display = 'none';
            }

            /* ── History ── */
            const HK = 'sr_scan_hist';
            const loadHist = () => {
                try {
                    return JSON.parse(localStorage.getItem(HK)) || [];
                } catch {
                    return [];
                }
            };
            const saveHist = a => localStorage.setItem(HK, JSON.stringify(a));

            function addHistory(code) {
                let a = loadHist().filter(h => h.c !== code);
                a.unshift({
                    c: code,
                    t: new Date().toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                });
                if (a.length > 10) a = a.slice(0, 10);
                saveHist(a);
                renderHist();
            }

            function renderHist() {
                const a = loadHist();
                hList.innerHTML = '';
                btnClearAll.style.display = a.length ? 'block' : 'none';
                if (!a.length) {
                    hList.appendChild(hEmpty);
                    return;
                }
                a.forEach(h => {
                    const el = document.createElement('div');
                    el.className = 'h-item';
                    el.innerHTML =
                        `<i class="fa-solid fa-clock-rotate-left" style="color:var(--ink-soft);font-size:.75rem;flex-shrink:0;"></i><span class="h-code">${h.c}</span><span class="h-time">${h.t}</span><button class="h-del" title="Hapus"><i class="fa-solid fa-xmark"></i></button>`;
                    el.querySelector('.h-del').addEventListener('click', e => {
                        e.stopPropagation();
                        saveHist(loadHist().filter(x => x.c !== h.c));
                        renderHist();
                    });
                    el.addEventListener('click', () => doSearch(h.c));
                    hList.appendChild(el);
                });
            }
            btnClearAll.addEventListener('click', () => {
                saveHist([]);
                renderHist();
            });
            renderHist();

            /* ── Enter key ── */
            scanInput.addEventListener('keydown', e => {
                if (e.key === 'Enter') doSearch(scanInput.value.trim());
            });

        })();
    </script>
</body>

</html>
