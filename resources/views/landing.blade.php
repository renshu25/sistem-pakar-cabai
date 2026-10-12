<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Tanaman Cabai</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-deep:   #0d3d2b;
            --green-mid:    #165c3e;
            --green-fresh:  #1e8a52;
            --green-light:  #2dba72;
            --green-pale:   #edf7f2;
            --red-chili:    #c0392b;
            --red-warm:     #d95448;
            --gold:         #b8972e;
            --cream:        #f9f7f2;
            --white:        #ffffff;
            --text-dark:    #1a2e22;
            --text-body:    #374840;
            --text-muted:   #637068;
            --border:       rgba(13,61,43,0.10);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text-body);
            overflow-x: hidden;
            font-size: 15px;
            line-height: 1.7;
        }

        h1, h2, h3, h4, .serif { font-family: 'Lora', serif; }
        code, .mono { font-family: 'JetBrains Mono', monospace; }

        /* ─── NAVBAR ─── */
        .navbar {
            background: rgba(13,61,43,0.97);
            backdrop-filter: blur(10px);
            padding: 0.85rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(45,186,114,0.12);
            transition: box-shadow 0.3s;
        }
        .navbar.scrolled { box-shadow: 0 2px 24px rgba(0,0,0,0.25); }
        .navbar-brand { display: flex; align-items: center; gap: 0.65rem; text-decoration: none; }
        .brand-mark {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--green-fresh), var(--green-light));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .brand-text { font-family: 'Lora', serif; font-size: 1rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .brand-text small { display: block; font-family: 'Inter', sans-serif; font-size: 0.68rem; font-weight: 400; color: rgba(255,255,255,0.5); letter-spacing: 0.04em; }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.75) !important;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.35rem 0.85rem !important;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .navbar-nav .nav-link:hover { color: #fff !important; background: rgba(255,255,255,0.07); }
        .btn-nav {
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.4rem 1.1rem !important;
            border-radius: 7px;
        }
        .btn-nav-outline {
            border: 1.5px solid rgba(45,186,114,0.5);
            color: var(--green-light) !important;
        }
        .btn-nav-outline:hover { background: rgba(45,186,114,0.12) !important; }
        .btn-nav-solid {
            background: var(--green-fresh);
            color: #fff !important;
            border: 1.5px solid var(--green-fresh);
        }
        .btn-nav-solid:hover { background: var(--green-light) !important; border-color: var(--green-light); }
        .navbar-toggler { border: none; }
        .navbar-toggler-icon { filter: invert(1); }

        /* ─── HERO ─── */
        #hero {
            min-height: 100vh;
            background: linear-gradient(150deg, var(--green-deep) 0%, #0b3320 45%, #091f14 100%);
            display: flex;
            align-items: center;
            padding-top: 76px;
            position: relative;
            overflow: hidden;
        }
        #hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 65% 35%, rgba(30,138,82,0.14) 0%, transparent 65%),
                radial-gradient(ellipse 40% 30% at 15% 80%, rgba(192,57,43,0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Subtle grid texture */
        #hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(45,186,114,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(45,186,114,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(45,186,114,0.1);
            border: 1px solid rgba(45,186,114,0.25);
            color: rgba(200,240,215,0.9);
            padding: 0.35rem 0.9rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .eyebrow-dot {
            width: 6px; height: 6px;
            background: var(--green-light);
            border-radius: 50%;
        }

        .hero-title {
            font-family: 'Lora', serif;
            font-size: clamp(2rem, 4.2vw, 3.4rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 0.8rem;
        }
        .hero-title em { font-style: italic; color: rgba(180,235,205,0.9); }

        .hero-method-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(192,57,43,0.2);
            border: 1px solid rgba(192,57,43,0.35);
            color: #f4a49e;
            padding: 0.2rem 0.7rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 1.4rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .hero-desc {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.8;
            max-width: 460px;
            margin-bottom: 2.2rem;
        }
        .hero-desc strong { color: rgba(255,255,255,0.85); font-weight: 600; }

        .hero-btns { display: flex; gap: 0.85rem; flex-wrap: wrap; margin-bottom: 2.8rem; }
        .btn-primary-hero {
            background: var(--green-fresh);
            color: #fff;
            padding: 0.78rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            border: none;
            display: inline-flex; align-items: center; gap: 0.45rem;
            transition: all 0.25s;
            box-shadow: 0 4px 20px rgba(30,138,82,0.35);
        }
        .btn-primary-hero:hover { background: var(--green-light); color: #fff; transform: translateY(-1px); box-shadow: 0 8px 28px rgba(30,138,82,0.45); }
        .btn-outline-hero {
            background: transparent;
            color: rgba(255,255,255,0.8);
            padding: 0.78rem 1.8rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            border: 1.5px solid rgba(255,255,255,0.18);
            display: inline-flex; align-items: center; gap: 0.45rem;
            transition: all 0.25s;
        }
        .btn-outline-hero:hover { border-color: rgba(255,255,255,0.4); color: #fff; background: rgba(255,255,255,0.05); }

        /* Hero indicators */
        .hero-indicators {
            display: flex; gap: 0;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 460px;
        }
        .hero-ind-item {
            flex: 1;
            padding: 0.9rem 1rem;
            border-right: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 0.6rem;
        }
        .hero-ind-item:last-child { border-right: none; }
        .ind-icon {
            width: 30px; height: 30px;
            background: rgba(45,186,114,0.12);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--green-light);
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .ind-label { font-size: 0.68rem; color: rgba(255,255,255,0.45); font-weight: 500; line-height: 1.3; }
        .ind-value { font-size: 0.78rem; color: rgba(255,255,255,0.9); font-weight: 600; line-height: 1.2; }

        /* Hero diagnosis card */
        .diagnosis-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 18px;
            padding: 1.75rem;
            max-width: 380px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }
        .dc-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.25rem;
        }
        .dc-title { font-size: 0.78rem; color: rgba(255,255,255,0.6); font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; }
        .dc-status {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.7rem; color: var(--green-light); font-weight: 600;
        }
        .dc-status-dot {
            width: 7px; height: 7px; background: var(--green-light); border-radius: 50%;
            animation: blink 2s infinite;
        }
        @keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0.3; } }

        .dc-section-label { font-size: 0.68rem; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.6rem; }

        .gejala-item {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.5rem 0.65rem;
            border-radius: 7px;
            margin-bottom: 0.35rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .gejala-item.checked { background: rgba(45,186,114,0.1); border-color: rgba(45,186,114,0.22); }
        .gejala-cb {
            width: 16px; height: 16px; border-radius: 4px;
            border: 1.5px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .gejala-item.checked .gejala-cb { background: var(--green-light); border-color: var(--green-light); }
        .gejala-code { font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; color: rgba(255,255,255,0.35); flex-shrink: 0; }
        .gejala-name { font-size: 0.78rem; color: rgba(255,255,255,0.7); }
        .gejala-item.checked .gejala-name { color: rgba(255,255,255,0.92); }

        .dc-divider { border-color: rgba(255,255,255,0.07); margin: 1.25rem 0; }

        .result-row { margin-bottom: 0.75rem; }
        .result-meta { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 0.3rem; }
        .result-disease { font-size: 0.8rem; color: rgba(255,255,255,0.8); font-weight: 600; font-family: 'Lora', serif; font-style: italic; }
        .result-score { font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; font-weight: 600; color: var(--green-light); }
        .result-score.red { color: #f4a49e; }
        .progress-track {
            height: 5px; background: rgba(255,255,255,0.08); border-radius: 100px; overflow: hidden;
        }
        .progress-fill {
            height: 100%; border-radius: 100px;
            background: linear-gradient(90deg, var(--green-fresh), var(--green-light));
        }
        .progress-fill.red { background: linear-gradient(90deg, var(--red-chili), var(--red-warm)); }

        /* ─── SECTION COMMONS ─── */
        section { padding: 90px 0; }

        .eyebrow-label {
            display: inline-flex; align-items: center; gap: 0.6rem;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--green-fresh);
            margin-bottom: 0.85rem;
        }
        .eyebrow-label::before { content: ''; width: 20px; height: 2px; background: var(--green-fresh); border-radius: 2px; }
        .eyebrow-label.light { color: rgba(45,186,114,0.8); }
        .eyebrow-label.light::before { background: rgba(45,186,114,0.8); }

        .section-heading {
            font-family: 'Lora', serif;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            font-weight: 700;
            color: var(--green-deep);
            line-height: 1.25;
            margin-bottom: 1rem;
        }
        .section-heading.light { color: #fff; }

        .section-body {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.85;
            max-width: 540px;
        }

        /* ─── ABOUT ─── */
        #tentang { background: var(--white); }

        .about-visual-block {
            background: linear-gradient(135deg, var(--green-deep) 0%, var(--green-mid) 100%);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        .about-visual-block::before {
            content: '';
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -100px; right: -80px;
            pointer-events: none;
        }

        /* Chili SVG illustration area */
        .chili-illustration {
            text-align: center;
            padding: 1rem 0;
            margin-bottom: 1.5rem;
        }
        .chili-svg-wrap svg { width: 180px; height: auto; }

        .tag-row { display: flex; flex-wrap: wrap; gap: 0.4rem; }
        .tag-pill {
            background: rgba(45,186,114,0.12);
            border: 1px solid rgba(45,186,114,0.22);
            color: rgba(200,240,215,0.85);
            padding: 0.25rem 0.7rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .about-point { display: flex; gap: 1rem; margin-bottom: 1.75rem; }
        .ap-icon {
            width: 42px; height: 42px; flex-shrink: 0;
            background: var(--green-pale);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--green-fresh);
            font-size: 1.15rem;
        }
        .ap-title { font-weight: 600; color: var(--green-deep); font-size: 0.92rem; margin-bottom: 0.25rem; }
        .ap-desc { font-size: 0.85rem; color: var(--text-muted); line-height: 1.7; }

        /* ─── METODE ─── */
        #metode { background: var(--cream); }

        /* Flow diagram */
        .flow-diagram {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2.5rem;
        }
        .flow-title { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); font-weight: 700; margin-bottom: 1.5rem; text-align: center; }
        .flow-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
            row-gap: 0.75rem;
        }
        .flow-step {
            display: flex; flex-direction: column; align-items: center;
            text-align: center;
            min-width: 110px;
        }
        .flow-step-num {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem; font-weight: 700;
            margin-bottom: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
        }
        .flow-step.input .flow-step-num { background: #e8f4fd; color: #2471a3; }
        .flow-step.rule .flow-step-num { background: #fef9e7; color: #b7950b; }
        .flow-step.wp .flow-step-num { background: var(--green-pale); color: var(--green-fresh); }
        .flow-step.output .flow-step-num { background: #fdf2f8; color: #8e44ad; }
        .flow-step-label { font-size: 0.76rem; font-weight: 600; color: var(--text-dark); line-height: 1.3; margin-bottom: 0.2rem; }
        .flow-step-desc { font-size: 0.68rem; color: var(--text-muted); line-height: 1.4; max-width: 90px; }
        .flow-arrow {
            color: var(--border);
            font-size: 1.1rem;
            padding: 0 0.25rem;
            flex-shrink: 0;
            align-self: flex-start;
            margin-top: 8px;
        }

        /* Method cards */
        .method-card {
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            border: 1px solid var(--border);
            background: var(--white);
        }
        .method-card.rule { border-top: 3px solid #c8a030; }
        .method-card.wp   { border-top: 3px solid var(--green-fresh); }

        .mc-label {
            display: inline-block;
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.2rem 0.6rem; border-radius: 4px;
            margin-bottom: 0.85rem;
        }
        .mc-label.rule { background: #fef9e7; color: #9a7d0a; }
        .mc-label.wp   { background: var(--green-pale); color: var(--green-fresh); }

        .method-card h4 { font-family: 'Lora', serif; font-size: 1.15rem; font-weight: 700; color: var(--green-deep); margin-bottom: 0.75rem; }
        .method-card p  { font-size: 0.875rem; color: var(--text-muted); line-height: 1.75; margin-bottom: 1rem; }

        .mc-step { display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 0.65rem; }
        .mc-step-num {
            width: 22px; height: 22px; flex-shrink: 0;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.68rem; font-weight: 700; margin-top: 0.05rem;
        }
        .rule .mc-step-num { background: #fef9e7; color: #9a7d0a; }
        .wp   .mc-step-num { background: var(--green-pale); color: var(--green-fresh); }
        .mc-step-text { font-size: 0.82rem; color: var(--text-body); line-height: 1.6; }

        .formula-box {
            background: #f7f8f9;
            border: 1px solid #e5e9ec;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: var(--text-dark);
            margin-top: 1rem;
            line-height: 1.6;
        }

        /* ─── FITUR ─── */
        #fitur { background: var(--white); }

        .feature-card {
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.75rem;
            height: 100%;
            transition: all 0.3s;
        }
        .feature-card:hover { background: var(--white); box-shadow: 0 8px 32px rgba(13,61,43,0.08); transform: translateY(-3px); }
        .fc-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        .feature-card h5 { font-family: 'Lora', serif; font-size: 1rem; font-weight: 700; color: var(--green-deep); margin-bottom: 0.5rem; }
        .feature-card p  { font-size: 0.84rem; color: var(--text-muted); line-height: 1.7; }

        /* ─── PENGUJIAN ─── */
        #pengujian {
            background: var(--green-deep);
            position: relative;
            overflow: hidden;
        }
        #pengujian::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 50% at 80% 50%, rgba(30,138,82,0.15) 0%, transparent 65%);
            pointer-events: none;
        }

        .stat-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 1.75rem;
            text-align: center;
            height: 100%;
        }
        .stat-number {
            font-family: 'Lora', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--green-light);
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .stat-unit { font-size: 1.1rem; }
        .stat-desc { font-size: 0.8rem; color: rgba(255,255,255,0.55); line-height: 1.5; }

        .result-summary {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 2rem;
            margin-top: 2.5rem;
        }
        .rs-title { font-family: 'Lora', serif; font-size: 1rem; color: rgba(255,255,255,0.85); font-weight: 600; margin-bottom: 0.5rem; }
        .rs-body  { font-size: 0.875rem; color: rgba(255,255,255,0.55); line-height: 1.75; }

        /* Accuracy badge */
        .accuracy-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(45,186,114,0.15);
            border: 1px solid rgba(45,186,114,0.3);
            color: var(--green-light);
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem; font-weight: 700;
        }

        /* ─── CTA ─── */
        #cta {
            background: var(--white);
            padding: 80px 0;
            border-top: 1px solid var(--border);
        }
        .cta-inner {
            background: linear-gradient(135deg, var(--green-deep), #0b3320);
            border-radius: 20px;
            padding: 3.5rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-inner::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            border: 1px solid rgba(45,186,114,0.1);
            top: -150px; right: -100px;
            pointer-events: none;
        }
        .cta-title { font-family: 'Lora', serif; font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: #fff; margin-bottom: 0.85rem; }
        .cta-desc { font-size: 0.9rem; color: rgba(255,255,255,0.55); line-height: 1.8; max-width: 440px; margin: 0 auto 2rem; }
        .cta-btns { display: flex; justify-content: center; gap: 0.85rem; flex-wrap: wrap; }
        .btn-cta-main {
            background: var(--green-fresh);
            color: #fff;
            padding: 0.85rem 2.2rem;
            border-radius: 8px;
            font-weight: 600; font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            transition: all 0.25s;
            box-shadow: 0 4px 20px rgba(30,138,82,0.4);
        }
        .btn-cta-main:hover { background: var(--green-light); color: #fff; transform: translateY(-1px); }
        .btn-cta-sec {
            background: transparent; color: rgba(255,255,255,0.75);
            padding: 0.85rem 2rem; border-radius: 8px;
            font-weight: 500; font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            border: 1.5px solid rgba(255,255,255,0.2);
            transition: all 0.25s;
        }
        .btn-cta-sec:hover { border-color: rgba(255,255,255,0.4); color: #fff; }

        /* ─── FOOTER ─── */
        footer {
            background: #050f09;
            padding: 3rem 0 1.75rem;
            color: rgba(255,255,255,0.45);
            font-size: 0.82rem;
        }
        .footer-brand-name { font-family: 'Lora', serif; font-size: 1rem; color: #fff; margin-bottom: 0.25rem; }
        .footer-brand-name span { color: var(--green-light); }
        .footer-identity { line-height: 1.8; }
        .footer-identity strong { color: rgba(255,255,255,0.75); font-weight: 600; }
        hr.footer-divider { border-color: rgba(255,255,255,0.06); margin: 1.75rem 0 1.25rem; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; }
        .footer-links a { color: rgba(255,255,255,0.35); text-decoration: none; margin-left: 1.25rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--green-light); }

        /* ─── SCROLL TOP ─── */
        .scroll-top {
            position: fixed; bottom: 1.75rem; right: 1.75rem;
            width: 40px; height: 40px;
            background: var(--green-fresh);
            color: #fff; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none;
            opacity: 0; transform: translateY(8px);
            transition: all 0.3s; z-index: 999;
            box-shadow: 0 4px 16px rgba(30,138,82,0.35);
        }
        .scroll-top.visible { opacity: 1; transform: translateY(0); }
        .scroll-top:hover { background: var(--green-light); color: #fff; transform: translateY(-2px); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            section { padding: 60px 0; }
            .hero-indicators { flex-direction: column; }
            .hero-ind-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
            .hero-ind-item:last-child { border-bottom: none; }
            .flow-steps { flex-direction: column; align-items: flex-start; padding-left: 1rem; }
            .flow-arrow { transform: rotate(90deg); margin: 0 0 0 38px; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .footer-links a { margin: 0 0.5rem; }
            .cta-inner { padding: 2.5rem 1.5rem; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">

            <div class="brand-text">
                Sistem Pakar Cabai
                <small>Diagnosa Penyakit Tanaman</small>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#metode">Metode</a></li>
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#pengujian">Pengujian</a></li>
            </ul>
            <div class="d-flex gap-2 mt-2 mt-lg-0">
                <a href="{{ route('login') }}" class="nav-link btn-nav btn-nav-outline">Masuk</a>
                <a href="{{ route('register') }}" class="nav-link btn-nav btn-nav-solid">Konsultasi</a>
            </div>
        </div>
    </div>
</nav>

<!-- ── HERO ── -->
<section id="hero">
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center g-5 py-4">

            <!-- LEFT COLUMN -->
            <div class="col-lg-6">
                <div class="hero-eyebrow" data-aos="fade-down" data-aos-duration="600">
                    <div class="eyebrow-dot"></div>
                    Skripsi — Sistem Pakar Pertanian
                </div>

                <h1 class="hero-title" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    Diagnosa Penyakit<br>
                    Tanaman <em>Cabai</em><br>
                    Berbasis Sistem Pakar
                </h1>

                <div class="hero-method-tag" data-aos="fade-up" data-aos-duration="600" data-aos-delay="170">
                    <i class="bi bi-diagram-3"></i>
                    Rule-Based &nbsp;+&nbsp; Weighted Product (WP)
                </div>

                <p class="hero-desc" data-aos="fade-up" data-aos-duration="700" data-aos-delay="220">
                    Sistem ini membantu <strong>petani dan penyuluh pertanian</strong> mengidentifikasi
                    penyakit tanaman cabai berdasarkan gejala yang teramati di lapangan,
                    menggunakan pendekatan basis pengetahuan dan perhitungan nilai preferensi terukur.
                </p>

                <div class="hero-btns" data-aos="fade-up" data-aos-duration="700" data-aos-delay="280">
                    <a href="{{ route('register') }}" class="btn-primary-hero">
                        <i class="bi bi-stethoscope"></i> Mulai Konsultasi
                    </a>
                    <a href="#tentang" class="btn-outline-hero">
                        <i class="bi bi-book"></i> Tentang Sistem
                    </a>
                </div>

                <div class="hero-indicators" data-aos="fade-up" data-aos-duration="700" data-aos-delay="340">
                    <div class="hero-ind-item">
                        <div class="ind-icon"><i class="bi bi-diagram-3-fill"></i></div>
                        <div>
                            <div class="ind-value">Rule-Based</div>
                            <div class="ind-label">Inferensi Gejala</div>
                        </div>
                    </div>
                    <div class="hero-ind-item">
                        <div class="ind-icon"><i class="bi bi-calculator"></i></div>
                        <div>
                            <div class="ind-value">Weighted Product</div>
                            <div class="ind-label">Nilai Preferensi</div>
                        </div>
                    </div>
                    <div class="hero-ind-item">
                        <div class="ind-icon"><i class="bi bi-capsule"></i></div>
                        <div>
                            <div class="ind-value">Rekomendasi</div>
                            <div class="ind-label">Penanganan Penyakit</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN — Diagnosis Demo Card -->
            <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="diagnosis-card">
                    <div class="dc-header">
                        <span class="dc-title">Simulasi Diagnosa</span>
                        <span class="dc-status"><div class="dc-status-dot"></div> Aktif</span>
                    </div>

                    <div class="dc-section-label">Gejala yang Dipilih</div>

                    <div class="gejala-item checked">
                        <div class="gejala-cb"><i class="bi bi-check text-white" style="font-size:0.6rem"></i></div>
                        <span class="gejala-code">G01</span>
                        <span class="gejala-name">Buah cabai busuk berwarna coklat</span>
                    </div>
                    <div class="gejala-item checked">
                        <div class="gejala-cb"><i class="bi bi-check text-white" style="font-size:0.6rem"></i></div>
                        <span class="gejala-code">G05</span>
                        <span class="gejala-name">Terdapat bercak cekung pada buah</span>
                    </div>
                    <div class="gejala-item">
                        <div class="gejala-cb"></div>
                        <span class="gejala-code">G08</span>
                        <span class="gejala-name">Daun menguning dari bawah</span>
                    </div>
                    <div class="gejala-item">
                        <div class="gejala-cb"></div>
                        <span class="gejala-code">G11</span>
                        <span class="gejala-name">Batang terlihat layu di siang hari</span>
                    </div>

                    <hr class="dc-divider">

                    <div class="dc-section-label">Hasil Perhitungan WP</div>

                    <div class="result-row">
                        <div class="result-meta">
                            <span class="result-disease">Antraknosa</span>
                            <span class="result-score">V = 0.834</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width:83.4%"></div></div>
                    </div>
                    <div class="result-row">
                        <div class="result-meta">
                            <span class="result-disease">Layu Fusarium</span>
                            <span class="result-score red">V = 0.166</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill red" style="width:16.6%"></div></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── TENTANG ── -->
<section id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="700">
                <div class="about-visual-block">
                    <!-- SVG Chili Illustration -->
                    <div class="chili-illustration">
                        <div class="chili-svg-wrap">
                            <svg viewBox="0 0 200 220" xmlns="http://www.w3.org/2000/svg">
                                <!-- Stem -->
                                <path d="M100 20 Q95 40 98 60" stroke="#2dba72" stroke-width="3" fill="none" stroke-linecap="round"/>
                                <!-- Leaf left -->
                                <path d="M98 50 Q75 35 65 50 Q80 55 98 60Z" fill="#1e8a52" opacity="0.8"/>
                                <!-- Leaf right -->
                                <path d="M98 55 Q120 38 132 52 Q115 58 98 60Z" fill="#2dba72" opacity="0.8"/>
                                <!-- Chili body -->
                                <path d="M88 60 Q78 90 76 130 Q75 160 100 185 Q125 160 124 130 Q122 90 112 60 Z" fill="#c0392b"/>
                                <!-- Chili highlight -->
                                <path d="M93 70 Q86 100 86 130" stroke="rgba(255,255,255,0.2)" stroke-width="4" fill="none" stroke-linecap="round"/>
                                <!-- Tip -->
                                <path d="M100 185 Q98 195 100 200 Q102 195 100 185Z" fill="#9b2d22"/>
                                <!-- Disease spots (left side) -->
                                <ellipse cx="83" cy="120" rx="7" ry="5" fill="#8B4513" opacity="0.7"/>
                                <ellipse cx="87" cy="138" rx="5" ry="4" fill="#6B3410" opacity="0.6"/>
                                <ellipse cx="79" cy="108" rx="4" ry="3" fill="#A0522D" opacity="0.5"/>
                            </svg>
                        </div>
                        <div style="font-size:0.72rem; color:rgba(200,240,215,0.5); margin-top:0.5rem; letter-spacing:0.05em;">
                            GEJALA PENYAKIT TERDETEKSI
                        </div>
                    </div>

                    <div class="tag-row">
                        <span class="tag-pill">Sistem Pakar</span>
                        <span class="tag-pill">Rule-Based</span>
                        <span class="tag-pill">Weighted Product</span>
                        <span class="tag-pill">Laravel</span>
                        <span class="tag-pill">Pertanian Digital</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="eyebrow-label">Tentang Sistem</div>
                <h2 class="section-heading">Sistem Pakar Berbasis<br>Pengetahuan Pertanian</h2>
                <p class="section-body mb-4">
                    Sistem ini dirancang untuk membantu petani, penyuluh pertanian, dan pemangku
                    kepentingan dalam mengidentifikasi penyakit tanaman cabai berdasarkan gejala
                    yang teramati secara visual di lapangan, menggunakan representasi pengetahuan
                    pakar yang terstruktur.
                </p>

                <div class="about-point">
                    <div class="ap-icon"><i class="bi bi-bookshelf"></i></div>
                    <div>
                        <div class="ap-title">Basis Pengetahuan Terstruktur</div>
                        <div class="ap-desc">Pengetahuan dari pakar pertanian direpresentasikan dalam bentuk kaidah produksi (IF-THEN rules) yang menghubungkan gejala dengan jenis penyakit pada tanaman cabai.</div>
                    </div>
                </div>
                <div class="about-point">
                    <div class="ap-icon"><i class="bi bi-bar-chart-steps"></i></div>
                    <div>
                        <div class="ap-title">Perhitungan Nilai Preferensi Terukur</div>
                        <div class="ap-desc">Metode Weighted Product menghasilkan nilai preferensi (V) untuk setiap kandidat penyakit, sehingga penyakit dengan kecocokan tertinggi dapat ditentukan secara kuantitatif.</div>
                    </div>
                </div>
                <div class="about-point">
                    <div class="ap-icon"><i class="bi bi-prescription"></i></div>
                    <div>
                        <div class="ap-title">Rekomendasi Pengendalian</div>
                        <div class="ap-desc">Setiap hasil diagnosa dilengkapi dengan informasi penyakit dan rekomendasi pengendalian yang sesuai, termasuk jenis obat atau tindakan yang dianjurkan.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── METODE ── -->
<section id="metode">
    <div class="container">

        <div class="text-center mb-5">
            <div class="eyebrow-label justify-content-center" data-aos="fade-up">Landasan Ilmiah</div>
            <h2 class="section-heading" data-aos="fade-up" data-aos-delay="80">Metode yang Digunakan</h2>
            <p class="section-body mx-auto" data-aos="fade-up" data-aos-delay="130">
                Kombinasi Rule-Based System dan Weighted Product diterapkan secara berurutan
                untuk menghasilkan diagnosa yang akurat dan terukur.
            </p>
        </div>

        <!-- Alur / Flow Diagram -->
        <div class="flow-diagram" data-aos="fade-up" data-aos-duration="700">
            <div class="flow-title">Alur Kerja Sistem Diagnosa</div>
            <div class="flow-steps">
                <div class="flow-step input">
                    <div class="flow-step-num">01</div>
                    <div class="flow-step-label">Input Gejala</div>
                    <div class="flow-step-desc">Pengguna memilih gejala yang diamati pada tanaman</div>
                </div>
                <div class="flow-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="flow-step rule">
                    <div class="flow-step-num">02</div>
                    <div class="flow-step-label">Rule-Based</div>
                    <div class="flow-step-desc">Gejala dicocokkan dengan kaidah → daftar kandidat penyakit</div>
                </div>
                <div class="flow-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="flow-step wp">
                    <div class="flow-step-num">03</div>
                    <div class="flow-step-label">Weighted Product</div>
                    <div class="flow-step-desc">Hitung S(i) dan V(i) untuk setiap kandidat penyakit</div>
                </div>
                <div class="flow-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="flow-step output">
                    <div class="flow-step-num">04</div>
                    <div class="flow-step-label">Hasil Diagnosa</div>
                    <div class="flow-step-desc">Penyakit dengan nilai V tertinggi sebagai hasil akhir</div>
                </div>
            </div>
        </div>

        <!-- Method Cards -->
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="700">
                <div class="method-card rule h-100">
                    <span class="mc-label rule">Tahap 1 — Penentuan Kandidat</span>
                    <h4>Rule-Based System</h4>
                    <p>
                        Sistem berbasis kaidah IF-THEN yang merepresentasikan pengetahuan pakar pertanian.
                        Setiap penyakit memiliki himpunan gejala yang menjadi prasyarat diagnosis.
                        Pada tahap ini, sistem menentukan penyakit mana saja yang <em>mungkin</em>
                        sesuai berdasarkan gejala yang dipilih pengguna.
                    </p>
                    <div class="mc-step">
                        <div class="mc-step-num">1</div>
                        <span class="mc-step-text">Basis pengetahuan disusun bersama pakar pertanian dalam bentuk aturan produksi</span>
                    </div>
                    <div class="mc-step">
                        <div class="mc-step-num">2</div>
                        <span class="mc-step-text">Gejala input pengguna dicocokkan dengan seluruh rule yang tersedia</span>
                    </div>
                    <div class="mc-step">
                        <div class="mc-step-num">3</div>
                        <span class="mc-step-text">Penyakit dengan minimal satu gejala cocok masuk sebagai kandidat diagnosa</span>
                    </div>
                    <div class="formula-box">
                        IF Gejala(G01 ∧ G05) THEN Kandidat(Antraknosa)<br>
                        IF Gejala(G08 ∧ G11) THEN Kandidat(Layu Fusarium)
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="method-card wp h-100">
                    <span class="mc-label wp">Tahap 2 — Penentuan Prioritas</span>
                    <h4>Weighted Product (WP)</h4>
                    <p>
                        Metode pengambilan keputusan multi-kriteria yang menghitung nilai preferensi
                        setiap kandidat penyakit. Setiap gejala diperlakukan sebagai kriteria dengan
                        bobot tertentu, dan nilai akhir diperoleh melalui perkalian berpangkat.
                    </p>
                    <div class="mc-step">
                        <div class="mc-step-num">1</div>
                        <span class="mc-step-text">Normalisasi bobot gejala sehingga ΣW = 1</span>
                    </div>
                    <div class="mc-step">
                        <div class="mc-step-num">2</div>
                        <span class="mc-step-text">Hitung nilai vektor S untuk setiap kandidat penyakit</span>
                    </div>
                    <div class="mc-step">
                        <div class="mc-step-num">3</div>
                        <span class="mc-step-text">Hitung nilai preferensi V; penyakit dengan V tertinggi adalah hasil diagnosa</span>
                    </div>
                    <div class="formula-box">
                        S(i) = ∏ (X<sub>ij</sub>)<sup>W<sub>j</sub></sup><br>
                        V(i) = S(i) / Σ S(k) &nbsp;→&nbsp; max V(i) = Hasil
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ── FITUR ── -->
<section id="fitur">
    <div class="container">
        <div class="text-center mb-5">
            <div class="eyebrow-label justify-content-center" data-aos="fade-up">Fungsionalitas Sistem</div>
            <h2 class="section-heading" data-aos="fade-up" data-aos-delay="80">Fitur Utama Sistem</h2>
        </div>

        <div class="row g-3">
            <!-- User features -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#edf7f2; color:var(--green-fresh);">
                        <i class="bi bi-stethoscope"></i>
                    </div>
                    <h5>Konsultasi Diagnosa</h5>
                    <p>Pilih gejala yang terlihat pada tanaman melalui antarmuka checkbox, lalu sistem memproses dan menampilkan hasil diagnosa secara otomatis.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="60">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#fef9e7; color:#9a7d0a;">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <h5>Hasil &amp; Nilai WP</h5>
                    <p>Hasil diagnosa ditampilkan beserta nilai preferensi (V) dari setiap penyakit kandidat sehingga proses perhitungan dapat ditelusuri.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="120">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#fdf2f8; color:#8e44ad;">
                        <i class="bi bi-capsule-pill"></i>
                    </div>
                    <h5>Rekomendasi Obat</h5>
                    <p>Setiap hasil diagnosa dilengkapi informasi penyakit dan daftar obat atau tindakan pengendalian yang direkomendasikan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="180">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#e8f4fd; color:#2471a3;">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h5>Cetak Hasil PDF</h5>
                    <p>Hasil diagnosa dapat dicetak atau diunduh dalam format PDF sebagai dokumentasi untuk keperluan pertanian atau pelaporan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#edf7f2; color:var(--green-fresh);">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5>Riwayat Diagnosa</h5>
                    <p>Pengguna dapat mengakses kembali seluruh riwayat konsultasi sebelumnya untuk memantau perkembangan kondisi tanaman.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="60">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#fef9e7; color:#9a7d0a;">
                        <i class="bi bi-database-gear"></i>
                    </div>
                    <h5>Manajemen Basis Pengetahuan</h5>
                    <p>Admin dapat mengelola data penyakit, gejala, dan kaidah rule secara terstruktur melalui panel administrasi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="120">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#fdf2f8; color:#8e44ad;">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <h5>Manajemen Bobot Gejala</h5>
                    <p>Admin dapat mengatur nilai bobot (W) setiap gejala pada basis pengetahuan sesuai dengan tingkat kepentingannya.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="180">
                <div class="feature-card">
                    <div class="fc-icon" style="background:#e8f4fd; color:#2471a3;">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h5>Antarmuka Responsif</h5>
                    <p>Tampilan menyesuaikan berbagai ukuran layar — komputer, tablet, maupun ponsel — agar mudah diakses di lapangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── PENGUJIAN ── -->
<section id="pengujian">
    <div class="container position-relative" style="z-index:2;">

        <div class="mb-5">
            <div class="eyebrow-label light" data-aos="fade-up">Hasil Pengujian Sistem</div>
            <h2 class="section-heading light" data-aos="fade-up" data-aos-delay="80">Ringkasan Pengujian</h2>
            <p style="font-size:0.9rem; color:rgba(255,255,255,0.5); max-width:480px; line-height:1.8;" data-aos="fade-up" data-aos-delay="130">
                Pengujian dilakukan menggunakan data kasus penyakit tanaman cabai
                yang dikonsultasikan dengan pakar pertanian.
            </p>
        </div>

        <div class="row g-3 mb-0">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-card">
                    <div class="stat-number">5</div>
                    <div class="stat-desc">Jenis Penyakit<br>dalam Basis Data</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card">
                    <div class="stat-number">15</div>
                    <div class="stat-desc">Gejala yang<br>Digunakan</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card">
                    <div class="stat-number">30</div>
                    <div class="stat-desc">Data Kasus<br>Pengujian</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card">
                    <div class="stat-number">86<span class="stat-unit">%</span></div>
                    <div class="stat-desc">Tingkat Akurasi<br>Sistem</div>
                </div>
            </div>
        </div>

        <div class="result-summary" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
            <div class="row align-items-center g-4">
                <div class="col-md-8">
                    <div class="rs-title">Catatan Pengujian</div>
                    <div class="rs-body">
                        Pengujian dilakukan dengan membandingkan hasil diagnosa sistem terhadap
                        diagnosis pakar pertanian. Dari 30 data kasus yang diuji, sistem berhasil
                        mendiagnosa dengan tepat pada 26 kasus. Ketidaksesuaian pada 4 kasus
                        disebabkan oleh kemiripan gejala antar penyakit yang tinggi.
                        <br><br>
                        <em style="color:rgba(255,255,255,0.35); font-size:0.8rem;">
                            * Sesuaikan angka di atas dengan data aktual hasil pengujian skripsi Anda.
                        </em>
                    </div>
                </div>
                <div class="col-md-4 text-md-end text-center">
                    <div class="accuracy-badge">
                        <i class="bi bi-patch-check-fill"></i>
                        Akurasi: 86.67%
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ── CTA ── -->
<section id="cta">
    <div class="container">
        <div class="cta-inner" data-aos="zoom-in" data-aos-duration="600">
            <div class="hero-eyebrow justify-content-center d-inline-flex mb-4">
                <div class="eyebrow-dot"></div>
                Sistem Siap Digunakan
            </div>
            <h2 class="cta-title">Lakukan Konsultasi<br>Penyakit Tanaman Cabai</h2>
            <p class="cta-desc">
                Daftarkan akun untuk menggunakan sistem diagnosa ini. Pilih gejala yang
                terlihat pada tanaman, dan sistem akan menentukan penyakit serta
                rekomendasi penanganannya.
            </p>
            <div class="cta-btns">
                <a href="{{ route('register') }}" class="btn-cta-main">
                    <i class="bi bi-person-plus"></i> Daftar &amp; Mulai Konsultasi
                </a>
                <a href="{{ route('login') }}" class="btn-cta-sec">
                    <i class="bi bi-box-arrow-in-right"></i> Sudah Punya Akun
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ── FOOTER ── -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="footer-brand-name">Sistem Pakar <span>Cabai</span></div>
                <div style="font-size:0.78rem; color:rgba(255,255,255,0.35); margin-top:0.3rem; margin-bottom:1rem; line-height:1.6;">
                    Diagnosa Penyakit Tanaman Cabai<br>
                    Menggunakan Metode Rule-Based &amp; Weighted Product
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-identity">
                    <strong>Rendy Maulana Sugiharto</strong><br>
                    NIM: E41222825<br>
                    Program Studi Teknik Informatika<br>
                    Fakultas Teknologi Informasi<br>
                    Politeknik Negeri Jember
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-identity">
                    <strong>Skripsi</strong><br>
                    Tahun 2026<br><br>
                    <strong>Pembimbing</strong><br>
                    [Nama Dosen Pembimbing]
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <span>© {{ date('Y') }} Sistem Pakar Diagnosa Cabai.</span>
            <div class="footer-links">
                <a href="#hero">Beranda</a>
                <a href="#metode">Metode</a>
                <a href="#pengujian">Pengujian</a>
                <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</footer>

<a href="#hero" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up"></i></a>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({ once: true, offset: 70, easing: 'ease-out-cubic', duration: 650 });

    const nav = document.getElementById('mainNav');
    const scrollBtn = document.getElementById('scrollTop');

    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 50);
        scrollBtn.classList.toggle('visible', window.scrollY > 400);
    });

    // Active nav highlight
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(s => {
            if (window.scrollY >= s.offsetTop - 120) current = s.getAttribute('id');
        });
        navLinks.forEach(link => {
            const isActive = link.getAttribute('href') === '#' + current;
            link.style.color = isActive ? '#fff' : '';
            link.style.background = isActive ? 'rgba(255,255,255,0.07)' : '';
        });
    });
</script>
</body>
</html>