@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SIMAPOL - Kelola User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
        .sidebar { background-color: #1E293B !important; color: white; min-height: 100vh; }
        .sidebar a, .sidebar .btn-link {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover, .sidebar .btn-link:hover { background-color: #334155; }
        .sidebar .active { background-color: #334155; font-weight: bold; }
        .content {
            padding: 20px;
            margin-top: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .card { margin-bottom: 20px; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
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
                        <small>{{ Auth::user()->name }}</small>
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

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-4">
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <span>Kelola User</span>
                            <a href="{{ route('admin.add_user') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
                        </div>
                        <div class="card-body">
                            @if($users->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NRP</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $usr)
                                                <tr>
                                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                                    <td>{{ $usr->name }}</td>
                                                    <td>{{ $usr->nrp }}</td>
                                                    <td>{{ ucfirst($usr->role) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.update_user', ['id' => $usr->id]) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin.delete_user', ['id' => $usr->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $users->links() }}
                                </div>
                            @else
                                <div class="text-center">Belum ada data user.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
