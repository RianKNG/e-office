<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat {{ $surat->nomor_surat }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 40px 50px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat h2 {
            margin: 5px 0;
            font-size: 20px;
        }
        .kop-surat p {
            margin: 2px 0;
            font-size: 14px;
        }
        .garis {
            border-top: 2px solid #000;
            margin: 10px 0;
        }
        .nomor-surat {
            text-align: right;
            margin-bottom: 20px;
        }
        .isi-surat {
            margin-top: 20px;
            text-align: justify;
        }
        .penutup {
            margin-top: 40px;
            text-align: right;
        }
        .ttd {
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop-surat">
        <h2>PEMERINTAH KOTA SUMEDANG</h2>
        <h3>{{ $surat->instansi ?? 'DINAS KOMUNIKASI DAN INFORMATIKA' }}</h3>
        <p>Jalan Wastukancana No. 2, Bandung 40111</p>
        <p>Telp. (022) 123456 | Email: info@bandung.go.id</p>
        <div class="garis"></div>
    </div>

    <!-- Nomor Surat -->
    <div class="nomor-surat">
        Nomor: {{ $surat->nomor_surat }}
    </div>

    <!-- Perihal -->
    <p>Perihal: <strong>{{ $surat->perihal ?? 'Permohonan Informasi' }}</strong></p>
    <p>Kepada Yth.<br>
    {{ $surat->kepada ?? 'Bapak/Ibu Pimpinan' }}<br>
    di Tempat</p>

    <!-- Isi Surat -->
    <div class="isi-surat">
        {!! $surat->isi_surat ?? '<p>Isi surat belum diisi.</p>' !!}
    </div>

    <!-- Penutup -->
    <div class="penutup">
        <p>Hormat kami,</p>
        <div class="ttd">
            <p>{{ $surat->penandatangan_jabatan ?? 'Kepala Dinas' }}</p>
            <br><br><br>
            <p><u>{{ $surat->penandatangan_nama ?? 'Budi Santoso' }}</u></p>
            <p>{{ $surat->penandatangan_nip ? 'NIP. ' . $surat->penandatangan_nip : '' }}</p>
        </div>
    </div>

</body>
</html>