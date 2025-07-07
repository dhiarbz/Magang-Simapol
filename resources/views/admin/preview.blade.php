<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Pengaduan - {{ $laporan->nama }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .underlined{
            text-decoration: underline;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-bold {
            font-weight: bold;
        }
        
        .signature-area {
            margin-top: 50px;
            text-align: right;
        }
        
        .materai-box {
            border: 1px solid black;
            width: 80px;
            height: 80px;
            float: right;
            margin-top: 100px;
            margin-right: 100px;
            text-align: center;
            line-height: 80px;
        }
        
        .indent {
            text-indent: 50px;
        }
        
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="text-left">
        <div class="text-bold">Perihal: <span class="">Surat Pengaduan</span></div>
    </div>
    
    <div class="text-right" style="margin-top: 50px;">
        <div>Kepada</div>
        <div class="text-bold">Yth. Dirressiber Polda Jateng</div>
        <div>di</div>
        <div class="underlined">Semarang</div>
    </div>
    
    <div style="margin-top: 30px;">
        <div class="text-bold">Dengan hormat:</div>
        <div class="indent">
            Yang bertanda tangan di bawah ini :
        </div>
        
        <div style="margin-left: 50px;">
            <div>No. NIK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->nik }}</span></div>
            <div>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->nama }}</span></div>
            <div>Tempat, tanggal lahir : <span class="">{{ $laporan->ttg }}</span></div>
            <div>Agama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->agama }}</span></div>
            <div>Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->pekerjaan }}</span></div>
            <div>Alamat KTP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->alamat_ktp }}</span></div>
            <div>Alamat Domisili &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->alamat_domisili }}</span></div>
            <div>Nomor HP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="">{{ $laporan->nomor_hp }}</span></div>
        </div>
        
        <div class="indent" style="margin-top: 20px;">
            Sehubungan dengan laporan pengaduan saya ini, disampaikan kepada Bapak
            Dirressiber Polda Jateng, tentang kronologis kejadian yang saya alami
            sebagai berikut:
        </div>
        
        <div style="margin-left: 50px; margin-top: 20px;">
            {{ $laporan->isi_laporan }}
        </div>
        
        <div class="indent" style="margin-top: 20px;">
            Bukti - bukti berupa:
        </div>
        
        <div style="margin-left: 50px; margin-top: 10px;">
            @foreach(['bukti_1', 'bukti_2', 'bukti_3'] as $bukti)
                @if($laporan->$bukti)
                    <div>{{ $loop->iteration }}. <span class="">{{ basename($laporan->$bukti) }}</span></div>
                @endif
            @endforeach
        </div>
    </div>
    
    <div class="indent" style="margin-top: 30px;">
        Demikian surat pengaduan ini saya buat, dimohon Bapak Dirressiber Polda 
        Jateng untuk membantu penyelesaiannya secara hukum yang berlaku, dan 
        untuk menguatkan laporan tersebut saya membubuhkan tanda tangan dibawah ini.
    </div>
    
    {{-- <div class="clear"></div> --}}
    {{-- <div class="materai-box">10.000</div> --}}
    
    <div class="signature-area">
        <div>Semarang, {{ date('d F Y') }}</div>
        <div>Yang mengadukan</div>
        <div style="margin-top:80px" class="underlined">{{ $laporan->nama }}</div>
    </div>
</body>
</html>