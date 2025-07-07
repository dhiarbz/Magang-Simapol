<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <h2>SIMAPOL</h2>
            <h4>Sistem Aduan Masyarakat untuk Kejahatan Siber</h4>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <input type="text" id="name" name="name" placeholder="Nama Pengguna" value="{{ old('name') }}" required>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="password" id="password" name="password" placeholder="Kata Sandi (minimal 8 karakter)" required>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                <button type="submit">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
        <div class="image-section">
            <img src="{{ asset('images/logo_siber.png') }}" alt="Gambar logo" class="floating-img">
        </div>
    </div>
</body>
</html>
