<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SIMAPOL - Backup Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS Anda tetap sama, tidak perlu diubah */
        body { background-color: #dae9f8; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif !important; margin: 0; padding: 0; background-image: url('{{ asset("images/bg_adm.png") }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; }
        .sidebar { background-color: #1E293B !important; color: white; min-height: 100vh; }
        .sidebar a, .sidebar .btn-link { color: white; text-decoration: none; display: block; padding: 15px; transition: background-color 0.3s; }
        .sidebar a:hover, .sidebar .btn-link:hover { background-color: #334155; }
        .sidebar .active { background-color: #334155; font-weight: bold; }
        .content { padding: 20px; margin-top: 20px; background: #fff; border-radius: 12px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1); }
        .card { margin-bottom: 20px; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
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
                    <button type="submit" class="btn btn-link text-white text-decoration-none p-0 mb-2" style="text-align: left; width: 100%; padding: 15px !important;">Logout</button>
                </form>
            </div>

            <main class="col-md-10 ms-sm-auto px-4">
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Data Laporan Masyarakat
                        </div>
                        <div class="card-body">
                            @if($laporan->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Isi Laporan</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($laporan as $lap)
                                                <tr>
                                                    <td>{{ ($laporan->currentPage()-1) * $laporan->perPage() + $loop->iteration }}</td>
                                                    <td>{{ $lap->nik }}</td>
                                                    <td>{{ $lap->nama }}</td>
                                                    <td>{{ Str::limit($lap->isi_laporan, 50) }}</td>
                                                    <td>{{ $lap->created_at->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $laporan->links() }}
                                </div>
                            @else
                                <p class="text-center text-muted">Tidak ada data laporan ditemukan.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('admin.exportLaporan_pdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export Semua Laporan ke PDF
                        </a>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            Data Surat Tanda Penerimaan Aduan (STPA)
                        </div>
                        <div class="card-body">
                            @if($aduan->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nomor Surat</th>
                                                <th>Nama</th>
                                                <th>Tujuan</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($aduan as $a)
                                                <tr>
                                                    <td>{{ ($aduan->currentPage()-1) * $aduan->perPage() + $loop->iteration }}</td>
                                                    <td>{{ $a->nomor_surat }}</td>
                                                    <td>{{ $a->nama }}</td>
                                                    <td>{{ $a->tujuan }}</td>
                                                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $aduan->links() }}
                                </div>
                            @else
                                <p class="text-center text-muted">Tidak ada data STPA ditemukan.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('admin.exportSTPA_pdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export Semua STPA ke PDF
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>