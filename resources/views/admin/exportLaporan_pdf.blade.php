<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Laporan Masyarakat</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>REKAPITULASI DATA LAPORAN MASYARAKAT</h2>
        <p>Sistem Informasi Manajemen Pelaporan Online (SIMAPOL)</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NIK Pelapor</th>
                <th>Nama Pelapor</th>
                <th>Isi Laporan</th>
                <th>Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $lap)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lap->nik }}</td>
                    <td>{{ $lap->nama }}</td>
                    <td>{{ $lap->isi_laporan }}</td>
                    <td>{{ $lap->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>