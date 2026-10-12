<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Sistem Pakar Cabai</title>

```
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root{
        --green-deep:#0d3d2b;
        --green-mid:#165c3e;
        --green-fresh:#1e8a52;
        --green-light:#2dba72;
        --green-pale:#edf7f2;

        --text-dark:#1a2e22;
        --text-muted:#637068;
        --border:#dde5e0;
        --cream:#f9f7f2;
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:20px;
        background:var(--cream);
        font-family:'Inter',sans-serif;
    }

    .card-reset{
        width:100%;
        max-width:460px;
        background:#fff;
        border:1px solid var(--border);
        border-radius:18px;
        padding:36px;
        box-shadow:0 15px 40px rgba(0,0,0,.06);
    }

    .logo-box{
        width:70px;
        height:70px;
        margin:0 auto 18px;
        border-radius:16px;
        background:linear-gradient(
            135deg,
            var(--green-fresh),
            var(--green-light)
        );
        display:flex;
        align-items:center;
        justify-content:center;
        color:white;
        font-size:1.8rem;
    }

    .title{
        font-family:'Lora',serif;
        font-size:1.9rem;
        text-align:center;
        color:var(--text-dark);
        margin-bottom:10px;
    }

    .subtitle{
        text-align:center;
        color:var(--text-muted);
        font-size:.92rem;
        line-height:1.7;
        margin-bottom:28px;
    }

    .alert-success{
        background:var(--green-pale);
        border:1px solid rgba(30,138,82,.2);
        color:var(--green-mid);
        padding:12px 14px;
        border-radius:10px;
        margin-bottom:18px;
        font-size:.85rem;
    }

    .alert-danger{
        background:#fff1f1;
        border:1px solid #ffc9c9;
        color:#842029;
        padding:12px 14px;
        border-radius:10px;
        margin-bottom:18px;
        font-size:.85rem;
    }

    .field-group{
        margin-bottom:18px;
    }

    .field-label{
        display:block;
        margin-bottom:8px;
        font-size:.85rem;
        font-weight:600;
        color:var(--text-dark);
    }

    .field-wrap{
        position:relative;
    }

    .field-icon{
        position:absolute;
        left:14px;
        top:50%;
        transform:translateY(-50%);
        color:var(--text-muted);
    }

    .field-input{
        width:100%;
        padding:13px 14px 13px 42px;
        border:1.5px solid var(--border);
        border-radius:10px;
        outline:none;
        font-size:.9rem;
        transition:.2s;
    }

    .field-input:focus{
        border-color:var(--green-fresh);
        box-shadow:0 0 0 4px rgba(30,138,82,.1);
    }

    .btn-submit{
        width:100%;
        border:none;
        border-radius:10px;
        padding:14px;
        background:var(--green-fresh);
        color:white;
        font-weight:600;
        cursor:pointer;
        transition:.25s;
        font-size:.9rem;
    }

    .btn-submit:hover{
        background:var(--green-light);
        transform:translateY(-1px);
    }

    .back-link{
        display:block;
        text-align:center;
        margin-top:18px;
        text-decoration:none;
        color:var(--green-fresh);
        font-size:.85rem;
        font-weight:600;
    }

    .back-link:hover{
        text-decoration:underline;
    }
</style>


</head>
<body>

<div class="card-reset">

<div class="logo-box">
    <i class="bi bi-shield-lock"></i>
</div>

<h1 class="title">Lupa Password</h1>

<p class="subtitle">
    Masukkan alamat email yang terdaftar pada sistem.
    Kami akan mengirimkan tautan untuk mengatur ulang password akun Anda.
</p>

@if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-danger">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="field-group">
        <label class="field-label">
            Alamat Email
        </label>

        <div class="field-wrap">
            <i class="bi bi-envelope field-icon"></i>

            <input
                type="email"
                name="email"
                class="field-input"
                placeholder="contoh@email.com"
                required>
        </div>
    </div>

    <button type="submit" class="btn-submit">
        <i class="bi bi-send"></i>
        Kirim Link Reset Password
    </button>
</form>

<a href="{{ route('login') }}" class="back-link">
    <i class="bi bi-arrow-left"></i>
    Kembali ke Login
</a>


</div>

</body>
</html>
