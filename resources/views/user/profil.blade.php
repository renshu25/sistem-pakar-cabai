@extends('layouts.user')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
:root {
    --green-deep:   #0d3d2b;
    --green-mid:    #165c3e;
    --green-fresh:  #1e8a52;
    --green-light:  #2dba72;
    --green-pale:   #edf7f2;
    --text-dark:    #1a2e22;
    --text-muted:   #637068;
    --border:       #dde5e0;
}

body {
    font-family: 'Inter', sans-serif;
}

/* ── CARD ── */
.profile-card {
    background: #fff;
    border: 0.5px solid var(--border);
    border-radius: 14px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

/* ── JUDUL SECTION ── */
.profile-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 0.5px solid var(--border);
}

/* ── LABEL & VALUE ── */
.profile-label {
    font-size: 11px;
    color: var(--text-muted);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 0.2rem;
}

.profile-value {
    font-size: 0.9rem;
    color: var(--text-dark);
    font-weight: 500;
}

/* ── BADGE ROLE ── */
.badge-role {
    display: inline-block;
    background: var(--green-pale);
    color: var(--green-deep);
    font-size: 11px;
    font-weight: 500;
    padding: 3px 10px;
    border-radius: 20px;
    border: 0.5px solid #c3e6d5;
}

/* ── FORM LABEL ── */
.form-label-custom {
    display: block;
    font-size: 11px;
    color: var(--text-muted);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 0.4rem;
}

/* ── FIELD WRAP (hanya untuk posisi ikon mata) ── */
.field-wrap {
    position: relative;
}

/* ── INPUT — tanpa padding kiri ekstra (tidak ada ikon kunci) ── */
.field-input {
    width: 100%;
    padding: 0.72rem 2.6rem 0.72rem 0.9rem; /* kanan untuk ikon mata, kiri normal */
    border: 0.5px solid var(--border);
    border-radius: 10px;
    font-size: 0.9rem;
    font-family: 'Inter', sans-serif;
    color: var(--text-dark);
    background: #fff;
    transition: border 0.2s, box-shadow 0.2s;
    outline: none;
}

.field-input:focus {
    border-color: var(--green-fresh);
    box-shadow: 0 0 0 3px rgba(30,138,82,0.1);
}

/* ── TOGGLE IKON MATA (kanan) ── */
.toggle-pw {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    line-height: 1;
}

.toggle-pw i {
    font-size: 1rem;
}

.toggle-pw:hover {
    color: var(--green-fresh);
}

/* ── BUTTON ── */
.btn-submit {
    width: 100%;
    background: var(--green-fresh);
    color: #fff;
    padding: 0.82rem;
    border-radius: 10px;
    border: none;
    font-weight: 500;
    font-size: 0.9rem;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    margin-top: 0.5rem;
    transition: background 0.2s, transform 0.15s;
}

.btn-submit:hover {
    background: var(--green-light);
    transform: translateY(-1px);
}

/* ── ALERT ── */
.alert {
    font-size: 0.85rem;
    border-radius: 10px;
}
</style>

<div class="row g-3">

    {{-- ─── KIRI: Informasi Akun ─── --}}
    <div class="col-lg-5">
        <div class="profile-card">
            <div class="profile-title">Informasi Akun</div>

            <div class="mb-3">
                <div class="profile-label">Nama</div>
                <div class="profile-value">{{ auth()->user()->name }}</div>
            </div>

            <div class="mb-3">
                <div class="profile-label">Email</div>
                <div class="profile-value">{{ auth()->user()->email }}</div>
            </div>

            <div class="mb-3">
                <div class="profile-label">Role</div>
                <div class="profile-value">
                    <span class="badge-role">Petani</span>
                </div>
            </div>

            <div>
                <div class="profile-label">Tanggal Bergabung</div>
                <div class="profile-value">
                    {{ auth()->user()->created_at->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ─── KANAN: Keamanan Akun ─── --}}
    <div class="col-lg-7">
        <div class="profile-card">
            <div class="profile-title">Keamanan Akun</div>

            <form method="POST" action="{{ route('user.profil.password') }}">
                @csrf

                {{-- Password Lama --}}
                <div class="mb-3">
                    <label for="password_lama" class="form-label-custom">
                        Password Lama
                    </label>
                    <div class="field-wrap">
                        <input type="password"
                               id="password_lama"
                               name="password_lama"
                               class="field-input"
                               placeholder="Masukkan password lama"
                               autocomplete="current-password">
                        <button type="button"
                                class="toggle-pw"
                                onclick="togglePw('password_lama', this)"
                                aria-label="Tampilkan password lama">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label for="password_baru" class="form-label-custom">
                        Password Baru
                    </label>
                    <div class="field-wrap">
                        <input type="password"
                               id="password_baru"
                               name="password_baru"
                               class="field-input"
                               placeholder="Masukkan password baru"
                               autocomplete="new-password">
                        <button type="button"
                                class="toggle-pw"
                                onclick="togglePw('password_baru', this)"
                                aria-label="Tampilkan password baru">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-3">
                    <label for="password_baru_confirmation" class="form-label-custom">
                        Konfirmasi Password Baru
                    </label>
                    <div class="field-wrap">
                        <input type="password"
                               id="password_baru_confirmation"
                               name="password_baru_confirmation"
                               class="field-input"
                               placeholder="Ulangi password baru"
                               autocomplete="new-password">
                        <button type="button"
                                class="toggle-pw"
                                onclick="togglePw('password_baru_confirmation', this)"
                                aria-label="Tampilkan konfirmasi password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Simpan Perubahan
                </button>
            </form>

            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>

</div>

<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');

    if (input.type === 'password') {
        input.type    = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type    = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>

@endsection