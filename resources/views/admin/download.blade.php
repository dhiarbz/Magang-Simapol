<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>STPA - Surat Tanda Penerimaan Aduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 40px;
        }
        h2, h3 {
            text-align: center;
            margin: 5px 0;
        }
        .center {
            text-align: center;
        }
        .section {
            margin-top: 25px;
        }
        .identitas {
            margin-left: 40px;
        }
        .ttd {
            margin-top: 50px;
        }
        .left, .right {
            width: 45%;
            display: inline-block;
            vertical-align: top;
        }
        .left {
            text-align: center;
        }
        .right {
            text-align: center;
            float: right;
        }
        img.logo {
            display: block;
            margin: 0 auto;
            width: 80px;
            height: auto;
        }
    </style>
</head>
<body>

    <h3>KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
    DAERAH JAWA TENGAH<br>
    DIREKTORAT RESERSE SIBER</h3>

<div style="text-align: center;">
    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('images/tribrata.jpg'))) }}" 
         alt="Logo POLRI" 
         style="width: 100px; height: auto;">
</div>
    <h2 style="margin-top: 20px; text-decoration: underline;">SURAT TANDA PENERIMAAN ADUAN</h2>
    <p class="center">Nomor: {{ $aduan->nomor_surat }}</p>

    <p>Pada hari ini {{ $aduan->hari }}, tanggal {{ \Carbon\Carbon::parse($aduan->tanggal)->translatedFormat('d F Y') }}, sekitar pukul {{ $aduan->jam }} WIB, telah datang seorang {{ strtolower($aduan->gender) }} di Kantor Direktorat Reserse Siber Polda Jawa Tengah, dengan identitas sebagai berikut:</p>

    <div class="identitas">
        <p>Nama: {{ $aduan->nama }}</p>
        <p>Tempat / Tanggal Lahir: {{ $aduan->ttg }}</p>
        <p>Pekerjaan: {{ $aduan->pekerjaan }}</p>
        <p>Alamat KTP: {{ $aduan->alamat }}</p>
        <p>Alamat Domisili: {{ $aduan->domisili }}</p>
        <p>Nomor HP: {{ $aduan->no_hp }}</p>
        <p>NIK: {{ $aduan->nik }}</p>
    </div>

    <p>Dengan maksud untuk mengadukan adanya dugaan tindak pidana:</p>

    <p class="center"><strong>"{{ strtoupper($aduan->tujuan) }}"</strong></p>

    <p>Bahwa telah terjadi adanya dugaan tindak pidana atau peristiwa sebagai berikut:</p>

    <div class="identitas">
        <p>Tempat Kejadian: {{ $aduan->tempat_kejadian }}</p>
        <p>Tanggal Kejadian: {{ \Carbon\Carbon::parse($aduan->tanggal_kejadian)->translatedFormat('d F Y') }}</p>
        <p>Kerugian: {{ $aduan->kerugian }}</p>
        <p>Teradu: {{ $aduan->teradu }}</p>
        <p>Korban: {{ $aduan->korban }}</p>
        <p>Modus: {{ $aduan->modus }}</p>
        <p>Keterangan: {{ ucfirst($aduan->keterangan) }}</p>
    </div>

    <p>Demikian Surat Tanda Terima Pengaduan ini dibuat dengan sebenarnya untuk digunakan seperlunya.</p>

    <div class="section">
        <div class="left">
            <p>Pengadu</p>
            <br><br><br>
            <p><strong>{{ $aduan->nama }}</strong></p>
        </div>
        <div class="right">
            <p>Yang Menerima</p>
            <p>a.n. PAWAS PIKET DITRESSIBER<br>BA PIKET</p>
            <br><br>
            <p><strong>{{ $aduan->penerima }}</strong><br>{{ strtoupper($aduan->jabatan) }} NRP {{ $aduan->nrp }}</p>
        </div>
    </div>

</body>
</html>
