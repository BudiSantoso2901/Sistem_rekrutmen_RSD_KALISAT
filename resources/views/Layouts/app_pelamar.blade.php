<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard — {{ $pelamar->nama }}</title>
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            --green: #1a7f5a;
            --red: #c0392b;
            --amber: #b45309;
            --sidebar: 270px;
        }

        html,
        body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        /* ════════════ LAYOUT ════════════ */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar);
            background: var(--ink);
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            transition: transform .3s cubic-bezier(.22, 1, .36, 1);
        }

        .sb-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sb-brand img {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, .15);
            object-fit: contain;
            padding: 3px;
            background: rgba(255, 255, 255, .06);
        }

        .sb-brand-name {
            font-size: .88rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.2px;
        }

        .sb-brand-sub {
            font-size: .63rem;
            color: var(--teal-mid);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .sb-nav {
            padding: 10px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .sb-section {
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .28);
            padding: 14px 8px 6px;
        }

        .sb-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255, 255, 255, .6);
            font-size: .84rem;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s;
            margin-bottom: 2px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
        }

        .sb-link i {
            width: 18px;
            text-align: center;
            font-size: .82rem;
        }

        .sb-link:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        .sb-link.active {
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            box-shadow: 0 4px 14px rgba(13, 122, 110, .4);
        }

        .sb-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .sb-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .06);
        }

        .sb-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sb-user-name {
            font-size: .8rem;
            font-weight: 600;
            color: #fff;
        }

        .sb-user-role {
            font-size: .66rem;
            color: var(--teal-mid);
        }

        .sb-logout {
            margin-left: auto;
            background: none;
            border: none;
            color: rgba(255, 255, 255, .35);
            cursor: pointer;
            font-size: .82rem;
            padding: 4px;
            transition: color .2s;
        }

        .sb-logout:hover {
            color: #fc8181;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            z-index: 190;
        }

        /* ── MAIN ── */
        .main-wrap {
            margin-left: var(--sidebar);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 62px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            padding: 0 26px;
            gap: 14px;
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
            font-size: 1.1rem;
            color: var(--ink);
        }

        .topbar-sub {
            font-size: .73rem;
            color: var(--muted);
            margin-top: 1px;
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-body {
            padding: 26px;
            flex: 1;
        }

        .toast-container {
            position: fixed;
            top: 72px;
            right: 18px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .toast {
            background: var(--white);
            border-left: 4px solid var(--teal);
            border-radius: 10px;
            padding: 11px 15px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .12);
            font-size: .81rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 250px;
            animation: toastIn .3s cubic-bezier(.22, 1, .36, 1) both;
        }

        .toast.error {
            border-color: var(--red);
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

        /* ════════════ SECTION TOGGLE ════════════ */
        .page-section {
            display: none;
        }

        .page-section.active {
            display: block;
        }

        /* ════════════ DASHBOARD SECTION ════════════ */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* hero card */
        .hero-card {
            background: linear-gradient(135deg, #162130 0%, #0d7a6e 100%);
            border-radius: 20px;
            padding: 28px 30px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
            animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1) both;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            right: -60px;
            top: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            pointer-events: none;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            left: -40px;
            bottom: -60px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            pointer-events: none;
        }

        .hero-avatar {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            color: #fff;
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 2.5px solid rgba(255, 255, 255, .2);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .2);
            position: relative;
            z-index: 1;
        }

        .hero-info {
            flex: 1;
            position: relative;
            z-index: 1;
            min-width: 0;
        }

        .hero-name {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.45rem;
            color: #fff;
            letter-spacing: -.3px;
        }

        .hero-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 9px;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            color: #fff;
            font-size: .72rem;
            font-weight: 600;
        }

        .hero-right {
            position: relative;
            z-index: 1;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: .8rem;
            font-weight: 700;
        }

        .status-pill.pending {
            background: rgba(251, 191, 36, .2);
            color: #fcd34d;
            border: 1px solid rgba(251, 191, 36, .3);
        }

        .status-pill.lolos_berkas {
            background: rgba(13, 122, 110, .3);
            color: #6ee7b7;
            border: 1px solid rgba(13, 122, 110, .4);
        }

        .status-pill.diterima {
            background: rgba(52, 211, 153, .2);
            color: #6ee7b7;
            border: 1px solid rgba(52, 211, 153, .3);
        }

        .status-pill.ditolak,
        .status-pill.tidak_lolos_berkas {
            background: rgba(248, 113, 113, .2);
            color: #fca5a5;
            border: 1px solid rgba(248, 113, 113, .3);
        }

        /* stat mini cards */
        .mini-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 13px;
            margin-bottom: 22px;
        }

        .mini-card {
            background: var(--white);
            border-radius: 14px;
            padding: 16px 18px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeUp .4s cubic-bezier(.22, 1, .36, 1) both;
        }

        .mini-card:nth-child(2) {
            animation-delay: .06s;
        }

        .mini-card:nth-child(3) {
            animation-delay: .12s;
        }

        .mini-card:nth-child(4) {
            animation-delay: .18s;
        }

        .mc-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .88rem;
            flex-shrink: 0;
        }

        .mc-icon.berkas {
            background: var(--teal-lt);
            color: var(--teal);
        }

        .mc-icon.prog {
            background: #fdf3e3;
            color: var(--gold);
        }

        .mc-icon.kuis {
            background: #eef2ff;
            color: #4338ca;
        }

        .mc-num {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
        }

        .mc-lbl {
            font-size: .7rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 2px;
        }

        /* info grid */
        .card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--line);
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            margin-bottom: 18px;
            animation: fadeUp .4s .08s cubic-bezier(.22, 1, .36, 1) both;
        }

        .card-header {
            padding: 16px 20px 12px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--teal-lt);
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
        }

        .card-title {
            font-size: .88rem;
            font-weight: 700;
            color: var(--ink);
        }

        .card-body {
            padding: 16px 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
        }

        .info-item {
            background: var(--bg);
            border-radius: 10px;
            padding: 10px 13px;
            border: 1px solid var(--line);
        }

        .info-item.full {
            grid-column: 1/-1;
        }

        .info-label {
            font-size: .62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .info-value {
            font-size: .84rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.5;
        }

        .info-value.empty {
            color: var(--muted);
            font-weight: 400;
            font-style: italic;
            font-size: .78rem;
        }

        /* kuis list */
        .kuis-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
        }

        .kuis-row:last-child {
            border-bottom: none;
        }

        .kuis-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: #eef2ff;
            color: #4338ca;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            flex-shrink: 0;
        }

        .kuis-name {
            font-weight: 600;
            font-size: .84rem;
            color: var(--ink);
        }

        .kuis-meta {
            font-size: .72rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .kuis-badge {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .7rem;
            font-weight: 700;
        }

        .kuis-badge.lulus {
            background: #edf7f2;
            color: var(--green);
        }

        .kuis-badge.gagal {
            background: #fdf0ef;
            color: var(--red);
        }

        .kuis-badge.pending {
            background: #fef9ec;
            color: var(--amber);
        }

        .no-kuis {
            text-align: center;
            padding: 28px;
            color: var(--muted);
            font-size: .83rem;
        }

        .no-kuis i {
            display: block;
            font-size: 1.8rem;
            margin-bottom: 8px;
            opacity: .3;
        }

        /* ════════════ TEMPLATE DOWNLOAD ════════════ */
        .template-card-wrap {
            background: var(--white);
            border-radius: 18px;
            border: 1px solid var(--line);
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            margin-bottom: 20px;
            overflow: hidden;
            animation: fadeUp .4s .05s cubic-bezier(.22, 1, .36, 1) both;
        }

        /* top row */
        .template-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            padding: 20px 22px 0;
            flex-wrap: wrap;
        }

        .template-top-left {
            flex: 1;
        }

        .template-heading {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .template-heading-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(13, 122, 110, .3);
        }

        .template-heading-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ink);
            margin-top: 2px;
        }

        .template-caption {
            font-size: .76rem;
            color: var(--muted);
            margin-top: 4px;
            line-height: 1.5;
        }

        .template-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 13px;
            border-radius: 20px;
            background: var(--teal-lt);
            border: 1px solid var(--teal-mid);
            color: var(--teal-dk);
            font-size: .72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        /* info bar */
        .template-info-bar {
            margin: 14px 22px 0;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            background: #fdf9ec;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: .76rem;
            color: #92400e;
            line-height: 1.5;
        }

        .template-info-bar i {
            color: var(--amber);
            flex-shrink: 0;
            margin-top: 1px;
            font-size: .82rem;
        }

        /* grid of 4 cards */
        .template-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            padding: 18px 22px 22px;
        }

        /* each card */
        .template-box {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 16px 16px 14px;
            background: var(--bg);
            border: 1.5px solid var(--line);
            border-radius: 14px;
            text-decoration: none;
            transition: border .22s, box-shadow .22s, transform .22s, background .22s;
            cursor: pointer;
        }

        .template-box:hover {
            border-color: var(--teal);
            background: var(--white);
            box-shadow: 0 8px 28px rgba(13, 122, 110, .14);
            transform: translateY(-3px);
        }

        .template-box:active {
            transform: translateY(-1px);
        }

        /* glow on hover */
        .tb-glow {
            position: absolute;
            inset: 0;
            border-radius: 13px;
            background: radial-gradient(ellipse at 50% 0%, rgba(13, 122, 110, .08) 0%, transparent 70%);
            opacity: 0;
            transition: opacity .3s;
            pointer-events: none;
        }

        .template-box:hover .tb-glow {
            opacity: 1;
        }

        /* header row inside card */
        .tb-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .template-file-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .template-file-icon.word {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .tb-ext-badge {
            font-size: .58rem;
            font-weight: 800;
            letter-spacing: .6px;
            padding: 2px 7px;
            border-radius: 5px;
            background: var(--line);
            color: var(--muted);
            align-self: flex-start;
        }

        /* required template extra styles */
        .required-template {
            border-color: #fde68a;
            background: linear-gradient(160deg, #fffbeb 0%, var(--bg) 100%);
        }

        .required-template:hover {
            border-color: var(--gold);
            box-shadow: 0 8px 28px rgba(201, 146, 42, .18);
        }

        .tb-required-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: .6rem;
            font-weight: 800;
            letter-spacing: .3px;
            padding: 3px 8px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--gold), #a0730e);
            color: #fff;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(201, 146, 42, .3);
        }

        /* text */
        .template-file-name {
            font-size: .82rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
            margin-top: 2px;
        }

        .tb-desc {
            font-size: .7rem;
            color: var(--muted);
            line-height: 1.45;
            flex: 1;
        }

        /* download button row */
        .template-download {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 6px;
            padding-top: 10px;
            border-top: 1px solid var(--line);
        }

        .td-text {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .74rem;
            font-weight: 700;
            color: var(--teal);
            transition: gap .2s;
        }

        .template-box:hover .td-text {
            gap: 9px;
        }

        .td-arrow {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            background: var(--teal-lt);
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .68rem;
            transition: background .2s, transform .2s;
        }

        .template-box:hover .td-arrow {
            background: var(--teal);
            color: #fff;
            transform: translateX(2px);
        }

        .required-template .td-text {
            color: var(--gold);
        }

        .required-template .td-arrow {
            background: var(--gold-lt);
            color: var(--gold);
        }

        .required-template:hover .td-arrow {
            background: var(--gold);
            color: #fff;
        }

        /* download flash animation on click */
        @keyframes dlFlash {
            0% {
                opacity: 1;
            }

            30% {
                opacity: .5;
                transform: scale(.97);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .template-box.downloading {
            animation: dlFlash .4s ease;
        }

        /* responsive */
        @media (max-width: 900px) {
            .template-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .template-grid {
                grid-template-columns: 1fr;
            }

            .template-top {
                flex-direction: column;
            }
        }

        /* ════════════ PROGRESS BAR ════════════ */
        /* progress bar */
        .progress-bar-wrap {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--line);
            padding: 18px 22px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
        }

        .pb-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .pb-label {
            font-size: .84rem;
            font-weight: 700;
            color: var(--ink);
        }

        .pb-pct {
            font-size: .84rem;
            font-weight: 800;
            color: var(--teal);
        }

        .pb-bar {
            height: 8px;
            background: var(--bg);
            border-radius: 20px;
            overflow: hidden;
        }

        .pb-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--teal), #34d399);
            border-radius: 20px;
            transition: width .8s cubic-bezier(.22, 1, .36, 1);
        }

        .pb-bottom {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: .72rem;
            color: var(--muted);
        }

        /* file grid */
        .file-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 14px;
        }

        /* file card */
        .file-card {
            background: var(--white);
            border-radius: 16px;
            border: 2px solid var(--line);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: border .2s, box-shadow .2s;
            position: relative;
            animation: fadeUp .35s cubic-bezier(.22, 1, .36, 1) both;
        }

        .file-card:hover {
            border-color: var(--teal-mid);
            box-shadow: 0 4px 18px rgba(13, 122, 110, .1);
        }

        .file-card.uploaded {
            border-color: #86efac;
        }

        .file-card.uploading {
            border-color: var(--teal-mid);
        }

        .file-card .required-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: .6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
            padding: 2px 7px;
            border-radius: 5px;
            background: #fef9ec;
            color: var(--amber);
            border: 1px solid #fde68a;
        }

        .file-card .optional-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: .6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            padding: 2px 7px;
            border-radius: 5px;
            background: var(--bg);
            color: var(--muted);
            border: 1px solid var(--line);
        }

        .fc-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .fc-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
            transition: background .2s;
        }

        .file-card.uploaded .fc-icon-wrap {
            background: #dcfce7;
            color: var(--green);
        }

        .file-card:not(.uploaded) .fc-icon-wrap {
            background: var(--bg);
            color: var(--muted);
        }

        .fc-name {
            font-size: .84rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
            flex: 1;
            padding-right: 50px;
        }

        .fc-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            font-weight: 600;
        }

        .fc-status.done {
            color: var(--green);
        }

        .fc-status.empty {
            color: var(--muted);
        }

        .fc-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .fc-status.done .fc-status-dot {
            background: var(--green);
        }

        .fc-status.empty .fc-status-dot {
            background: var(--line);
        }

        /* drop zone */
        .drop-zone {
            border: 2px dashed var(--line);
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: border .2s, background .2s;
            position: relative;
        }

        .drop-zone:hover,
        .drop-zone.drag-over {
            border-color: var(--teal);
            background: var(--teal-lt);
        }

        .drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .dz-icon {
            font-size: 1.3rem;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .dz-text {
            font-size: .74rem;
            color: var(--muted);
            font-weight: 500;
        }

        .dz-text strong {
            color: var(--teal);
        }

        .dz-hint {
            font-size: .66rem;
            color: var(--muted);
            margin-top: 3px;
            opacity: .8;
        }

        /* file uploaded state */
        .fc-file-info {
            display: none;
            background: var(--bg);
            border-radius: 9px;
            padding: 10px 12px;
            border: 1px solid var(--line);
        }

        .file-card.uploaded .fc-file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-card.uploaded .drop-zone {
            display: none;
        }

        .ffi-icon {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .ffi-icon.pdf {
            color: #e74c3c;
        }

        .ffi-icon.img {
            color: #3b82f6;
        }

        .ffi-name {
            font-size: .78rem;
            font-weight: 600;
            color: var(--ink);
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .ffi-actions {
            display: flex;
            gap: 5px;
            flex-shrink: 0;
        }

        .ffi-btn {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            border: 1.5px solid var(--line);
            background: var(--white);
            color: var(--muted);
            cursor: pointer;
            font-size: .72rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .18s;
        }

        .ffi-btn.view:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: var(--teal-lt);
        }

        .ffi-btn.del:hover {
            border-color: var(--red);
            color: var(--red);
            background: #fdf0ef;
        }

        .ffi-btn.replace {
            position: relative;
        }

        .ffi-btn.replace input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .ffi-btn.replace:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-lt);
        }

        /* upload progress overlay */
        .upload-overlay {
            display: none;
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, .88);
            border-radius: 14px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
            z-index: 10;
            backdrop-filter: blur(2px);
        }

        .file-card.uploading .upload-overlay {
            display: flex;
        }

        .up-spinner {
            width: 32px;
            height: 32px;
            border: 3px solid var(--teal-lt);
            border-top-color: var(--teal);
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .up-pct {
            font-size: .8rem;
            font-weight: 700;
            color: var(--teal);
        }

        /* ── lightbox ── */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .88);
            z-index: 999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .lightbox.open {
            display: flex;
        }

        .lightbox img {
            max-width: 90vw;
            max-height: 88vh;
            border-radius: 12px;
            object-fit: contain;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
        }

        .lbx-close {
            position: absolute;
            top: 18px;
            right: 18px;
            background: rgba(255, 255, 255, .12);
            border: none;
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            font-size: .9rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lbx-close:hover {
            background: rgba(255, 255, 255, .22);
        }

        /* responsive */
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

            .file-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .btn-tanda-terima {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 9px 18px;
            background: linear-gradient(135deg, #116040 0%, #22a06b 100%);
            color: #fff;
            font-size: .83rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(34, 160, 107, .35);
            transition: all .2s cubic-bezier(.4, 0, .2, 1);
            white-space: nowrap;
            width: 100%;
            justify-content: center;
        }

        .btn-tanda-terima:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 160, 107, .45);
            color: #fff;
            text-decoration: none;
        }

        .btn-tanda-terima:active {
            transform: translateY(0);
        }

        .btn-tanda-terima i {
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <div class="layout">

        {{-- ════════════ SIDEBAR ════════════ --}}
        <aside class="sidebar" id="sidebar">
            <div class="sb-brand">
                <img src="{{ asset('Lambang-kabupaten-jember.png') }}" alt="Logo">
                <div>
                    <div class="sb-brand-name">Sistem Rekrutmen</div>
                    <div class="sb-brand-sub">Portal Pelamar</div>
                </div>
            </div>
            <div class="sb-nav">
                <div class="sb-section">Menu</div>
                <button class="sb-link active" id="navDashboard" onclick="showSection('dashboard')">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </button>
                <button class="sb-link" id="navUpload" onclick="showSection('upload')">
                    <i class="fa-solid fa-upload"></i> Unggah Berkas
                    @php
                        $uploaded = $uploadedFiles->count();
                        $uploadedFiles = $uploadedFiles ?? collect();
                        $required = collect($jenisFile)->where('required', true)->count();
                    @endphp
                    @if ($uploaded < $required)
                        <span
                            style="margin-left:auto;background:var(--gold);color:#fff;font-size:.6rem;font-weight:800;border-radius:20px;padding:2px 7px">{{ $required - $uploaded }}</span>
                    @endif
                </button>
            </div>
            <div class="sb-footer">
                <div class="sb-user">
                    <div class="sb-avatar">{{ strtoupper(substr($pelamar->nama, 0, 1)) }}</div>
                    <div>
                        <div class="sb-user-name">{{ Str::limit($pelamar->nama, 18) }}</div>
                        <div class="sb-user-role">Pelamar</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sb-logout" title="Keluar"><i
                                class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                </div>
            </div>
        </aside>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ════════════ MAIN ════════════ --}}
        <div class="main-wrap">
            <header class="topbar">
                <button class="topbar-toggle" id="sbToggle"><i class="fa-solid fa-bars"></i></button>
                <div>
                    <div class="topbar-title" id="topbarTitle">Dashboard</div>
                    <div class="topbar-sub" id="topbarSub">Selamat datang, {{ $pelamar->nama }}</div>
                </div>
                <div class="topbar-right">
                    <div style="font-size:.74rem;color:var(--muted);background:var(--bg);padding:6px 12px;border-radius:8px;font-weight:500"
                        id="liveClock"></div>
                </div>
            </header>

            <main class="page-body">
                <div class="toast-container" id="toastCont"></div>

                {{-- ════════ DASHBOARD ════════ --}}
                <div class="page-section active" id="secDashboard">

                    {{-- Hero --}}
                    <div class="hero-card">
                        <div class="hero-avatar">{{ strtoupper(substr($pelamar->nama, 0, 1)) }}</div>
                        <div class="hero-info">
                            <div class="hero-name">{{ $pelamar->nama }}</div>
                            <div class="hero-chips">
                                <span class="hero-chip"><i class="fa-solid fa-briefcase"></i>
                                    {{ $pelamar->posisi->nama_posisi ?? '-' }}</span>
                                <span class="hero-chip"><i class="fa-solid fa-id-badge"></i>
                                    {{ $pelamar->nomer_peserta ?? 'Belum ada no. peserta' }}</span>
                                <span class="hero-chip"><i class="fa-solid fa-calendar"></i> Daftar
                                    {{ $pelamar->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="hero-right">
                            @php $st = $pelamar->status_pelamar; @endphp
                            <div class="status-pill {{ $st }}">
                                <i
                                    class="fa-solid fa-{{ $st === 'diterima' ? 'circle-check' : ($st === 'pending' ? 'clock' : 'user-check') }}"></i>
                                {{ str_replace('_', ' ', ucwords($st, '_')) }}
                            </div>
                        </div>
                    </div>

                    {{-- Mini stats --}}
                    <div class="mini-grid">
                        <div class="mini-card">
                            <div class="mc-icon berkas"><i class="fa-solid fa-folder-open"></i></div>
                            <div>
                                <div class="mc-num">{{ $uploadedFiles->count() }}</div>
                                <div class="mc-lbl">Berkas Diunggah</div>
                            </div>
                        </div>
                        <div class="mini-card">
                            <div class="mc-icon prog"><i class="fa-solid fa-percent"></i></div>
                            <div>
                                <div class="mc-num">{{ $progress }}%</div>
                                <div class="mc-lbl">Kelengkapan Wajib</div>
                                @if ($progress >= 100)
                                    {{-- Tombol muncul hanya saat semua berkas wajib sudah lengkap --}}
                                    <a href="{{ asset('file_template/12. TANDA TERIMA BERKAS PELAMAR.docx') }}"
                                        class="btn-tanda-terima" title="Unduh Tanda Terima Berkas">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                        <span>Unduh Tanda Terima</span>
                                    </a>
                                @endif
                            </div>

                        </div>
                        <div class="mini-card">
                            <div class="mc-icon kuis"><i class="fa-solid fa-graduation-cap"></i></div>
                            <div>
                                <a href="{{ route('Pelamar.hasil', $pelamar->token) }}" class="btn-tanda-terima"
                                    title="Unduh Kartu Pelamar">
                                    <i class="fa-solid fa-id-card"></i>
                                    <span>Cetak Kartu Pelamar</span>
                                </a>
                                {{-- <div class="mc-num">{{ $pengerjaanList->count() }}</div> --}}
                                <div class="mc-lbl">Kartu Pelamar</div>
                            </div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;flex-wrap:wrap">

                        {{-- Info Pribadi --}}
                        <div class="card" style="grid-column:span 2">
                            <div class="card-header">
                                <div class="card-header-icon"><i class="fa-solid fa-id-card"></i></div>
                                <div class="card-title">Informasi Pribadi</div>
                            </div>
                            <div class="card-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">NIK</div>
                                        <div class="info-value {{ !$pelamar->nik ? 'empty' : '' }}">
                                            {{ $pelamar->nik ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Jenis Kelamin</div>
                                        <div class="info-value {{ !$pelamar->jenis_kelamin ? 'empty' : '' }}">
                                            {{ $pelamar->jenis_kelamin ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">No. Handphone</div>
                                        <div class="info-value {{ !$pelamar->no_hp ? 'empty' : '' }}">
                                            {{ $pelamar->no_hp ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">{{ $pelamar->email }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Kota Domisili</div>
                                        <div class="info-value {{ !$pelamar->kota_domisili ? 'empty' : '' }}">
                                            {{ $pelamar->kota_domisili ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Jenjang Pendidikan</div>
                                        <div class="info-value {{ !$pelamar->jenjang ? 'empty' : '' }}">
                                            {{ $pelamar->jenjang ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">No. Ijazah</div>
                                        <div class="info-value {{ !$pelamar->no_ijasah ? 'empty' : '' }}">
                                            {{ $pelamar->no_ijasah ?? 'Tidak diisi' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Pengalaman Kerja</div>
                                        <div class="info-value">{{ $pelamar->pengalaman_kerja ? 'Ya' : 'Tidak' }}
                                        </div>
                                    </div>
                                    @if ($pelamar->keterangan_pengalaman)
                                        <div class="info-item full">
                                            <div class="info-label">Keterangan Pengalaman</div>
                                            <div class="info-value">{{ $pelamar->keterangan_pengalaman }}</div>
                                        </div>
                                    @endif
                                    @if ($pelamar->alamat)
                                        <div class="info-item full">
                                            <div class="info-label">Alamat</div>
                                            <div class="info-value">{{ $pelamar->alamat }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Status Kuis --}}
                        <div class="card" style="grid-column:span 2">
                            <div class="card-header">
                                <div class="card-header-icon" style="background:#eef2ff;color:#4338ca"><i
                                        class="fa-solid fa-graduation-cap"></i></div>
                                <div class="card-title">Status Pengerjaan Kuis</div>
                            </div>
                            <div class="card-body" style="padding-top:0">
                                @if ($pengerjaanList->count())
                                    @foreach ($pengerjaanList as $kuis)
                                        <div class="kuis-row">
                                            <div class="kuis-icon"><i class="fa-solid fa-clipboard-question"></i>
                                            </div>
                                            <div>
                                                <div class="kuis-name">{{ $kuis['nama_kuis'] }}</div>
                                                <div class="kuis-meta">Nilai: {{ $kuis['nilai'] ?? '—' }}</div>
                                            </div>
                                            <span class="kuis-badge {{ $kuis['status'] }}">
                                                <i
                                                    class="fa-solid fa-{{ $kuis['status'] === 'lulus' ? 'circle-check' : ($kuis['status'] === 'gagal' ? 'circle-xmark' : 'hourglass-half') }}"></i>
                                                {{ ucfirst($kuis['status']) }}
                                            </span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-kuis"><i class="fa-solid fa-clipboard-question"></i>
                                        <p>Belum ada kuis yang dikerjakan</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    @if ($pelamar->catatan)
                        <div class="card" style="margin-top:0">
                            <div class="card-header">
                                <div class="card-header-icon" style="background:#fdf3e3;color:var(--gold)"><i
                                        class="fa-solid fa-note-sticky"></i></div>
                                <div class="card-title">Catatan dari Admin</div>
                            </div>
                            <div class="card-body">
                                <p style="font-size:.85rem;color:var(--ink2);line-height:1.65">{{ $pelamar->catatan }}
                                </p>
                            </div>
                        </div>
                    @endif

                </div>{{-- /secDashboard --}}

                {{-- ════════ UPLOAD SECTION ════════ --}}
                <div class="page-section" id="secUpload">

                    <div class="upload-header">
                        <h2>Unggah Berkas Dokumen</h2>
                        <p>Upload semua dokumen yang diperlukan dalam format PDF (maks. 1 MB per file)
                        </p>
                    </div>

                    {{-- ════════ TEMPLATE DOWNLOAD ════════ --}}
                    <div class="template-card-wrap">

                        <div class="template-top">
                            <div class="template-top-left">
                                <div class="template-heading">
                                    <span class="template-heading-icon"><i
                                            class="fa-solid fa-file-arrow-down"></i></span>
                                    <div>
                                        <div class="template-heading-title">Template Berkas Wajib</div>
                                        <div class="template-caption">Download dan gunakan format resmi sebelum upload
                                            berkas lamaran.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="template-top-right">
                                <div class="template-badge"><i class="fa-solid fa-circle-info"></i> 4 Template
                                    Tersedia</div>
                            </div>
                        </div>

                        {{-- info banner --}}
                        <div class="template-info-bar">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Pastikan menggunakan template resmi di bawah ini. Berkas yang tidak sesuai format
                                dapat menyebabkan penolakan lamaran.</span>
                        </div>

                        <div class="template-grid">

                            {{-- ITEM 1 --}}
                            <a href="{{ asset('file_template/1. TEMPLATE SURAT LAMARAN PEKERJAAN.docx') }}"
                                class="template-box" download data-name="Surat Lamaran">
                                <div class="tb-glow"></div>
                                <div class="tb-header">
                                    <div class="template-file-icon word">
                                        <i class="fa-solid fa-file-word"></i>
                                    </div>
                                    <span class="tb-ext-badge">DOCX</span>
                                </div>
                                <div class="template-file-name">Surat Lamaran Pekerjaan</div>
                                <div class="tb-desc">Template resmi surat lamaran untuk RSD Kalisat</div>
                                <div class="template-download">
                                    <span class="td-text"><i class="fa-solid fa-download"></i> Download</span>
                                    <span class="td-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </a>

                            {{-- ITEM 2 --}}
                            <a href="{{ asset('file_template/2. TEMPLATE CURRICULUM VITAE.docx') }}"
                                class="template-box" download data-name="Curriculum Vitae">
                                <div class="tb-glow"></div>
                                <div class="tb-header">
                                    <div class="template-file-icon word">
                                        <i class="fa-solid fa-file-word"></i>
                                    </div>
                                    <span class="tb-ext-badge">DOCX</span>
                                </div>
                                <div class="template-file-name">Curriculum Vitae (CV)</div>
                                <div class="tb-desc">Format CV standar yang diterima sistem rekrutmen</div>
                                <div class="template-download">
                                    <span class="td-text"><i class="fa-solid fa-download"></i> Download</span>
                                    <span class="td-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </a>

                            {{-- ITEM 3 --}}
                            <a href="{{ asset('file_template/3. SURAT PERNYATAAN TDK MENUNTUT JADI ASN.docx') }}"
                                class="template-box" download data-name="Pernyataan ASN">
                                <div class="tb-glow"></div>
                                <div class="tb-header">
                                    <div class="template-file-icon word">
                                        <i class="fa-solid fa-file-word"></i>
                                    </div>
                                    <span class="tb-ext-badge">DOCX</span>
                                </div>
                                <div class="template-file-name">Pernyataan Tidak Menuntut ASN</div>
                                <div class="tb-desc">Surat pernyataan tidak menuntut pengangkatan sebagai ASN</div>
                                <div class="template-download">
                                    <span class="td-text"><i class="fa-solid fa-download"></i> Download</span>
                                    <span class="td-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </a>

                            {{-- ITEM 4 --}}
                            <a href="{{ asset('file_template/4. SURAT PERNYATAAN KEBENARAN DOKUMEN.docx') }}"
                                class="template-box" download data-name="Pernyataan Kebenaran Dokumen">
                                <div class="tb-glow"></div>
                                <div class="tb-header">
                                    <div class="template-file-icon word">
                                        <i class="fa-solid fa-file-word"></i>
                                    </div>
                                    <span class="tb-ext-badge">DOCX</span>
                                </div>
                                <div class="template-file-name">Pernyataan Kebenaran Dokumen</div>
                                <div class="tb-desc">Surat pernyataan tentang kebenaran dokumen yang diajukan</div>
                                <div class="template-download">
                                    <span class="td-text"><i class="fa-solid fa-download"></i> Download</span>
                                    <span class="td-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>{{-- /template-grid --}}

                    </div>{{-- /template-card-wrap --}}

                    {{-- progress --}}
                    <div class="progress-bar-wrap">
                        <div class="pb-top">
                            <div class="pb-label">Kelengkapan Berkas Wajib</div>
                            <div class="pb-pct" id="pbPct">{{ $progress }}%</div>
                        </div>
                        <div class="pb-bar">
                            <div class="pb-fill" id="pbFill" style="width:{{ $progress }}%"></div>
                        </div>
                        <div class="pb-bottom">
                            <span id="pbDone">{{ $complete }} dari
                                {{ collect($jenisFile)->where('required', true)->count() }} berkas wajib
                                terpenuhi</span>
                            <span
                                id="pbOptional">{{ collect($jenisFile)->where('required', false)->filter(fn($v, $k) => $uploadedFiles->has($k))->count() }}
                                berkas opsional diunggah</span>
                        </div>
                    </div>

                    {{-- file cards --}}
                    <div class="file-grid">
                        @foreach ($jenisFile as $key => $meta)
                            @php
                                $existing = $uploadedFiles->get($key);
                                $isUploaded = !is_null($existing);
                                $ext = $isUploaded ? pathinfo($existing->file_path, PATHINFO_EXTENSION) : null;
                                $isPdf = $ext === 'pdf';
                            @endphp
                            <div class="file-card {{ $isUploaded ? 'uploaded' : '' }}" id="fc-{{ $key }}">

                                {{-- badge wajib/opsional --}}
                                @if ($meta['required'])
                                    <span class="required-badge">Wajib</span>
                                @else
                                    <span class="optional-badge">Opsional</span>
                                @endif

                                {{-- upload overlay --}}
                                <div class="upload-overlay" id="upov-{{ $key }}">
                                    <div class="up-spinner"></div>
                                    <div class="up-pct" id="uppct-{{ $key }}">0%</div>
                                </div>

                                {{-- header --}}
                                <div class="fc-top">
                                    <div class="fc-icon-wrap">
                                        <i class="fa-solid {{ $meta['icon'] }}"></i>
                                    </div>
                                    <div class="fc-name">{{ $meta['label'] }}</div>
                                </div>

                                {{-- status --}}
                                <div class="fc-status {{ $isUploaded ? 'done' : 'empty' }}"
                                    id="fcStatus-{{ $key }}">
                                    <div class="fc-status-dot"></div>
                                    <span
                                        id="fcStatusTxt-{{ $key }}">{{ $isUploaded ? 'Sudah diunggah' : 'Belum ada file' }}</span>
                                </div>

                                {{-- uploaded info --}}
                                <div class="fc-file-info" id="ffi-{{ $key }}">
                                    @if ($isUploaded)
                                        <i
                                            class="ffi-icon {{ $isPdf ? 'pdf' : 'img' }} fa-solid {{ $isPdf ? 'fa-file-pdf' : 'fa-file-image' }}"></i>
                                        <span class="ffi-name"
                                            id="ffiName-{{ $key }}">{{ basename($existing->file_path) }}</span>
                                        <div class="ffi-actions">
                                            <button class="ffi-btn view" title="Lihat"
                                                onclick="viewFile('{{ route('file.view', $existing->id) }}','{{ $ext }}')"><i
                                                    class="fa-solid fa-eye"></i></button>
                                            <label class="ffi-btn replace" title="Ganti file">
                                                <i class="fa-solid fa-arrow-rotate-right"></i>
                                                <input type="file" accept=".pdf,.jpg,.jpeg,.png"
                                                    onchange="handleUpload(this,'{{ $key }}')">
                                            </label>
                                            <button class="ffi-btn del" title="Hapus"
                                                onclick="handleDelete('{{ $key }}')"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </div>
                                    @endif
                                </div>

                                {{-- drop zone (shown when not uploaded) --}}
                                <div class="drop-zone" id="dz-{{ $key }}"
                                    ondragover="dzDrag(event,true,'{{ $key }}')"
                                    ondragleave="dzDrag(event,false,'{{ $key }}')"
                                    ondrop="dzDrop(event,'{{ $key }}')">
                                    <input type="file" accept=".pdf,.jpg,.jpeg,.png"
                                        onchange="handleUpload(this,'{{ $key }}')">
                                    <div class="dz-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                    <div class="dz-text"><strong>Klik</strong> atau seret file ke sini</div>
                                    <div class="dz-hint">PDF · Maks. 1 MB</div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>{{-- /secUpload --}}

            </main>
        </div>{{-- /main-wrap --}}
    </div>{{-- /layout --}}

    {{-- LIGHTBOX --}}
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lbx-close" onclick="closeLightbox()"><i class="fa-solid fa-xmark"></i></button>
        <img src="" alt="preview" id="lbxImg">
    </div>

    {{-- Pre-compute JS data in PHP before <script> --}}
    @php
        $jsRequired = collect($jenisFile)->where('required', true)->keys()->values()->toJson();
        $jsOptional = collect($jenisFile)->where('required', false)->keys()->values()->toJson();
        $jsUploaded = $uploadedFiles->keys()->values()->toJson();
        $uploadUrl = route('file.upload');
        $deleteUrlBase = rtrim(route('file.delete', ['jenis' => '__JENIS__']), '');
    @endphp

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        // ── clock ──────────────────────────────────────────
        (function tick() {
            const now = new Date();
            document.getElementById('liveClock').textContent =
                now.toLocaleDateString('id-ID', {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                }) +
                ' · ' + now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            setTimeout(tick, 1000);
        })();

        // ── sidebar mobile ──────────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        document.getElementById('sbToggle').addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });

        // ── section switch ──────────────────────────────────
        const SEC_META = {
            dashboard: {
                title: 'Dashboard',
                sub: 'Ringkasan informasi pendaftaran Anda'
            },
            upload: {
                title: 'Unggah Berkas',
                sub: 'Lengkapi dokumen persyaratan pendaftaran'
            },
        };

        function showSection(sec) {
            document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sb-link').forEach(l => l.classList.remove('active'));
            document.getElementById('sec' + cap(sec)).classList.add('active');
            document.getElementById('nav' + cap(sec)).classList.add('active');
            document.getElementById('topbarTitle').textContent = SEC_META[sec].title;
            document.getElementById('topbarSub').textContent = SEC_META[sec].sub;
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }

        function cap(s) {
            return s.charAt(0).toUpperCase() + s.slice(1);
        }

        // ── progress counters ──────────────────────────────
        const REQUIRED_KEYS = new Set({!! $jsRequired !!});
        const OPTIONAL_KEYS = new Set({!! $jsOptional !!});
        const uploadedSet = new Set({!! $jsUploaded !!});

        function refreshProgress() {
            const done = [...REQUIRED_KEYS].filter(k => uploadedSet.has(k)).length;
            const total = REQUIRED_KEYS.size;
            const pct = total > 0 ? Math.round((done / total) * 100) : 0;
            const optDone = [...OPTIONAL_KEYS].filter(k => uploadedSet.has(k)).length;
            document.getElementById('pbPct').textContent = pct + '%';
            document.getElementById('pbFill').style.width = pct + '%';
            document.getElementById('pbDone').textContent = `${done} dari ${total} berkas wajib terpenuhi`;
            document.getElementById('pbOptional').textContent = `${optDone} berkas opsional diunggah`;
        }

        // ── UPLOAD ─────────────────────────────────────────
        function handleUpload(input, jenis) {
            const file = input.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                toast('Ukuran file maks. 5 MB.', 'error');
                input.value = '';
                return;
            }
            const allowed = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
            if (!allowed.includes(file.type)) {
                toast('Format harus PDF, JPG, atau PNG.', 'error');
                input.value = '';
                return;
            }
            doUpload(file, jenis);
        }

        function dzDrop(e, jenis) {
            e.preventDefault();
            dzDrag(e, false, jenis);
            const f = e.dataTransfer.files[0];
            if (f) handleUpload({
                files: [f],
                value: ''
            }, jenis);
        }

        function dzDrag(e, on, jenis) {
            e.preventDefault();
            document.getElementById('dz-' + jenis).classList.toggle('drag-over', on);
        }

        async function doUpload(file, jenis) {
            const card = document.getElementById('fc-' + jenis);
            card.classList.add('uploading');
            const fd = new FormData();
            fd.append('jenis_file', jenis);
            fd.append('file', file);
            fd.append('_token', CSRF);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{!! $uploadUrl !!}', true);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);

            xhr.upload.onprogress = e => {
                if (e.lengthComputable) {
                    document.getElementById('uppct-' + jenis).textContent = Math.round(e.loaded / e.total * 100) +
                        '%';
                }
            };
            xhr.onload = () => {
                card.classList.remove('uploading');
                try {
                    const data = JSON.parse(xhr.responseText);
                    if (data.success) {
                        setCardUploaded(jenis, data.data, file.name);
                        uploadedSet.add(jenis);
                        refreshProgress();
                        toast(data.message, 'success');
                    } else {
                        toast(data.message || 'Upload gagal', 'error');
                    }
                } catch (e) {
                    toast('Terjadi kesalahan server', 'error');
                }
            };
            xhr.onerror = () => {
                card.classList.remove('uploading');
                toast('Gagal terhubung ke server', 'error');
            };
            xhr.send(fd);
        }

        function setCardUploaded(jenis, fileData, originalName) {
            const card = document.getElementById('fc-' + jenis);
            const ext = fileData.ext || (fileData.url.includes('.pdf') ? 'pdf' : 'jpg');
            const isPdf = ext === 'pdf';
            card.classList.add('uploaded');
            card.classList.remove('uploading');
            document.getElementById('dz-' + jenis).style.display = 'none';

            const ffi = document.getElementById('ffi-' + jenis);
            ffi.style.display = 'flex';
            ffi.innerHTML = `
        <i class="ffi-icon ${isPdf?'pdf':'img'} fa-solid ${isPdf?'fa-file-pdf':'fa-file-image'}"></i>
        <span class="ffi-name">${esc(originalName)}</span>
        <div class="ffi-actions">
            <button class="ffi-btn view" title="Lihat" onclick="viewFile('${fileData.url}','${ext}')"><i class="fa-solid fa-eye"></i></button>
            <label class="ffi-btn replace" title="Ganti file">
                <i class="fa-solid fa-arrow-rotate-right"></i>
                <input type="file" accept=".pdf,.jpg,.jpeg,.png" onchange="handleUpload(this,'${jenis}')">
            </label>
            <button class="ffi-btn del" title="Hapus" onclick="handleDelete('${jenis}')"><i class="fa-solid fa-trash"></i></button>
        </div>`;

            const st = document.getElementById('fcStatus-' + jenis);
            st.className = 'fc-status done';
            st.innerHTML = '<div class="fc-status-dot"></div><span>Sudah diunggah</span>';
        }

        // ── DELETE ─────────────────────────────────────────
        async function handleDelete(jenis) {
            const result = await Swal.fire({
                icon: 'warning',
                title: 'Hapus File?',
                text: 'File ini akan dihapus dari sistem.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#c0392b',
            });
            if (!result.isConfirmed) return;

            try {
                const deleteUrl = '{!! url('pelamar/file') !!}/' + jenis;
                const res = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    const card = document.getElementById('fc-' + jenis);
                    card.classList.remove('uploaded');
                    const ffi = document.getElementById('ffi-' + jenis);
                    ffi.style.display = 'none';
                    ffi.innerHTML = '';
                    document.getElementById('dz-' + jenis).style.display = '';
                    const st = document.getElementById('fcStatus-' + jenis);
                    st.className = 'fc-status empty';
                    st.innerHTML = '<div class="fc-status-dot"></div><span>Belum ada file</span>';
                    uploadedSet.delete(jenis);
                    refreshProgress();
                    toast(data.message, 'success');
                } else {
                    toast(data.message || 'Gagal menghapus', 'error');
                }
            } catch (e) {
                toast('Terjadi kesalahan', 'error');
            }
        }

        // ── VIEW FILE ──────────────────────────────────────
        function viewFile(url, ext) {
            if (ext === 'pdf') {
                window.open(url, '_blank');
            } else {
                document.getElementById('lbxImg').src = url;
                document.getElementById('lightbox').classList.add('open');
            }
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.getElementById('lbxImg').src = '';
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
        });

        // ── TOAST ──────────────────────────────────────────
        function toast(msg, type = 'success') {
            const box = document.createElement('div');
            box.className = `toast ${type}`;
            const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
            const col = type === 'success' ? '#1a7f5a' : '#c0392b';
            box.innerHTML = `<i class="fa-solid ${icon}" style="color:${col}"></i> ${msg}`;
            document.getElementById('toastCont').appendChild(box);
            setTimeout(() => {
                box.style.animation = 'toastOut .3s forwards';
                setTimeout(() => box.remove(), 300);
            }, 3500);
        }
        // ── TEMPLATE DOWNLOAD FLASH ────────────────────────
        document.querySelectorAll('.template-box').forEach(box => {
            box.addEventListener('click', function() {
                this.classList.add('downloading');
                const name = this.dataset.name || 'Template';
                setTimeout(() => this.classList.remove('downloading'), 450);
                setTimeout(() => toast(`Mengunduh ${name}...`, 'success'), 100);
            });
        });

        function esc(s) {
            return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }
    </script>
</body>

</html>
