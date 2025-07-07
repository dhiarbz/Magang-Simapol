<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - SIMAPOL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; /* Added Inter as a preferred modern font */
            margin: 0;
            padding: 0;
            /* background-image: url('{{ asset('images/bg_adm.png') }}'); */ /* Assuming this will be resolved by Laravel's asset helper */
            background: linear-gradient(to bottom right, #0a192f, #173a5e); /* Placeholder background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Keeps background fixed during scroll */
            color: #e0e0e0; /* Lighter default text color for dark background */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(13, 34, 55, 0.9); /* Slightly transparent navbar */
            color: white;
            padding: 15px 30px; /* Increased padding */
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .logo-area {
            display: flex;
            align-items: center;
        }
        
        .logo {
            height: 60px; /* Adjusted logo size */
            margin-right: 15px;
            border-radius: 50%; /* Example: make logo circular if appropriate */
            background-color: #fff; /* Placeholder for logo image */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0d2237;
        }
        
        .logo-text {
            line-height: 1.3;
            text-align: left;
        }
        
        .logo-text strong {
            font-size: 24px; /* Slightly larger */
            color: #ffffff;
        }
        
        .logo-text span {
            font-size: 14px;
            color: #b0c4de; /* Lighter blueish grey */
        }
        
        .menu {
            display: flex;
            gap: 25px; /* Adjusted gap */
        }
        
        .menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 8px 12px; /* Added padding for better hover area */
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .menu a:hover, .menu a.active { /* Added .active class example */
            background-color: #334155;
            color: #e0f2fe; /* Light cyan on hover */
        }

        .logout-button {
            background-color: #dc3545; /* Red for logout */
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        .main {
            flex-grow: 1; /* Allows main to take up available space */
            padding: 30px 20px; /* Increased padding */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items to the top */
        }

        .detail-container {
            background-color: rgba(15, 34, 54, 0.9); /* Darker, slightly more opaque */
            color: white;
            margin: 20px auto;
            padding: 35px; /* Increased padding */
            border-radius: 15px; /* More rounded corners */
            max-width: 850px; /* Slightly wider */
            width: 100%; /* Ensure it takes full width on smaller screens up to max-width */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5); /* Enhanced shadow */
        }

        .detail-container h2 {
            text-align: center;
            margin-bottom: 30px; /* Increased margin */
            color: #64b5f6; /* Light blue for heading */
            font-size: 28px; /* Larger heading */
            border-bottom: 2px solid #64b5f6;
            padding-bottom: 10px;
        }

        .detail-grid { /* Using grid for details */
            display: grid;
            grid-template-columns: 180px 1fr; /* Fixed label column, flexible value column */
            gap: 18px; /* Gap between rows and columns */
        }

        .detail-label {
            font-weight: bold;
            color: #90a4ae; /* Lighter grey for labels */
            padding-right: 10px; /* Space between label and colon (if any) */
            text-align: left; /* Align labels to the left */
        }

        .detail-value {
            color: #e0e0e0; /* Main text color */
            word-break: break-word; /* Prevent long strings from breaking layout */
            text-align: left;
        }
        
        /* Full span for Isi Laporan and Bukti Pendukung */
        .full-span {
            grid-column: 1 / -1; /* Make this item span all columns */
        }
        .full-span .detail-label { /* Label for full-span items */
            margin-bottom: 8px;
            display: block; /* Make label take full width */
        }
        .full-span .detail-value {
            background-color: rgba(0,0,0,0.15);
            padding: 10px;
            border-radius: 5px;
            min-height: 80px; /* Minimum height for text area like content */
        }


        .bukti-container {
            margin-top: 25px; /* Increased margin */
            grid-column: 1 / -1; /* Span full width */
        }
        
        .bukti-container .detail-label { /* Style for "Bukti Pendukung:" label */
             margin-bottom: 15px;
             display: block;
             font-size: 1.1em;
        }

        .bukti-items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid for bukti items */
            gap: 20px;
        }

        .bukti-item {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items within the bukti-item */
        }
        .bukti-item a.btn {
            margin-bottom: 10px; /* Space between button and image */
            width: calc(100% - 10px); /* Make button responsive within item */
            text-align: center;
        }

        .bukti-preview {
            max-width: 100%;
            height: auto; /* Maintain aspect ratio */
            max-height: 200px; /* Limit preview height */
            border-radius: 5px;
            object-fit: cover; /* Cover the area nicely */
            border: 2px solid #455a64; /* Darker border for preview */
        }
         .bukti-item .no-bukti-text {
            color: #78909c;
            font-style: italic;
            font-size: 0.9em;
        }


        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 35px; /* Increased margin */
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .action-buttons .btn-group .btn{
            margin-left: 10px;
        }
        .action-buttons .btn-group .btn:first-child{
            margin-left: 0;
        }


        .btn {
            padding: 12px 22px; /* Increased padding */
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px; /* Standardized font size */
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            border: none; /* Remove default border */
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .btn:hover {
            transform: translateY(-2px); /* Slight lift on hover */
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .btn-secondary {
            background: #546e7a; /* Darker blue-grey */
            color: white;
        }
        .btn-secondary:hover { background: #455a64; }

        .btn-warning {
            background: #ffa000; /* Amber */
            color: #212529;
        }
        .btn-warning:hover { background: #ff8f00; }

        .btn-info {
            background: #0288d1; /* Light blue */
            color: white;
        }
        .btn-info:hover { background: #0277bd; }

        .btn-success {
            background: #388e3c; /* Green */
            color: white;
        }
        .btn-success:hover { background: #2e7d32; }

        footer {
            text-align: center;
            padding: 20px 0; /* Increased padding */
            background: rgba(13, 34, 55, 0.9); /* Consistent with navbar */
            color: #a0a0a0; /* Lighter footer text */
            width: 100%;
            margin-top: auto; /* Pushes footer to bottom if content is short */
            box-shadow: 0 -2px 10px rgba(0,0,0,0.3);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) { /* Tablet */
            .menu {
                display: none; /* Hide menu for a burger menu implementation (not added here) */
                               /* Or, stack them if preferred for tablet */
            }
            .navbar {
                padding: 15px 20px;
            }
             .detail-grid {
                grid-template-columns: 150px 1fr;
                gap: 15px;
            }
        }


        @media (max-width: 768px) { /* Mobile */
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }
            .logo-area {
                margin-bottom: 10px;
            }
            .menu {
                /* For a real mobile menu, you'd use JavaScript to toggle visibility */
                /* For now, let's stack them if they were visible */
                flex-direction: column;
                width: 100%;
                align-items: flex-start;
                gap: 10px;
                margin-top: 10px;
                display: block; /* Show menu items stacked on mobile for now */
            }
            .menu a {
                display: block; /* Make menu items full width */
                width: calc(100% - 24px); /* Account for padding */
                text-align: left;
            }
            .logout-button {
                width: 100%;
                margin-top: 10px;
                text-align: center;
            }

            .detail-grid {
                grid-template-columns: 1fr; /* Single column for details */
            }
            .detail-label {
                margin-bottom: 5px;
                text-align: left; /* Ensure labels are left-aligned */
            }
            .detail-value {
                margin-bottom: 10px; /* Add space below value before next label */
                text-align: left;
            }
             .full-span .detail-value {
                min-height: 60px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 15px; /* Increased gap */
            }
            .action-buttons .btn, .action-buttons .btn-group .btn {
                width: 100%;
                text-align: center;
                margin-left: 0; /* Reset margin for stacked buttons */
            }
             .action-buttons .btn-group {
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }
        }
         @media (max-width: 480px) { /* Smaller Mobile */
            .detail-container {
                padding: 20px;
                margin: 10px;
            }
            .detail-container h2 {
                font-size: 22px;
            }
            .btn {
                padding: 10px 18px;
                font-size: 14px;
            }
            .logo-text strong { font-size: 20px; }
            .logo-text span { font-size: 12px; }
            .logo { height: 50px; }
        }

    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo-area">
             <img src="{{ asset('images/siber.png') }}" alt="Logo SIMAPOL" class="logo">
            <div class="logo-text">
                <strong>SIMAPOL</strong><br>
                <span>Laporan Pengaduan</span>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('user.dashboard') }}" class="active">Beranda</a>
            <a href="{{ route('user.dashboard') }}#laporan">Buat Laporan</a>
            <a href="{{ route('user.dashboard') }}#kontak">Kontak</a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </header>

    <main class="main">
        <div class="detail-container">
            <h2>Detail Laporan Pengaduan</h2>
            
            <div class="detail-grid">
                <div class="detail-label">No. NIK:</div>
                <div class="detail-value">{{ $laporan->nik ?? 'N/A' }}</div>
                
                <div class="detail-label">Nama:</div>
                <div class="detail-value">{{ $laporan->nama ?? 'N/A' }}</div>
                
                <div class="detail-label">Tempat, Tanggal Lahir:</div>
                <div class="detail-value">{{ $laporan->ttg ?? 'N/A' }}</div>
                
                <div class="detail-label">Agama:</div>
                <div class="detail-value">{{ $laporan->agama ?? 'N/A' }}</div>
                
                <div class="detail-label">Pekerjaan:</div>
                <div class="detail-value">{{ $laporan->pekerjaan ?? 'N/A' }}</div>
                
                <div class="detail-label">Alamat KTP:</div>
                <div class="detail-value">{{ $laporan->alamat_ktp ?? 'N/A' }}</div>
                
                <div class="detail-label">Alamat Domisili:</div>
                <div class="detail-value">{{ $laporan->alamat_domisili ?? 'N/A' }}</div>
                
                <div class="detail-label">No HP:</div>
                <div class="detail-value">{{ $laporan->nomor_hp ?? 'N/A' }}</div>
                
                <div class="full-span">
                    <div class="detail-label">Isi Laporan:</div>
                    <div class="detail-value">{{ $laporan->isi_laporan ?? 'Tidak ada isi laporan.' }}</div>
                </div>
                
                <div class="bukti-container full-span">
                    <div class="detail-label">Bukti Pendukung:</div>
                    <div class="bukti-items-grid">
                        @php $buktiFields = ['bukti_1', 'bukti_2', 'bukti_3']; @endphp
                        @forelse($buktiFields as $index => $buktiField)
                            @if($laporan->$buktiField)
                                <div class="bukti-item">
                                    <a href="{{ asset('storage/'.$laporan->$buktiField) }}" target="_blank" class="btn btn-secondary">
                                        <i class="fas fa-eye"></i> Lihat {{ ucfirst(str_replace('_', ' ', $buktiField)) }}
                                    </a>
                                    @if(in_array(strtolower(pathinfo($laporan->$buktiField, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/'.$laporan->$buktiField) }}" alt="Pratinjau {{ ucfirst(str_replace('_', ' ', $buktiField)) }}" class="bukti-preview">
                                    @elseif(strtolower(pathinfo($laporan->$buktiField, PATHINFO_EXTENSION)) == 'pdf')
                                        <p class="no-bukti-text"><i class="fas fa-file-pdf"></i> Ini adalah file PDF. Klik untuk melihat.</p>
                                    @else
                                         <p class="no-bukti-text"><i class="fas fa-file-alt"></i> Format file tidak dapat dipratinjau.</p>
                                    @endif
                                </div>
                            @else
                                <div class="bukti-item">
                                     <p class="no-bukti-text">{{ ucfirst(str_replace('_', ' ', $buktiField)) }}: Tidak ada.</p>
                                </div>
                            @endif
                        @empty 
                            <div class="bukti-item full-span"> <p class="no-bukti-text">Tidak ada bukti pendukung yang diunggah.</p>
                            </div>
                        @endforelse
                        
                        {{-- Fallback if all bukti fields are null and you want a general message --}}
                        @if (empty($laporan->bukti_1) && empty($laporan->bukti_2) && empty($laporan->bukti_3))
                             <div class="bukti-item" style="grid-column: 1 / -1;"> <p class="no-bukti-text" style="text-align:center; width:100%;">Tidak ada bukti pendukung yang diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <div class="btn-group">
                    <a href="{{ route('user.edit', $laporan->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <a href="{{ route('user.preview', $laporan->id) }}" class="btn btn-info" target="_blank"><i class="fas fa-file-pdf"></i> Preview PDF</a>
                    <a href="{{ route('user.download', $laporan->id) }}" class="btn btn-success"><i class="fas fa-download"></i> Download PDF</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Laporan Pengaduan - SIMAPOL. Semua hak dilindungi.</p>
    </footer>
    <script>
        // Optional: Add active class to current menu item based on URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.menu a');
            menuLinks.forEach(link => {
                if (link.getAttribute('href').includes(currentPath) && currentPath !== '/') {
                    // A more robust check might be needed if routes are complex
                    // For now, simple includes check
                    // link.classList.add('active'); 
                }
            });
        });
    </script>
</body>
</html>
