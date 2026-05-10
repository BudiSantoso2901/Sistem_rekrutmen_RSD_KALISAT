@extends('Layouts.app')

@section('title', 'Dashboard Admin IT')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'SIREKRUT / Dashboard Admin IT')

@push('styles')
    {{-- Chart.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.min.css">
    {{-- Flatpickr date range (untuk filter tanggal) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        /* ══════════════════════════════════════════
                           CSS VARIABLES (extend parent theme)
                        ══════════════════════════════════════════ */
        :root {
            --dash-radius: 16px;
            --dash-shadow: 0 2px 16px rgba(0, 0, 0, .06);
            --anim-dur: .45s;
        }

        /* ══════════════════════════════════════════
                           WELCOME HERO BANNER
                        ══════════════════════════════════════════ */
        .hero-banner {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dk) 60%, #063f38 100%);
            border-radius: 20px;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            animation: fadeUp var(--anim-dur) cubic-bezier(.22, 1, .36, 1) both;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            top: -100px;
            right: -60px;
            pointer-events: none;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            bottom: -80px;
            right: 200px;
            pointer-events: none;
        }

        .hero-text {
            z-index: 1;
        }

        .hero-greeting {
            font-size: .8rem;
            color: rgba(255, 255, 255, .65);
            font-weight: 500;
            letter-spacing: .5px;
        }

        .hero-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 1.75rem;
            color: #fff;
            margin: 4px 0 8px;
            line-height: 1.2;
        }

        .hero-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .75rem;
            color: rgba(255, 255, 255, .7);
        }

        .hero-meta-item i {
            font-size: .72rem;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            z-index: 1;
            flex-shrink: 0;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            border-radius: 10px;
            font-family: inherit;
            font-size: .8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            border: 2px solid transparent;
        }

        .btn-hero-white {
            background: #fff;
            color: var(--teal-dk);
        }

        .btn-hero-white:hover {
            background: rgba(255, 255, 255, .9);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }

        .btn-hero-outline {
            background: rgba(255, 255, 255, .12);
            color: #fff;
            border-color: rgba(255, 255, 255, .25);
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, .2);
            transform: translateY(-2px);
        }

        /* ══════════════════════════════════════════
                           STATS GRID  (baris 1)
                        ══════════════════════════════════════════ */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--dash-radius);
            padding: 20px;
            border: 1px solid var(--line);
            box-shadow: var(--dash-shadow);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            animation: fadeUp var(--anim-dur) cubic-bezier(.22, 1, .36, 1) both;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 60%, rgba(13, 122, 110, .03));
            pointer-events: none;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, .1);
        }

        .stat-card:nth-child(1) {
            animation-delay: .05s
        }

        .stat-card:nth-child(2) {
            animation-delay: .10s
        }

        .stat-card:nth-child(3) {
            animation-delay: .15s
        }

        .stat-card:nth-child(4) {
            animation-delay: .20s
        }

        .stat-card:nth-child(5) {
            animation-delay: .25s
        }

        .stat-card:nth-child(6) {
            animation-delay: .30s
        }

        .stat-icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
        }

        .si-teal {
            background: var(--teal-lt);
            color: var(--teal);
        }

        .si-amber {
            background: #fef9ec;
            color: var(--amber);
        }

        .si-green {
            background: #edf7f2;
            color: var(--green);
        }

        .si-red {
            background: #fdf0ef;
            color: var(--red);
        }

        .si-blue {
            background: #eef4fb;
            color: #3b82f6;
        }

        .si-purple {
            background: #f3f0fd;
            color: #7c3aed;
        }

        .si-indigo {
            background: #eef2ff;
            color: #4f46e5;
        }

        .stat-body {
            flex: 1;
            min-width: 0;
        }

        .stat-num {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--ink);
            line-height: 1;
            font-variant-numeric: tabular-nums;
        }

        .stat-lbl {
            font-size: .73rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 4px;
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: .68rem;
            font-weight: 700;
            margin-top: 6px;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .trend-up {
            background: #edf7f2;
            color: var(--green);
        }

        .trend-down {
            background: #fdf0ef;
            color: var(--red);
        }

        .trend-flat {
            background: var(--bg);
            color: var(--muted);
        }

        /* ══════════════════════════════════════════
                           LAYOUT GRID  (charts + tables)
                        ══════════════════════════════════════════ */
        .dash-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 18px;
            margin-bottom: 20px;
        }

        .dash-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .dash-full {
            grid-column: 1 / -1;
        }

        .panel {
            background: var(--white);
            border-radius: var(--dash-radius);
            border: 1px solid var(--line);
            box-shadow: var(--dash-shadow);
            overflow: hidden;
            animation: fadeUp var(--anim-dur) cubic-bezier(.22, 1, .36, 1) both;
        }

        .panel-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .panel-title {
            font-size: .88rem;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title i {
            color: var(--teal);
            font-size: .85rem;
        }

        .panel-sub {
            font-size: .72rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .panel-body {
            padding: 20px;
        }

        .panel-body-0 {
            padding: 0;
        }

        /* chip tabs inside panel */
        .chip-tabs {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .chip-tab {
            padding: 5px 12px;
            border-radius: 20px;
            border: 1.5px solid var(--line);
            font-size: .72rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
            background: none;
            font-family: inherit;
        }

        .chip-tab:hover,
        .chip-tab.active {
            background: var(--teal-lt);
            border-color: var(--teal);
            color: var(--teal-dk);
        }

        /* ══════════════════════════════════════════
                           CHART CONTAINERS
                        ══════════════════════════════════════════ */
        .chart-area {
            position: relative;
        }

        .chart-area canvas {
            max-height: 280px;
        }

        /* ══════════════════════════════════════════
                           FUNNEL PELAMAR
                        ══════════════════════════════════════════ */
        .funnel {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .funnel-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .funnel-label {
            font-size: .75rem;
            font-weight: 600;
            color: var(--ink2);
            width: 140px;
            flex-shrink: 0;
        }

        .funnel-bar-wrap {
            flex: 1;
            background: var(--bg);
            border-radius: 20px;
            height: 10px;
            overflow: hidden;
        }

        .funnel-bar {
            height: 100%;
            border-radius: 20px;
            transition: width 1s cubic-bezier(.22, 1, .36, 1);
        }

        .funnel-count {
            font-size: .75rem;
            font-weight: 700;
            color: var(--ink);
            width: 36px;
            text-align: right;
            flex-shrink: 0;
        }

        .funnel-pct {
            font-size: .68rem;
            color: var(--muted);
            width: 36px;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
                           LEADERBOARD POSISI
                        ══════════════════════════════════════════ */
        .posisi-list {
            display: flex;
            flex-direction: column;
        }

        .posisi-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid var(--line);
            transition: background .15s;
        }

        .posisi-item:last-child {
            border-bottom: none;
        }

        .posisi-item:hover {
            background: var(--teal-lt);
        }

        .posisi-rank {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: var(--bg);
            font-size: .72rem;
            font-weight: 800;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .posisi-rank.r1 {
            background: #fef3c7;
            color: #d97706;
        }

        .posisi-rank.r2 {
            background: #f1f5f9;
            color: #64748b;
        }

        .posisi-rank.r3 {
            background: #fdf0ef;
            color: #b45309;
        }

        .posisi-name {
            flex: 1;
            font-size: .82rem;
            font-weight: 600;
            color: var(--ink);
        }

        .posisi-bar-mini {
            width: 60px;
            background: var(--bg);
            border-radius: 20px;
            height: 6px;
            overflow: hidden;
        }

        .posisi-bar-fill {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(90deg, var(--teal), var(--teal-dk));
        }

        .posisi-count-badge {
            background: var(--teal-lt);
            color: var(--teal-dk);
            font-size: .68rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
                           RECENT ACTIVITY FEED
                        ══════════════════════════════════════════ */
        .activity-feed {
            display: flex;
            flex-direction: column;
            padding: 8px 0;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 20px;
            transition: background .15s;
        }

        .activity-item:hover {
            background: var(--bg);
        }

        .activity-dot-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            flex-shrink: 0;
            padding-top: 3px;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .activity-line {
            width: 2px;
            flex: 1;
            min-height: 16px;
            background: var(--line);
            margin-top: 4px;
        }

        .activity-item:last-child .activity-line {
            display: none;
        }

        .activity-text {
            flex: 1;
        }

        .activity-msg {
            font-size: .8rem;
            color: var(--ink2);
            line-height: 1.4;
        }

        .activity-msg strong {
            color: var(--ink);
        }

        .activity-time {
            font-size: .68rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .act-pending {
            background: var(--amber);
        }

        .act-lolos {
            background: var(--teal);
        }

        .act-diterima {
            background: var(--green);
        }

        .act-ditolak {
            background: var(--red);
        }

        .act-kuis {
            background: #3b82f6;
        }

        /* ══════════════════════════════════════════
                           KUIS CARDS
                        ══════════════════════════════════════════ */
        .kuis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 14px;
            padding: 20px;
        }

        .kuis-card {
            background: var(--bg);
            border: 1px solid var(--line);
            border-radius: 13px;
            padding: 16px;
            transition: all .2s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .kuis-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--teal-dk));
            border-radius: 0;
        }

        .kuis-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 122, 110, .12);
            border-color: var(--teal);
        }

        .kuis-card-name {
            font-size: .86rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .kuis-card-posisi {
            font-size: .72rem;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .kuis-card-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .kuis-meta-chip {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: .68rem;
            font-weight: 600;
            color: var(--ink2);
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 3px 8px;
        }

        .kuis-meta-chip i {
            font-size: .62rem;
            color: var(--teal);
        }

        .kuis-card-footer {
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .kuis-pass-rate {
            font-size: .7rem;
            font-weight: 700;
        }

        .kuis-pass-rate.good {
            color: var(--green);
        }

        .kuis-pass-rate.avg {
            color: var(--amber);
        }

        .kuis-pass-rate.bad {
            color: var(--red);
        }

        .kuis-pengerjaan {
            font-size: .68rem;
            color: var(--muted);
        }

        /* ══════════════════════════════════════════
                           QUICK ACTION BUTTONS
                        ══════════════════════════════════════════ */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px;
            padding: 20px;
        }

        .qa-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 18px 12px;
            border-radius: 13px;
            border: 1.5px solid var(--line);
            background: var(--bg);
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            font-family: inherit;
        }

        .qa-btn:hover {
            border-color: var(--teal);
            background: var(--teal-lt);
            transform: translateY(-2px);
        }

        .qa-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
        }

        .qa-label {
            font-size: .72rem;
            font-weight: 700;
            color: var(--ink2);
            text-align: center;
        }

        /* ══════════════════════════════════════════
                           MINI TABLE (Recent Pelamar)
                        ══════════════════════════════════════════ */
        .mini-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mini-table th {
            padding: 10px 16px;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--bg);
            border-bottom: 1px solid var(--line);
            text-align: left;
            white-space: nowrap;
        }

        .mini-table td {
            padding: 12px 16px;
            font-size: .8rem;
            color: var(--ink2);
            border-bottom: 1px solid var(--line);
            vertical-align: middle;
        }

        .mini-table tbody tr:last-child td {
            border-bottom: none;
        }

        .mini-table tbody tr {
            transition: background .15s;
        }

        .mini-table tbody tr:hover {
            background: var(--teal-lt);
        }

        /* badge (reuse dari pelamar page) */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: .68rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .badge.pending {
            background: #fef9ec;
            color: var(--amber);
        }

        .badge.pending .badge-dot {
            background: var(--amber);
        }

        .badge.lolos_berkas {
            background: var(--teal-lt);
            color: var(--teal-dk);
        }

        .badge.lolos_berkas .badge-dot {
            background: var(--teal);
        }

        .badge.tidak_lolos_berkas {
            background: #fdf0ef;
            color: var(--red);
        }

        .badge.tidak_lolos_berkas .badge-dot {
            background: var(--red);
        }

        .badge.diterima {
            background: #edf7f2;
            color: var(--green);
        }

        .badge.diterima .badge-dot {
            background: var(--green);
        }

        .badge.ditolak {
            background: #fdf0ef;
            color: var(--red);
        }

        .badge.ditolak .badge-dot {
            background: var(--red);
        }

        .badge.lulus {
            background: #edf7f2;
            color: var(--green);
        }

        .badge.lulus .badge-dot {
            background: var(--green);
        }

        .badge.gagal {
            background: #fdf0ef;
            color: var(--red);
        }

        .badge.gagal .badge-dot {
            background: var(--red);
        }

        /* avatar mini */
        .av {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-dk));
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-right: 8px;
        }

        /* ══════════════════════════════════════════
                           DONUT LEGEND
                        ══════════════════════════════════════════ */
        .donut-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .donut-wrap canvas {
            max-width: 200px;
            max-height: 200px;
        }

        .donut-legend {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .75rem;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .legend-text {
            flex: 1;
            color: var(--ink2);
            font-weight: 500;
        }

        .legend-val {
            color: var(--ink);
            font-weight: 700;
        }

        /* ══════════════════════════════════════════
                           DATE RANGE FILTER BAR
                        ══════════════════════════════════════════ */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            animation: fadeUp var(--anim-dur) .1s cubic-bezier(.22, 1, .36, 1) both;
        }

        .filter-label {
            font-size: .75rem;
            color: var(--muted);
            font-weight: 600;
        }

        .filter-date-input {
            padding: 8px 14px;
            border: 1.5px solid var(--line);
            border-radius: 9px;
            font-family: inherit;
            font-size: .8rem;
            color: var(--ink);
            background: var(--white);
            outline: none;
            cursor: pointer;
            transition: border .2s;
        }

        .filter-date-input:focus {
            border-color: var(--teal);
        }

        .filter-period-btns {
            display: flex;
            gap: 6px;
        }

        .period-btn {
            padding: 7px 13px;
            border-radius: 8px;
            border: 1.5px solid var(--line);
            font-family: inherit;
            font-size: .75rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            background: none;
            transition: all .2s;
        }

        .period-btn.active,
        .period-btn:hover {
            background: var(--teal-lt);
            border-color: var(--teal);
            color: var(--teal-dk);
        }

        /* ══════════════════════════════════════════
                           DEADLINE ALERT BANNER
                        ══════════════════════════════════════════ */
        .deadline-banner {
            background: linear-gradient(135deg, #fffbeb, #fef9ec);
            border: 1.5px solid #fde68a;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
            animation: fadeUp var(--anim-dur) .05s cubic-bezier(.22, 1, .36, 1) both;
        }

        .deadline-banner i {
            color: var(--amber);
            font-size: 1rem;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .deadline-banner-text {
            flex: 1;
            font-size: .78rem;
            color: #92400e;
        }

        .deadline-banner-title {
            font-weight: 700;
            margin-bottom: 2px;
        }

        .deadline-items {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .deadline-chip {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
            border-radius: 6px;
            padding: 3px 10px;
            font-size: .68rem;
            font-weight: 700;
        }

        /* ══════════════════════════════════════════
                           RESPONSIVE
                        ══════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .dash-grid {
                grid-template-columns: 1fr;
            }

            .dash-grid-3 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .dash-grid-3 {
                grid-template-columns: 1fr;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-actions {
                display: none;
            }

            .hero-title {
                font-size: 1.3rem;
            }

            .quick-actions {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ══════════════════════════════════════════════
         HERO BANNER
    ══════════════════════════════════════════════ --}}
    <div class="hero-banner">
        <div class="hero-text">
            <div class="hero-greeting">Selamat datang kembali 👋</div>
            <div class="hero-title">Dashboard Admin IT</div>
            <div class="hero-meta">
                <span class="hero-meta-item"><i class="fa-solid fa-calendar-day"></i>
                    {{ now()->translatedFormat('l, d F Y') }}</span>
                <span class="hero-meta-item"><i class="fa-solid fa-clock"></i> <span id="liveClock">--:--:--</span></span>
                <span class="hero-meta-item"><i class="fa-solid fa-server"></i> SIREKRUT v2.0</span>
            </div>
        </div>
        <div class="hero-actions">
            <a href="{{ route('sdm.pelamar') }}" class="btn-hero btn-hero-white">
                <i class="fa-solid fa-users"></i> Kelola Pelamar
            </a>
            <a href="#" class="btn-hero btn-hero-outline">
                <i class="fa-solid fa-download"></i> Export Laporan
            </a>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         DEADLINE ALERT  (posisi yang hampir tutup)
    ══════════════════════════════════════════════ --}}
    @php
        $deadlinePosisis = $posisis->filter(
            fn($p) => $p->tanggal_ditutup &&
                \Carbon\Carbon::parse($p->tanggal_ditutup)->diffInDays(now(), false) >= -7 &&
                \Carbon\Carbon::parse($p->tanggal_ditutup)->isFuture(),
        );
    @endphp
    @if ($deadlinePosisis->count())
        <div class="deadline-banner">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div class="deadline-banner-text">
                <div class="deadline-banner-title">Posisi akan segera ditutup dalam 7 hari ke depan</div>
                <div class="deadline-items">
                    @foreach ($deadlinePosisis as $dp)
                        <span class="deadline-chip">
                            {{ $dp->nama_posisi }} — {{ \Carbon\Carbon::parse($dp->tanggal_ditutup)->format('d M Y') }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════
         FILTER BAR
    ══════════════════════════════════════════════ --}}
    <div class="filter-bar">
        <span class="filter-label"><i class="fa-solid fa-filter" style="margin-right:4px"></i>Periode :</span>
        <div class="filter-period-btns">
            <button class="period-btn active" data-period="7">7 Hari</button>
            <button class="period-btn" data-period="30">30 Hari</button>
            <button class="period-btn" data-period="90">3 Bulan</button>
            <button class="period-btn" data-period="365">1 Tahun</button>
        </div>
        <input type="text" class="filter-date-input" id="dateRangePicker" placeholder="Pilih rentang tanggal...">
    </div>

    {{-- ══════════════════════════════════════════════
         STATS ROW
    ══════════════════════════════════════════════ --}}
    @php
        $totalPelamar = $pelamars->count();
        $pending = $pelamars->where('status_pelamar', 'pending')->count();
        $lolosBerkas = $pelamars->where('status_pelamar', 'lolos_berkas')->count();
        $diterima = $pelamars->where('status_pelamar', 'diterima')->count();
        $ditolak = $pelamars->whereIn('status_pelamar', ['ditolak', 'tidak_lolos_berkas'])->count();
        $totalKuis = $kuis->count();
        $totalSoal = $soals->count();
        $totalPosisi = $posisis->count();
        $totalPengerjaan = $pengerjaanPelamars->count();
        $lulusKuis = $pengerjaanPelamars->where('status', 'lulus')->count();
        $passRate = $totalPengerjaan > 0 ? round(($lulusKuis / $totalPengerjaan) * 100) : 0;
    @endphp

    <div class="stats-row">
        <div class="stat-card" onclick="location.href='{{ route('sdm.pelamar') }}'">
            <div class="stat-icon-wrap si-teal"><i class="fa-solid fa-users"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $totalPelamar }}">0</div>
                <div class="stat-lbl">Total Pelamar</div>
                <div class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Aktif</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrap si-amber"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $pending }}">0</div>
                <div class="stat-lbl">Menunggu Validasi</div>
                @if ($pending > 0)
                    <div class="stat-trend trend-down"><i class="fa-solid fa-circle-exclamation"></i> Perlu tindakan</div>
                @else
                    <div class="stat-trend trend-flat"><i class="fa-solid fa-check"></i> Semua terproses</div>
                @endif
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrap si-teal"><i class="fa-solid fa-file-circle-check"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $lolosBerkas }}">0</div>
                <div class="stat-lbl">Lolos Berkas</div>
                <div class="stat-trend trend-up"><i class="fa-solid fa-arrow-up"></i> Seleksi lanjut</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrap si-green"><i class="fa-solid fa-user-check"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $diterima }}">0</div>
                <div class="stat-lbl">Diterima</div>
                <div class="stat-trend trend-up"><i class="fa-solid fa-trophy"></i> Final</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrap si-blue"><i class="fa-solid fa-clipboard-question"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $totalKuis }}">0</div>
                <div class="stat-lbl">Total Kuis</div>
                <div class="stat-trend trend-flat"><i class="fa-solid fa-layer-group"></i> {{ $totalSoal }} soal</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-wrap si-purple"><i class="fa-solid fa-percent"></i></div>
            <div class="stat-body">
                <div class="stat-num" data-target="{{ $passRate }}" data-suffix="%">0</div>
                <div class="stat-lbl">Pass Rate Kuis</div>
                <div
                    class="stat-trend {{ $passRate >= 60 ? 'trend-up' : ($passRate >= 40 ? 'trend-flat' : 'trend-down') }}">
                    <i class="fa-solid fa-chart-line"></i> {{ $lulusKuis }}/{{ $totalPengerjaan }}
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
         ROW 1 : Grafik Pelamar per Bulan + Funnel
    ══════════════════════════════════════════════ --}}
    <div class="dash-grid" style="animation-delay:.1s">

        {{-- Chart: Tren Pelamar --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-chart-line"></i> Tren Pendaftaran Pelamar</div>
                    <div class="panel-sub">Jumlah pelamar baru per bulan (12 bulan terakhir)</div>
                </div>
                <div class="chip-tabs">
                    <button class="chip-tab active" onclick="switchChart('tren','line',this)">Line</button>
                    <button class="chip-tab" onclick="switchChart('tren','bar',this)">Bar</button>
                </div>
            </div>
            <div class="panel-body">
                <div class="chart-area">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>
        </div>

        {{-- Funnel Status Pelamar --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-filter"></i> Funnel Seleksi</div>
                    <div class="panel-sub">Konversi status pelamar</div>
                </div>
            </div>
            <div class="panel-body">
                @php
                    $totalNonDitolak = $totalPelamar;
                    $funnelData = [
                        ['label' => 'Total Mendaftar', 'val' => $totalPelamar, 'color' => '#0d7a6e', 'pct' => 100],
                        [
                            'label' => 'Lolos Berkas',
                            'val' => $lolosBerkas + $diterima,
                            'color' => '#3b82f6',
                            'pct' => $totalPelamar ? round((($lolosBerkas + $diterima) / $totalPelamar) * 100) : 0,
                        ],
                        [
                            'label' => 'Diterima',
                            'val' => $diterima,
                            'color' => '#22c55e',
                            'pct' => $totalPelamar ? round(($diterima / $totalPelamar) * 100) : 0,
                        ],
                        [
                            'label' => 'Tidak Lolos',
                            'val' => $ditolak,
                            'color' => '#ef4444',
                            'pct' => $totalPelamar ? round(($ditolak / $totalPelamar) * 100) : 0,
                        ],
                    ];
                @endphp
                <div class="funnel">
                    @foreach ($funnelData as $f)
                        <div class="funnel-item">
                            <div class="funnel-label">{{ $f['label'] }}</div>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar"
                                    style="width:{{ $f['pct'] }}%; background:{{ $f['color'] }}"></div>
                            </div>
                            <div class="funnel-count">{{ $f['val'] }}</div>
                            <div class="funnel-pct">{{ $f['pct'] }}%</div>
                        </div>
                    @endforeach
                </div>

                {{-- Donut chart --}}
                <div style="margin-top: 24px">
                    <div class="donut-wrap">
                        <canvas id="chartDonut"></canvas>
                        <div class="donut-legend">
                            @php
                                $legendItems = [
                                    ['color' => '#fbbf24', 'label' => 'Pending', 'val' => $pending],
                                    ['color' => '#0d7a6e', 'label' => 'Lolos Berkas', 'val' => $lolosBerkas],
                                    ['color' => '#22c55e', 'label' => 'Diterima', 'val' => $diterima],
                                    ['color' => '#ef4444', 'label' => 'Tidak Lolos/Ditolak', 'val' => $ditolak],
                                ];
                            @endphp
                            @foreach ($legendItems as $li)
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:{{ $li['color'] }}"></div>
                                    <div class="legend-text">{{ $li['label'] }}</div>
                                    <div class="legend-val">{{ $li['val'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
         ROW 2 : Posisi Terpopuler + Kuis Pass Rate + Pengerjaan
    ══════════════════════════════════════════════ --}}
    <div class="dash-grid-3">

        {{-- Posisi Terpopuler --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-ranking-star"></i> Posisi Terpopuler</div>
                    <div class="panel-sub">Berdasarkan jumlah pelamar</div>
                </div>
            </div>
            <div class="panel-body-0 posisi-list">
                @php
                    $posisiRanked = $posisis
                        ->map(function ($p) use ($pelamars) {
                            $count = $pelamars->where('id_posisi', $p->id)->count();
                            return ['nama' => $p->nama_posisi, 'count' => $count];
                        })
                        ->sortByDesc('count')
                        ->take(6)
                        ->values();
                    $maxPosisi = $posisiRanked->max('count') ?: 1;
                @endphp
                @forelse($posisiRanked as $idx => $pr)
                    <div class="posisi-item">
                        <div class="posisi-rank {{ $idx === 0 ? 'r1' : ($idx === 1 ? 'r2' : ($idx === 2 ? 'r3' : '')) }}">
                            {{ $idx + 1 }}</div>
                        <div class="posisi-name">{{ $pr['nama'] }}</div>
                        <div class="posisi-bar-mini">
                            <div class="posisi-bar-fill" style="width:{{ round(($pr['count'] / $maxPosisi) * 100) }}%">
                            </div>
                        </div>
                        <div class="posisi-count-badge">{{ $pr['count'] }}</div>
                    </div>
                @empty
                    <div style="padding:30px;text-align:center;color:var(--muted);font-size:.8rem">Belum ada posisi</div>
                @endforelse
            </div>
        </div>

        {{-- Chart: Bar Pass Rate per Kuis --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-chart-bar"></i> Pass Rate per Kuis</div>
                    <div class="panel-sub">Persentase kelulusan</div>
                </div>
            </div>
            <div class="panel-body">
                <div class="chart-area">
                    <canvas id="chartPassRate"></canvas>
                </div>
            </div>
        </div>

        {{-- Chart: Distribusi Status Pengerjaan --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-list-check"></i> Status Pengerjaan Kuis</div>
                    <div class="panel-sub">Distribusi semua pengerjaan</div>
                </div>
            </div>
            <div class="panel-body">
                @php
                    $pgPending = $pengerjaanPelamars->where('status', 'pending')->count();
                    $pgLulus = $pengerjaanPelamars->where('status', 'lulus')->count();
                    $pgGagal = $pengerjaanPelamars->where('status', 'gagal')->count();
                @endphp
                <div class="chart-area">
                    <canvas id="chartPengerjaan"></canvas>
                </div>
                <div class="donut-legend" style="margin-top:14px">
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#fbbf24"></div>
                        <div class="legend-text">Pending</div>
                        <div class="legend-val">{{ $pgPending }}</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#22c55e"></div>
                        <div class="legend-text">Lulus</div>
                        <div class="legend-val">{{ $pgLulus }}</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#ef4444"></div>
                        <div class="legend-text">Gagal</div>
                        <div class="legend-val">{{ $pgGagal }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
         ROW 3 : Recent Pelamar + Activity Feed
    ══════════════════════════════════════════════ --}}
    <div class="dash-grid">

        {{-- Recent Pelamar --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-user-clock"></i> Pelamar Terbaru</div>
                    <div class="panel-sub">10 pendaftar terakhir</div>
                </div>
                <a href="{{ route('sdm.pelamar') }}"
                    style="font-size:.75rem;color:var(--teal);font-weight:600;text-decoration:none">
                    Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size:.65rem"></i>
                </a>
            </div>
            <div class="panel-body-0">
                <table class="mini-table">
                    <thead>
                        <tr>
                            <th>Pelamar</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelamars->take(10) as $p)
                            @php
                                $ini = strtoupper(
                                    substr($p->nama ?? 'P', 0, 1) .
                                        substr(explode(' ', $p->nama ?? 'P ')[1] ?? '', 0, 1),
                                );
                            @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center">
                                        <div class="av">{{ $ini }}</div>
                                        <div>
                                            <div style="font-weight:600;font-size:.8rem;color:var(--ink)">
                                                {{ $p->nama }}</div>
                                            <div style="font-size:.68rem;color:var(--muted)">{{ $p->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:.75rem">{{ $p->posisi->nama_posisi ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $p->status_pelamar }}">
                                        <span class="badge-dot"></span>
                                        {{ str_replace('_', ' ', ucwords($p->status_pelamar, '_')) }}
                                    </span>
                                </td>
                                <td style="font-size:.72rem;color:var(--muted)">{{ $p->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;padding:30px;color:var(--muted)">Belum ada
                                    pelamar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Activity Feed --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title"><i class="fa-solid fa-bolt"></i> Aktivitas Terbaru</div>
                    <div class="panel-sub">Log perubahan status terkini</div>
                </div>
            </div>
            <div class="panel-body-0 activity-feed">
                @php
                    $recentActivities = $pelamars->sortByDesc('updated_at')->take(10);
                @endphp
                @forelse($recentActivities as $act)
                    @php
                        $actClass = match ($act->status_pelamar) {
                            'pending' => 'act-pending',
                            'lolos_berkas' => 'act-lolos',
                            'diterima' => 'act-diterima',
                            'ditolak', 'tidak_lolos_berkas' => 'act-ditolak',
                            default => 'act-pending',
                        };
                        $actIcon = match ($act->status_pelamar) {
                            'pending' => 'Mendaftar',
                            'lolos_berkas' => 'Lolos Berkas',
                            'diterima' => 'Diterima',
                            'ditolak' => 'Ditolak',
                            'tidak_lolos_berkas' => 'Tidak Lolos',
                            default => 'Update',
                        };
                    @endphp
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot {{ $actClass }}"></div>
                            <div class="activity-line"></div>
                        </div>
                        <div class="activity-text">
                            <div class="activity-msg">
                                <strong>{{ $act->nama }}</strong> — <em>{{ $actIcon }}</em>
                                di posisi {{ $act->posisi->nama_posisi ?? '-' }}
                            </div>
                            <div class="activity-time">{{ $act->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div style="padding:30px;text-align:center;color:var(--muted);font-size:.8rem">Belum ada aktivitas
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
         ROW 4 : Kuis Cards
    ══════════════════════════════════════════════ --}}
    <div class="panel" style="margin-bottom:20px">
        <div class="panel-header">
            <div>
                <div class="panel-title"><i class="fa-solid fa-clipboard-question"></i> Daftar Kuis</div>
                <div class="panel-sub">{{ $totalKuis }} kuis tersedia · {{ $totalSoal }} total soal</div>
            </div>
            <div class="chip-tabs">
                <button class="chip-tab active" onclick="filterKuis('',this)">Semua</button>
                @foreach ($posisis->take(4) as $pos)
                    <button class="chip-tab"
                        onclick="filterKuis('{{ $pos->id }}',this)">{{ $pos->nama_posisi }}</button>
                @endforeach
            </div>
        </div>
        <div class="kuis-grid" id="kuisGrid">
            @forelse($kuis as $k)
                @php
                    $pengerjaan = $pengerjaanPelamars->where('id_kuis', $k->id);
                    $total = $pengerjaan->count();
                    $lulusK = $pengerjaan->where('status', 'lulus')->count();
                    $passK = $total > 0 ? round(($lulusK / $total) * 100) : 0;
                    $passClass = $passK >= 60 ? 'good' : ($passK >= 40 ? 'avg' : 'bad');
                    $soalCount = $soals->where('id_kuis', $k->id)->count();
                @endphp
                <div class="kuis-card" data-posisi="{{ $k->posisi_id }}">
                    <div class="kuis-card-name">{{ $k->nama_kuis }}</div>
                    <div class="kuis-card-posisi">
                        <i class="fa-solid fa-briefcase" style="margin-right:4px;color:var(--teal);font-size:.65rem"></i>
                        {{ $k->posisi->nama_posisi ?? '-' }}
                    </div>
                    <div class="kuis-card-meta">
                        <div class="kuis-meta-chip"><i class="fa-solid fa-clock"></i> {{ $k->waktu }} mnt</div>
                        <div class="kuis-meta-chip"><i class="fa-solid fa-list-ol"></i> {{ $soalCount }} soal</div>
                        <div class="kuis-meta-chip"><i class="fa-solid fa-users"></i> {{ $total }} peserta</div>
                    </div>
                    <div class="kuis-card-footer">
                        <div class="kuis-pass-rate {{ $passClass }}">
                            <i class="fa-solid fa-chart-pie" style="margin-right:3px"></i>
                            Pass rate: {{ $passK }}%
                        </div>
                        <div class="kuis-pengerjaan">{{ $lulusK }} lulus</div>
                    </div>
                </div>
            @empty
                <div style="padding:30px;color:var(--muted);font-size:.8rem;grid-column:1/-1;text-align:center">Belum ada
                    kuis</div>
            @endforelse
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
         ROW 5 : Quick Actions
    ══════════════════════════════════════════════ --}}
    <div class="panel" style="margin-bottom:20px">
        <div class="panel-header">
            <div class="panel-title"><i class="fa-solid fa-rocket"></i> Aksi Cepat</div>
        </div>
        <div class="quick-actions">
            <a href="{{ route('sdm.pelamar') }}" class="qa-btn">
                <div class="qa-icon si-teal"><i class="fa-solid fa-users"></i></div>
                <div class="qa-label">Data Pelamar</div>
            </a>
            <a href="#" class="qa-btn">
                <div class="qa-icon si-blue"><i class="fa-solid fa-clipboard-question"></i></div>
                <div class="qa-label">Kelola Kuis</div>
            </a>
            <a href="#" class="qa-btn">
                <div class="qa-icon si-purple"><i class="fa-solid fa-briefcase"></i></div>
                <div class="qa-label">Kelola Posisi</div>
            </a>
            <a href="#" class="qa-btn">
                <div class="qa-icon si-amber"><i class="fa-solid fa-file-excel"></i></div>
                <div class="qa-label">Export Excel</div>
            </a>
            <a href="#" class="qa-btn">
                <div class="qa-icon si-green"><i class="fa-solid fa-chart-bar"></i></div>
                <div class="qa-label">Laporan</div>
            </a>
            <a href="#" class="qa-btn">
                <div class="qa-icon si-red"><i class="fa-solid fa-envelope-open-text"></i></div>
                <div class="qa-label">Notifikasi</div>
            </a>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        window.DASH = {
            pending: {{ $pending }},
            lolosBerkas: {{ $lolosBerkas }},
            diterima: {{ (int) $diterima }},
            ditolak: {{ (int) $ditolak }},
            pgPending: {{ (int) $pgPending }},
            pgLulus: {{ (int) $pgLulus }},
            pgGagal: {{ (int) $pgGagal }},
            trenLabels: {!! json_encode($trenLabels) !!},
            trenData: {!! json_encode($trenData) !!},
            kuisLabels: {!! json_encode($kuisLabels) !!},
            kuisPass: {!! json_encode($kuisPass) !!},
        };
    </script>
    <script>
        // ── LIVE CLOCK ───────────────────────────────
        function updateClock() {
            const now = new Date();
            const hh = String(now.getHours()).padStart(2, '0');
            const mm = String(now.getMinutes()).padStart(2, '0');
            const ss = String(now.getSeconds()).padStart(2, '0');
            const el = document.getElementById('liveClock');
            if (el) el.textContent = `${hh}:${mm}:${ss}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // ── COUNTER ANIMATION ────────────────────────
        document.querySelectorAll('.stat-num[data-target]').forEach(el => {
            const target = parseInt(el.dataset.target) || 0;
            const suffix = el.dataset.suffix || '';
            let cur = 0;
            const step = Math.max(1, Math.ceil(target / 60));
            const timer = setInterval(() => {
                cur = Math.min(cur + step, target);
                el.textContent = cur + suffix;
                if (cur >= target) clearInterval(timer);
            }, 18);
        });

        // ── DATE RANGE PICKER ────────────────────────
        flatpickr('#dateRangePicker', {
            mode: 'range',
            dateFormat: 'd M Y',
            locale: {
                rangeSeparator: ' s/d '
            },
            onChange: function(selectedDates) {
                if (selectedDates.length === 2) {
                    document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                }
            }
        });

        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ── CHART DEFAULTS ───────────────────────────
        Chart.defaults.font.family = "'DM Sans', 'Poppins', sans-serif";
        Chart.defaults.color = '#6b7e93';

        // ── DATA FROM BLADE ──────────────────────────
        const trenLabels = window.DASH.trenLabels;
        const trenData = window.DASH.trenData;
        const kuisLabels = window.DASH.kuisLabels;
        const kuisPass = window.DASH.kuisPass;
        const donutData = [window.DASH.pending, window.DASH.lolosBerkas, window.DASH.diterima, window.DASH.ditolak];
        const pgData = [window.DASH.pgPending, window.DASH.pgLulus, window.DASH.pgGagal];

        // ── CHART: TREN PELAMAR ──────────────────────
        let chartTrenInst = null;

        function buildTren(type) {
            const ctx = document.getElementById('chartTren').getContext('2d');
            if (chartTrenInst) chartTrenInst.destroy();

            const gradient = ctx.createLinearGradient(0, 0, 0, 280);
            gradient.addColorStop(0, 'rgba(13,122,110,.25)');
            gradient.addColorStop(1, 'rgba(13,122,110,0)');

            chartTrenInst = new Chart(ctx, {
                type: type,
                data: {
                    labels: trenLabels.length ? trenLabels : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul',
                        'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                    ],
                    datasets: [{
                        label: 'Pelamar Baru',
                        data: trenData.length ? trenData : [4, 7, 3, 9, 5, 12, 8, 6, 11, 4, 7, 3],
                        borderColor: '#0d7a6e',
                        backgroundColor: type === 'line' ? gradient : 'rgba(13,122,110,.75)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: type === 'line',
                        pointBackgroundColor: '#0d7a6e',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderRadius: type === 'bar' ? 6 : 0,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0a1420',
                            titleColor: '#fff',
                            bodyColor: 'rgba(255,255,255,.7)',
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: ctx => `  ${ctx.parsed.y} pelamar`
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,.05)',
                                drawBorder: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
        buildTren('line');

        function switchChart(name, type, btn) {
            document.querySelectorAll('.chip-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (name === 'tren') buildTren(type);
        }

        // ── CHART: DONUT STATUS PELAMAR ──────────────
        new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Lolos Berkas', 'Diterima', 'Tidak Lolos'],
                datasets: [{
                    data: donutData,
                    backgroundColor: ['#fbbf24', '#0d7a6e', '#22c55e', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '68%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0a1420',
                        bodyColor: 'rgba(255,255,255,.8)',
                        padding: 10,
                        cornerRadius: 8,
                    }
                }
            }
        });

        // ── CHART: PASS RATE PER KUIS ────────────────
        new Chart(document.getElementById('chartPassRate'), {
            type: 'bar',
            data: {
                labels: kuisLabels.length ? kuisLabels : ['Kuis 1', 'Kuis 2', 'Kuis 3'],
                datasets: [{
                    label: 'Pass Rate (%)',
                    data: kuisPass.length ? kuisPass : [65, 48, 72],
                    backgroundColor: (kuisPass.length ? kuisPass : [65, 48, 72]).map(v =>
                        v >= 60 ? 'rgba(34,197,94,.8)' : v >= 40 ? 'rgba(251,191,36,.8)' :
                        'rgba(239,68,68,.8)'
                    ),
                    borderRadius: 7,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0a1420',
                        bodyColor: 'rgba(255,255,255,.8)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: ctx => `  ${ctx.parsed.x}%`
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'rgba(0,0,0,.05)',
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            callback: v => v + '%'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        // ── CHART: STATUS PENGERJAAN ─────────────────
        new Chart(document.getElementById('chartPengerjaan'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Lulus', 'Gagal'],
                datasets: [{
                    data: pgData,
                    backgroundColor: ['#fbbf24', '#22c55e', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0a1420',
                        bodyColor: 'rgba(255,255,255,.8)',
                        padding: 10,
                        cornerRadius: 8,
                    }
                }
            }
        });

        // ── FILTER KUIS CARDS ────────────────────────
        function filterKuis(posisiId, btn) {
            document.querySelectorAll('.chip-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.kuis-card').forEach(card => {
                card.style.display = (!posisiId || card.dataset.posisi == posisiId) ? '' : 'none';
            });
        }
    </script>
@endpush
