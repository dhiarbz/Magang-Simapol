<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPOL</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <style>
        :root {
            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            --bg-card-header: #f8f9fa;
            --color-text-primary: #343a40;
            --color-text-secondary: #6c757d;
            --color-accent: #0d6efd;
            --color-accent-hover: #0b5ed7;
            --color-border: #e9ecef;
            --font-family: 'Poppins', sans-serif;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --radius: 8px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: var(--font-family);
        }
        
        body { 
            background-color: var(--bg-body); 
            color: var(--color-text-primary); 
        }

        .navbar {
            background: var(--bg-card);
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo { 
            height: 50px; 
        }
        
        .logo-text strong { 
            font-size: 22px; 
            font-weight: 600; 
            color: var(--color-text-primary);
        }
        
        .logo-text span { 
            font-size: 13px; 
            color: var(--color-text-secondary); 
            display: block;
        }

        .menu { 
            display: flex; 
            gap: 10px; 
        }
        
        .menu a {
            color: var(--color-text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            padding: 8px 16px;
            border-radius: var(--radius);
            transition: all 0.2s ease-in-out;
        }
        
        .menu a:hover {
            color: var(--color-text-primary);
            background-color: var(--bg-body);
        }
        
        .menu a.active {
            color: var(--color-accent);
            background-color: #e7f1ff;
            font-weight: 600;
        }

        .login-btn {
            background: #1E293B;
            border: 1px solid #1E293B;
            color: var(--color-border);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 8px 18px;
            border-radius: var(--radius);
            transition: all 0.2s ease-in-out;
            font-family: var(--font-family);
        }
        
        .login-btn:hover {
            background-color: var(--bg-body);
            color: #0f2236;
            border-color: #0f2236;
        }
        
        .login-btn i { 
            margin-right: 8px; 
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-polisi {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
            color: white;
            padding: 12px 30px;
            border-radius: var(--radius);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-polisi:hover {
            background-color: var(--color-accent-hover);
            color: white;
            border-color: var(--color-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }
        
        .btn-outline-polisi {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            border-radius: var(--radius);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-polisi:hover {
            background-color: white;
            color: var(--color-text-primary);
        }
        
        /* Services Section */
        .services-section {
            padding: 80px 0;
            background-color: var(--bg-card);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--color-text-primary);
            font-weight: 700;
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--color-text-secondary);
            max-width: 600px;
            margin: 0 auto 3rem;
        }
        
        .feature-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: var(--shadow-sm);
            border-radius: var(--radius);
            background-color: var(--bg-card);
            height: 100%;
            padding: 2rem;
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--color-accent);
            margin-bottom: 1.5rem;
        }
        
        .feature-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--color-text-primary);
        }
        
        .feature-description {
            color: var(--color-text-secondary);
            margin-bottom: 1.5rem;
        }
        
        /* Stats Section */
        .stats-section {
            padding: 60px 0;
            background-color: var(--bg-body);
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--color-accent);
            display: block;
        }
        
        .stat-label {
            color: var(--color-text-secondary);
            font-size: 1rem;
        }
        
        /* Quick Actions */
        .quick-actions-section {
            padding: 80px 0;
            background-color: var(--bg-card);
        }
        
        .quick-action-card {
            border-radius: var(--radius);
            transition: all 0.3s;
            border: 1px solid var(--color-border);
            background-color: var(--bg-card);
            padding: 2rem;
            text-align: center;
            height: 100%;
        }
        
        .quick-action-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        
        .quick-action-icon {
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 1rem;
        }
        
        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 60px 0 20px;
        }
        
        .footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: #b0b0b0;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-contact li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
            color: #b0b0b0;
        }
        
        .footer-contact i {
            margin-right: 10px;
            color: var(--color-accent);
            margin-top: 3px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 1rem;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #333;
            border-radius: 50%;
            color: white;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background-color: var(--color-accent);
            transform: translateY(-3px);
        }
        
        .copyright {
            border-top: 1px solid #333;
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            color: #b0b0b0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .menu {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-buttons .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
   <header class="navbar">
        <div class="logo-area">
            <img src="{{ asset('images/siber.png') }}" alt="Logo SIMAPOL" class="logo">
            <div class="logo-text">
                <strong>SIMAPOL</strong>
            </div>
        </div>
        <nav class="menu">
            <a href=""><i class=""></i> Jelajah Aduan</a>
            <a href=""><i class=""></i> Tentang SIMAPOL</a>
            <a href=""><i class=""></i> Kontak</a>
        </nav>
        <a class="login-btn" href="{{ url('/login') }}"><i class="fa-solid fa-user"> Masuk / Daftar</i></a>
    </header>


    <!-- Main Content -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">SIMAPOL</h1>
            <p class="lead mb-5">Layanan Pengaduan Masyarakat</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ url('/login') }}" class="btn btn-primary btn-lg me-md-2 px-4">
                            <i class="fas fa-plus-circle me-2"></i>Buat Aduan
                        </a>
                        <a href="" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-search me-2"></i>Cek Status Aduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold">Layanan Cepat</h2>
                    <p class="text-muted">Pilih jenis layanan yang Anda butuhkan</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card quick-action-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-primary bg-gradient rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-bell text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title">Aduan Kehilangan</h5>
                            <p class="card-text">Untuk kejadian yang membutuhkan penanganan segera seperti kekerasan, pencurian, atau kecelakaan.</p>
                            <a href="" class="btn btn-polisi">Adukan Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card quick-action-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-success bg-gradient rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-file-alt text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title">Aduan Umum</h5>
                            <p class="card-text">Untuk pengaduan kejadian tidak darurat seperti pengaduan masyarakat, informasi, atau konsultasi.</p>
                            <a href="" class="btn btn-polisi">Buat Aduan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card quick-action-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-warning bg-gradient rounded-circle p-3 mx-auto mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-search text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title">Cek Aduan</h5>
                            <p class="card-text">Pantau perkembangan aduan yang telah Anda kirim dengan nomor pelacakan yang diberikan.</p>
                            <a href="" class="btn btn-polisi">Cek Status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="stat-number">1,250+</div>
                    <p class="text-muted">Aduan Diproses</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-number">98%</div>
                    <p class="text-muted">Tingkat Kepuasan</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-number">24/7</div>
                    <p class="text-muted">Layanan Tersedia</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-number">45m</div>
                    <p class="text-muted">Rata-Rata Respon</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold">Cara Melapor</h2>
                    <p class="text-muted">Ikuti langkah-langkah mudah berikut untuk membuat laporan</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-primary bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">1</span>
                            </div>
                            <h5 class="card-title">Daftar/Login</h5>
                            <p class="card-text">Silakan login terlebih dahulu untuk membuat aduan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-primary bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">2</span>
                            </div>
                            <h5 class="card-title">Isi Formulir</h5>
                            <p class="card-text">Lengkapi formulir laporan dengan data yang akurat dan jelas mengenai kejadian yang dialami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-primary bg-gradient text-white rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">3</span>
                            </div>
                            <h5 class="card-title">Proses & Tindak Lanjut</h5>
                            <p class="card-text">Laporan akan diproses oleh unit terkait dan Anda dapat memantau perkembangannya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><img src="{{ asset('images/siber.png') }}" alt="Logo SIMAPOL" class="logo" style="height: 35px; wide: 100%;"></i> LAPOR POLISI</h5>
                    <p class="mt-3">Layanan pengaduan masyarakat secara online untuk melaporkan tindak kriminalitas dan pelanggaran hukum.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak Darurat</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> 110 - Polisi</li>
                        <li><i class="fas fa-ambulance me-2"></i> 119 - Ambulans</li>
                        <li><i class="fas fa-fire me-2"></i> 113 - Pemadam Kebakaran</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="" class="text-white text-decoration-none">Buat Laporan</a></li>
                        <li><a href="" class="text-white text-decoration-none">Status Laporan</a></li>
                        <li><a href="" class="text-white text-decoration-none">Tentang Kami</a></li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4">
            <div class="text-center">
                <p>&copy; 2023 Lapor Polisi. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>