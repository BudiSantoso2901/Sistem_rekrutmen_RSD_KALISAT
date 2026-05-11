<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">
    <title>Rekrutmen Kabupaten Jember</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.css">
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

        html {
            scroll-behavior: smooth;
        }

        .error-text {
            color: rgb(146, 9, 9);
            font-size: 12px;
            margin-top: 4px;
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border: 1px solid rgb(146, 9, 9);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ─── NAVBAR ─── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            transition: box-shadow .3s;
        }

        nav.scrolled {
            box-shadow: var(--shadow);
        }

        .nav-inner {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-logo .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--primary);
            border-radius: 10px;
            display: grid;
            place-items: center;
        }

        .nav-logo .logo-icon i {
            color: white;
            font-size: 1rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-mid);
            text-decoration: none;
            font-size: .93rem;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-cta {
            background: var(--primary);
            color: white !important;
            padding: 9px 22px;
            border-radius: 50px !important;
            transition: background .2s, transform .2s !important;
        }

        .nav-cta:hover {
            background: var(--primary-light) !important;
            transform: translateY(-1px);
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: var(--primary);
            font-size: 1.4rem;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 68px;
            left: 0;
            right: 0;
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 1.2rem 5%;
            z-index: 999;
            flex-direction: column;
            gap: 1rem;
            box-shadow: var(--shadow);
        }

        .mobile-menu.open {
            display: flex;
        }

        .mobile-menu a {
            color: var(--text-mid);
            text-decoration: none;
            font-weight: 500;
            padding: .4rem 0;
            border-bottom: 1px solid var(--border);
        }

        .mobile-menu .nav-cta {
            background: var(--primary);
            color: white !important;
            padding: 10px 20px;
            border-radius: 50px;
            text-align: center;
            border: none;
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            padding: 120px 5% 80px;
            display: flex;
            align-items: center;
            background:
                radial-gradient(ellipse 60% 50% at 80% 50%, rgba(20, 163, 114, .12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 10% 80%, rgba(244, 168, 39, .08) 0%, transparent 60%),
                var(--white);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            right: -80px;
            top: -80px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            border: 60px solid rgba(13, 110, 78, .06);
        }

        .hero::after {
            content: '';
            position: absolute;
            left: -40px;
            bottom: -60px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 40px solid rgba(244, 168, 39, .08);
        }

        .hero-inner {
            max-width: 1200px;
            margin: auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-light);
            color: #b37a00;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: .82rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            animation: fadeInDown .8s both;
        }

        .hero-badge i {
            font-size: .75rem;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.18;
            color: var(--text-dark);
            margin-bottom: 1.2rem;
            animation: fadeInUp .9s .1s both;
        }

        h1 span {
            color: var(--primary);
        }

        .hero-desc {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 2rem;
            animation: fadeInUp .9s .2s both;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeInUp .9s .3s both;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .25s;
            box-shadow: 0 4px 16px rgba(13, 110, 78, .3);
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 110, 78, .35);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            border: 2px solid var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .25s;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: var(--primary-pale);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2.5rem;
            animation: fadeInUp .9s .4s both;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .hero-stat-label {
            font-size: .78rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .hero-stat-divider {
            width: 1px;
            background: var(--border);
            align-self: stretch;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            animation: fadeInRight 1s .3s both;
        }

        .hero-card-main {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
        }

        .hero-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .avatar-stack {
            display: flex;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid white;
            margin-left: -8px;
            display: grid;
            place-items: center;
            font-size: .7rem;
            font-weight: 700;
            color: white;
        }

        .avatar:first-child {
            margin-left: 0;
        }

        .av1 {
            background: #0d6e4e;
        }

        .av2 {
            background: #f4a827;
        }

        .av3 {
            background: #e85d5d;
        }

        .av4 {
            background: #4a90d9;
        }

        .hero-card-title {
            font-weight: 600;
            font-size: .95rem;
        }

        .hero-card-sub {
            font-size: .78rem;
            color: var(--text-muted);
        }

        .job-list {
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .job-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--bg);
            cursor: pointer;
            transition: all .2s;
        }

        .job-item:hover {
            border-color: var(--primary-light);
            background: var(--primary-pale);
            transform: translateX(4px);
        }

        .job-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            font-size: .95rem;
            flex-shrink: 0;
        }

        .ji-green {
            background: var(--primary-pale);
            color: var(--primary);
        }

        .ji-amber {
            background: var(--accent-light);
            color: #9a6800;
        }

        .ji-red {
            background: #fde8e8;
            color: #c44;
        }

        .ji-blue {
            background: #e6f2fd;
            color: #1a6fb4;
        }

        .job-info {
            flex: 1;
            min-width: 0;
        }

        .job-name {
            font-weight: 600;
            font-size: .88rem;
        }

        .job-meta {
            font-size: .75rem;
            color: var(--text-muted);
        }

        .job-badge {
            font-size: .68rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-new {
            background: #e4f7f0;
            color: var(--primary);
        }

        .badge-hot {
            background: #fde8e8;
            color: #c44;
        }

        .badge-open {
            background: #e6f2fd;
            color: #1a6fb4;
        }

        .floating-card {
            position: absolute;
            background: white;
            border-radius: var(--radius);
            padding: .9rem 1.1rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
        }

        .fc-notif {
            bottom: -24px;
            left: -32px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: float 3s ease-in-out infinite;
        }

        .fc-notif-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-pale);
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            color: var(--primary);
            font-size: 1rem;
        }

        .fc-notif-title {
            font-weight: 600;
            font-size: .82rem;
        }

        .fc-notif-sub {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .fc-stat {
            top: -20px;
            right: -24px;
            text-align: center;
            min-width: 110px;
            animation: float 3s ease-in-out infinite reverse;
        }

        .fc-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .fc-stat-label {
            font-size: .72rem;
            color: var(--text-muted);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* ─── SECTION BASE ─── */
        section {
            padding: 90px 5%;
        }

        .section-inner {
            max-width: 1200px;
            margin: auto;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary);
            font-size: .8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .8rem;
        }

        .section-tag::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--primary);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            line-height: 1.25;
            color: var(--text-dark);
            margin-bottom: .8rem;
        }

        h2 span {
            color: var(--primary);
        }

        .section-sub {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 580px;
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .section-header.center {
            text-align: center;
        }

        .section-header.center .section-sub {
            margin: 0 auto;
        }

        /* ─── ABOUT / STATS ─── */
        .stats-section {
            background: var(--primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .stat-item {}

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
        }

        .stat-label {
            color: rgba(255, 255, 255, .7);
            font-size: .9rem;
            margin-top: .3rem;
        }

        /* ─── FEATURES / WHY ─── */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .feature-card {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            border: 1px solid var(--border);
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            transform: scaleX(0);
            transition: transform .3s;
            transform-origin: left;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--radius-sm);
            background: var(--primary-pale);
            color: var(--primary);
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            margin-bottom: 1.2rem;
        }

        .feature-icon.amber {
            background: var(--accent-light);
            color: #9a6800;
        }

        .feature-icon.red {
            background: #fde8e8;
            color: #c44;
        }

        .feature-icon.blue {
            background: #e6f2fd;
            color: #1a6fb4;
        }

        .feature-icon.purple {
            background: #f0eafd;
            color: #7c3aed;
        }

        .feature-icon.teal {
            background: #e0f5f5;
            color: #0d9488;
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: .5rem;
        }

        .feature-desc {
            color: var(--text-muted);
            font-size: .9rem;
            line-height: 1.65;
        }

        /* ─── POSITIONS ─── */
        .positions-section {
            background: white;
        }

        .filter-bar {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 50px;
            border: 1.5px solid var(--border);
            background: white;
            font-size: .85rem;
            font-weight: 500;
            color: var(--text-mid);
            cursor: pointer;
            transition: all .2s;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .positions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .pos-card {
            background: var(--bg);
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1.5px solid var(--border);
            transition: all .25s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .pos-card:hover {
            border-color: var(--primary);
            background: white;
            box-shadow: var(--shadow);
        }

        .pos-top {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .pos-logo {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .pos-dept {
            font-size: .78rem;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .pos-title {
            font-weight: 700;
            font-size: 1rem;
        }

        .pos-tags {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .pos-tag {
            font-size: .72rem;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 50px;
            border: 1px solid var(--border);
            color: var(--text-mid);
        }

        .pos-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .pos-salary {
            font-weight: 700;
            color: var(--primary);
            font-size: .95rem;
        }

        .pos-deadline {
            font-size: .75rem;
            color: var(--text-muted);
        }

        .pos-apply {
            background: var(--primary);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: .82rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all .2s;
        }

        .pos-apply:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
        }

        /* ─── PROCESS ─── */
        .process-section {
            background: var(--bg);
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            position: relative;
        }

        .process-steps::before {
            content: '';
            position: absolute;
            top: 40px;
            left: calc(12.5% + 20px);
            right: calc(12.5% + 20px);
            height: 2px;
            background: repeating-linear-gradient(90deg, var(--primary) 0, var(--primary) 8px, transparent 8px, transparent 16px);
        }

        .process-step {
            text-align: center;
            position: relative;
        }

        .step-num {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--primary);
            color: var(--primary);
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            display: grid;
            place-items: center;
            margin: 0 auto 1.2rem;
            position: relative;
            z-index: 1;
            transition: all .3s;
        }

        .process-step:hover .step-num {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .step-title {
            font-weight: 700;
            margin-bottom: .4rem;
        }

        .step-desc {
            font-size: .85rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ─── TESTIMONIALS ─── */
        .testimonials-section {
            background: white;
        }

        .swiper-testi {
            padding-bottom: 3rem !important;
        }

        .testi-card {
            background: var(--bg);
            border-radius: var(--radius);
            padding: 2rem;
            border: 1px solid var(--border);
        }

        .testi-stars {
            color: var(--accent);
            font-size: .85rem;
            margin-bottom: .8rem;
        }

        .testi-quote {
            font-size: .95rem;
            line-height: 1.75;
            color: var(--text-mid);
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testi-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: .85rem;
            color: white;
            flex-shrink: 0;
        }

        .testi-name {
            font-weight: 700;
            font-size: .9rem;
        }

        .testi-role {
            font-size: .78rem;
            color: var(--text-muted);
        }

        .swiper-pagination-bullet-active {
            background: var(--primary) !important;
        }

        /* ─── APPLICATION FORM ─── */
        .form-section {
            background: linear-gradient(135deg, var(--primary) 0%, #0a5a3e 100%);
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            right: -100px;
            top: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
        }

        .form-section::after {
            content: '';
            position: absolute;
            left: -60px;
            bottom: -60px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(244, 168, 39, .08);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .form-info h2 {
            color: white;
        }

        .form-info .section-sub {
            color: rgba(255, 255, 255, .75);
        }

        .form-info .section-tag {
            color: rgba(255, 255, 255, .6);
        }

        .form-info .section-tag::before {
            background: rgba(255, 255, 255, .4);
        }

        .form-benefits {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .form-benefit {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, .85);
            font-size: .9rem;
        }

        .form-benefit i {
            color: var(--accent);
            width: 20px;
        }

        .form-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            box-shadow: var(--shadow-lg);
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: .4rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--text-dark);
            background: var(--bg);
            transition: border .2s, box-shadow .2s;
            outline: none;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 110, 78, .12);
            background: white;
        }

        .form-textarea {
            resize: vertical;
            min-height: 90px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: var(--bg);
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: var(--primary-pale);
        }

        .upload-icon {
            font-size: 1.8rem;
            color: var(--text-muted);
            margin-bottom: .5rem;
        }

        .upload-text {
            font-size: .82rem;
            color: var(--text-muted);
        }

        .upload-text strong {
            color: var(--primary);
        }

        .form-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 1rem;
        }

        .form-submit:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 78, .35);
        }

        .form-note {
            text-align: center;
            font-size: .75rem;
            color: var(--text-muted);
            margin-top: .8rem;
        }

        /* ─── SUCCESS MODAL ─── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 2000;
            place-items: center;
        }

        .modal-overlay.show {
            display: grid;
        }

        .modal-box {
            background: white;
            border-radius: var(--radius-xl);
            padding: 3rem;
            text-align: center;
            max-width: 420px;
            margin: 1rem;
            box-shadow: var(--shadow-lg);
            animation: zoomIn .4s;
        }

        .modal-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 2rem;
            display: grid;
            place-items: center;
            margin: 0 auto 1.2rem;
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: .6rem;
        }

        .modal-desc {
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .modal-close {
            background: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            font-size: .9rem;
            transition: all .2s;
        }

        .modal-close:hover {
            background: var(--primary-light);
        }

        @keyframes zoomIn {
            from {
                transform: scale(.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* ─── FAQ ─── */
        .faq-section {
            background: var(--bg);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .faq-item {
            background: white;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .faq-q {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            font-weight: 600;
            font-size: .92rem;
            gap: 12px;
            transition: background .2s;
        }

        .faq-q:hover {
            background: var(--primary-pale);
        }

        .faq-q.open {
            color: var(--primary);
        }

        .faq-q .faq-arrow {
            color: var(--text-muted);
            transition: transform .3s;
            flex-shrink: 0;
        }

        .faq-q.open .faq-arrow {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease, padding .3s;
            font-size: .88rem;
            color: var(--text-muted);
            line-height: 1.7;
            padding: 0 1.5rem;
        }

        .faq-a.open {
            max-height: 200px;
            padding: 0 1.5rem 1.2rem;
        }

        /* ─── FOOTER ─── */
        footer {
            background: var(--text-dark);
            color: rgba(255, 255, 255, .75);
            padding: 60px 5% 30px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 34px;
            height: 34px;
            background: var(--primary);
            border-radius: 8px;
            display: grid;
            place-items: center;
        }

        .footer-logo-icon i {
            color: white;
            font-size: .9rem;
        }

        .footer-about {
            font-size: .88rem;
            line-height: 1.7;
        }

        .footer-col-title {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: .9rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, .65);
            text-decoration: none;
            font-size: .85rem;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: var(--primary-light);
        }

        .social-links {
            display: flex;
            gap: .75rem;
            margin-top: 1.2rem;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            color: rgba(255, 255, 255, .7);
            display: grid;
            place-items: center;
            font-size: .9rem;
            text-decoration: none;
            transition: all .2s;
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: .5rem;
            font-size: .8rem;
            color: rgba(255, 255, 255, .45);
        }

        /* ─── SCROLL TOP ─── */
        #scrollTop {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 900;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: var(--shadow-lg);
            display: grid;
            place-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s, transform .2s;
        }

        #scrollTop.show {
            opacity: 1;
            pointer-events: auto;
        }

        #scrollTop:hover {
            transform: translateY(-3px);
        }

        /* ─── ANIMATIONS ─── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s, transform .7s;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hero-inner {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                display: none;
            }

            .hero-stats {
                gap: 1rem;
            }

            .positions-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-info {
                text-align: center;
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }

            .process-steps {
                grid-template-columns: repeat(2, 1fr);
            }

            .process-steps::before {
                display: none;
            }

            .footer-top {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                text-align: center;
                flex-direction: column;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            section {
                padding: 60px 4%;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .process-steps {
                grid-template-columns: 1fr;
            }

            .hero-btns {
                flex-direction: column;
            }

            .btn-primary,
            .btn-outline {
                justify-content: center;
            }
        }

        /* Counter animation */
        .counting {
            display: inline-block;
        }

        .follow-box,
        .maps-review-box {
            margin-top: 20px;
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, .08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
        }

        .follow-title,
        .maps-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #222;
        }

        .follow-title i,
        .maps-title i {
            color: #ff4d4f;
        }

        .social-follow-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-follow-item {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            padding: 14px 16px;
            border-radius: 14px;
            transition: .3s;
            color: #fff;
        }

        .social-follow-item:hover {
            transform: translateY(-3px);
        }

        .social-follow-item i {
            font-size: 22px;
            width: 30px;
            text-align: center;
        }

        .social-follow-item div {
            display: flex;
            flex-direction: column;
        }

        .social-follow-item span {
            font-size: 13px;
            opacity: .9;
        }

        .instagram {
            background: linear-gradient(45deg, #fd5949, #d6249f, #285AEB);
        }

        .facebook {
            background: #1877f2;
        }

        .tiktok {
            background: #111;
        }

        .youtube {
            background: #ff0000;
        }

        .maps-text {
            font-size: 14px;
            line-height: 1.7;
            color: #666;
            margin-bottom: 18px;
        }

        .maps-review-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 12px;
            background: #ffb400;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            transition: .3s;
        }

        .maps-review-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(255, 180, 0, .35);
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .maps-review-box {
            margin-top: 20px;
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, .08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
        }

        .maps-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #222;
        }

        .maps-title i {
            color: #ff4d4f;
        }

        .maps-text {
            font-size: 14px;
            line-height: 1.7;
            color: #666;
            margin-bottom: 18px;
        }

        .maps-frame {
            overflow: hidden;
            border-radius: 16px;
            margin-bottom: 18px;
            border: 1px solid #eee;
        }

        .maps-frame iframe {
            display: block;
        }

        .maps-review-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 12px;
            background: #ffb400;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            transition: .3s;
        }

        .maps-review-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(255, 180, 0, .35);
        }
    </style>
</head>

<body>

    <!-- ─── NAVBAR ─── -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <input type="image" src="{{ asset('Lambang-kabupaten-jember.png') }}" alt="" width="50">
                <em style="font-style:normal;color:var(--accent)">Kabupaten Jember</em>
            </a>
            <ul class="nav-links">
                <li><a href="#beranda">Beranda</a></li>
                {{-- <li><a href="#posisi">Lowongan</a></li> --}}
                <li><a href="#proses">Proses</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#daftar" class="nav-cta">Daftar Sekarang</a></li>
            </ul>
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#beranda" class="mobile-link">Beranda</a>
        {{-- <a href="#posisi" class="mobile-link">Lowongan</a> --}}
        <a href="#proses" class="mobile-link">Proses Rekrutmen</a>
        <a href="#faq" class="mobile-link">FAQ</a>
        <a href="#daftar" class="nav-cta mobile-link">Daftar Sekarang</a>
    </div>

    <!-- ─── HERO ─── -->
    <section class="hero" id="beranda">
        <div class="hero-inner">
            <div class="hero-content">
                {{-- <div class="hero-badge"><i class="fas fa-star"></i> Rekrutmen Resmi 2025</div> --}}
                <h1>Wujudkan Karir <span>Kesehatan</span> Impianmu</h1>
                <p class="hero-desc">
                    Bergabunglah dengan tim profesional medis terbaik Indonesia. Kami mencari tenaga kesehatan
                    berdedikasi yang siap memberikan pelayanan terbaik bagi masyarakat.
                </p>
                <div class="hero-btns">
                    <a href="{{ route('login') }}" class="btn-primary"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="#daftar" class="btn-outline"><i class="fas fa-paper-plane"></i> Daftar Sekarang</a>
                </div>
                <div class="hero-stats">
                    {{-- <div class="hero-stat">
                        <div class="hero-stat-num counting" data-target="248">0</div>
                        <div class="hero-stat-label">Posisi Terbuka</div>
                    </div>
                    <div class="hero-stat-divider"></div> --}}
                    <div class="hero-stat">
                        <div class="hero-stat-num counting" data-target="112">0</div>
                        <div class="hero-stat-label">TT</div>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <div class="hero-stat-num counting" data-target="357">0</div>
                        <div class="hero-stat-label">Pegawai Aktif</div>
                    </div>
                </div>
            </div>

            {{-- <div class="hero-visual">
                <div class="hero-card-main">
                    <div class="hero-card-header">
                        <div class="avatar-stack">
                            <div class="avatar av1">DR</div>
                            <div class="avatar av2">NS</div>
                            <div class="avatar av3">FT</div>
                            <div class="avatar av4">+8</div>
                        </div>
                        <div>
                            <div class="hero-card-title">Tim Rekruter Aktif</div>
                            <div class="hero-card-sub">Siap membantu proses Anda</div>
                        </div>
                    </div>
                    <div class="job-list">
                        <div class="job-item">
                            <div class="job-icon ji-green"><i class="fas fa-user-md"></i></div>
                            <div class="job-info">
                                <div class="job-name">Dokter Spesialis</div>
                                <div class="job-meta">RS Pusat · Full-time</div>
                            </div>
                            <span class="job-badge badge-new">Baru</span>
                        </div>
                        <div class="job-item">
                            <div class="job-icon ji-blue"><i class="fas fa-procedures"></i></div>
                            <div class="job-info">
                                <div class="job-name">Perawat ICU</div>
                                <div class="job-meta">RS Cabang · Full-time</div>
                            </div>
                            <span class="job-badge badge-hot">Urgent</span>
                        </div>
                        <div class="job-item">
                            <div class="job-icon ji-amber"><i class="fas fa-pills"></i></div>
                            <div class="job-info">
                                <div class="job-name">Apoteker Klinis</div>
                                <div class="job-meta">Farmasi · Full-time</div>
                            </div>
                            <span class="job-badge badge-open">Buka</span>
                        </div>
                        <div class="job-item">
                            <div class="job-icon ji-red"><i class="fas fa-microscope"></i></div>
                            <div class="job-info">
                                <div class="job-name">Analis Laboratorium</div>
                                <div class="job-meta">Lab Klinik · Part-time</div>
                            </div>
                            <span class="job-badge badge-new">Baru</span>
                        </div>
                    </div>
                </div>

                <div class="floating-card fc-notif">
                    <div class="fc-notif-icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="fc-notif-title">Lamaran Diterima!</div>
                        <div class="fc-notif-sub">dr. Sari — 2 menit lalu</div>
                    </div>
                </div>

                <div class="floating-card fc-stat">
                    <div class="fc-stat-num">96%</div>
                    <div class="fc-stat-label">Tingkat Kepuasan</div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- ─── STATS BAR ─── -->
    {{-- <div class="stats-section">
        <div class="section-inner">
            <div class="stats-grid reveal">
                <div class="stat-item">
                    <div class="stat-num counting" data-target="15">0</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num counting" data-target="98">0</div>
                    <div class="stat-label">% Akreditasi JCI</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num counting" data-target="34">0</div>
                    <div class="stat-label">Departemen Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num counting" data-target="1200">0</div>
                    <div class="stat-label">Pasien per Hari</div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- ─── FEATURES / MENGAPA ─── -->
    <section id="mengapa">
        <div class="section-inner">
            <div class="section-header center reveal">
                <div class="section-tag">Keunggulan Kami</div>
                <h2>Mengapa <span>Bergabung</span> dengan Kami?</h2>
                <p class="section-sub">Kami menawarkan lebih dari sekadar pekerjaan — kami membangun karir kesehatan
                    yang bermakna dan berdampak nyata.</p>
            </div>
            <div class="features-grid">
                {{-- <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="feature-title">Pengembangan</div>
                    <div class="feature-desc">Program pelatihan berkelanjutan, seminar, dan sertifikasi internasional
                        untuk mendukung pertumbuhan profesional Anda.</div>
                </div> --}}
                <div class="feature-card reveal">
                    <div class="feature-icon amber"><i class="fas fa-shield-alt"></i></div>
                    <div class="feature-title">Jaminan Kesejahteraan</div>
                    <div class="feature-desc">Gaji kompetitif, BPJS Kesehatan & Ketenagakerjaan, asuransi jiwa, dan
                        tunjangan kesehatan tambahan untuk keluarga.</div>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon blue"><i class="fas fa-balance-scale"></i></div>
                    <div class="feature-title">Work-Life Balance</div>
                    <div class="feature-desc">Jadwal kerja terstruktur, cuti sakit, dan program
                        wellness untuk menjaga kesehatan mental Anda.</div>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon red"><i class="fas fa-chart-line"></i></div>
                    <div class="feature-title">Jenjang Karir Jelas</div>
                    <div class="feature-desc">Struktur promosi transparan berdasarkan kompetensi dan prestasi, dengan
                        peluang menjadi pemimpin departemen.</div>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon purple"><i class="fas fa-hospital-alt"></i></div>
                    <div class="feature-title">Fasilitas Modern</div>
                    <div class="feature-desc">Bekerja dengan peralatan medis terkini dan teknologi kesehatan canggih di
                        lingkungan yang nyaman dan steril.</div>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon teal"><i class="fas fa-users"></i></div>
                    <div class="feature-title">Tim yang Suportif</div>
                    <div class="feature-desc">Bergabung dengan komunitas profesional kesehatan yang kolaboratif,
                        inklusif, dan saling mendukung satu sama lain.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── LOWONGAN ─── -->
    {{-- <section class="positions-section" id="posisi">
        <div class="section-inner">
            <div class="section-header reveal">
                <div class="section-tag">Lowongan Terbuka</div>
                <h2>Temukan Posisi <span>Idealmu</span></h2>
                <p class="section-sub">Pilih dari berbagai posisi yang sesuai dengan keahlian dan minat Anda.</p>
            </div>
            <div class="filter-bar reveal">
                <button class="filter-btn active" data-cat="all">Semua</button>
                <button class="filter-btn" data-cat="medis">Tenaga Medis</button>
                <button class="filter-btn" data-cat="keperawatan">Keperawatan</button>
                <button class="filter-btn" data-cat="farmasi">Farmasi</button>
                <button class="filter-btn" data-cat="penunjang">Penunjang Medis</button>
                <button class="filter-btn" data-cat="admin">Administrasi</button>
            </div>
            <div class="positions-grid" id="positionsGrid">
                <!-- Cards injected by JS -->
            </div>
        </div>
    </section> --}}

    <!-- ─── PROCESS ─── -->
    <section class="process-section" id="proses">
        <div class="section-inner">
            <div class="section-header center reveal">
                <div class="section-tag">Alur Rekrutmen</div>
                <h2>Proses <span>Sederhana</span> & Transparan</h2>
                <p class="section-sub">4 langkah mudah untuk memulai perjalanan karir kesehatan Anda bersama kami.</p>
            </div>
            <div class="process-steps">
                <div class="process-step reveal">
                    <div class="step-num">1</div>
                    <div class="step-title">Kirim Lamaran</div>
                    <div class="step-desc">11 s/d 13 Mei 2026</div>
                </div>
                <div class="process-step reveal">
                    <div class="step-num">2</div>
                    <div class="step-title">Seleksi Administrasi</div>
                    <div class="step-desc">18 s/d 20 Mei 2026</div>
                </div>
                <div class="process-step reveal">
                    <div class="step-num">3</div>
                    <div class="step-title">Wawancara & Test</div>
                    <div class="step-desc">23 Mei 2026</div>
                </div>
                <div class="process-step reveal">
                    <div class="step-num">4</div>
                    <div class="step-title">Hasil Pengumuman</div>
                    <div class="step-desc">22 Juni 2026</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── TESTIMONIALS ─── -->
    <section class="testimonials-section">
        <div class="section-inner">
            <div class="section-header center reveal">
                <div class="section-tag">Cerita Sukses</div>
                <h2>Apa Kata <span>Karyawan</span> Kami?</h2>
            </div>
            <div class="swiper swiper-testi reveal">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <div class="testi-stars">★★★★★</div>
                            <p class="testi-quote">"Bergabung dengan tim ini adalah keputusan terbaik dalam karir saya.
                                Fasilitas yang lengkap, tim yang suportif, dan kesempatan pengembangan diri yang luar
                                biasa membuat saya terus berkembang setiap hari."</p>
                            <div class="testi-author">
                                <div class="testi-avatar" style="background:#0d6e4e">SR</div>
                                {{-- <div>
                                    <div class="testi-name">dr. Sari Rahayu, Sp.PD</div>
                                    <div class="testi-role">Dokter Spesialis Penyakit Dalam · 3 tahun</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <div class="testi-stars">★★★★★</div>
                            <p class="testi-quote">"Proses rekrutmen yang transparan dan profesional. Saya langsung
                                merasa dihargai sejak pertama kali melamar. Sekarang saya bangga menjadi bagian dari tim
                                keperawatan yang luar biasa ini."</p>
                            <div class="testi-author">
                                <div class="testi-avatar" style="background:#f4a827">BW</div>
                                {{-- <div>
                                    <div class="testi-name">Budi Wicaksono, S.Kep</div>
                                    <div class="testi-role">Perawat Senior ICU · 5 tahun</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <div class="testi-stars">★★★★★</div>
                            <p class="testi-quote">"Jenjang karir yang jelas dan mentor yang berpengalaman membantu
                                saya tumbuh dari apoteker junior menjadi kepala farmasi dalam 4 tahun. Sistem kerja di
                                sini benar-benar mendukung pengembangan profesional."</p>
                            <div class="testi-author">
                                <div class="testi-avatar" style="background:#e85d5d">LA</div>
                                {{-- <div>
                                    <div class="testi-name">Linda Anggraini, M.Farm</div>
                                    <div class="testi-role">Kepala Instalasi Farmasi · 4 tahun</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <div class="testi-stars">★★★★★</div>
                            <p class="testi-quote">"Lingkungan kerja yang inklusif dan kolaboratif. Sebagai analis
                                laboratorium, saya mendapat akses ke peralatan canggih dan pelatihan rutin yang
                                meningkatkan kompetensi teknis saya secara signifikan."</p>
                            <div class="testi-author">
                                <div class="testi-avatar" style="background:#4a90d9">RP</div>
                                {{-- <div>
                                    <div class="testi-name">Rizky Pratama, A.Md.AK</div>
                                    <div class="testi-role">Analis Laboratorium · 2 tahun</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- ─── FORM DAFTAR ─── -->
    <section class="form-section" id="daftar">
        <div class="section-inner">
            <div class="form-grid">
                <div class="form-info reveal">

                    <div class="section-tag">
                        <i class="fas fa-hospital"></i>
                        Informasi Rumah Sakit
                    </div>

                    <h2>
                        Rekrutmen <span style="color:var(--accent)">RSD Kabupaten Jember</span>
                    </h2>

                    <p class="section-sub">
                        Silakan pilih rumah sakit tujuan untuk melihat informasi lokasi,
                        media sosial resmi, serta dukungan review Google Maps.
                    </p>

                    <!-- WRAPPER CARD -->
                    <div class="hospital-card-wrapper">

                        <!-- ================= RSD KALISAT ================= -->
                        <div class="hospital-card">

                            <div class="hospital-header">
                                <div class="hospital-icon">
                                    <i class="fas fa-hospital-alt"></i>
                                </div>

                                <div>
                                    <h3>RSD Kalisat Jember</h3>
                                    <span>Rumah Sakit Daerah</span>
                                </div>
                            </div>

                            <!-- SOCIAL MEDIA -->
                            <div class="follow-box">

                                <div class="follow-title">
                                    <i class="fas fa-bullhorn"></i>
                                    Media Sosial Resmi
                                </div>

                                <div class="social-follow-list">

                                    <a href="https://www.instagram.com/rsdkalisatjember/" target="_blank"
                                        class="social-follow-item instagram">
                                        <i class="fab fa-instagram"></i>
                                        <div>
                                            <strong>Instagram</strong>
                                            <span>@rsdkalisatjember</span>
                                        </div>
                                    </a>

                                    <a href="https://www.facebook.com/profile.php?id=61574390483671" target="_blank"
                                        class="social-follow-item facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        <div>
                                            <strong>Facebook</strong>
                                            <span>RSD Kalisat Jember</span>
                                        </div>
                                    </a>

                                    <a href="https://www.tiktok.com/@rsdkalisat" target="_blank"
                                        class="social-follow-item tiktok">
                                        <i class="fab fa-tiktok"></i>
                                        <div>
                                            <strong>TikTok</strong>
                                            <span>@rsdkalisat</span>
                                        </div>
                                    </a>

                                    <a href="https://www.youtube.com/@rsdkalisatjember" target="_blank"
                                        class="social-follow-item youtube">
                                        <i class="fab fa-youtube"></i>
                                        <div>
                                            <strong>YouTube</strong>
                                            <span>RSD Kalisat Jember</span>
                                        </div>
                                    </a>

                                </div>
                            </div>

                            <!-- MAPS -->
                            <div class="maps-review-box">

                                <div class="maps-title">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Lokasi RSD Kalisat Jember
                                </div>

                                <div class="maps-frame">
                                    <iframe src="https://www.google.com/maps?q=RSD+Kalisat+Jember&output=embed"
                                        width="100%" height="220" style="border:0;" allowfullscreen=""
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <a href="https://maps.app.goo.gl/McWTfzCzZf1ZNjcW9" target="_blank"
                                    class="maps-review-btn">
                                    <i class="fas fa-star"></i>
                                    Review Google Maps
                                </a>

                            </div>

                        </div>

                        <!-- ================= RSD BALUNG ================= -->
                        <div class="hospital-card">

                            <div class="hospital-header">
                                <div class="hospital-icon">
                                    <i class="fas fa-hospital-alt"></i>
                                </div>

                                <div>
                                    <h3>RSD Balung</h3>
                                    <span>Rumah Sakit Daerah</span>
                                </div>
                            </div>

                            <!-- SOCIAL MEDIA -->
                            <div class="follow-box">

                                <div class="follow-title">
                                    <i class="fas fa-bullhorn"></i>
                                    Media Sosial Resmi
                                </div>

                                <div class="social-follow-list">

                                    <!-- Nanti bisa ditambahkan -->
                                    <div class="social-coming-soon">
                                        <i class="fas fa-clock"></i>
                                        Sosial media akan ditambahkan
                                    </div>

                                </div>
                            </div>

                            <!-- MAPS -->
                            <div class="maps-review-box">

                                <div class="maps-title">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Lokasi RSD Balung
                                </div>

                                <div class="maps-frame">
                                    <iframe src="https://www.google.com/maps?q=RSD+Balung&output=embed" width="100%"
                                        height="220" style="border:0;" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>

                                <a href="https://maps.app.goo.gl/QqaMDHf3qrh5nzvH8" target="_blank"
                                    class="maps-review-btn">
                                    <i class="fas fa-star"></i>
                                    Review Google Maps
                                </a>

                            </div>

                        </div>

                        <!-- ================= RSD SOEBANDI ================= -->
                        <div class="hospital-card">

                            <div class="hospital-header">
                                <div class="hospital-icon">
                                    <i class="fas fa-hospital-alt"></i>
                                </div>

                                <div>
                                    <h3>RSD dr. Soebandi</h3>
                                    <span>Rumah Sakit Daerah</span>
                                </div>
                            </div>

                            <!-- SOCIAL MEDIA -->
                            <div class="follow-box">

                                <div class="follow-title">
                                    <i class="fas fa-bullhorn"></i>
                                    Media Sosial Resmi
                                </div>

                                <div class="social-follow-list">

                                    <!-- Nanti bisa ditambahkan -->
                                    <div class="social-coming-soon">
                                        <i class="fas fa-clock"></i>
                                        Sosial media akan ditambahkan
                                    </div>

                                </div>
                            </div>

                            <!-- MAPS -->
                            <div class="maps-review-box">

                                <div class="maps-title">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Lokasi RSD dr. Soebandi
                                </div>

                                <div class="maps-frame">
                                    <iframe src="https://www.google.com/maps?q=RSD+dr+Soebandi+Jember&output=embed"
                                        width="100%" height="220" style="border:0;" allowfullscreen=""
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <a href="https://maps.app.goo.gl/AgKbEcr5yt2nskXG7" target="_blank"
                                    class="maps-review-btn">
                                    <i class="fas fa-star"></i>
                                    Review Google Maps
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-card reveal">
                    <div class="form-title">
                        Formulir Lamaran Kerja
                    </div>

                    <form action="{{ route('pelamar.store') }}" method="POST" id="applicationForm" novalidate>

                        @csrf

                        <!-- ===================== -->
                        <!-- DATA DASAR -->
                        <!-- ===================== -->

                        <div class="form-row">

                            {{-- RUMAH SAKIT --}}
                            <div class="form-group">

                                <label class="form-label">
                                    Rumah Sakit *
                                </label>

                                <select class="form-select" name="rumah_sakit_id" id="rumahSakitSelect"
                                    data-field="rumah_sakit_id">

                                    <option value="">
                                        — Pilih Rumah Sakit —
                                    </option>

                                    @foreach ($rumahSakits as $rs)
                                        <option value="{{ $rs->id }}">
                                            {{ $rs->nama_rs }}
                                        </option>
                                    @endforeach

                                </select>

                                <small class="error-text" data-error="rumah_sakit_id"></small>

                            </div>

                            {{-- POSISI --}}
                            <div class="form-group">

                                <label class="form-label">
                                    Posisi yang Dilamar *
                                </label>

                                <select class="form-select" name="id_posisi" id="posisiSelect"
                                    data-field="id_posisi" disabled>

                                    <option value="">
                                        — Pilih Rumah Sakit Terlebih Dahulu —
                                    </option>

                                    @foreach ($posisis as $posisi)
                                        <option value="{{ $posisi->id }}" data-rs="{{ $posisi->id_rs }}">
                                            {{ $posisi->nama_posisi }}
                                        </option>
                                    @endforeach

                                </select>

                                <small class="error-text" data-error="id_posisi"></small>

                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- IDENTITAS -->
                        <!-- ===================== -->

                        <div class="form-row">

                            <div class="form-group">
                                <label class="form-label">
                                    Nama Lengkap *
                                </label>

                                <input class="form-input" type="text" name="nama" data-field="nama">

                                <small class="error-text" data-error="nama"></small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    NIK *
                                </label>

                                <input class="form-input" type="text" name="nik" maxlength="16"
                                    data-field="nik">

                                <small class="error-text" data-error="nik"></small>
                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- EMAIL DAN HP -->
                        <!-- ===================== -->

                        <div class="form-row">

                            <div class="form-group">
                                <label class="form-label">
                                    Email *
                                </label>

                                <input class="form-input" type="email" name="email" data-field="email">

                                <small class="error-text" data-error="email"></small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    No. Telepon *
                                </label>

                                <input class="form-input" type="text" name="no_hp" data-field="no_hp">

                                <small class="error-text" data-error="no_hp"></small>
                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- JENIS KELAMIN -->
                        <!-- ===================== -->

                        <div class="form-row">

                            <div class="form-group">
                                <label class="form-label">
                                    Jenis Kelamin *
                                </label>

                                <select class="form-select" name="jenis_kelamin" data-field="jenis_kelamin">

                                    <option value="">
                                        — Pilih Jenis Kelamin —
                                    </option>

                                    <option value="Laki-laki">
                                        Laki-laki
                                    </option>

                                    <option value="Perempuan">
                                        Perempuan
                                    </option>

                                </select>

                                <small class="error-text" data-error="jenis_kelamin"></small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Jenis Pelamar *
                                </label>

                                <select class="form-select" name="jenis_pelamar" data-field="jenis_pelamar">

                                    <option value="">
                                        — Pilih Jenis Pelamar —
                                    </option>

                                    <option value="nakes">
                                        Tenaga Kesehatan
                                    </option>

                                    <option value="non_nakes">
                                        Non Tenaga Kesehatan
                                    </option>

                                </select>

                                <small class="error-text" data-error="jenis_pelamar"></small>
                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- PENDIDIKAN -->
                        <!-- ===================== -->

                        <div class="form-row">

                            <div class="form-group">
                                <label class="form-label">
                                    Jenjang Pendidikan *
                                </label>

                                <select class="form-select" name="jenjang" data-field="jenjang">

                                    <option value="">
                                        — Pilih Jenjang —
                                    </option>

                                    <option value="SMA">SMA</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>

                                </select>

                                <small class="error-text" data-error="jenjang"></small>
                            </div>

                            <div class="form-group" id="group-no-str">
                                <label class="form-label" id="label-no-str">
                                    No STR
                                </label>

                                <input class="form-input" type="text" name="no_str" data-field="no_str"
                                    id="no_str">

                                <small class="form-text" id="text-no-str">
                                    Diisi jika merupakan tenaga kesehatan
                                </small>

                                <small class="error-text" data-error="no_str"></small>
                            </div>
                        </div>

                        <!-- ===================== -->
                        <!-- DOMISILI -->
                        <!-- ===================== -->

                        <div class="form-row">

                            <div class="form-group">
                                <label class="form-label">
                                    Kota Domisili *
                                </label>

                                <input class="form-input" type="text" name="kota_domisili"
                                    data-field="kota_domisili">

                                <small class="error-text" data-error="kota_domisili"></small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Pengalaman Kerja
                                </label>

                                <select class="form-select" name="pengalaman_kerja" data-field="pengalaman_kerja">
                                    <option value="" >
                                        — Pilih Pengalaman —
                                    </option>
                                    <option value=" Kurang Dari 1 Tahun">
                                        Kurang Dari 1 Tahun
                                    </option>

                                    <option value="1 - 3 Tahun">
                                        1 – 3 Tahun
                                    </option>

                                    <option value="Lebih dari 3 Tahun">
                                        Lebih dari 3 Tahun
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                No Ijasah *
                            </label>

                            <input class="form-input" type="text" name="no_ijasah" data-field="no_ijasah">

                            <small class="error-text" data-error="no_ijasah"></small>
                        </div>

                        <!-- ===================== -->
                        <!-- ALAMAT -->
                        <!-- ===================== -->

                        <div class="form-group">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea class="form-textarea" name="alamat" data-field="alamat"></textarea>

                            <small class="error-text" data-error="alamat"></small>

                        </div>

                        <!-- ===================== -->
                        <!-- MOTIVASI -->
                        <!-- ===================== -->

                        <div class="form-group">

                            <label class="form-label">
                                Motivasi / Keterangan Tambahan
                            </label>

                            <textarea class="form-textarea" name="keterangan_pengalaman" data-field="keterangan_pengalaman"></textarea>

                            <small class="error-text" data-error="keterangan_pengalaman"></small>

                        </div>

                        <!-- ===================== -->
                        <!-- ALERT -->
                        <!-- ===================== -->

                        <div class="alert-info">

                            <i class="fas fa-info-circle"></i>

                            Berkas pendukung seperti CV, ijazah,
                            STR/SIP, sertifikat, dan dokumen lainnya
                            akan diupload setelah pendaftaran berhasil
                            dan pelamar berhasil login ke sistem.

                        </div>

                        <!-- ===================== -->
                        <!-- BUTTON -->
                        <!-- ===================== -->

                        <button type="submit" class="form-submit">

                            <i class="fas fa-paper-plane"></i>

                            Kirim Lamaran

                        </button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── FAQ ─── -->
    <section class="faq-section" id="faq">
        <div class="section-inner">
            <div class="section-header center reveal">
                <div class="section-tag">FAQ</div>
                <h2>Pertanyaan yang <span>Sering Ditanyakan</span></h2>
            </div>
            <div class="faq-grid reveal" id="faqGrid">
                <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Apakah ada biaya pendaftaran? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">Tidak ada biaya apapun dalam seluruh proses rekrutmen kami. Proses seleksi
                        sepenuhnya gratis dan transparan.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Berapa lama proses seleksi berlangsung? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">Proses seleksi umumnya berlangsung 2–4 minggu, tergantung posisi yang dilamar.
                        Anda akan mendapat notifikasi di setiap tahap.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Dokumen apa saja yang diperlukan? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">CV terbaru, fotokopi ijazah & transkrip nilai, STR/SIP (bagi tenaga medis),
                        sertifikat kompetensi, dan pas foto terbaru.</div>
                </div>
                {{-- <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Apakah ada program untuk Fresh Graduate? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">Ya! Kami memiliki program Management Trainee dan Fresh Graduate Program khusus
                        untuk lulusan baru dengan mentoring intensif selama 6 bulan.</div>
                </div> --}}
                {{-- <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Apakah ada fasilitas perumahan dinas? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">Beberapa posisi tertentu (terutama dokter spesialis di daerah) mendapatkan
                        fasilitas perumahan dinas atau tunjangan perumahan.</div>
                </div> --}}
                {{-- <div class="faq-item">
                    <div class="faq-q" onclick="toggleFAQ(this)">
                        Bagaimana cara memantau status lamaran? <i class="fas fa-chevron-down faq-arrow"></i>
                    </div>
                    <div class="faq-a">Setelah mengirim lamaran, Anda akan menerima email konfirmasi beserta nomor
                        referensi untuk memantau status lamaran secara online.</div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- ─── FOOTER ─── -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <a href="#" class="footer-logo">
                        <div class="footer-logo-icon"><i class="fas fa-heartbeat"></i></div>
                        Rekrutment
                    </a>
                    <p class="footer-about">Platform rekrutmen resmi tenaga kesehatan profesional Indonesia. Kami
                        berkomitmen menghadirkan proses seleksi yang adil, transparan, dan bermartabat.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/rsdkalisatjember/" class="social-link"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=61574390483671" class="social-link"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.tiktok.com/@rsdkalisat" class="social-link"><i
                                class="fab fa-tiktok"></i></a>
                        <a href="https://www.youtube.com/@rsdkalisatjember" class="social-link"><i
                                class="fab fa-youtube"></i></a>

                    </div>
                </div>
                <div>
                    <div class="footer-col-title">Navigasi</div>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#posisi">Lowongan Kerja</a></li>
                        <li><a href="#proses">Proses Rekrutmen</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#daftar">Daftar Sekarang</a></li>
                    </ul>
                </div>
                {{-- <div>
                    <div class="footer-col-title">Posisi Populer</div>
                    <ul class="footer-links">
                        <li><a href="#">Dokter Umum</a></li>
                        <li><a href="#">Dokter Spesialis</a></li>
                        <li><a href="#">Perawat / Ners</a></li>
                        <li><a href="#">Apoteker Klinis</a></li>
                        <li><a href="#">Fisioterapis</a></li>
                    </ul>
                </div> --}}
                <div>
                    <div class="footer-col-title">Kontak</div>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-map-marker-alt" style="width:16px"></i> Jember, Jawa
                                Timur</a></li>
                        <li><a href="#"><i class="fas fa-phone" style="width:16px"></i> (031) 5xx-xxxx</a></li>
                        <li><a href="#"><i class="fas fa-envelope" style="width:16px"></i>
                                rsdkalisat@gmail.com</a></li>
                        <li><a href="#"><i class="fas fa-clock" style="width:16px"></i> Senin–Jumat,
                                08.00–15.00</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2026 RSD KALISAT Rekrutment. Hak cipta dilindungi undang-undang.</span>
                <span>Kebijakan Privasi · Syarat & Ketentuan</span>
            </div>
        </div>
    </footer>


    <!-- Scroll to top -->
    <button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </button>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js"></script>
    <script>
        const form = document.getElementById('applicationForm');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // WAJIB untuk AJAX

                const formData = new FormData(form);

                // ======================
                // RESET ERROR
                // ======================
                document.querySelectorAll('.error-text').forEach(el => el.innerText = '');
                document.querySelectorAll('.form-input, .form-select, .form-textarea')
                    .forEach(el => el.classList.remove('error'));

                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Mengirim...';

                // ======================
                // LOADING
                // ======================
                Swal.fire({
                    title: 'Mengirim lamaran...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // ======================
                // AJAX REQUEST
                // ======================
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();

                        if (!res.ok) throw data;

                        return data;
                    })
                    .then(res => {

                        // SUCCESS
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message || 'Pendaftaran berhasil'
                        }).then(() => {
                            window.location.href = res.redirect;
                        });

                    })
                    .catch(err => {

                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Lamaran';

                        Swal.close();

                        // ======================
                        // VALIDATION ERROR
                        // ======================
                        if (err.errors) {

                            let firstError = null;

                            Object.keys(err.errors).forEach(field => {

                                // ambil pesan error pertama
                                const message = err.errors[field][0];

                                // support array field (sertifikat.*)
                                const cleanField = field.split('.')[0];

                                const errorEl = document.querySelector(`[data-error="${cleanField}"]`);
                                const inputEl = document.querySelector(`[name="${cleanField}"]`);

                                if (errorEl) {
                                    errorEl.innerText = message;
                                }

                                if (inputEl) {
                                    inputEl.classList.add('error');
                                }

                                if (!firstError) {
                                    firstError = inputEl;
                                }
                            });

                            // scroll ke error pertama
                            if (firstError) {
                                firstError.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }

                            Swal.fire({
                                icon: 'warning',
                                title: 'Periksa Form',
                                text: 'Masih ada data yang belum valid'
                            });

                        } else {
                            // ======================
                            // SERVER ERROR
                            // ======================
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: err.message || 'Terjadi kesalahan server'
                            });
                        }
                    });
            });
        }

        // ─── SWIPER ───
        new Swiper('.swiper-testi', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        // ─── NAV ───
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
            document.getElementById('scrollTop').classList.toggle('show', window.scrollY > 400);
        });

        document.getElementById('hamburger').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('open');
            this.innerHTML = menu.classList.contains('open') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });
        document.querySelectorAll('.mobile-link').forEach(a => {
            a.addEventListener('click', () => {
                document.getElementById('mobileMenu').classList.remove('open');
                document.getElementById('hamburger').innerHTML = '<i class="fas fa-bars"></i>';
            });
        });

        // ─── FAQ ───
        function toggleFAQ(el) {
            const answer = el.nextElementSibling;
            const isOpen = el.classList.contains('open');
            document.querySelectorAll('.faq-q').forEach(q => {
                q.classList.remove('open');
                q.nextElementSibling.classList.remove('open');
            });
            if (!isOpen) {
                el.classList.add('open');
                answer.classList.add('open');
            }
        }

        // ─── COUNTER ───
        function animateCounters(els) {
            els.forEach(el => {
                const target = +el.dataset.target;
                const duration = 1800;
                const step = target / (duration / 16);
                let current = 0;
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = Math.floor(current).toLocaleString('id-ID');
                    if (current >= target) clearInterval(timer);
                }, 16);
            });
        }

        // ─── SCROLL REVEAL ───
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    const counters = entry.target.querySelectorAll('.counting');
                    if (counters.length) animateCounters(counters);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        setTimeout(() => {
            animateCounters(document.querySelectorAll('.hero-stats .counting'));
        }, 700);

        document.addEventListener('DOMContentLoaded', function() {

            const jenisPelamar = document.querySelector('[name="jenis_pelamar"]');
            const labelNoStr = document.getElementById('label-no-str');
            const textNoStr = document.getElementById('text-no-str');
            const inputNoStr = document.getElementById('no_str');

            function toggleSTR() {

                if (jenisPelamar.value === 'nakes') {

                    labelNoStr.innerHTML = 'No STR <span style="color:red;">*</span>';

                    textNoStr.innerHTML = 'Wajib diisi untuk tenaga kesehatan';
                    textNoStr.style.color = 'red';

                    inputNoStr.setAttribute('required', true);

                } else {

                    labelNoStr.innerHTML = 'No STR';

                    textNoStr.innerHTML = 'Opsional untuk non tenaga kesehatan';
                    textNoStr.style.color = '#6c757d';

                    inputNoStr.removeAttribute('required');

                }
            }

            toggleSTR();

            jenisPelamar.addEventListener('change', toggleSTR);

        });
        // filter posisi berdasarkan rumah sakit
        const rsSelect = document.getElementById('rumahSakitSelect');
        const posisiSelect = document.getElementById('posisiSelect');

        const allOptions = [...posisiSelect.options];

        rsSelect.addEventListener('change', function() {

            const rsId = this.value;

            posisiSelect.innerHTML = '';

            // default option
            const defaultOption = document.createElement('option');

            defaultOption.value = '';
            defaultOption.textContent = '— Pilih Posisi —';

            posisiSelect.appendChild(defaultOption);

            if (!rsId) {

                posisiSelect.disabled = true;

                return;
            }

            posisiSelect.disabled = false;

            allOptions.forEach(option => {

                if (!option.value) return;

                if (option.dataset.rs == rsId) {

                    posisiSelect.appendChild(option.cloneNode(true));
                }
            });

        });
    </script>
</body>

</html>
