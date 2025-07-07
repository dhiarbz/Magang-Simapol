<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPOL - Laporan Pengaduan Profesional</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* =================================================================
           1. ROOT VARIABLES & GLOBAL STYLES (SEIMBANG & PROFESIONAL)
           ================================================================= */
        :root {
            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            --bg-card-header: #f8f9fa;
            --color-text-primary: #343a40;
            --color-text-secondary: #6c757d;
            --color-accent: #0d6efd; /* Biru Bootstrap standar, sangat dikenal */
            --color-accent-hover: #0b5ed7;
            --color-border: #e9ecef;
            --font-family: 'Poppins', sans-serif;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            color: var(--color-text-primary);
            font-size: 16px; /* Ukuran font standar web */
            line-height: 1.6;
        }
        
        /* =================================================================
           2. HEADER & NAVIGATION (BERSIH & FUNGSIONAL)
           ================================================================= */
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
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logo { height: 50px; }
        .logo-text strong { font-size: 22px; font-weight: 600; }
        .logo-text span { font-size: 13px; color: var(--color-text-secondary); }

        .menu { display: flex; gap: 10px; }
        .menu a {
            color: var(--color-text-secondary);
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

        /* Tombol Logout dibuat lebih subtil, sebagai secondary action */
        .logout-btn {
            background: transparent;
            border: 1px solid var(--color-border);
            color: var(--color-text-secondary);
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 18px;
            border-radius: var(--radius);
            transition: all 0.2s ease-in-out;
            font-family: inherit;
        }
        .logout-btn:hover {
            background-color: var(--bg-body);
            color: var(--color-text-primary);
            border-color: #ced4da;
        }
        .logout-btn i { margin-right: 8px; }
        
        /* =================================================================
           3. MAIN CONTENT & CARD DESIGN (RAPI & TERSTRUKTUR)
           ================================================================= */
        .main {
            padding: 30px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .main-section {
            background: var(--bg-card);
            border: 1px solid var(--color-border);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            overflow: hidden; /* Penting untuk menjaga border-radius pada header */
        }
        
        .section-header {
            background-color: var(--bg-card-header);
            padding: 20px 30px;
            border-bottom: 1px solid var(--color-border);
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-header h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color: var(--color-text-primary);
        }
        .section-header i {
            color: var(--color-accent);
            font-size: 20px;
        }

        /* Konten di dalam card diberi padding terpisah */
        .card-body {
            padding: 30px;
        }
        
        .welcome-section p {
            font-size: 1.1rem;
            color: var(--color-text-secondary);
            text-align: center;
        }

        /* =================================================================
           4. FORMULIR (INTUITIF & NYAMAN)
           ================================================================= */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px 25px;
        }
        .form-group.full-width { grid-column: 1 / -1; }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 15px;
            color: var(--color-text-primary);
        }
        form label .required { color: #dc3545; }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px 15px; /* Padding input normal */
            border: 1px solid #ced4da;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: 15px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        form input:focus, form select:focus, form textarea:focus {
            outline: none;
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
        }
        form textarea { min-height: 120px; resize: vertical; }
        
        /* File Input yang lebih sederhana */
        input[type="file"] { display: none; }
        .file-input-label {
            background-color: var(--bg-card-header);
            border: 2px dashed var(--color-border);
            border-radius: var(--radius);
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .file-input-label:hover { border-color: var(--color-accent); }
        .file-input-label i { color: var(--color-text-secondary); margin-right: 8px; }
        .file-name { font-style: italic; color: var(--color-text-secondary); margin-top: 8px; font-size: 13px; }
        
        /* Tombol User-Friendly */
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 22px;
            border-radius: var(--radius);
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease-in-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-primary {
            background-color: var(--color-accent);
            color: white;
        }
        .btn-primary:hover {
            background-color: var(--color-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
        }
        .btn-secondary {
            background-color: var(--bg-card);
            color: var(--color-text-secondary);
            border-color: #ced4da;
        }
        .btn-secondary:hover {
            background-color: var(--bg-body);
            color: var(--color-text-primary);
        }

        /* =================================================================
           5. FORMULIR MULTI-LANGKAH (SLEEK & MINIMAL)
           ================================================================= */
        .form-progress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }
        .form-progress::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--color-border);
            transform: translateY(-50%);
        }
        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 0%;
            height: 2px;
            background: var(--color-accent);
            transition: width 0.4s ease;
        }
        .progress-step {
            position: relative;
            text-align: center;
        }
        .step-circle {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 2px solid var(--color-border);
            color: var(--color-text-secondary);
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 14px;
            transition: all 0.4s ease;
            margin: 0 auto 10px;
        }
        .step-label { font-size: 14px; color: var(--color-text-secondary); }
        .progress-step.active .step-circle {
            background: var(--color-accent);
            border-color: var(--color-accent);
            color: white;
        }
        .progress-step.active .step-label { color: var(--color-text-primary); font-weight: 500; }
        .progress-step.completed .step-circle { background: #e7f1ff; border-color: var(--color-accent); color: var(--color-accent); }
        .form-step { display: none; }
        .form-step.active { display: block; }

        /* =================================================================
           6. KONTAK & FOOTER
           ================================================================= */
        .contact-columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--color-text-secondary);
        }
        .contact-item i { font-size: 20px; color: var(--color-accent); width: 25px; }

        footer {
            text-align: center;
            padding: 25px;
            background: var(--bg-card);
            color: var(--color-text-secondary);
            margin-top: 30px;
            border-top: 1px solid var(--color-border);
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo-area">
            <img src="{{ asset('images/siber.png') }}" alt="Logo SIMAPOL" class="logo">
            <div class="logo-text">
                <strong>SIMAPOL</strong>
                <span>Layanan Pengaduan Masyarakat</span>
            </div>
        </div>
        <nav class="menu">
            <a href="#home" class="active"><i class="fas fa-home"></i> Beranda</a>
            <a href="#laporan"><i class="fas fa-edit"></i> Buat Laporan</a>
            <a href="#surat"><i class="fas fa-file-alt"></i> Buat STPA</a>
            <a href="#kontak"><i class="fas fa-phone-alt"></i> Kontak</a>
        </nav>
        <button class="logout-btn" onclick="document.getElementById('logout-form').submit()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
    </header>

    <main class="main">
        <section id="home" class="main-section">
            <div class="card-body welcome-section">
                <h2 style="text-align: center; font-weight: 600; margin-bottom: 1rem;">Selamat Datang di SIMAPOL</h2>
                <p>Platform layanan pengaduan masyarakat yang dirancang untuk kemudahan dan kenyamanan Anda. Silakan sampaikan laporan Anda melalui formulir yang telah kami sediakan.</p>
            </div>
        </section>

        <section id="laporan" class="main-section">
             <div class="section-header">
                <i class="fas fa-edit"></i>
                <h2>Formulir Laporan Pengaduan</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group"><label for="nik">No. NIK <span class="required">*</span></label><input type="text" id="nik" name="nik" placeholder="Contoh: 3374012345678901" required></div>
                        <div class="form-group"><label for="nama">Nama Lengkap <span class="required">*</span></label><input type="text" id="nama" name="nama" placeholder="Sesuai KTP" required></div>
                        <div class="form-group"><label for="ttg">Tempat, Tgl Lahir <span class="required">*</span></label><input type="text" id="ttg" name="ttg" placeholder="Semarang, 17-08-1990" required></div>
                        <div class="form-group"><label for="agama">Agama <span class="required">*</span></label><input type="text" id="agama" name="agama" required></div>
                        <div class="form-group"><label for="pekerjaan">Pekerjaan <span class="required">*</span></label><input type="text" id="pekerjaan" name="pekerjaan" required></div>
                        <div class="form-group"><label for="nomor_hp">No. HP/WA <span class="required">*</span></label><input type="text" id="nomor_hp" name="nomor_hp" placeholder="08123..." required></div>
                        <div class="form-group full-width"><label for="alamat_ktp">Alamat KTP <span class="required">*</span></label><input type="text" id="alamat_ktp" name="alamat_ktp" required></div>
                        <div class="form-group full-width"><label for="alamat_domisili">Alamat Domisili <span class="required">*</span></label><input type="text" id="alamat_domisili" name="alamat_domisili" required></div>
                        <div class="form-group full-width"><label for="isi_laporan">Isi Laporan <span class="required">*</span></label><textarea id="isi_laporan" name="isi_laporan" placeholder="Jelaskan kronologi kejadian dengan jelas..." required></textarea></div>
                        
                        <div class="form-group">
                            <label>Bukti 1 (Wajib)</label>
                            <label for="bukti_1" class="file-input-label"><i class="fas fa-upload"></i><span>Pilih file...</span></label>
                            <div class="file-name" id="file-name-1"></div>
                            <input type="file" id="bukti_1" name="bukti_1" required>
                        </div>
                        <div class="form-group">
                            <label>Bukti 2</label>
                            <label for="bukti_2" class="file-input-label"><i class="fas fa-upload"></i><span>Pilih file...</span></label>
                            <div class="file-name" id="file-name-2"></div>
                            <input type="file" id="bukti_2" name="bukti_2">
                        </div>
                        <div class="form-group">
                            <label>Bukti 3</label>
                            <label for="bukti_3" class="file-input-label"><i class="fas fa-upload"></i><span>Pilih file...</span></label>
                            <div class="file-name" id="file-name-3"></div>
                            <input type="file" id="bukti_3" name="bukti_3">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="surat" class="main-section">
            <div class="section-header">
                <i class="fas fa-file-alt"></i>
                <h2>Buat Surat Tanda Penerima Aduan (STPA)</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.add_surat') }}" method="POST" id="stpaForm">
                    @csrf
                    <div class="form-progress">
                        <div class="progress-line"></div>
                        <div class="progress-step active" data-step="1"><div class="step-circle">1</div><div class="step-label">Info Surat</div></div>
                        <div class="progress-step" data-step="2"><div class="step-circle">2</div><div class="step-label">Data Pelapor</div></div>
                        <div class="progress-step" data-step="3"><div class="step-circle">3</div><div class="step-label">Detail Aduan</div></div>
                    </div>
                    <fieldset class="form-step active" data-step="1">
                        <div class="form-grid">
                            <div class="form-group"><label for="nomor_surat">Nomor Surat <span class="required">*</span></label><input type="text" id="nomor_surat" name="nomor_surat" required></div>
                            <div class="form-group"><label for="hari">Hari <span class="required">*</span></label><input type="text" id="hari" name="hari" required></div>
                            <div class="form-group"><label for="tanggal">Tanggal <span class="required">*</span></label><input type="date" id="tanggal" name="tanggal" required></div>
                            <div class="form-group"><label for="jam">Jam <span class="required">*</span></label><input type="time" id="jam" name="jam" required></div>
                        </div>
                        <div class="btn-group"><button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fas fa-arrow-right"></i></button></div>
                    </fieldset>
                    <fieldset class="form-step" data-step="2">
                        <div class="form-grid">
                           </div>
                        <div class="btn-group"><button type="button" class="btn btn-secondary btn-prev"><i class="fas fa-arrow-left"></i> Sebelumnya</button><button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fas fa-arrow-right"></i></button></div>
                    </fieldset>
                    <fieldset class="form-step" data-step="3">
                        <div class="form-grid">
                            </div>
                        <div class="btn-group"><button type="button" class="btn btn-secondary btn-prev"><i class="fas fa-arrow-left"></i> Sebelumnya</button><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit & Cetak</button></div>
                    </fieldset>
                </form>
            </div>
        </section>
        
        <section id="kontak" class="main-section">
            <div class="section-header"><i class="fas fa-headset"></i><h2>Kontak & Bantuan</h2></div>
            <div class="card-body">
                <div class="contact-columns">
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 10px;">Butuh Bantuan?</h3>
                        <p style="color: var(--color-text-secondary);">Tim kami siap membantu Anda selama jam kerja (Senin - Jumat, 08:00 - 16:00 WIB).</p>
                    </div>
                    <div>
                        <div class="contact-item"><i class="fas fa-map-marker-alt"></i><span>DITRESKRIMSUS POLDA JATENG<br>Jl Sukun Raya No. 46, Semarang</span></div>
                        <div class="contact-item"><i class="fas fa-envelope"></i><span>info@simapol.go.id</span></div>
                        <div class="contact-item"><i class="fas fa-phone"></i><span>(024) 1234567</span></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 SIMAPOL - Sistem Informasi Pengaduan Masyarakat Online.</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const setActiveMenu = () => {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.menu a');
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 60) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        };
        window.addEventListener('scroll', setActiveMenu);

        const stpaForm = document.getElementById('stpaForm');
        if (stpaForm) {
            const nextButtons = stpaForm.querySelectorAll('.btn-next');
            const prevButtons = stpaForm.querySelectorAll('.btn-prev');
            const formSteps = stpaForm.querySelectorAll('.form-step');
            const progressSteps = stpaForm.querySelectorAll('.progress-step');
            const progressLine = stpaForm.querySelector('.progress-line');
            let currentStep = 1;

            const updateFormState = () => {
                formSteps.forEach(step => step.classList.toggle('active', parseInt(step.dataset.step) === currentStep));
                progressSteps.forEach(step => {
                    const stepNum = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNum < currentStep) step.classList.add('completed');
                    else if (stepNum === currentStep) step.classList.add('active');
                });
                progressLine.style.width = `${((currentStep - 1) / (formSteps.length - 1)) * 100}%`;
            };

            nextButtons.forEach(button => button.addEventListener('click', () => {
                if (currentStep < formSteps.length) currentStep++;
                updateFormState();
            }));

            prevButtons.forEach(button => button.addEventListener('click', () => {
                if (currentStep > 1) currentStep--;
                updateFormState();
            }));
            updateFormState();
        }

        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                const label = this.previousElementSibling;
                const fileNameDiv = label.nextElementSibling;
                if (file) {
                    fileNameDiv.textContent = `File terpilih: ${file.name}`;
                } else {
                    fileNameDiv.textContent = '';
                }
            });
        });
    });
    </script>
</body>
</html>