<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Register</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 360px;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .tabs {
            display: flex;
            background: #eee;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            border-radius: 10px;
        }

        .tab.active {
            background: #6f8fc9;
            color: #fff;
        }

        .form-group {
            margin-bottom: 14px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
        }

        .link {
            font-size: 13px;
            color: #5b7bd5;
            text-decoration: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(to right, #6f8fc9, #8898b8);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .switch {
            text-align: center;
            font-size: 13px;
            margin-top: 12px;
        }

        .form {
            display: none;
        }

        .form.active {
            display: block;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="title">Form Login</div>

    <div class="tabs">
        <div class="tab active" onclick="showLogin()">Login</div>
        <div class="tab" onclick="showRegister()">Register</div>
    </div>

    {{-- LOGIN --}}
    <form class="form active" id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Masukkan Email">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Masukkan Password">
        </div>

        <a href="#" class="link">Lupa password?</a>

        <button class="btn">Login</button>

        <div class="switch">
            Belum punya akun? <a href="#" class="link" onclick="showRegister()">Daftar sekarang</a>
        </div>
    </form>

    {{-- REGISTER --}}
    <form class="form" id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Nama Lengkap">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">
        </div>

        <button class="btn">Register</button>

        <div class="switch">
            Sudah punya akun? <a href="#" class="link" onclick="showLogin()">Login</a>
        </div>
    </form>
</div>

<script>
    function showLogin() {
        document.querySelector('.title').innerText = 'Form Login';
        document.getElementById('loginForm').classList.add('active');
        document.getElementById('registerForm').classList.remove('active');
        document.querySelectorAll('.tab')[0].classList.add('active');
        document.querySelectorAll('.tab')[1].classList.remove('active');
    }

    function showRegister() {
        document.querySelector('.title').innerText = 'Form Register';
        document.getElementById('registerForm').classList.add('active');
        document.getElementById('loginForm').classList.remove('active');
        document.querySelectorAll('.tab')[1].classList.add('active');
        document.querySelectorAll('.tab')[0].classList.remove('active');
    }
</script>

</body>
</html>