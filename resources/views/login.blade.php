<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login - SIMAPOL</title>
    <!-- Bootstrap CSS (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style_login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <h2>SIMAPOL</h2>
            <h4>Sistem Aduan Masyarakat untuk Kejahatan Siber</h4>
            
            <!-- Laravel Form with route handling -->
            <form method="POST" action="{{ route('login') }}">
                @csrf <!-- CSRF Protection -->

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Username Field -->
                <div class="form-group">
                    <label for="name" class="visually-hidden">Username</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Username" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="visually-hidden">Kata Sandi</label>
                    <input type="password" id="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Kata Sandi" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label ms-1 mt-1" for="remember">
                        Ingat Saya
                    </label>
                </div>

                <!-- reCAPTCHA -->
                <div class="recaptcha-container my-3">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                        <span class="text-danger" role="alert">
                            <small><strong>{{ $message }}</strong></small>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">
                    Masuk
                </button>

                <!-- Forgot Password Link -->
                <div class="text-center mt-2">
                    <a href="#">Lupa Kata Sandi?</a>
                </div>

                <!-- Register Link -->
                <p class="register-text text-center mt-3">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </p>
            </form>
        </div>
        
        <!-- Image Section -->
        <div class="image-section">
            <img src="{{ asset('images/logo_siber.png') }}" alt="Logo Kejahatan Siber" class="floating-img">
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>