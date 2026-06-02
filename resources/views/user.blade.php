<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title') - Sistem Pakar Cabai</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f8faf7; }
.sidebar{
    width:220px;
    min-height:100vh;
    background:#1a2e1a;
    position:fixed;
}
.main{
    margin-left:220px;
    padding:25px;
}
.nav-link{
    color:#ddd;
}
.nav-link:hover,.active{
    color:#7ec97e !important;
}
</style>
</head>
<body>

<div class="sidebar p-3">
    <h5 style="color:#7ec97e">Sistem Pakar</h5>
    <small style="color:#ccc">Tanaman Cabai — User</small>

    <hr style="border-color:#555">

    <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
    <a href="{{ route('user.diagnosa.index') }}" class="nav-link">Diagnosa</a>
    <a href="{{ route('user.riwayat') }}" class="nav-link">Riwayat</a>

    <hr style="border-color:#555">

    <div style="color:#fff">{{ auth()->user()->name }}</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-sm btn-outline-light mt-2">Logout</button>
    </form>
</div>

<div class="main">
    @yield('content')
</div>

</body>
</html>