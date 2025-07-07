<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - SIMAPOL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            /* background-image: url('{{ asset('images/bg_adm.png') }}'); */ /* Ganti dengan path gambar Anda */
            background: linear-gradient(to bottom right, #0a192f, #173a5e); /* Placeholder background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Placeholder untuk Header Anda */
        header.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(13, 34, 55, 0.9);
            color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        header.navbar .logo-area strong { font-size: 24px; }
        header.navbar .menu a { color: white; text-decoration: none; margin-left: 20px; }
        header.navbar .logout-button { background-color: #dc3545; color:white; border:none; padding: 8px 15px; border-radius: 5px; cursor:pointer;}
        /* Akhir Placeholder Header */

        .main-content {
            flex-grow: 1;
            padding: 30px 15px; /* Padding atas bawah lebih banyak */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align form to top */
        }

        .form-container {
            background-color: rgba(15, 34, 54, 0.92); /* Sedikit lebih solid */
            color: white;
            margin: 20px auto;
            padding: 35px;
            border-radius: 15px;
            max-width: 850px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #64b5f6; /* Light blue for heading */
            font-size: 26px;
            border-bottom: 1px solid #64b5f6;
            padding-bottom: 15px;
        }

        .validation-errors {
            background-color: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ffdddd;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 8px;
        }
        .validation-errors strong {
            display: block;
            margin-bottom: 5px;
        }
        .validation-errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 25px; /* Gap between columns */
            margin-bottom: 20px; /* Space below each row */
        }

        .form-group {
            flex: 1 1 100%; /* Default to full width */
            min-width: 250px; /* Minimum width for side-by-side fields */
        }
        /* For two-column layout in a row */
        .form-row > .form-group {
            flex-basis: calc(50% - 12.5px); /* Adjust for gap */
        }
        /* For single full-width field in a row, ensure it takes all space */
         .form-row > .form-group.full-width {
            flex-basis: 100%;
        }


        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #b0bec5; /* Lighter label color */
            font-size: 0.95em;
        }

        form input[type="text"],
        form input[type="email"], /* Added for consistency if needed */
        form input[type="password"], /* Added for consistency if needed */
        form textarea,
        form select { /* Added select for future use */
            width: 100%;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #37474f; /* Subtle border */
            background-color: rgba(255, 255, 255, 0.05); /* Very light background */
            color: white;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-sizing: border-box; /* Important for padding and width */
        }
        form input[type="text"]:focus,
        form textarea:focus,
        form select:focus {
            border-color: #64b5f6; /* Highlight on focus */
            box-shadow: 0 0 0 2px rgba(100, 181, 246, 0.3);
            outline: none;
        }

        form textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        /* File Input Styling */
        form input[type="file"] {
            display: block; /* Or inline-block */
            width: 100%;
            padding: 8px 0;
            color: #b0bec5;
            font-size: 0.95em;
        }
        form input[type="file"]::file-selector-button {
            margin-right: 10px;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #64b5f6;
            background-color: #64b5f6;
            color: #0a192f;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        form input[type="file"]::file-selector-button:hover {
            background-color: #42a5f5;
        }

        .current-bukti-link {
            display: inline-block;
            margin-top: 8px;
            margin-right: 10px;
            padding: 6px 10px;
            font-size: 0.85em;
            background-color: #455a64;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        .current-bukti-link:hover {
            background-color: #546e7a;
        }

        .bukti-preview {
            max-width: 100%; /* Responsive preview */
            height: auto;
            max-height: 150px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #37474f;
            object-fit: cover;
            display: block; /* Ensure it's block for margin-top */
        }
        .form-group .field-error { /* For individual field errors */
            color: #ff8a80; /* Light red for error text */
            font-size: 0.85em;
            margin-top: 5px;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap; /* Allow buttons to wrap on small screens */
            justify-content: space-between;
            align-items: center;
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-weight: 500;
            font-size: 1em;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-flex; /* For icon alignment */
            align-items: center;
            gap: 8px; /* Space between icon and text */
        }
        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #546e7a;
            color: white;
        }
        .btn-secondary:hover { background: #455a64; }

        .btn-primary {
            background: #1976d2; /* Darker blue */
            color: white;
        }
        .btn-primary:hover { background: #1565c0; }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-row {
                gap: 0; /* Remove gap and let margin-bottom on form-group handle spacing */
            }
            .form-row > .form-group {
                flex-basis: 100%; /* Stack fields on smaller screens */
                margin-bottom: 20px; /* Add margin for stacked fields */
            }
            .form-row > .form-group:last-child {
                 margin-bottom: 0; /* Remove margin for last item in a row */
            }
            .action-buttons {
                flex-direction: column;
                gap: 15px; /* Space between stacked buttons */
            }
            .action-buttons .btn {
                width: 100%;
                justify-content: center; /* Center text/icon in button */
            }
        }
        @media (max-width: 480px) {
            .form-container { padding: 25px; }
            .form-container h2 { font-size: 22px; padding-bottom: 10px; }
            form input[type="text"], form textarea { padding: 10px; }
            .btn { padding: 10px 20px; font-size: 0.95em; }
        }

        /* Placeholder untuk Footer Anda */
        footer { text-align: center; padding: 20px 0; background: rgba(13, 34, 55, 0.9); color: #a0a0a0; width: 100%; margin-top: auto;}
        /* Akhir Placeholder Footer */
    </style>
</head>
<body>
    <header class="navbar">
        
        <div class="logo-area"><strong>SIMAPOL</strong></div>
        <nav class="menu"><a href="#">Beranda</a></nav>
        <button class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </header>
    <main class="main-content">
        <div class="form-container">
            <h2><i class="fas fa-edit"></i> Edit Laporan STPA</h2>
            
            @if ($errors->any())
                <div class="validation-errors">
                    <strong><i class="fas fa-exclamation-triangle"></i> Oops! Ada beberapa kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('user.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $laporan->nik) }}" required>
                        @error('nik') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $laporan->nama) }}" required>
                        @error('nama') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="ttg">Tempat, Tanggal Lahir</label>
                        <input type="text" id="ttg" name="ttg" value="{{ old('ttg', $laporan->ttg) }}" required>
                        @error('ttg') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" id="agama" name="agama" value="{{ old('agama', $laporan->agama) }}" required>
                        @error('agama') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                     <div class="form-group full-width"> {/* Pekerjaan dibuat full-width untuk konsistensi jika hanya satu di baris ini */}
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $laporan->pekerjaan) }}" required>
                        @error('pekerjaan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="alamat_ktp">Alamat KTP</label>
                        <input type="text" id="alamat_ktp" name="alamat_ktp" value="{{ old('alamat_ktp', $laporan->alamat_ktp) }}" required>
                        @error('alamat_ktp') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="alamat_domisili">Alamat Domisili</label>
                        <input type="text" id="alamat_domisili" name="alamat_domisili" value="{{ old('alamat_domisili', $laporan->alamat_domisili) }}" required>
                        @error('alamat_domisili') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="text" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $laporan->nomor_hp) }}" required>
                        @error('nomor_hp') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="isi_laporan">Isi Laporan Lengkap</label>
                        <textarea id="isi_laporan" name="isi_laporan" required>{{ old('isi_laporan', $laporan->isi_laporan) }}</textarea>
                        @error('isi_laporan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                @foreach(['bukti_1', 'bukti_2', 'bukti_3'] as $buktiKey)
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="{{ $buktiKey }}">{{ Str::ucfirst(str_replace('_', ' ', $buktiKey)) }} (Opsional)</label>
                        <input type="file" id="{{ $buktiKey }}" name="{{ $buktiKey }}" accept=".jpg,.jpeg,.png,.pdf">
                        @error($buktiKey) <div class="field-error">{{ $message }}</div> @enderror
                        
                        @if($laporan->$buktiKey)
                            <div style="margin-top:10px;">
                                <a href="{{ asset('storage/'.$laporan->$buktiKey) }}" class="current-bukti-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Lihat {{ Str::ucfirst(str_replace('_', ' ', $buktiKey)) }} Saat Ini
                                </a>
                                @if(in_array(strtolower(pathinfo($laporan->$buktiKey, PATHINFO_EXTENSION)), ['jpg','jpeg','png', 'gif']))
                                    <img src="{{ asset('storage/'.$laporan->$buktiKey) }}" alt="Pratinjau {{ $buktiKey }}" class="bukti-preview">
                                @elseif(strtolower(pathinfo($laporan->$buktiKey, PATHINFO_EXTENSION)) == 'pdf')
                                     <p style="font-size:0.9em; color:#90a4ae; margin-top:5px;"><i class="fas fa-file-pdf"></i> File PDF: {{ basename($laporan->$buktiKey) }}</p>
                                @endif
                                <p style="font-size: 0.8em; color: #78909c;">Kosongkan jika tidak ingin mengganti file ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
                
                <div class="action-buttons">
                    <a href="{{ route('user.show', $laporan->id) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
    
    <footer>
        <p>&copy; {{ date('Y') }} Laporan Pengaduan - SIMAPOL. Semua hak dilindungi.</p>
    </footer>
    </body>
</html>