<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') — Sistem Pakar Cabai</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --sidebar-bg: #0f1f0f;
      --sidebar-border: rgba(255,255,255,.08);
      --sidebar-text: rgba(255,255,255,.55);
      --sidebar-active: #7ed87e;

      --bg-page: #f4f7f4;
      --bg-white: #ffffff;
      --border: #e3e8e3;

      --text-primary: #1e3a1e;
      --text-muted: #6a886a;

      --green: #4a8c4a;
      --green-soft: #e8f5e8;

      --radius: 10px;
      --sidebar-w: 240px;
      --topbar-h: 56px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg-page);
      color: var(--text-primary);
      font-size: 14px;
    }

    /* SIDEBAR */
    .sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
    }

    .brand {
      padding: 18px;
      border-bottom: 1px solid var(--sidebar-border);
      color: #e8f5e8;
      font-weight: 600;
      font-size: 14px;
    }

    .brand small {
      display: block;
      font-size: 10px;
      opacity: .4;
      font-weight: 400;
    }

    .nav-link {
      color: var(--sidebar-text);
      padding: 10px 16px;
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      border-radius: 8px;
      margin: 2px 10px;
      transition: .2s;
    }

    .nav-link:hover {
      background: rgba(255,255,255,.05);
      color: white;
    }

    .nav-link.active {
      background: rgba(126,216,126,.12);
      color: var(--sidebar-active);
    }

    /* TOPBAR */
    .topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: white;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }

    .badge-role {
      background: var(--green-soft);
      color: var(--green);
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
    }

    /* MAIN */
    .main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
    }

    .content {
      padding: 24px;
    }

    /* CARD STYLE (SAMAKAN DENGAN USER) */
    .card {
      border: 1px solid var(--border);
      border-radius: var(--radius);
      background: var(--bg-white);
    }

  </style>
</head>

<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
  <div class="brand">
    Sistem Pakar Cabai
    <small>Admin Panel</small>
  </div>

  <a class="nav-link @if(Request::routeIs('admin.dashboard')) active @endif"
     href="{{ route('admin.dashboard') }}">
     <i class="ti ti-layout-dashboard"></i> Dashboard
  </a>

  <a class="nav-link @if(Request::routeIs('admin.penyakit.*')) active @endif"
     href="{{ route('admin.penyakit.index') }}">
     <i class="ti ti-virus"></i> Penyakit
  </a>

  <a class="nav-link @if(Request::routeIs('admin.gejala.*')) active @endif"
     href="{{ route('admin.gejala.index') }}">
     <i class="ti ti-list-details"></i> Gejala
  </a>

  <a class="nav-link @if(Request::routeIs('admin.basis.*')) active @endif"
     href="{{ route('admin.basis.index') }}">
     <i class="ti ti-sitemap"></i> Rule
  </a>

  <a class="nav-link @if(Request::routeIs('admin.obat.*')) active @endif"
     href="{{ route('admin.obat.index') }}">
     <i class="ti ti-pill"></i> Obat
  </a>

  <a class="nav-link @if(Request::routeIs('admin.diagnosa.*')) active @endif"
     href="{{ route('admin.diagnosa.index') }}">
     <i class="ti ti-report-medical"></i> Diagnosa
  </a>
</aside>

{{-- TOPBAR --}}
<header class="topbar">
  <div>
    <strong>@yield('page-title','Dashboard')</strong>
  </div>

  <div style="display:flex;align-items:center;gap:10px;">
    <span class="badge-role">Admin</span>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button style="border:none;background:none;color:#666;font-size:13px;">
        Logout
      </button>
    </form>
  </div>
</header>

{{-- CONTENT --}}
<main class="main">
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>