<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f4f8f4">

<div class="container">
<div class="row justify-content-center align-items-center vh-100">
<div class="col-md-5">

<div class="card shadow p-4 border-0 rounded-4">

<h3 class="text-center">Daftar Akun</h3>

<form method="POST" action="/register">
@csrf

<div class="mb-3">
<label>Nama</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Konfirmasi Password</label>
<input type="password" name="password_confirmation" class="form-control" required>
</div>

<button class="btn btn-success w-100">
Daftar
</button>

<a href="/login" class="btn btn-outline-secondary w-100 mt-2">
Kembali Login
</a>

</form>

</div>
</div>
</div>
</div>

</body>
</html>