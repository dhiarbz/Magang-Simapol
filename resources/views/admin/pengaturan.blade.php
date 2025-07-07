<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SIMAPOL - Pengaturan</title>
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
                    <<div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Pengaturan
                </div>
                <div class="card-body">
                    {{-- Alert untuk pesan sukses dan error --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Ubah Nama --}}
                    <form action="{{ route('admin.updateProfile') }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <h5>Ubah Nama</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Baru</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                    <hr>

                    {{-- Form Ubah Password --}}
                    <form action="{{ route('admin.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <h5>Reset Password</h5>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Reset Password</button>
                    </form>
                </div>
            </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>