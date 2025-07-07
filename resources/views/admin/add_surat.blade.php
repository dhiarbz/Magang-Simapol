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
    <div class="col-md-10 p-3">
        <div class="content">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Surat Tanda Penerimaan Aduan</h4>
                        <form action="{{ route('admin.fadd_surat') }}" method="POST" enctype="multipart/form-data" class="form-sample">
                            @csrf
                            <!-- Nomor Surat -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_surat" class="form-control" required>
                                </div>
                            </div>
                            <!-- Hari -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <input type="text" name="hari" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tanggal -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <!-- Jam -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Jam</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam" class="form-control" required>
                                </div>
                            </div>
                            <!-- Gender -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="gender" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Nama -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tempat, Tanggal Lahir -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ttg" class="form-control" required>
                                </div>
                            </div>
                            <!-- Pekerjaan -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pekerjaan" class="form-control" required>
                                </div>
                            </div>
                            <!-- Alamat KTP -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                            </div>
                            <!-- Alamat Domisili -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Domisili</label>
                                <div class="col-sm-9">
                                    <input type="text" name="domisili" class="form-control" required>
                                </div>
                            </div>
                            <!-- Nomor HP -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">No. HP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                            </div>
                            <!-- NIK -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nik" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tujuan -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Tujuan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tujuan" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tempat Kejadian -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Tempat Kejadian</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tempat_kejadian" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tanggal Kejadian -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Kejadian</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tanggal_kejadian" class="form-control" required>
                                </div>
                            </div>
                            <!-- Kerugian -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Kerugian</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kerugian" class="form-control" required>
                                </div>
                            </div>
                            <!-- Teradu -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Teradu</label>
                                <div class="col-sm-9">
                                    <input type="text" name="teradu" class="form-control" required>
                                </div>
                            </div>
                            <!-- Korban -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Korban</label>
                                <div class="col-sm-9">
                                    <input type="text" name="korban" class="form-control" required>
                                </div>
                            </div>
                            <!-- Modus -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Modus</label>
                                <div class="col-sm-9">
                                    <input type="text" name="modus" class="form-control" required>
                                </div>
                            </div>
                            <!-- Keterangan -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <select name="keterangan" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="belum">Belum</option>
                                        <option value="sudah pernah dilaporkan">Sudah Pernah Dilaporkan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Penerima -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Penerima</label>
                                <div class="col-sm-9">
                                    <input type="text" name="penerima" class="form-control" required>
                                </div>
                            </div>
                            <!-- Jabatan -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jabatan" class="form-control" required>
                                </div>
                            </div>
                            <!-- NRP -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">NRP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nrp" class="form-control" required>
                                </div>
                            </div>
                            <!-- Tombol Submit -->
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Submit</button>
                                    <a href="{{ route('admin.surat') }}" class="btn btn-light"><i class="fas fa-times"></i> Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>