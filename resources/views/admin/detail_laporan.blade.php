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
                <div class="detail-header d-flex justify-content-between align-items-center">
                        <h2 class="detail-title">Detail Laporan</h2>
                </div>
                    <div class="row">
                        <!-- Kolom Kiri - Data Pelapor -->
                        <div class="col-md-6">
                            <h4 class="mb-4"><i class="fas fa-user-circle me-2"></i>Data Pelapor</h4>
                            
                            <div class="mb-3">
                                <div class="detail-label">NIK</div>
                                <div class="detail-value">{{ $laporan->nik }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Nama Lengkap</div>
                                <div class="detail-value">{{ $laporan->nama }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Tempat, Tanggal Lahir</div>
                                <div class="detail-value">{{ $laporan->ttg }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Agama</div>
                                <div class="detail-value">{{ $laporan->agama }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Pekerjaan</div>
                                <div class="detail-value">{{ $laporan->pekerjaan }}</div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Kontak dan Alamat -->
                        <div class="col-md-6">
                            <h4 class="mb-4"><i class="fas fa-address-card me-2"></i>Kontak & Alamat</h4>
                            
                            <div class="mb-3">
                                <div class="detail-label">Alamat KTP</div>
                                <div class="detail-value">{{ $laporan->alamat_ktp }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Alamat Domisili</div>
                                <div class="detail-value">{{ $laporan->alamat_domisili }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Nomor HP</div>
                                <div class="detail-value">{{ $laporan->nomor_hp }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="detail-label">Tanggal Laporan</div>
                                <div class="detail-value">{{ $laporan->created_at->format('d F Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Laporan -->
                    <div class="mt-4">
                        <h4><i class="fas fa-align-left me-2"></i>Isi Laporan</h4>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p class="card-text">{{ $laporan->isi_laporan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bukti Pendukung -->
                    <div class="mt-4">
                        <h4><i class="fas fa-paperclip me-2"></i>Bukti Pendukung</h4>
                        <div class="row">
                            @foreach(['bukti_1', 'bukti_2', 'bukti_3'] as $bukti)
                                @if($laporan->$bukti)
                                    <div class="col-md-4 mb-3">
                                        <div class="file-preview">
                                            @if(in_array(pathinfo($laporan->$bukti, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/'.$laporan->$bukti) }}" class="img-fluid mb-2" alt="Bukti {{ $loop->iteration }}">
                                            @else
                                                <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ asset('storage/'.$laporan->$bukti) }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ route('admin.data_laporan') }}" class="btn btn-secondary">Back</a>
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