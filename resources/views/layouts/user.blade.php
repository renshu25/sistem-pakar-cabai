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
      --green-500: #4a8c4a;
      --green-600: #3a7a3a;
      --green-700: #2d5e2d;
      --green-900: #1e3a1e;
      --sidebar-bg: #0f1f0f;
      --sidebar-border: rgba(255,255,255,.08);
      --sidebar-text: rgba(255,255,255,.5);
      --sidebar-text-active: #7ed87e;
      --sidebar-active-bg: rgba(126,216,126,.1);
      --border: #e3e8e3;
      --bg-page: #f4f7f4;
      --bg-white: #ffffff;
      --text-primary: #1e3a1e;
      --text-secondary: #6a886a;
      --text-muted: #9ab09a;
      --radius-sm: 8px;
      --radius-md: 10px;
      --radius-lg: 12px;
      --sidebar-w: 240px;
      --topbar-h: 56px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg-page);
      color: var(--text-primary);
      font-size: 14px;
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
      padding: 18px 20px;
      border-bottom: 0.5px solid var(--sidebar-border);
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .brand-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--green-700), var(--green-500));
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .brand-icon i {
      font-size: 18px;
      color: #b8e6b8;
    }

    .brand-text-main {
      font-size: 13px;
      font-weight: 600;
      color: #e8f5e8;
      line-height: 1.2;
    }

    .brand-text-sub {
      font-size: 10px;
      color: rgba(255,255,255,.3);
      margin-top: 2px;
    }

    .sidebar-section-label {
      padding: 16px 20px 4px;
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .08em;
      color: rgba(255,255,255,.22);
      text-transform: uppercase;
    }

    .sidebar-nav {
      padding: 4px 12px;
    }

    .sidebar-nav .nav-link {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 9px 10px;
      border-radius: var(--radius-sm);
      font-size: 13px;
      font-weight: 400;
      color: var(--sidebar-text);
      text-decoration: none;
      margin-bottom: 2px;
      transition: background .15s, color .15s;
      position: relative;
    }

    .sidebar-nav .nav-link i {
      font-size: 17px;
      flex-shrink: 0;
    }

    .sidebar-nav .nav-link .nav-dot {
      width: 6px;
      height: 6px;
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
      color: rgba(255,255,255,.8);
      background: rgba(255,255,255,.05);
    }

    .sidebar-footer {
      margin-top: auto;
      padding: 14px 16px;
      border-top: 0.5px solid var(--sidebar-border);
    }

    .sidebar-footer .user-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-700), var(--green-500));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 600;
      color: #c8e6c8;
      flex-shrink: 0;
      text-transform: uppercase;
    }

    .user-info { flex: 1; min-width: 0; }

    .user-name {
      font-size: 12px;
      font-weight: 500;
      color: rgba(255,255,255,.75);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .logout-btn {
      background: none;
      border: none;
      padding: 0;
      font-size: 11px;
      color: rgba(255,255,255,.28);
      cursor: pointer;
      font-family: inherit;
      transition: color .15s;
    }

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
      padding: 0 24px;
      z-index: 90;
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .breadcrumb-item-muted {
      font-size: 12px;
      color: var(--text-muted);
    }

    .breadcrumb-sep {
      font-size: 12px;
      color: #d0dad0;
    }

    .page-title {
      font-size: 14px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .icon-btn {
      width: 34px;
      height: 34px;
      border-radius: var(--radius-sm);
      background: var(--bg-page);
      border: 0.5px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background .15s;
      text-decoration: none;
    }

    .icon-btn:hover { background: var(--green-50); }

    .icon-btn i {
      font-size: 16px;
      color: var(--text-secondary);
    }

    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: var(--green-50);
      color: var(--green-600);
      font-size: 11px;
      font-weight: 600;
      padding: 4px 12px;
      border-radius: 20px;
      border: 0.5px solid var(--green-100);
    }

    .role-badge::before {
      content: '';
      display: inline-block;
      width: 6px;
      height: 6px;
      background: var(--green-500);
      border-radius: 50%;
    }

    /* ── MAIN CONTENT ── */
    .main-content {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      min-height: 100vh;
    }

    .content-body {
      padding: 28px 28px 40px;
    }

    /* ── CARDS ── */
    .card {
      background: var(--bg-white);
      border: 0.5px solid var(--border);
      border-radius: var(--radius-lg);
      box-shadow: none;
    }

    .card-header-clean {
      padding: 16px 20px 12px;
      border-bottom: 0.5px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-title-sm {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
    }

    /* ── UTILITIES ── */
    .text-muted-green { color: var(--text-muted); }
    .text-green { color: var(--green-600); }

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
    <div class="brand-icon">
      <i class="ti ti-leaf" aria-hidden="true"></i>
    </div>
    <div>
      <div class="brand-text-main">Sistem Pakar</div>
      <div class="brand-text-sub">Tanaman Cabai</div>
    </div>
  </a>

  <div class="sidebar-section-label">Menu</div>
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
      <div class="user-avatar" aria-hidden="true">
        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
      </div>
      <div class="user-info">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">Keluar →</button>
        </form>
      </div>
    </div>
  </div>
</aside>

{{-- ─── TOPBAR ──────────────────────────────────── --}}
<header class="topbar">
  <div class="topbar-left">
    <span class="breadcrumb-item-muted">Beranda</span>
    <span class="breadcrumb-sep">/</span>
    <span class="page-title">@yield('page-title', 'Dashboard')</span>
  </div>
  <div class="topbar-right">
    <a class="icon-btn" href="#" title="Notifikasi" aria-label="Notifikasi">
      <i class="ti ti-bell" aria-hidden="true"></i>
    </a>
    <span class="role-badge">User</span>
  </div>
</header>

{{-- ─── MAIN CONTENT ────────────────────────────── --}}
<main class="main-content" role="main">
  <div class="content-body">
    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>