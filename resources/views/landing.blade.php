<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Tanaman Cabai</title>

    <!-- AOS Animate On Scroll -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-deep:   #0d3d2b;
            --green-mid:    #165c3e;
            --green-fresh:  #1e8a52;
            --green-light:  #2dba72;
            --green-pale:   #e8f7ef;
            --red-chili:    #d63a2f;
            --red-warm:     #e85d50;
            --gold:         #c8a84b;
            --cream:        #faf8f3;
            --text-dark:    #1a2e22;
            --text-muted:   #5a7060;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, .display-font {
            font-family: 'Playfair Display', serif;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(13, 61, 43, 0.96);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(45,186,114,0.15);
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            padding: 0.6rem 0;
            background: rgba(13, 61, 43, 0.99);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--green-light), var(--red-chili));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        .brand-text span { color: var(--green-light); }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem !important;
            border-radius: 6px;
            transition: all 0.2s;
            letter-spacing: 0.02em;
        }
        .navbar-nav .nav-link:hover { color: #fff !important; background: rgba(255,255,255,0.08); }
        .btn-nav-login {
            background: transparent;
            border: 1.5px solid rgba(45,186,114,0.6);
            color: var(--green-light) !important;
            border-radius: 8px;
        }
        .btn-nav-login:hover {
            background: var(--green-fresh) !important;
            color: #fff !important;
            border-color: var(--green-fresh);
        }
        .btn-nav-register {
            background: var(--red-chili);
            border: 1.5px solid var(--red-chili);
            color: #fff !important;
            border-radius: 8px;
        }
        .btn-nav-register:hover {
            background: var(--red-warm) !important;
            border-color: var(--red-warm);
        }
        .navbar-toggler { border: none; outline: none; }
        .navbar-toggler-icon { filter: invert(1); }

        /* ── HERO ── */
        #hero {
            min-height: 100vh;
            background:
                radial-gradient(ellipse 80% 60% at 70% 40%, rgba(30,138,82,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 20% 80%, rgba(214,58,47,0.1) 0%, transparent 50%),
                linear-gradient(160deg, var(--green-deep) 0%, #0a2e1e 40%, #071f14 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 80px;
        }

        /* Decorative circles */
        #hero::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(45,186,114,0.08);
            top: -100px; right: -150px;
        }
        #hero::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(45,186,114,0.06);
            bottom: -80px; left: -100px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(45,186,114,0.12);
            border: 1px solid rgba(45,186,114,0.3);
            color: var(--green-light);
            padding: 0.4rem 1rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5vw, 4rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        .hero-title .highlight {
            color: var(--green-light);
            position: relative;
        }
        .hero-title .highlight-red { color: var(--red-warm); }

        .hero-subtitle {
            font-size: 1rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 2.5rem;
        }

        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--green-fresh), var(--green-light));
            color: #fff;
            padding: 0.85rem 2.2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            box-shadow: 0 8px 30px rgba(30,138,82,0.4);
            transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(30,138,82,0.5);
            color: #fff;
        }

        .btn-hero-secondary {
            background: transparent;
            color: rgba(255,255,255,0.85);
            padding: 0.85rem 2rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            border: 1.5px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.4);
            color: #fff;
        }

        /* Hero stats */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .stat-item .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--green-light);
        }
        .stat-item .stat-label {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* Hero illustration panel */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero-card-main {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 2;
        }
        .hero-card-main .card-header-custom {
            display: flex; align-items: center; gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .pulse-dot {
            width: 10px; height: 10px;
            background: var(--green-light);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(45,186,114,0.4); }
            50% { opacity: 0.8; transform: scale(1.1); box-shadow: 0 0 0 6px rgba(45,186,114,0); }
        }
        .card-title-small {
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .symptom-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            transition: all 0.3s;
        }
        .symptom-item.active {
            background: rgba(45,186,114,0.15);
            border-color: rgba(45,186,114,0.3);
        }
        .symptom-check {
            width: 20px; height: 20px;
            border-radius: 6px;
            border: 1.5px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .symptom-item.active .symptom-check {
            background: var(--green-light);
            border-color: var(--green-light);
        }
        .symptom-text {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.7);
        }
        .symptom-item.active .symptom-text { color: rgba(255,255,255,0.95); }

        .result-bar {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .result-label {
            display: flex; justify-content: space-between;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.6);
            margin-bottom: 0.4rem;
        }
        .result-label span:last-child { color: var(--green-light); font-weight: 600; }
        .progress-bar-custom {
            height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 100px;
            overflow: hidden;
            margin-bottom: 0.6rem;
        }
        .progress-fill {
            height: 100%;
            border-radius: 100px;
            background: linear-gradient(90deg, var(--green-fresh), var(--green-light));
            animation: fillBar 2s ease-out forwards;
            transform-origin: left;
        }
        .progress-fill.red { background: linear-gradient(90deg, var(--red-chili), var(--red-warm)); }
        @keyframes fillBar { from { width: 0; } }

        /* Floating badge */
        .float-badge {
            position: absolute;
            background: linear-gradient(135deg, var(--red-chili), var(--red-warm));
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(214,58,47,0.4);
            animation: floatBadge 3s ease-in-out infinite;
        }
        .float-badge.top { top: -15px; right: -20px; }
        .float-badge.bottom { bottom: 10px; left: -25px; }
        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* ── SECTION COMMON ── */
        section { padding: 100px 0; }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--green-fresh);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .section-label::before {
            content: '';
            width: 24px; height: 2px;
            background: var(--green-fresh);
            border-radius: 2px;
        }
        .section-title {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 900;
            color: var(--green-deep);
            line-height: 1.25;
            margin-bottom: 1rem;
        }
        .section-desc {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.8;
            max-width: 520px;
        }

        /* ── ABOUT ── */
        #tentang { background: #fff; }

        .about-visual {
            position: relative;
        }
        .about-img-wrap {
            background: linear-gradient(135deg, var(--green-deep), var(--green-mid));
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .about-img-wrap::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(45,186,114,0.08);
            top: -100px; right: -100px;
        }
        .about-emoji { font-size: 5rem; display: block; margin-bottom: 1rem; }
        .about-chip {
            display: inline-block;
            background: rgba(45,186,114,0.15);
            color: var(--green-light);
            padding: 0.3rem 0.8rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            margin: 0.2rem;
            border: 1px solid rgba(45,186,114,0.2);
        }

        .about-point {
            display: flex; gap: 1rem;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        .about-point-icon {
            width: 44px; height: 44px;
            background: var(--green-pale);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--green-fresh);
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .about-point-title { font-weight: 600; color: var(--green-deep); margin-bottom: 0.2rem; font-size: 0.95rem; }
        .about-point-desc { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        /* ── FITUR ── */
        #fitur { background: var(--green-pale); }

        .feature-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem 1.75rem;
            height: 100%;
            border: 1px solid rgba(13,61,43,0.06);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--green-fresh), var(--green-light));
            transform: scaleX(0);
            transition: transform 0.35s ease;
        }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(13,61,43,0.1); }
        .feature-card:hover::before { transform: scaleX(1); }

        .feature-icon-wrap {
            width: 56px; height: 56px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .feature-card h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--green-deep);
            margin-bottom: 0.6rem;
        }
        .feature-card p { font-size: 0.875rem; color: var(--text-muted); line-height: 1.7; }

        /* ── METODE ── */
        #metode { background: #fff; }

        .method-card {
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .method-card.wp {
            background: linear-gradient(135deg, var(--green-deep) 0%, var(--green-mid) 100%);
            color: #fff;
        }
        .method-card.rb {
            background: linear-gradient(135deg, #2c1810 0%, var(--red-chili) 100%);
            color: #fff;
        }
        .method-card::before {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -60px; right: -60px;
        }
        .method-icon {
            font-size: 2.5rem;
            margin-bottom: 1.25rem;
            display: block;
        }
        .method-card h3 {
            font-size: 1.4rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            color: #fff;
        }
        .method-card .method-sub {
            font-size: 0.8rem;
            opacity: 0.65;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.25rem;
        }
        .method-card p { font-size: 0.875rem; opacity: 0.85; line-height: 1.75; margin-bottom: 1.25rem; }

        .method-step {
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.82rem;
            opacity: 0.85;
            margin-bottom: 0.6rem;
        }
        .step-num {
            width: 24px; height: 24px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .method-formula {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            margin-top: 1rem;
            letter-spacing: 0.03em;
        }

        /* ── CTA ── */
        #cta {
            background: linear-gradient(135deg, var(--green-deep) 0%, #0a2e1e 100%);
            position: relative;
            overflow: hidden;
            padding: 120px 0;
        }
        #cta::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 1px solid rgba(45,186,114,0.1);
            top: -200px; left: -100px;
        }
        #cta::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(214,58,47,0.1);
            bottom: -150px; right: -100px;
        }
        .cta-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .cta-desc { font-size: 1rem; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 480px; margin: 0 auto 2.5rem; }

        .btn-cta {
            background: linear-gradient(135deg, var(--green-fresh), var(--green-light));
            color: #fff;
            padding: 1rem 3rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.6rem;
            box-shadow: 0 10px 40px rgba(30,138,82,0.5);
            transition: all 0.3s ease;
            border: none;
        }
        .btn-cta:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 16px 50px rgba(30,138,82,0.6);
            color: #fff;
        }

        /* ── FOOTER ── */
        footer {
            background: #050f09;
            padding: 3rem 0 2rem;
            color: rgba(255,255,255,0.5);
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .footer-brand span { color: var(--green-light); }
        .footer-divider {
            border-color: rgba(255,255,255,0.07);
            margin: 1.5rem 0;
        }
        .footer-bottom {
            font-size: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: gap;
            gap: 0.5rem;
        }
        .footer-links a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            margin-left: 1.25rem;
            font-size: 0.8rem;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--green-light); }

        /* ── SCROLL TO TOP ── */
        .scroll-top {
            position: fixed;
            bottom: 2rem; right: 2rem;
            width: 44px; height: 44px;
            background: var(--green-fresh);
            color: #fff;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(30,138,82,0.4);
            font-size: 1.1rem;
        }
        .scroll-top.visible { opacity: 1; transform: translateY(0); }
        .scroll-top:hover { background: var(--green-light); color: #fff; transform: translateY(-2px); }

        /* Responsive */
        @media (max-width: 768px) {
            section { padding: 70px 0; }
            .hero-stats { gap: 1.5rem; }
            .float-badge { display: none; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .footer-links a { margin: 0 0.5rem; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="brand-icon">🌶️</div>
            <div class="brand-text">Sistem Pakar <span>Cabai</span></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#metode">Metode</a></li>
            </ul>
            <div class="d-flex gap-2 mt-2 mt-lg-0">
                <a href="{{ route('login') }}" class="nav-link btn-nav-login px-3">Login</a>
                <a href="{{ route('register') }}" class="nav-link btn-nav-register px-3">Daftar</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="hero">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge" data-aos="fade-down" data-aos-duration="600">
                    <span>🔬</span> Sistem Pakar Berbasis AI
                </div>
                <h1 class="hero-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    Diagnosa Penyakit<br>
                    <span class="hero-title">Tanaman Cabai</span><br>
                    <span class="highlight">Lebih Akurat</span>
                </h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    Menggunakan metode <strong style="color:rgba(255,255,255,0.9)">Weighted Product (WP)</strong>
                    dan <strong style="color:rgba(255,255,255,0.9)">Rule-Based</strong> untuk membantu petani
                    mengidentifikasi penyakit cabai berdasarkan gejala secara cepat dan tepat.
                </p>
                <div class="hero-actions" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="bi bi-play-circle-fill"></i> Mulai Diagnosa
                    </a>
                    <a href="#tentang" class="btn-hero-secondary">
                        <i class="bi bi-info-circle"></i> Pelajari Lebih
                    </a>
                </div>
                <div class="hero-stats" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                    <div class="stat-item">
                        <div class="stat-num">5+</div>
                        <div class="stat-label">Jenis Penyakit</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">10+</div>
                        <div class="stat-label">Gejala Terdeteksi</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">WP</div>
                        <div class="stat-label">Metode Analisis</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="hero-visual">
                    <div class="float-badge top">🌿 Analisis Real-time</div>
                    <div class="hero-card-main">
                        <div class="card-header-custom">
                            <div class="pulse-dot"></div>
                            <span class="card-title-small">Sistem Diagnosa Aktif</span>
                        </div>
                        <div class="symptom-item active">
                            <div class="symptom-check"><i class="bi bi-check text-white" style="font-size:0.7rem"></i></div>
                            <span class="symptom-text">Buah cabai busuk basah</span>
                        </div>
                        <div class="symptom-item active">
                            <div class="symptom-check"><i class="bi bi-check text-white" style="font-size:0.7rem"></i></div>
                            <span class="symptom-text">Bercak coklat pada buah</span>
                        </div>
                        <div class="symptom-item">
                            <div class="symptom-check"></div>
                            <span class="symptom-text">Daun menguning</span>
                        </div>
                        <div class="symptom-item">
                            <div class="symptom-check"></div>
                            <span class="symptom-text">Batang membusuk</span>
                        </div>
                        <div class="result-bar">
                            <div class="result-label">
                                <span>Antraknosa</span>
                                <span>83.4%</span>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-fill" style="width:83.4%"></div>
                            </div>
                            <div class="result-label">
                                <span>Layu Fusarium</span>
                                <span>16.6%</span>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-fill red" style="width:16.6%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="float-badge bottom">✅ Rekomendasi Obat Tersedia</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG SISTEM -->
<section id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="700">
                <div class="about-img-wrap">
                    <span class="about-emoji">🌶️</span>
                    <div>
                        <span class="about-chip">Sistem Pakar</span>
                        <span class="about-chip">Weighted Product</span>
                        <span class="about-chip">Rule-Based</span>
                        <span class="about-chip">Laravel</span>
                        <span class="about-chip">Pertanian Digital</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="section-label">Tentang Sistem</div>
                <h2 class="section-title">Apa Itu Sistem Pakar<br>Diagnosa Cabai?</h2>
                <p class="section-desc mb-4">
                    Sistem ini dirancang untuk membantu petani, penyuluh pertanian, dan peneliti dalam
                    mengidentifikasi penyakit tanaman cabai secara cepat, akurat, dan berbasis pengetahuan pakar.
                </p>
                <div class="about-point">
                    <div class="about-point-icon"><i class="bi bi-cpu"></i></div>
                    <div>
                        <div class="about-point-title">Berbasis Kecerdasan Buatan</div>
                        <div class="about-point-desc">Menggunakan basis pengetahuan dari pakar pertanian yang diintegrasikan ke dalam sistem komputasi untuk menghasilkan diagnosa yang reliable.</div>
                    </div>
                </div>
                <div class="about-point">
                    <div class="about-point-icon"><i class="bi bi-shield-check"></i></div>
                    <div>
                        <div class="about-point-title">Akurasi Terukur</div>
                        <div class="about-point-desc">Metode Weighted Product memberikan nilai preferensi terukur sehingga hasil diagnosa dilengkapi dengan tingkat kepercayaan yang jelas.</div>
                    </div>
                </div>
                <div class="about-point">
                    <div class="about-point-icon"><i class="bi bi-journal-medical"></i></div>
                    <div>
                        <div class="about-point-title">Rekomendasi Pengendalian</div>
                        <div class="about-point-desc">Setiap hasil diagnosa dilengkapi rekomendasi obat atau cara pengendalian penyakit yang sesuai.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR -->
<section id="fitur">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center" data-aos="fade-up">Fitur Unggulan</div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Apa yang Bisa Dilakukan<br>Sistem Ini?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#e8f7ef;">
                        <span>🔍</span>
                    </div>
                    <h5>Diagnosa Penyakit</h5>
                    <p>Identifikasi penyakit tanaman cabai secara otomatis berdasarkan gejala yang dipilih pengguna.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#fff3f3;">
                        <span>✅</span>
                    </div>
                    <h5>Pemilihan Gejala</h5>
                    <p>Pilih gejala yang terlihat pada tanaman secara mudah menggunakan antarmuka checkbox yang intuitif.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#fffbea;">
                        <span>📊</span>
                    </div>
                    <h5>Analisis & Ranking</h5>
                    <p>Hasil perhitungan WP ditampilkan dalam bentuk ranking penyakit beserta nilai preferensi masing-masing.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#eef5ff;">
                        <span>💊</span>
                    </div>
                    <h5>Rekomendasi Obat</h5>
                    <p>Dapatkan rekomendasi pengendalian dan obat yang tepat berdasarkan penyakit yang terdiagnosa.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#f3f0ff;">
                        <span>📄</span>
                    </div>
                    <h5>Export PDF</h5>
                    <p>Unduh hasil diagnosa dalam format PDF untuk keperluan dokumentasi dan laporan pertanian.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#e8f7ef;">
                        <span>📋</span>
                    </div>
                    <h5>Riwayat Diagnosa</h5>
                    <p>Simpan dan akses kembali riwayat diagnosa yang pernah dilakukan untuk monitoring tanaman.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#fff3f3;">
                        <span>🛠️</span>
                    </div>
                    <h5>Panel Admin</h5>
                    <p>Kelola data penyakit, gejala, basis pengetahuan, dan obat secara terstruktur melalui panel admin.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:#fffbea;">
                        <span>📱</span>
                    </div>
                    <h5>Responsif</h5>
                    <p>Tampilan yang optimal di semua perangkat — desktop, tablet, maupun smartphone.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- METODE -->
<section id="metode">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center" data-aos="fade-up">Metode Ilmiah</div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Dua Metode yang Digunakan</h2>
            <p class="section-desc mx-auto" data-aos="fade-up" data-aos-delay="150">
                Kombinasi Rule-Based dan Weighted Product menghasilkan sistem yang andal dan terukur.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="700">
                <div class="method-card wp">
                    <span class="method-icon">⚖️</span>
                    <div class="method-sub">Metode Utama</div>
                    <h3>Weighted Product (WP)</h3>
                    <p>
                        Metode pengambilan keputusan multi-kriteria yang mengalikan setiap atribut dengan bobot
                        tertentu menggunakan operasi perkalian berpangkat, menghasilkan nilai preferensi
                        untuk setiap penyakit kandidat.
                    </p>
                    <div class="method-step">
                        <div class="step-num">1</div>
                        <span>Normalisasi input gejala dari pengguna</span>
                    </div>
                    <div class="method-step">
                        <div class="step-num">2</div>
                        <span>Hitung nilai S = ∏ (nilai)^bobot per penyakit</span>
                    </div>
                    <div class="method-step">
                        <div class="step-num">3</div>
                        <span>Hitung nilai V = S(i) / ΣS sebagai preferensi akhir</span>
                    </div>
                    <div class="method-formula">
                        S(i) = ∏ (X<sub>ij</sub>)^W<sub>j</sub> &nbsp;|&nbsp; V(i) = S(i) / ΣS
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="method-card rb">
                    <span class="method-icon">📋</span>
                    <div class="method-sub">Metode Pendukung</div>
                    <h3>Rule-Based System</h3>
                    <p>
                        Sistem berbasis aturan IF-THEN yang merepresentasikan pengetahuan pakar dalam
                        bentuk aturan produksi. Setiap penyakit memiliki himpunan gejala (rule) yang
                        dicocokkan dengan input pengguna.
                    </p>
                    <div class="method-step">
                        <div class="step-num">1</div>
                        <span>Basis pengetahuan disusun dari pakar pertanian</span>
                    </div>
                    <div class="method-step">
                        <div class="step-num">2</div>
                        <span>Gejala input dicocokkan dengan rule penyakit</span>
                    </div>
                    <div class="method-step">
                        <div class="step-num">3</div>
                        <span>Penyakit dengan minimal 1 gejala cocok masuk kandidat</span>
                    </div>
                    <div class="method-formula">
                        IF Gejala(G01 ∧ G09) THEN Penyakit(Antraknosa)
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section id="cta">
    <div class="container position-relative" style="z-index:2">
        <div class="text-center" data-aos="zoom-in" data-aos-duration="700">
            <div class="hero-badge justify-content-center mb-4" style="display:inline-flex">
                🌶️ Siap Mendiagnosa Tanaman Anda?
            </div>
            <h2 class="cta-title">Mulai Diagnosa Sekarang,<br>Selamatkan Panen Anda</h2>
            <p class="cta-desc">
                Daftarkan akun gratis dan gunakan sistem pakar ini untuk mendeteksi penyakit
                tanaman cabai sebelum terlambat.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn-cta">
                    <i class="bi bi-rocket-takeoff-fill"></i> Daftar & Mulai Gratis
                </a>
                <a href="{{ route('login') }}" class="btn-hero-secondary" style="padding:1rem 2rem; border-radius:14px; font-size:1.05rem;">
                    <i class="bi bi-box-arrow-in-right"></i> Sudah Punya Akun?
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="footer-brand">Sistem Pakar <span>Cabai</span></div>
                <div style="font-size:0.82rem; line-height:1.7;">
                    Sistem Pakar Diagnosa Penyakit Tanaman Cabai<br>
                    Menggunakan Metode Weighted Product & Rule-Based
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div style="font-size:0.82rem; line-height:1.7;">
                    Skripsi — [Nama Mahasiswa]<br>
                    [Nama Universitas] &bull; [Tahun]
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <span>© {{ date('Y') }} Sistem Pakar Cabai. All rights reserved.</span>
            <div class="footer-links">
                <a href="#hero">Home</a>
                <a href="#tentang">Tentang</a>
                <a href="#fitur">Fitur</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top -->
<a href="#hero" class="scroll-top" id="scrollTop">
    <i class="bi bi-arrow-up"></i>
</a>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Init AOS
    AOS.init({
        once: true,
        offset: 80,
        easing: 'ease-out-cubic',
    });

    // Navbar scroll effect
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 50);
    });

    // Scroll to top button
    const scrollBtn = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => {
        scrollBtn.classList.toggle('visible', window.scrollY > 400);
    });

    // Smooth active nav highlight
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(s => {
            if (window.scrollY >= s.offsetTop - 120) current = s.getAttribute('id');
        });
        navLinks.forEach(link => {
            link.style.color = link.getAttribute('href') === '#' + current
                ? 'rgba(255,255,255,1)'
                : '';
        });
    });
</script>

</body>
</html>