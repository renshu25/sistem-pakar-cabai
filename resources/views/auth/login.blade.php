<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Sistem Pakar Cabai</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background:#f4f8f4;
}
.card{
    border:none;
    border-radius:16px;
}
.btn-login{
    background:#198754;
    color:white;
}
.btn-login:hover{
    background:#157347;
}
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center align-items-center vh-100">
<div class="col-md-5">

<div class="card shadow p-4">

<h3 class="text-center mb-1">🌶 Sistem Pakar Cabai</h3>
<p class="text-center text-muted mb-4">Silakan login</p>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
{{ $errors->first() }}
</div>
@endif

<form method="POST" action="/login">
@csrf

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" class="btn btn-login w-100">
Login
</button>

<a href="/register" class="btn btn-outline-secondary w-100 mt-2">
Daftar Akun
</a>

</form>

</div>

</div>
</div>
</div>

</body>
</html>