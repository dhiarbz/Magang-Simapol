<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Surat Tanda Penerimaan Aduan</title>
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
        <h2>REKAPITULASI DATA SURAT TANDA PENERIMAAN ADUAN (STPA)</h2>
        <p>Sistem Informasi Manajemen Pelaporan Online (SIMAPOL)</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Surat</th>
                <th>Nama Pelapor</th>
                <th>Tujuan Aduan</th>
                <th>Tanggal Surat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aduan as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->nomor_surat }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->tujuan }}</td>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data STPA.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>