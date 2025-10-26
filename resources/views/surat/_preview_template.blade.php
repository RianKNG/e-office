<!-- resources/views/surat/_preview_template.blade.php -->
<!-- <div class="surat-preview-content">
    <h3>Ythssssssssssssss. {{ $dataSurat['penerima'] }}</h3>
    <h4>Perihalssssssssssss: {{ $dataSurat['perihal'] }}</h4>
    <hr>
    <p>{!! nl2br(e($dataSurat['isi_surat'])) !!}</p>
    <p>Hormat kamisssssssssssssssssssssssssss,</p>
    <p>...<br>Pengirim</p>
</div> -->
<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kop Surat F4 dengan TTD</title>
    <link rel="stylesheet" href="style-f4-ttd.css">
</head> -->
<style>
    /* Aturan dasar untuk seluruh dokumen */
body {
    font-family: 'Times New Roman', Times, serif; /* Font formal */
    line-height: 1.6;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Mengatur ukuran kertas F4 dan margin untuk saat dicetak */
@page {
    size: 21.5cm 33cm; /* Ukuran kertas F4 */
    margin: 2cm; /* Margin untuk cetak */
}

/* Tata letak kop surat dengan Flexbox */
.letterhead-f4-ttd {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
}

.logo-kiri img, .logo-kanan img {
    width: 100px; /* Ukuran logo */
    height: auto;
}

.company-info-tengah {
    flex: 1; /* Mengambil ruang tersisa di tengah */
    text-align: center;
}

.company-info-tengah h1 {
    margin: 0;
    font-size: 24px;
    color: #005A9C;
    text-transform: uppercase;
}

.company-info-tengah p {
    margin: 0;
    font-size: 12px;
}

/* Garis pemisah */
.divider-full {
    height: 2px;
    background-color: #005A9C;
    border-bottom: 1px solid #ccc;
    margin-top: 15px;
    margin-bottom: 25px;
}

/* Konten surat */
.content-f4-ttd {
    width: 90%;
    margin: 0 auto;
    font-size: 12pt;
}

/* Blok tanda tangan */
.signature-block {
    margin-top: 50px;
    display: flex;
    justify-content: flex-end; /* Menempatkan tanda tangan di sisi kanan */
    width: 100%;
}

.signature-left {
    text-align: left;
    width: 300px;
}

.signature-left p {
    margin: 0;
}

/* Aturan untuk tampilan cetak */
@media print {
    body {
        margin: 0;
    }
    .letterhead-f4-ttd {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        padding-top: 20px;
        padding-bottom: 10px;
    }
    .content-f4-ttd {
        margin-top: 150px; /* Memberi ruang untuk kop surat di setiap halaman cetak */
    }
}

</style>
<body>
    <header class="letterhead-f4-ttd">
        <div class="logo-kiri">
           <img src="{{asset('template')}}/img/undraw_profile.svg" alt="Deskripsi Gambar">
        </div>
        <div class="company-info-tengah">
            <h1>PERUMDA SUMEDANG</h1>
            <p>Jalan Serang Cimalaka No. 17, Sumedan</p>
            <p>Telp: (021) 98765432 | Email: kontak@perusahaan.com | Website: www.perusahaan.com</p>
        </div>
        <div class="logo-kanan">
            <img src="{{asset('template')}}/img/undraw_profile.svg" alt="Deskripsi Gambar">
        </div>
    </header>

    <main class="content-f4-ttd">
        <div class="divider-full"></div>
        <p><strong>Nomor:</strong> 123/AP/IX/2025</p>
        <p><strong>Hal:</strong> Penawaran Jasa</p>
        
        <br>
        <p>Yth. Bapak/Ibu Pimpinan</p>
        <p>PT. Mitra Maju Bersama</p>
        <p>Jalan Raya Utama No. 45</p>
        <p>Jakarta Selatan</p>
        
        <br>
        <p>Dengan hormat,</p>
        <p>{{ $dataSurat['isi_surat'] }}</p>
        <!-- Isi surat bisa ditambahkan di sini -->

        <br><br><br>
        <div class="signature-block">
            <div class="signature-left">
                <p>Hormat kami,</p>
                <br><br><br><br>
                <p><strong>(Nama Lengkap Pimpinan)</strong></p>
                <p><strong>Jabatan</strong></p>
            </div>
        </div>
    </main>
</body>
<!-- </html> -->
 <!-- <script>
    $(document).ready(function() {
        // 1. Sembunyikan Kotak Pratinjau di Awal
        $('#previewBox').hide();

        // 2. Event Listener untuk Tombol Pratinjau
        // Pastikan di HTML Anda ada tombol dengan ID="tombol_preview"
        $('#tombol_preview').on('click', function(e) {
            e.preventDefault(); 
            
            const $previewBox = $('#previewBox');
            const $button = $(this); // Merujuk pada tombol yang diklik

            // Cek apakah Pratinjau sedang TERSEMBUNYI
            if ($previewBox.is(':hidden')) {
                // --- STATUS: TERSEMBUNYI -> TAMPILKAN ---

                // Ambil data dari form
                let formData = $('#suratForm').serialize();

                // Lakukan Panggilan AJAX
                $.ajax({
                    type: 'POST',
                    url: "{{ route('surat.preview.ajax') }}",
                    data: formData,
                    // PENTING: Untuk Laravel, selalu sertakan CSRF Token di sini
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response) {
                        // Tampilkan konten dan kotak
                        $previewBox.html(response).show();
                        
                        // Ubah tombol menjadi 'TUTUP'
                        $button.text('Tutup Pratinjau');
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan:', xhr);
                        $previewBox.html('Gagal memuat pratinjau.');
                        $previewBox.show();
                    }
                });

            } else {
                // --- STATUS: TAMPIL -> SEMBUNYIKAN/TUTUP ---

                // Sembunyikan kotak pratinjau
                $previewBox.hide();
                
                // Ubah tombol kembali menjadi 'LIHAT'
                $button.text('Lihat Pratinjau Surat');
            }
        });

        // Catatan: Jika Anda ingin pratinjau diperbarui otomatis setelah diklik, 
        // Anda perlu memanggil 'loadPreview()' di sini, tapi untuk saat ini kita biarkan kosong.
    });
</script>
++ -->
