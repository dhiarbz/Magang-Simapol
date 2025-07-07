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
                <small> {{ $user->name }} </small>
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
          <h2 class="mb-4" style="font-weight: 700;">Dashboard</h2>
          
          <!-- Stats Cards -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="card text-white bg-primary">
                <div class="card-body">
                  <h5 class="card-title">Data Laporan</h5>
                  <p class="card-text">{{ $totalLaporan }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-success">
                <div class="card-body">
                  <h5 class="card-title">Laporan Hari Ini</h5>
                  <p class="card-text">{{ $laporanHariini}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-danger">
                <div class="card-body">
                  <h5 class="card-title">Laporan Bulan Ini</h5>
                  <p class="card-text">{{ $laporanBulanini}}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Reports Table -->
          <h3 class="mb-3">Data Laporan Terbaru</h3>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>NIK</th>
                <th>Laporan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
               @forelse($laporan as $l)
              <tr>
                <td>{{ $loop-> iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                <td>{{ $l->nama }}</td>
                <td>{{ $l->nik }}</td>
                <td>{{ $l->isi_laporan }}</td>
                <td>{{ $l->created_at->format('d/m/Y') }}</td>
                <td>                    
                  <a href="{{ route('admin.detail_laporan', ['id' => $l->id]) }}" class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i> Lihat Detail</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">Belum ada laporan.</td>
              </tr>
              @endforelse 
            </tbody>
          </table>
          
          <!-- Pagination -->
          @if($laporan->hasPages())
          <div class="d-flex justify-content-center mt-4">
            {{ $laporan->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>