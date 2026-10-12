<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Sistem Pakar Cabai</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,400&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-deep:   #0d3d2b;
            --green-mid:    #165c3e;
            --green-fresh:  #1e8a52;
            --green-light:  #2dba72;
            --green-pale:   #edf7f2;
            --red-chili:    #c0392b;
            --cream:        #f9f7f2;
            --text-dark:    #1a2e22;
            --text-body:    #374840;
            --text-muted:   #637068;
            --border:       #dde5e0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            min-height: 100vh;
            background: var(--cream);
        }

        /* ── LEFT PANEL ── */
        .auth-panel-left {
            width: 42%;
            background: linear-gradient(155deg, var(--green-deep) 0%, #0b3320 50%, #081e12 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(45,186,114,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(45,186,114,0.04) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
        }
        .auth-panel-left::after {
            content: '';
            position: absolute;
            width: 380px; height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30,138,82,0.12) 0%, transparent 70%);
            bottom: -80px; right: -80px;
            pointer-events: none;
        }
        .apl-top { position: relative; z-index: 2; }
        .apl-mid { position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 2rem 0; }
        .apl-bot { position: relative; z-index: 2; }

        .brand-wrap { display: flex; align-items: center; gap: 0.65rem; text-decoration: none; }
        .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--green-fresh), var(--green-light));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; flex-shrink: 0;
        }
        .brand-name { font-family: 'Lora', serif; font-size: 0.98rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .brand-name small { display: block; font-family: 'Inter', sans-serif; font-size: 0.66rem; font-weight: 400; color: rgba(255,255,255,0.4); letter-spacing: 0.04em; }

        .panel-eyebrow {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(45,186,114,0.1);
            border: 1px solid rgba(45,186,114,0.22);
            color: rgba(180,235,205,0.85);
            padding: 0.28rem 0.75rem;
            border-radius: 4px;
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1.4rem;
        }
        .panel-eyebrow-dot { width: 5px; height: 5px; background: var(--green-light); border-radius: 50%; }

        .panel-title {
            font-family: 'Lora', serif;
            font-size: 1.65rem; font-weight: 700;
            color: #fff; line-height: 1.3; margin-bottom: 1rem;
        }
        .panel-title em { font-style: italic; color: rgba(180,235,205,0.9); }

        .panel-desc { font-size: 0.84rem; color: rgba(255,255,255,0.5); line-height: 1.75; margin-bottom: 1.75rem; }

        /* Step guide */
        .step-guide { display: flex; flex-direction: column; gap: 0.6rem; }
        .step-item {
            display: flex; align-items: flex-start; gap: 0.75rem;
        }
        .step-num {
            width: 24px; height: 24px; flex-shrink: 0;
            background: rgba(45,186,114,0.15);
            border: 1px solid rgba(45,186,114,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem; font-weight: 600;
            color: var(--green-light);
            margin-top: 0.05rem;
        }
        .step-text { font-size: 0.78rem; color: rgba(255,255,255,0.55); line-height: 1.45; }
        .step-text strong { color: rgba(255,255,255,0.8); font-weight: 600; }

        .panel-footer-text { font-size: 0.72rem; color: rgba(255,255,255,0.25); line-height: 1.6; }

        /* ── RIGHT PANEL ── */
        .auth-panel-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--cream);
            overflow-y: auto;
        }

        .auth-form-wrap { width: 100%; max-width: 420px; padding: 0.5rem 0; }

        .form-eyebrow {
            font-size: 0.72rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--green-fresh);
            margin-bottom: 0.5rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .form-eyebrow::before { content: ''; width: 16px; height: 2px; background: var(--green-fresh); border-radius: 2px; }

        .form-heading {
            font-family: 'Lora', serif;
            font-size: 1.7rem; font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.4rem; line-height: 1.2;
        }
        .form-subheading { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.75rem; }

        /* Alert */
        .alert-custom {
            border-radius: 8px; padding: 0.7rem 1rem;
            font-size: 0.83rem; margin-bottom: 1.25rem;
            display: flex; align-items: flex-start; gap: 0.6rem;
            border: 1px solid;
        }
        .alert-danger-custom { background: #fdf2f2; border-color: #f5c6c6; color: #842029; }
        .alert-success-custom { background: var(--green-pale); border-color: rgba(45,186,114,0.3); color: var(--green-mid); }

        /* Fields */
        .field-label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-dark); margin-bottom: 0.4rem; }
        .field-wrap { position: relative; }
        .field-input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 0.88rem; font-family: 'Inter', sans-serif;
            color: var(--text-dark); background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .field-input:focus { border-color: var(--green-fresh); box-shadow: 0 0 0 3px rgba(30,138,82,0.1); }
        .field-input.is-invalid { border-color: var(--red-chili); }
        .field-icon { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem; pointer-events: none; }
        .toggle-pw {
            position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 0.9rem;
            cursor: pointer; background: none; border: none; padding: 0;
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--green-fresh); }
        .field-hint { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.3rem; }
        .field-group { margin-bottom: 1rem; }

        /* Row fields */
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }

        /* Password strength */
        .pw-strength-bar {
            display: flex; gap: 3px; margin-top: 0.4rem;
        }
        .pw-seg {
            flex: 1; height: 3px; border-radius: 100px;
            background: var(--border);
            transition: background 0.3s;
        }
        .pw-seg.weak   { background: var(--red-chili); }
        .pw-seg.medium { background: #e0a800; }
        .pw-seg.strong { background: var(--green-fresh); }

        /* Submit button */
        .btn-submit {
            width: 100%; background: var(--green-fresh); color: #fff;
            padding: 0.8rem; border-radius: 8px;
            font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer;
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 0.5rem;
            box-shadow: 0 2px 12px rgba(30,138,82,0.3);
        }
        .btn-submit:hover { background: var(--green-light); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(30,138,82,0.38); }

        .form-divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1.1rem 0;
            color: var(--text-muted); font-size: 0.78rem;
        }
        .form-divider::before, .form-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        .btn-secondary-link {
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
            width: 100%; padding: 0.75rem; border-radius: 8px;
            font-size: 0.88rem; font-weight: 500; color: var(--text-body);
            text-decoration: none; border: 1.5px solid var(--border); background: #fff;
            transition: all 0.2s;
        }
        .btn-secondary-link:hover { border-color: var(--green-fresh); color: var(--green-fresh); background: var(--green-pale); }

        .form-footer-note { text-align: center; font-size: 0.77rem; color: var(--text-muted); margin-top: 1.5rem; }
        .form-footer-note a { color: var(--green-fresh); text-decoration: none; font-weight: 600; }
        .form-footer-note a:hover { text-decoration: underline; }

        /* Terms note */
        .terms-note { font-size: 0.75rem; color: var(--text-muted); text-align: center; margin-top: 0.85rem; line-height: 1.55; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            body { flex-direction: column; }
            .auth-panel-left { width: 100%; min-height: auto; padding: 2rem 1.5rem; }
            .apl-mid { padding: 1.25rem 0; }
            .auth-panel-right { padding: 2rem 1.25rem; }
        }
        @media (max-width: 520px) {
            .field-row { grid-template-columns: 1fr; }
            .auth-panel-right { padding: 1.5rem 1rem; }
        }
    </style>
</head>
<body>

<!-- LEFT PANEL -->
<!-- LEFT PANEL -->
<style>
/* ── WORKFLOW PANEL STYLES ── */
.auth-panel-left {
    width: 42%;
    background: linear-gradient(155deg, var(--green-deep) 0%, #0b3320 50%, #081e12 100%);
    display: flex;
    flex-direction: column;
    padding: 2.75rem 2.75rem 2.25rem;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}
.apl-bg-grid {
    position: absolute; inset: 0; pointer-events: none;
    background-image:
        linear-gradient(rgba(45,186,114,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(45,186,114,0.035) 1px, transparent 1px);
    background-size: 32px 32px;
}
.apl-bg-glow {
    position: absolute; width: 360px; height: 360px; border-radius: 50%;
    background: radial-gradient(circle, rgba(30,138,82,0.10) 0%, transparent 70%);
    bottom: -60px; right: -60px; pointer-events: none;
}
.apl-top { position: relative; z-index: 2; margin-bottom: 2.25rem; }
.apl-mid  { position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; }
.apl-bot  { position: relative; z-index: 2; margin-top: 2rem; }

/* Badge */
.badge-eyebrow {
    display: inline-flex; align-items: center; gap: 0.45rem;
    background: rgba(45,186,114,0.10);
    border: 1px solid rgba(45,186,114,0.22);
    color: rgba(180,235,205,0.80);
    padding: 0.26rem 0.7rem; border-radius: 4px;
    font-size: 0.67rem; font-weight: 700;
    letter-spacing: 0.10em; text-transform: uppercase;
    margin-bottom: 1.25rem;
}
.badge-dot { width: 5px; height: 5px; background: #2dba72; border-radius: 50%; }

/* Title */
.panel-title {
    font-family: 'Lora', Georgia, serif;
    font-size: 1.15rem; font-weight: 700; color: #fff;
    line-height: 1.5; margin-bottom: 2rem;
}
.panel-title em { font-style: italic; color: rgba(180,235,205,0.88); }

/* Workflow */
.workflow { display: flex; flex-direction: column; gap: 0; position: relative; flex: 1; }

/* Connector line with moving light */
.connector-line {
    width: 2px; height: 32px;
    background: rgba(45,186,114,0.18);
    margin-left: calc(1.1rem);
    position: relative; overflow: hidden;
    flex-shrink: 0; border-radius: 2px;
}
.connector-line::after {
    content: '';
    position: absolute; top: -100%; left: 0;
    width: 100%; height: 60%;
    background: linear-gradient(to bottom, transparent, #2dba72, transparent);
    animation: lineflow 2.4s ease-in-out infinite;
    border-radius: 2px;
}
.connector-line:nth-of-type(2)::after { animation-delay: 0.0s; }
.connector-line:nth-of-type(4)::after { animation-delay: 0.8s; }
.connector-line:nth-of-type(6)::after { animation-delay: 1.6s; }

@keyframes lineflow {
    0%   { top: -80%; opacity: 0; }
    15%  { opacity: 1; }
    85%  { opacity: 1; }
    100% { top: 120%; opacity: 0; }
}

/* Workflow card */
.wf-card {
    display: flex; align-items: flex-start; gap: 0.85rem;
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(45,186,114,0.16);
    border-radius: 12px;
    padding: 0.85rem 1rem;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    animation: floatCard 4s ease-in-out infinite;
    transition: border-color 0.25s, background 0.25s;
}
.wf-card:hover {
    background: rgba(255,255,255,0.085);
    border-color: rgba(45,186,114,0.36);
}
.wf-card:nth-child(1) { animation-delay: 0.0s; }
.wf-card:nth-child(3) { animation-delay: 1.0s; }
.wf-card:nth-child(5) { animation-delay: 2.0s; }
.wf-card:nth-child(7) { animation-delay: 3.0s; }

@keyframes floatCard {
    0%, 100% { transform: translateY(0px); }
    50%      { transform: translateY(-3px); }
}

/* Icon */
.wf-step { display: flex; flex-direction: column; position: relative; }
.step-num {
    position: absolute; top: -6px; left: -6px;
    width: 16px; height: 16px;
    background: #1e8a52;
    border: 1.5px solid rgba(255,255,255,0.18);
    border-radius: 50%;
    font-size: 0.62rem; font-weight: 700; color: #fff;
    display: flex; align-items: center; justify-content: center;
    line-height: 1; z-index: 1;
}
.wf-icon {
    width: 2.2rem; height: 2.2rem; flex-shrink: 0;
    background: rgba(45,186,114,0.13);
    border: 1px solid rgba(45,186,114,0.25);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; color: #2dba72;
}
.wf-body { flex: 1; min-width: 0; }
.wf-label {
    font-size: 0.82rem; font-weight: 700;
    color: rgba(255,255,255,0.90);
    margin-bottom: 0.18rem; letter-spacing: 0.01em;
}
.wf-desc { font-size: 0.74rem; color: rgba(255,255,255,0.45); line-height: 1.5; }

/* Accent card (last step) */
.wf-card.accent {
    background: rgba(45,186,114,0.10);
    border-color: rgba(45,186,114,0.30);
}
.wf-card.accent .wf-icon {
    background: rgba(45,186,114,0.22);
    border-color: rgba(45,186,114,0.40);
    color: #4ee89a;
}
.wf-card.accent .wf-label { color: #4ee89a; }

/* Footer */
.panel-footer-text { font-size: 0.70rem; color: rgba(255,255,255,0.22); line-height: 1.65; }

/* Responsive */
@media (max-width: 900px) {
    .auth-panel-left { width: 100%; min-height: auto; padding: 2rem 1.5rem; }
    .wf-card { animation: none !important; }
}
</style>

<div class="auth-panel-left">
    <div class="apl-bg-grid"></div>
    <div class="apl-bg-glow"></div>

    <div class="apl-top">
        <div class="badge-eyebrow">
            <div class="badge-dot"></div>
            Sistem Pakar Pertanian
        </div>
        <h2 class="panel-title">
            Sistem Pakar Berbasis <em>Rule-Based</em> dan <em>Weighted Product</em>
            untuk Rekomendasi Obat Pertanian pada Tanaman Cabai
        </h2>
    </div>

    <div class="apl-mid">
        <div class="workflow">

            <!-- Step 1 -->
            <div class="wf-card">
                <div class="wf-step">
                    <span class="step-num">1</span>
                    <div class="wf-icon"><i class="bi bi-ui-checks-grid"></i></div>
                </div>
                <div class="wf-body">
                    <div class="wf-label">Pilih Gejala</div>
                    <div class="wf-desc">Pengguna memilih gejala yang teramati pada tanaman cabai</div>
                </div>
            </div>

            <div class="connector-line"></div>

            <!-- Step 2 -->
            <div class="wf-card">
                <div class="wf-step">
                    <span class="step-num">2</span>
                    <div class="wf-icon"><i class="bi bi-diagram-3-fill"></i></div>
                </div>
                <div class="wf-body">
                    <div class="wf-label">Rule-Based</div>
                    <div class="wf-desc">Pencocokan gejala dengan basis aturan untuk menentukan kandidat penyakit</div>
                </div>
            </div>

            <div class="connector-line"></div>

            <!-- Step 3 -->
            <div class="wf-card">
                <div class="wf-step">
                    <span class="step-num">3</span>
                    <div class="wf-icon"><i class="bi bi-calculator-fill"></i></div>
                </div>
                <div class="wf-body">
                    <div class="wf-label">Weighted Product</div>
                    <div class="wf-desc">Perhitungan nilai preferensi (V) dari setiap kandidat penyakit berdasarkan bobot kriteria</div>
                </div>
            </div>

            <div class="connector-line"></div>

            <!-- Step 4 (accent) -->
            <div class="wf-card accent">
                <div class="wf-step">
                    <span class="step-num">4</span>
                    <div class="wf-icon"><i class="bi bi-capsule-pill"></i></div>
                </div>
                <div class="wf-body">
                    <div class="wf-label">Hasil &amp; Rekomendasi</div>
                    <div class="wf-desc">Diagnosis penyakit dengan nilai tertinggi beserta rekomendasi penanganan dan obat</div>
                </div>
            </div>

        </div>
    </div>

    <div class="apl-bot">
        <div class="panel-footer-text">
            Skripsi — Sistem Pakar Diagnosa Penyakit Tanaman Cabai<br>
            Metode Rule-Based &amp; Weighted Product
        </div>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="auth-panel-right">
    <div class="auth-form-wrap">

        <div class="form-eyebrow">Buat Akun</div>
        <h1 class="form-heading">Daftar</h1>
        <p class="form-subheading">Buat akun untuk mengakses sistem diagnosa</p>

        @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0; margin-top:1px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="field-group">
                <label class="field-label" for="name">Nama Lengkap</label>
                <div class="field-wrap">
                    <i class="bi bi-person field-icon"></i>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="field-input @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required
                    >
                </div>
            </div>

            <div class="field-group">
                <label class="field-label" for="email">Alamat Email</label>
                <div class="field-wrap">
                    <i class="bi bi-envelope field-icon"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="field-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        required
                    >
                </div>
            </div>

            <div class="field-group">
                <label class="field-label" for="password">Kata Sandi</label>
                <div class="field-wrap">
                    <i class="bi bi-lock field-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="field-input @error('password') is-invalid @enderror"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        oninput="checkStrength(this.value)"
                        required
                    >
                    <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="pw-strength-bar">
                    <div class="pw-seg" id="seg1"></div>
                    <div class="pw-seg" id="seg2"></div>
                    <div class="pw-seg" id="seg3"></div>
                    <div class="pw-seg" id="seg4"></div>
                </div>
                <div class="field-hint">Gunakan minimal 8 karakter</div>
            </div>

            <div class="field-group">
                <label class="field-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="field-wrap">
                    <i class="bi bi-lock-fill field-icon"></i>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="field-input"
                        placeholder="Ulangi kata sandi"
                        autocomplete="new-password"
                        required
                    >
                    <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-person-check-fill"></i>
                Buat Akun
            </button>

        </form>

        <div class="form-divider">sudah punya akun?</div>

        <a href="{{ route('login') }}" class="btn-secondary-link">
            <i class="bi bi-box-arrow-in-right"></i>
            Masuk ke Sistem
        </a>

        <div class="form-footer-note">
            <a href="{{ route('landing') }}">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

function checkStrength(val) {
    const segs  = [1,2,3,4].map(n => document.getElementById('seg' + n));
    const len   = val.length;
    let score   = 0;
    if (len >= 8)  score++;
    if (len >= 12) score++;
    if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
    segs.forEach((seg, i) => {
        seg.className = 'pw-seg' + (i < score ? ' ' + cls : '');
    });
}
</script>

</body>
</html>