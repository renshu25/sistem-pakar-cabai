<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — Sistem Pakar Cabai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-50:  #f0f7f0;
      --green-100: #d4ebd4;
      --green-200: #a8d4a8;
      --green-400: #5a9e5a;
      --green-500: #4a8c4a;
      --green-600: #3a7a3a;
      --green-700: #2d5e2d;
      --green-900: #1e3a1e;
      --sidebar-bg: #0c1a0c;
      --sidebar-border: rgba(255,255,255,.07);
      --sidebar-text: rgba(255,255,255,.42);
      --sidebar-text-active: #6ecf6e;
      --sidebar-active-bg: rgba(110,207,110,.1);
      --border: #e3e8e3;
      --bg-page: #f5f7f5;
      --bg-white: #ffffff;
      --text-primary: #1e3a1e;
      --text-secondary: #6a886a;
      --text-muted: #8aaa8a;
      --radius-sm: 7px;
      --radius-md: 9px;
      --radius-lg: 11px;
      --sidebar-w: 220px;
      --topbar-h: 52px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg-page);
      color: var(--text-primary);
      font-size: 13px;
      line-height: 1.6;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
      z-index: 100;
    }

    .sidebar-brand {
      padding: 16px 16px 14px;
      border-bottom: 0.5px solid var(--sidebar-border);
      display: flex;
      align-items: center;
      gap: 9px;
      text-decoration: none;
    }

    .brand-icon {
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, var(--green-700), var(--green-400));
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .brand-icon i {
      font-size: 16px;
      color: #b8e8b8;
    }

    .brand-text-main {
      font-size: 12px;
      font-weight: 600;
      color: #e6f5e6;
      line-height: 1.2;
    }

    .brand-text-sub {
      font-size: 10px;
      color: rgba(255,255,255,.25);
      margin-top: 1px;
    }

    .sidebar-section-label {
      padding: 10px 16px 4px;
      font-size: 9.5px;
      font-weight: 600;
      letter-spacing: .09em;
      color: rgba(255,255,255,.2);
      text-transform: uppercase;
    }

    .sidebar-nav {
      padding: 2px 10px;
    }

    .sidebar-nav .nav-link {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 10px;
      border-radius: var(--radius-sm);
      font-size: 12.5px;
      font-weight: 400;
      color: var(--sidebar-text);
      text-decoration: none;
      margin-bottom: 1px;
      transition: background .12s, color .12s;
    }

    .sidebar-nav .nav-link i {
      font-size: 16px;
      flex-shrink: 0;
    }

    .sidebar-nav .nav-link .nav-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--sidebar-text-active);
      margin-left: auto;
      flex-shrink: 0;
      display: none;
    }

    .sidebar-nav .nav-link.active {
      color: var(--sidebar-text-active);
      background: var(--sidebar-active-bg);
      font-weight: 500;
    }

    .sidebar-nav .nav-link.active .nav-dot {
      display: block;
    }

    .sidebar-nav .nav-link:hover:not(.active) {
      color: rgba(255,255,255,.7);
      background: rgba(255,255,255,.04);
    }

    .sidebar-footer {
      margin-top: auto;
      padding: 12px 14px;
      border-top: 0.5px solid var(--sidebar-border);
    }

    .sidebar-footer .user-row {
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .user-avatar {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-700), var(--green-400));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 600;
      color: #c8e6c8;
      flex-shrink: 0;
      text-transform: uppercase;
    }

    .user-info { flex: 1; min-width: 0; }

    .user-name {
      font-size: 11.5px;
      font-weight: 500;
      color: rgba(255,255,255,.65);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .logout-btn {
      background: none;
      border: none;
      padding: 0;
      color: rgba(255,255,255,.22);
      cursor: pointer;
      font-family: inherit;
      transition: color .15s;
      display: flex;
      align-items: center;
    }

    .logout-btn i { font-size: 16px; }
    .logout-btn:hover { color: #f87171; }

    /* ── TOPBAR ── */
    .topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: var(--bg-white);
      border-bottom: 0.5px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 22px;
      z-index: 90;
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .breadcrumb-item-muted {
      font-size: 11.5px;
      color: var(--text-muted);
    }

    .breadcrumb-sep {
      font-size: 11.5px;
      color: #cdd8cd;
    }

    .page-title {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: var(--green-50);
      color: var(--green-600);
      font-size: 10.5px;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 20px;
      border: 0.5px solid var(--green-100);
    }

    .role-badge::before {
      content: '';
      display: inline-block;
      width: 5px;
      height: 5px;
      background: var(--green-500);
      border-radius: 50%;
    }

    /* Dropdown user di topbar */
    .user-dropdown {
      border: 0.5px solid var(--border);
      background: var(--bg-white);
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      padding: 5px 10px;
      border-radius: var(--radius-md);
      transition: background .15s;
    }

    .user-dropdown:hover { background: var(--bg-page); }

    .top-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-700), var(--green-400));
      color: #c8e8c8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 600;
      flex-shrink: 0;
      text-transform: uppercase;
    }

    .top-user-name {
      font-size: 12px;
      font-weight: 500;
      color: var(--text-primary);
    }

    .top-chevron {
      font-size: 14px;
      color: var(--text-muted);
    }

    .dropdown-menu {
      min-width: 220px;
      border-radius: 12px;
      border: 0.5px solid var(--border) !important;
      box-shadow: 0 4px 20px rgba(0,0,0,.07) !important;
      padding: 6px;
    }

    .dropdown-header {
      padding: 10px 12px;
      line-height: 1.5;
    }

    .dropdown-item {
      border-radius: var(--radius-sm);
      font-size: 12.5px;
      padding: 8px 12px;
      color: var(--text-primary);
    }

    .dropdown-item:hover {
      background: var(--green-50);
      color: var(--green-700);
    }

    .dropdown-item.text-danger:hover {
      background: #fcebeb;
      color: #a32d2d;
    }

    /* ── MAIN CONTENT ── */
    .main-content {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      min-height: 100vh;
    }

    .content-body {
      padding: 24px 24px 40px;
    }

    /* ── CTA BANNER ── */
    .cta-banner {
      background: linear-gradient(135deg, var(--green-900), var(--green-700));
      border-radius: var(--radius-lg);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      gap: 16px;
    }

    .cta-text-main {
      font-size: 13.5px;
      font-weight: 600;
      color: #e6f5e6;
      margin-bottom: 3px;
    }

    .cta-text-sub {
      font-size: 11.5px;
      color: rgba(255,255,255,.45);
    }

    .cta-btn {
      background: var(--sidebar-text-active);
      color: #0c1a0c;
      border: none;
      padding: 8px 16px;
      border-radius: var(--radius-sm);
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      white-space: nowrap;
      font-family: inherit;
      display: flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      transition: background .15s;
      flex-shrink: 0;
    }

    .cta-btn:hover { background: #7ed87e; color: #0c1a0c; }

    /* ── STATS GRID ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-bottom: 20px;
    }

    .stat-card {
      background: var(--bg-white);
      border: 0.5px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 14px 16px;
    }

    .stat-icon-wrap {
      width: 34px;
      height: 34px;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }

    .stat-icon-wrap.green { background: var(--green-50); }
    .stat-icon-wrap.green i { color: var(--green-600); font-size: 17px; }
    .stat-icon-wrap.amber { background: #faeeda; }
    .stat-icon-wrap.amber i { color: #854f0b; font-size: 17px; }
    .stat-icon-wrap.blue { background: #e6f1fb; }
    .stat-icon-wrap.blue i { color: #185fa5; font-size: 17px; }

    .stat-val {
      font-size: 22px;
      font-weight: 600;
      color: var(--text-primary);
      line-height: 1;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 11.5px;
      font-weight: 500;
      color: var(--text-secondary);
    }

    .stat-note {
      font-size: 10.5px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* ── TWO-COLUMN GRID ── */
    .grid-2 {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 12px;
    }

    /* ── CARD ── */
    .card {
      background: var(--bg-white);
      border: 0.5px solid var(--border);
      border-radius: var(--radius-lg);
      box-shadow: none;
    }

    .card-header-clean {
      padding: 13px 16px 10px;
      border-bottom: 0.5px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-title-sm {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .card-action-link {
      font-size: 11px;
      color: var(--green-600);
      text-decoration: none;
      font-weight: 500;
    }

    .card-action-link:hover { color: var(--green-700); }

    .card-body-pad {
      padding: 14px 16px;
    }

    /* ── RIWAYAT ROWS ── */
    .riwayat-row {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 0;
      border-bottom: 0.5px solid var(--border);
    }

    .riwayat-row:last-child { border-bottom: none; }

    .riwayat-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .riwayat-dot.red   { background: #e24b4a; }
    .riwayat-dot.amber { background: #ef9f27; }
    .riwayat-dot.green { background: #4a8c4a; }

    .riwayat-info { flex: 1; min-width: 0; }

    .riwayat-name {
      font-size: 12px;
      font-weight: 500;
      color: var(--text-primary);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .riwayat-date {
      font-size: 10.5px;
      color: var(--text-muted);
    }

    .riwayat-badge {
      font-size: 8px;
      font-weight: 600;
      padding: 2px 8px;
      border-radius: 20px;
      white-space: nowrap;
    }

    .riwayat-badge.red   { background: #fcebeb; color: #a32d2d; }
    .riwayat-badge.amber { background: #faeeda; color: #854f0b; }
    .riwayat-badge.green { background: #eaf3de; color: #3b6d11; }

    /* ── TIPS ── */
    .tip-list { display: flex; flex-direction: column; gap: 8px; }

    .tip-item {
      display: flex;
      align-items: flex-start;
      gap: 9px;
      padding: 9px 10px;
      background: var(--bg-page);
      border-radius: var(--radius-sm);
    }

    .tip-icon {
      width: 28px;
      height: 28px;
      border-radius: 6px;
      background: var(--green-50);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .tip-icon i { font-size: 14px; color: var(--green-600); }

    .tip-title {
      font-size: 12px;
      font-weight: 500;
      color: var(--text-primary);
      margin-bottom: 2px;
    }

    .tip-desc {
      font-size: 11px;
      color: var(--text-muted);
      line-height: 1.4;
    }

    /* ── UTILITIES ── */
    .divider {
      border: none;
      border-top: 0.5px solid var(--border);
      margin: 0;
    }
  </style>
</head>
<body>

{{-- ─── SIDEBAR ─────────────────────────────────── --}}
<aside class="sidebar">
  <a class="sidebar-brand" href="{{ route('user.dashboard') }}">

    <div>
      <div class="brand-text-main">Sistem Pakar</div>
      <div class="brand-text-sub">Tanaman Cabai</div>
    </div>
  </a>

  <div class="sidebar-section-label">Menu Utama</div>
  <nav class="sidebar-nav" aria-label="Navigasi utama">
    <a class="nav-link @if(Request::routeIs('user.dashboard')) active @endif"
       href="{{ route('user.dashboard') }}">
      <i class="ti ti-layout-dashboard" aria-hidden="true"></i>
      Dashboard
      <span class="nav-dot" aria-hidden="true"></span>
    </a>
    <a class="nav-link @if(Request::routeIs('user.diagnosa.*')) active @endif"
       href="{{ route('user.diagnosa.index') }}">
      <i class="ti ti-stethoscope" aria-hidden="true"></i>
      Diagnosa
      <span class="nav-dot" aria-hidden="true"></span>
    </a>
    <a class="nav-link @if(Request::routeIs('user.riwayat')) active @endif"
       href="{{ route('user.riwayat') }}">
      <i class="ti ti-history" aria-hidden="true"></i>
      Riwayat
      <span class="nav-dot" aria-hidden="true"></span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-row">
      <div class="user-avatar">
        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
      </div>
      <div class="user-info">
        <div class="user-name">{{ auth()->user()->name }}</div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn" title="Logout">
          <i class="ti ti-logout" aria-hidden="true"></i>
        </button>
      </form>
    </div>
  </div>
</aside>

{{-- ─── TOPBAR ──────────────────────────────────── --}}
<header class="topbar">
<div class="topbar-left">

@php
    if(Request::routeIs('user.dashboard')){
        $breadcrumb = 'Dashboard';
    }
    elseif(Request::routeIs('user.diagnosa.*')){
        $breadcrumb = 'Diagnosa';
    }
    elseif(Request::routeIs('user.riwayat')){
        $breadcrumb = 'Riwayat';
    }
    elseif(Request::routeIs('user.profil')){
        $breadcrumb = 'Profil';
    }
    else{
        $breadcrumb = 'Dashboard';
    }
@endphp


<span class="breadcrumb-item-muted">
    Dashboard
</span>

<span class="breadcrumb-sep">
    /
</span>

<span class="page-title">
    {{ $breadcrumb }}
</span>

</div>

  <div class="topbar-right">
    <span class="role-badge">Petani</span>

    <div class="dropdown">
      <button class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="top-avatar">
          {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <span class="top-user-name">{{ auth()->user()->name }}</span>
        <i class="ti ti-chevron-down top-chevron" aria-hidden="true"></i>
      </button>

      <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-header">
          <strong>{{ auth()->user()->name }}</strong><br>
          <small class="text-muted">{{ auth()->user()->email }}</small>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item" href="{{ route('user.profil') }}">
            <i class="ti ti-user me-2" aria-hidden="true"></i>
            Profil Saya
          </a>
        </li>


        <li><hr class="dropdown-divider"></li>

        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
              <i class="ti ti-logout me-2" aria-hidden="true"></i>
              Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</header>

{{-- ─── MAIN CONTENT ────────────────────────────── --}}
<main class="main-content" role="main">
  <div class="content-body">
    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
@yield('scripts')
</body>
</html>