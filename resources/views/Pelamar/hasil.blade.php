<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran – SIREKRUT</title>
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* ── CSS VARIABLES ── */
        :root {
            --navy: #0d4f35;
            --navy-mid: #116040;
            --navy-lite: #1a7a52;
            --gold: #2ecc7a;
            --gold-light: #5de8a0;
            --cream: #f0faf5;
            --white: #FFFFFF;
            --text-dark: #0a3324;
            --text-mid: #2e6b4f;
            --text-soft: #5a9478;
            --success: #1B8A5A;
            --success-bg: #E8F7F1;
            --shadow-sm: 0 2px 8px rgba(13, 79, 53, .10);
            --shadow-md: 0 8px 32px rgba(13, 79, 53, .16);
            --shadow-lg: 0 24px 64px rgba(13, 79, 53, .22);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
        }

        /* ── RESET & BASE ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── ANIMATED BACKGROUND ── */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(145deg, #e0f5ec 0%, #f0faf5 50%, #e8f7ee 100%);
        }

        .bg-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 20%, rgba(13, 79, 53, .10) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(46, 204, 122, .08) 0%, transparent 50%),
                radial-gradient(circle at 60% 10%, rgba(10, 51, 36, .06) 0%, transparent 40%);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: driftOrb 20s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: rgba(13, 79, 53, .14);
            top: -100px;
            left: -100px;
            animation-duration: 18s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: rgba(46, 204, 122, .10);
            bottom: -80px;
            right: -80px;
            animation-duration: 22s;
            animation-delay: -6s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: rgba(10, 51, 36, .08);
            top: 40%;
            left: 60%;
            animation-duration: 25s;
            animation-delay: -12s;
        }

        @keyframes driftOrb {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(40px, 30px) scale(1.1);
            }
        }

        .grid-overlay {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image:
                linear-gradient(rgba(13, 79, 53, .04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(13, 79, 53, .04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ── WRAPPER ── */
        .wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 64px;
        }

        /* ── ALERT ── */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--success-bg);
            border: 1.5px solid rgba(27, 138, 90, .3);
            border-left: 4px solid var(--success);
            border-radius: var(--radius-sm);
            padding: 14px 20px;
            margin-bottom: 24px;
            width: 100%;
            max-width: 780px;
            font-size: .92rem;
            font-weight: 500;
            color: var(--success);
            animation: slideDown .5s ease;
        }

        .alert-icon {
            width: 28px;
            height: 28px;
            background: var(--success);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── MAIN CARD ── */
        .card-main {
            width: 100%;
            max-width: 780px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: riseUp .6s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes riseUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── CARD HEADER ── */
        .card-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-lite) 100%);
            padding: 40px 40px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            background: rgba(212, 160, 23, .10);
            border-radius: 50%;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 30px;
            left: -40px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, .04);
            border-radius: 50%;
        }

        .hospital-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 100px;
            padding: 6px 16px;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .85);
            margin-bottom: 20px;
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            background: var(--gold-light);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .6;
                transform: scale(1.3);
            }
        }

        .trophy-ring {
            font-size: 3.2rem;
            margin-bottom: 12px;
            display: block;
            animation: bounceIn .8s cubic-bezier(.22, 1, .36, 1) .3s both;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(.4);
            }

            70% {
                transform: scale(1.1);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .card-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            color: var(--white);
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .card-header p {
            font-size: .95rem;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 28px;
        }

        .ecg-line {
            display: block;
            width: 100%;
            height: 36px;
            margin: 0;
            opacity: .35;
        }

        /* ── CARD BODY ── */
        .card-body {
            padding: 36px 40px;
        }

        /* ── SECTION ── */
        .section {
            margin-bottom: 28px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .icon-green {
            background: var(--success-bg);
        }

        .icon-blue {
            background: #E8F7EF;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: .01em;
        }

        /* ── ACCOUNT BOX ── */
        .account-box {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            border-radius: var(--radius);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .account-box::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(212, 160, 23, .15);
            border-radius: 50%;
        }

        .account-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            position: relative;
        }

        .account-field label {
            display: block;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .55);
            margin-bottom: 6px;
        }

        .account-field .value {
            font-size: .95rem;
            font-weight: 600;
            color: var(--white);
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: var(--radius-xs);
            padding: 8px 12px;
            letter-spacing: .02em;
            word-break: break-all;
        }

        .nomor-peserta-field .value {
            color: var(--gold-light);
            font-size: 1.05rem;
            border-color: rgba(212, 160, 23, .4);
            background: rgba(212, 160, 23, .12);
        }

        /* ── DATA BOX ── */
        .data-box {
            border: 1.5px solid #d0ede0;
            border-radius: var(--radius);
            overflow: hidden;
        }

        .data-row {
            display: flex;
            align-items: center;
            padding: 13px 20px;
            border-bottom: 1px solid #e0f2ea;
            gap: 16px;
            transition: background .15s;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .data-row:hover {
            background: #f0faf5;
        }

        .key {
            font-size: .8rem;
            font-weight: 600;
            color: var(--text-soft);
            width: 140px;
            flex-shrink: 0;
            letter-spacing: .02em;
        }

        .val {
            font-size: .9rem;
            color: var(--text-dark);
            font-weight: 500;
            flex: 1;
        }

        .pill {
            display: inline-block;
            background: linear-gradient(90deg, #e0f7ec 0%, #c8f0de 100%);
            color: var(--navy-lite);
            border: 1px solid #a8e0c4;
            border-radius: 100px;
            padding: 3px 14px;
            font-size: .82rem;
            font-weight: 600;
        }

        /* ── CARD FOOTER ── */
        .card-footer {
            background: #f0faf5;
            border-top: 1.5px solid #d0ede0;
            padding: 24px 40px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-note {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .82rem;
            color: var(--text-mid);
            flex: 1;
            min-width: 200px;
        }

        .btn-home,
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 100px;
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
            cursor: pointer;
            border: none;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-home {
            background: #ddf3ea;
            color: var(--navy);
        }

        .btn-home:hover {
            background: #c4ebd8;
            transform: translateX(-2px);
        }

        .btn-home:last-of-type:hover {
            transform: translateX(2px);
        }

        .btn-print {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: var(--navy);
            box-shadow: 0 4px 16px rgba(212, 160, 23, .35);
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 160, 23, .45);
        }

        .btn-print:active {
            transform: translateY(0);
        }

        .print-hint {
            text-align: center;
            font-size: .78rem;
            color: var(--text-soft);
            padding: 12px 40px 20px;
        }

        /* ═══════════════════════════════════════════════════
           KARTU PESERTA FORMAL
        ════════════════════════════════════════════════════ */
        .kartu-section {
            width: 100%;
            max-width: 780px;
            margin-top: 32px;
            animation: riseUp .7s cubic-bezier(.22, 1, .36, 1) .2s both;
        }

        .kartu-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .kartu-section-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: var(--navy);
        }

        /* ── Formal card container ── */
        .kartu-wrapper {
            width: 100%;
        }

        .kartu-formal {
            background: var(--white);
            border: 2px solid var(--navy);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            font-family: 'DM Sans', sans-serif;
        }

        /* Header strip */
        .kf-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .kf-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, .03) 10px,
                    rgba(255, 255, 255, .03) 20px);
        }

        .kf-header-accent {
            height: 6px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 50%, var(--gold) 100%);
        }

        .kf-header-inner {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 28px;
            position: relative;
            z-index: 1;
        }

        .kf-logo-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: 2px solid rgba(255, 255, 255, .3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .kf-header-text {
            flex: 1;
        }

        .kf-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.15rem;
            color: var(--white);
            line-height: 1.2;
            letter-spacing: .01em;
        }

        .kf-header-sub {
            font-size: .78rem;
            color: rgba(255, 255, 255, .65);
            margin-top: 3px;
            letter-spacing: .03em;
        }

        .kf-header-badge {
            text-align: right;
            flex-shrink: 0;
        }

        .kf-badge-label {
            display: block;
            font-size: .62rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .5);
            margin-bottom: 4px;
        }

        .kf-badge-nomor {
            display: inline-block;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: var(--navy);
            font-size: 20px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 6px;
            letter-spacing: .05em;
        }

        /* ── Subheader: Rumah Sakit ── */
        .kf-rs-bar {
            background: var(--success-bg);
            border-bottom: 1px solid rgba(13, 79, 53, .15);
            padding: 10px 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kf-rs-icon {
            font-size: 1rem;
            flex-shrink: 0;
        }

        .kf-rs-info {
            flex: 1;
        }

        .kf-rs-label {
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--text-soft);
        }

        .kf-rs-name {
            font-size: .92rem;
            font-weight: 700;
            color: var(--navy);
        }

        .kf-rs-kode {
            font-size: .75rem;
            color: var(--text-soft);
            background: rgba(13, 79, 53, .08);
            border: 1px solid rgba(13, 79, 53, .15);
            padding: 2px 10px;
            border-radius: 100px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* ── Body: two-column layout ── */
        .kf-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .kf-col {
            padding: 22px 28px;
        }

        .kf-col:first-child {
            border-right: 1.5px solid #e0ede8;
        }

        .kf-col-title {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--navy);
            padding-bottom: 8px;
            margin-bottom: 12px;
            border-bottom: 2px solid var(--gold);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ── Info rows ── */
        .kf-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 11px;
        }

        .kf-row:last-child {
            margin-bottom: 0;
        }

        .kf-label {
            font-size: .67rem;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--text-soft);
            margin-bottom: 2px;
        }

        .kf-value {
            font-size: .88rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .kf-value.highlight {
            color: var(--navy);
            font-size: .95rem;
        }

        .kf-value .badge-posisi {
            display: inline-block;
            background: linear-gradient(90deg, #e0f7ec 0%, #c8f0de 100%);
            color: var(--navy);
            border: 1px solid rgba(13, 79, 53, .2);
            border-radius: 5px;
            padding: 3px 10px;
            font-size: .82rem;
            font-weight: 700;
        }

        .kf-value .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid rgba(27, 138, 90, .25);
            border-radius: 5px;
            padding: 3px 10px;
            font-size: .8rem;
            font-weight: 700;
        }

        .kf-value .badge-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
        }

        /* ── Divider inside col ── */
        .kf-divider {
            height: 1px;
            background: #e0ede8;
            margin: 12px 0;
        }

        /* ── Footer strip ── */
        .kf-footer {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .kf-footer-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .kf-footer-label {
            font-size: .62rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .45);
        }

        .kf-footer-val {
            font-size: .8rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .85);
        }

        .kf-footer-center {
            flex: 1;
            text-align: center;
        }

        .kf-footer-watermark {
            font-size: .68rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .25);
            font-style: italic;
        }

        /* Barcode style */
        .kf-barcode {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 3px;
        }

        .kf-barcode-bars {
            display: flex;
            gap: 2px;
            height: 28px;
            align-items: flex-end;
        }

        .kf-barcode-bars span {
            width: 2.5px;
            background: rgba(255, 255, 255, .4);
            border-radius: 1px;
        }

        .kf-barcode-num {
            font-size: .55rem;
            color: rgba(255, 255, 255, .35);
            letter-spacing: .05em;
        }

        /* ── PRINT BUTTON ROW ── */
        .btn-row {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        /* ── MODAL / OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(11, 37, 69, .55);
            backdrop-filter: blur(4px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
            animation: fadeIn .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-box {
            background: var(--white);
            border-radius: 20px;
            padding: 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: var(--shadow-lg);
            animation: slideUp .3s cubic-bezier(.22, 1, .36, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-box h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            margin-bottom: 8px;
            color: var(--navy);
        }

        .modal-box p {
            font-size: .88rem;
            color: var(--text-mid);
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-modal-cancel {
            flex: 1;
            padding: 11px;
            border-radius: 100px;
            border: 1.5px solid #d8e3f0;
            background: transparent;
            font-size: .88rem;
            font-weight: 600;
            color: var(--text-mid);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s;
        }

        .btn-modal-cancel:hover {
            background: #edf7f2;
        }

        .btn-modal-confirm {
            flex: 2;
            padding: 11px;
            border-radius: 100px;
            border: none;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            font-size: .88rem;
            font-weight: 700;
            color: var(--navy);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            box-shadow: 0 4px 16px rgba(212, 160, 23, .35);
            transition: all .2s;
        }

        .btn-modal-confirm:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(212, 160, 23, .45);
        }

        /* ═══════════════════════════════════════════════════
           PRINT STYLES
        ════════════════════════════════════════════════════ */
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: white !important;
            }

            .bg-canvas,
            .grid-overlay,
            .card-main,
            .alert-success,
            .kartu-section-header,
            .btn-row,
            .modal-overlay,
            .print-hint {
                display: none !important;
            }

            .wrapper {
                padding: 0;
                min-height: unset;
            }

            .kartu-section {
                margin: 0;
                max-width: 100%;
                animation: none;
            }

            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }

            .print-sheet {
                display: block !important;
            }

            .kartu-formal {
                border: 1.5px solid #0d4f35;
                box-shadow: none;
                border-radius: 8px;
            }

            .kf-header-title {
                font-size: 13pt;
            }

            .kf-header-sub {
                font-size: 8pt;
            }

            .kf-badge-nomor {
                font-size: 20pt;
            }

            .kf-col-title {
                font-size: 7pt;
            }

            .kf-label {
                font-size: 7pt;
            }

            .kf-value {
                font-size: 9.5pt;
            }

            .kf-rs-name {
                font-size: 9.5pt;
            }

            .kf-footer-val {
                font-size: 8pt;
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .card-header {
                padding: 28px 20px 0;
            }

            .card-body {
                padding: 24px 20px;
            }

            .card-footer {
                padding: 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .account-grid {
                grid-template-columns: 1fr 1fr;
            }

            .nomor-peserta-field {
                grid-column: 1 / -1;
            }

            .key {
                width: 110px;
            }

            .print-hint {
                padding: 12px 20px 16px;
            }

            /* Formal card responsive */
            .kf-header-inner {
                flex-wrap: wrap;
                gap: 12px;
            }

            .kf-header-badge {
                width: 100%;
                text-align: left;
            }

            .kf-body {
                grid-template-columns: 1fr;
            }

            .kf-col:first-child {
                border-right: none;
                border-bottom: 1.5px solid #e0ede8;
            }

            .kf-col {
                padding: 18px 20px;
            }

            .kf-footer {
                flex-wrap: wrap;
                gap: 10px;
            }
        }

        @media (max-width: 420px) {
            .account-grid {
                grid-template-columns: 1fr;
            }

            .kf-header-inner {
                padding: 16px 16px;
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

    <!-- Print confirmation modal -->
    <div class="modal-overlay" id="printModal">
        <div class="modal-box">
            <h3>🖨️ Cetak Kartu Pelamar</h3>
            <p>Kartu peserta Anda akan dicetak dalam format landscape. Pastikan printer terhubung. Kartu berisi data
                pendaftaran lengkap sebagai bukti resmi.</p>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-modal-confirm" onclick="doPrint()">✓ &nbsp;Cetak Sekarang</button>
            </div>
        </div>
    </div>

    <div class="wrapper">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert-success animate__animated animate__fadeInDown">
                <div class="alert-icon">✓</div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- ───────────── MAIN RESULT CARD ───────────── -->
        <div class="card-main animate__animated animate__fadeInUp">

            <!-- HEADER -->
            <div class="card-header">
                <div class="hospital-badge">
                    <div class="badge-dot"></div>
                    Rekrutmen Pegawai – SIREKRUT
                </div>
                <span class="trophy-ring">🎉</span>
                <h1>Pendaftaran Berhasil!</h1>
                <p>Data Anda telah tercatat. Simpan informasi akun di bawah ini.</p>
                <svg class="ecg-line" viewBox="0 0 900 36" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <polyline fill="none" stroke="#ffffff" stroke-width="2"
                        points="0,18 80,18 100,18 120,4 130,32 140,8 150,28 160,18 240,18 320,18 340,4 350,32 360,8 370,28 380,18 460,18 540,18 560,4 570,32 580,8 590,28 600,18 680,18 760,18 780,4 790,32 800,8 810,28 820,18 900,18" />
                </svg>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <!-- Informasi Akun -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-icon icon-green">🔐</div>
                        <span class="section-title">Informasi Akun</span>
                    </div>
                    <div class="account-box">
                        <div class="account-grid">
                            <div class="account-field nomor-peserta-field">
                                <label>Nomor Peserta</label>
                                <div class="value">{{ $nomor_peserta }}</div>
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

                <!-- Data Pelamar -->
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

            </div>

            <!-- FOOTER -->
            <div class="card-footer">
                <div class="footer-note">
                    <span>📋</span>
                    <span>Simpan nomor peserta untuk keperluan seleksi.</span>
                </div>
                <a href="{{ url('/') }}" class="btn-home">← Beranda</a>
                <a href="{{ route('login') }}" class="btn-home">Login →</a>
            </div>

            <p class="print-hint">Cetak kartu pelamar dengan tombol di bawah atau tekan Ctrl+P.</p>
        </div>

        <!-- ───────────── KARTU PESERTA FORMAL ───────────── -->
        <div class="kartu-section">
            <div class="kartu-section-header">
                <span class="kartu-section-title">🪪 Kartu Peserta Pelamar</span>
                <button class="btn-print" onclick="openModal()">
                    🖨️ &nbsp;Cetak Kartu
                </button>
            </div>

            <div class="print-sheet">
                <div class="kartu-wrapper">
                    <div class="kartu-formal">

                        {{-- ── HEADER ── --}}
                        <div class="kf-header">
                            <div class="kf-header-accent"></div>
                            <div class="kf-header-inner">
                                <div class="kf-logo-circle">🏥</div>
                                <div class="kf-header-text">
                                    <div class="kf-header-title">KARTU PESERTA REKRUTMEN</div>
                                    <div class="kf-header-sub">SIREKRUT — Sistem Informasi Rekrutmen Pegawai</div>
                                </div>
                                <div class="kf-header-badge">
                                    <span class="kf-badge-label">No. Peserta</span>
                                    <span class="kf-badge-nomor">{{ $pelamar->nomer_peserta }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- ── RS BAR ── --}}
                        <div class="kf-rs-bar">
                            <span class="kf-rs-icon">🏨</span>
                            <div class="kf-rs-info">
                                <div class="kf-rs-label">Mendaftar di</div>
                                <div class="kf-rs-name">{{ $pelamar->rumahSakit->nama_rs ?? '-' }}</div>
                            </div>
                            <span class="kf-rs-kode">{{ $pelamar->rumahSakit->kode_rs ?? '-' }}</span>
                        </div>

                        {{-- ── BODY TWO COLUMNS ── --}}
                        <div class="kf-body">
                            {{-- Kolom Kiri: Data Pribadi --}}
                            <div class="kf-col">
                                <div class="kf-col-title">
                                    <span>👤</span> Foto Pelamar
                                </div>
                                <div class="kf-row">
                                    @php
                                        $pasFoto = $pelamar->files->firstWhere('jenis_file', 'pas_foto');
                                    @endphp

                                    @if ($pasFoto)
                                        <img src="{{ $pasFoto->url }}" alt="Foto Pelamar" class="foto-pelamar"
                                            width="100%" >
                                    @else
                                        <div class="foto-placeholder">
                                            Foto tidak tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Kolom Kiri: Data Pribadi --}}
                            <div class="kf-col">
                                <div class="kf-col-title">
                                    <span>👤</span> Data Pribadi
                                </div>

                                <div class="kf-row">
                                    <span class="kf-label">Nama Lengkap</span>
                                    <span class="kf-value highlight">{{ $pelamar->nama }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">NIK</span>
                                    <span class="kf-value">{{ $pelamar->nik ?? '-' }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Jenis Kelamin</span>
                                    <span class="kf-value">{{ $pelamar->jenis_kelamin ?? '-' }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Kota Domisili</span>
                                    <span class="kf-value">{{ $pelamar->kota_domisili }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Alamat</span>
                                    <span class="kf-value">{{ $pelamar->alamat ?? '-' }}</span>
                                </div>

                                <div class="kf-divider"></div>

                                <div class="kf-col-title">
                                    <span>📞</span> Kontak
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">No. Telepon</span>
                                    <span class="kf-value">{{ $pelamar->no_hp }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Email</span>
                                    <span class="kf-value">{{ $pelamar->email }}</span>
                                </div>
                            </div>
                            {{-- Kolom Kanan: Data Lamaran --}}
                            <div class="kf-col">
                                <div class="kf-col-title">
                                    <span>📋</span> Data Lamaran
                                </div>

                                <div class="kf-row">
                                    <span class="kf-label">Posisi Dilamar</span>
                                    <span class="kf-value">
                                        <span class="badge-posisi">{{ $pelamar->posisi->nama_posisi ?? '-' }}</span>
                                    </span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Jenjang Pendidikan</span>
                                    <span class="kf-value">{{ $pelamar->jenjang }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Jenis Pelamar</span>
                                    <span class="kf-value">{{ $pelamar->jenis_pelamar ?? '-' }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">No. Ijazah</span>
                                    <span class="kf-value">{{ $pelamar->no_ijasah ?? '-' }}</span>
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">No. STR</span>
                                    <span class="kf-value">{{ $pelamar->no_str ?? '-' }}</span>
                                </div>
                                {{-- <div class="kf-row">
                                    <span class="kf-label">Status Pelamar</span>
                                    <span class="kf-value">
                                        <span
                                            class="badge-status">{{ $pelamar->status_pelamar ?? 'Terdaftar' }}</span>
                                    </span>
                                </div> --}}
                            </div>
                            <div class="kf-col">
                                <div class="kf-col-title">
                                    <span>💼</span> Pengalaman Kerja
                                </div>
                                <div class="kf-row">
                                    <span class="kf-label">Pengalaman</span>
                                    <span class="kf-value">{{ $pelamar->pengalaman_kerja ?? 'Tidak ada' }}</span>
                                </div>
                                @if ($pelamar->keterangan_pengalaman)
                                    <div class="kf-row">
                                        <span class="kf-label">Keterangan</span>
                                        <span class="kf-value">{{ $pelamar->keterangan_pengalaman }}</span>
                                    </div>
                                @endif

                                <div class="kf-divider"></div>
                            </div>

                        </div>{{-- /kf-body --}}

                        {{-- ── FOOTER ── --}}
                        <div class="kf-footer">
                            <div class="kf-footer-left">
                                <span class="kf-footer-label">Username</span>
                                <span class="kf-footer-val">{{ $pelamar->username }}</span>
                            </div>
                            <div class="kf-footer-center">
                                <span class="kf-footer-watermark">Dokumen ini sah sebagai bukti pendaftaran
                                    resmi</span>
                            </div>
                            <div class="kf-barcode">
                                <div class="kf-barcode-bars" id="kfBarcode"
                                    data-code="{{ $pelamar->nomer_peserta }}">
                                </div>
                                <svg id="barcode" width="20" height="10"></svg>
                            </div>
                        </div>

                    </div>{{-- /kartu-formal --}}
                </div>{{-- /kartu-wrapper --}}
            </div>{{-- /print-sheet --}}

            <!-- Button row -->
            <div class="btn-row">
                <button class="btn-print" onclick="openModal()">🖨️ &nbsp;Cetak Kartu Pelamar</button>
                <a href="{{ url('/') }}" class="btn-home" style="background:#ddf3ea;color:var(--navy);">←
                    Beranda</a>
            </div>
        </div>

    </div><!-- /wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>

    <script>
        /* ── Generate barcode bars ── */
        JsBarcode("#barcode",
            "{{ $pelamar->nomer_peserta }}", {
                format: "CODE128",
                width: 1, // ketebalan garis (kecilkan)
                height: 25, // tinggi barcode
                displayValue: false, // sembunyikan teks bawah
                margin: 0,
                lineColor: "#000",
                background: "transparent"
            });

        /* ── Modal ── */
        function openModal() {
            document.getElementById('printModal').classList.add('open');
        }

        function closeModal() {
            document.getElementById('printModal').classList.remove('open');
        }

        function doPrint() {
            closeModal();
            setTimeout(() => {
                window.print();
            }, 150);
        }

        /* Close modal on overlay click */
        document.getElementById('printModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        /* Keyboard shortcut Ctrl+P override */
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                openModal();
            }
        });
    </script>

</body>

</html>
