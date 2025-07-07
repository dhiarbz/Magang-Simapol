<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin SIMAPOL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
        background-color: #dae9f8;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif !important;
        margin: 0;
        padding: 0;
        background-image: url('{{ asset("images/bg_adm.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    /* Sidebar Styles */
    .sidebar {
        background-color: #1E293B !important;
        color: white;
        min-height: 100vh;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 15px;
        transition: background-color 0.3s;
    }

    .sidebar a:hover {
        background-color: #334155;
    }

    .sidebar .active {
        background-color: #334155;
        font-weight: bold;
    }

    /* Content Styles */
    .content {
        padding: 20px;
        margin-top: 10px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    /* Table Styles */
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6;
        padding: 12px;
        text-align: left;
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .card {
        margin-bottom: 20px;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .section-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1f2d3d;
        padding-left: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-process {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('images/siber.png') }}" alt="Logo" style="height: 60px; margin-right: 10px;">
            <div>
                <h5 class="mb-0">SIMAPOL</h5>
                <small>{{ $user->name }}</small>
            </div>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="mb-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.data_laporan') }}" class="mb-2 {{ request()->routeIs('admin.data_laporan') ? 'active' : '' }}">Data Laporan</a>
        <a href="{{ route('admin.surat') }}" class="mb-2 {{ request()->routeIs('admin.surat') ? 'active' : '' }}">Buat STPA</a>
        <a href="{{ route('admin.kelola_user') }}" class="mb-2 {{ request()->routeIs('admin.kelola_user') ? 'active' : '' }}">Kelola User</a>
        <a href="{{ route('admin.backup') }}" class="mb-2 {{ request()->routeIs('admin.backup') ? 'active' : '' }}">Backup Data</a>
        <a href="{{ route('admin.pengaturan') }}" class="mb-2 {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}">Pengaturan</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="btn btn-link text-white text-decoration-none p-0 mb-2" style="text-align: left; width: 100%;">Logout</button>
        </form>
      </div>

      <!-- Main Content -->
<div class="col-md-10 p-4">
    <div class="content">
        <div class="detail-container">
            <div class="detail-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
                <h2 class="detail-title mb-0">Detail Surat Tanda Penerimaan Aduan</h2>
            </div>

            <!-- Informasi Umum -->
            <h5 class="text-primary fw-bold mb-3">Informasi Umum</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-2"><strong>Nomor Surat:</strong> <div class="text-muted">{{ $aduan->nomor_surat }}</div></div>
                    <div class="mb-2"><strong>Hari:</strong> <div class="text-muted">{{ $aduan->hari }}</div></div>
                    <div class="mb-2"><strong>Tanggal Aduan:</strong> <div class="text-muted">{{ $aduan->tanggal }}</div></div>
                    <div class="mb-2"><strong>Jam:</strong> <div class="text-muted">{{ $aduan->jam }}</div></div>
                    <div class="mb-2"><strong>Jenis Kelamin:</strong> <div class="text-muted">{{ $aduan->gender }}</div></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2"><strong>Nama:</strong> <div class="text-muted">{{ $aduan->nama }}</div></div>
                    <div class="mb-2"><strong>Tempat, Tanggal Lahir:</strong> <div class="text-muted">{{ $aduan->ttg }}</div></div>
                    <div class="mb-2"><strong>Pekerjaan:</strong> <div class="text-muted">{{ $aduan->pekerjaan }}</div></div>
                    <div class="mb-2"><strong>Alamat KTP:</strong> <div class="text-muted">{{ $aduan->alamat }}</div></div>
                </div>
            </div>

            <!-- Kontak & Identitas -->
            <h5 class="text-primary fw-bold mb-3">Kontak & Identitas</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-2"><strong>Domisili:</strong> <div class="text-muted">{{ $aduan->domisili }}</div></div>
                    <div class="mb-2"><strong>Nomor HP:</strong> <div class="text-muted">{{ $aduan->no_hp }}</div></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2"><strong>NIK:</strong> <div class="text-muted">{{ $aduan->nik }}</div></div>
                    <div class="mb-2"><strong>Tujuan Pengaduan:</strong> <div class="text-muted">{{ $aduan->tujuan }}</div></div>
                </div>
            </div>

            <!-- Detail Kejadian -->
            <h5 class="text-primary fw-bold mb-3">Detail Kejadian</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-2"><strong>Tempat Kejadian:</strong> <div class="text-muted">{{ $aduan->tempat_kejadian }}</div></div>
                    <div class="mb-2"><strong>Tanggal Kejadian:</strong> <div class="text-muted">{{ $aduan->tanggal_kejadian }}</div></div>
                    <div class="mb-2"><strong>Kerugian:</strong> <div class="text-muted">{{ $aduan->kerugian }}</div></div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2"><strong>Modus:</strong> <div class="text-muted">{{ $aduan->modus }}</div></div>
                    <div class="mb-2"><strong>Keterangan:</strong> <div class="text-muted">{{ $aduan->keterangan }}</div></div>
                </div>
            </div>

            <!-- Penerima -->
            <h5 class="text-primary fw-bold mb-3">Penerima Pengaduan</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-2"><strong>Penerima:</strong> <div class="text-muted">{{ $aduan->penerima }}</div></div>
                    <div class="mb-2"><strong>Jabatan:</strong> <div class="text-muted">{{ $aduan->jabatan }}</div></div>
                    <div class="mb-2"><strong>NRP:</strong> <div class="text-muted">{{ $aduan->nrp }}</div></div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="text-end">
                <a href="{{ route('admin.surat') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

    </div>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: '{{ session('success') }}',
        timer: 3000
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif
</body>
</html>