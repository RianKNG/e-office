@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@section('content')


       <style>
        .container { display: flex; gap: 20px; }
        .form-area, .preview-area { flex: 1; }
        .preview-box { border: 1px solid #ccc; padding: 20px; min-height: 200px; }
    </style>
<div class="form-container fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Buat Surat Baru</h5>
        <!-- <div>
            <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="saveAsDraft()">
                <i class="bi bi-save"></i> Simpan Draft
            </button>
        </div> -->
         @if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
    
    </div>
    
         <form action="/surat/store" method="POST" enctype="multipart/form-data" id="suratForm">
            @csrf
        <div class="row">
            <div class="col-md-6 mb-3" >
                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                <select class="form-control" id="jenisSurat" name="jenis_surat" required>
                    <option value="">Pilih Jenis Surat</option>
                    <option value="Surat Edaran">Surat Edaran</option>
                    <option value="Surat Undangan">Surat Undangan</option>
                    <option value="Surat Pengumuman">Surat Pengumuman</option>
                   
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomorSurat" name="nomor_surat" >
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggalSurat" name="tanggal_surat" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Perihal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Masukkan perihal surat" required>
            </div>
        </div>
        
        <!-- <div class="mb-3">
            <label class="form-label">tipe <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="letter_type" name="letter_type" placeholder="Masukkan tujuan surat" required>
        </div> -->
        
        
        <div class="mb-3">
            <div class="form-group">
                        <label for="isi_surat">Isi Surat:</label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="10" required></textarea>
                    </div>
            <div class="form-text">
                <small>Tip: Gunakan format surat yang baku dan jelas</small>
            </div>
        </div>
          <div class="form-group">
                        <label for="letter_type_selector">Jenis Surat:</label>
                        <select class="form-control" id="letter_type_selector" name="letter_type">
                            <option value="">-- Pilih Jenis Surat --</option>
                            <option value="undangan_rapat">Undangan Rapat</option>
                            <option value="permohonan_izin">Permohonan Izin</option>
                            <option value="pemberitahuan">Pemberitahuan</option>
                            <option value="lain-lain">Lain-lain</option>
                        </select>
                    </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Lampiran</label>
                <!-- <input type="file" class="form-control" name="documen" placeholder="ds"> -->
                <input type="file" class="form-control" name="berkas_surat[]" accept=".pdf,.doc,.docx,.xls,.jpeg,.xlsx" multiple>
                <div class="form-text">
                    <small>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX (max 5MB)</small>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Sifat Surat <span class="text-danger">*</span></label>
                <select class="form-control" id="sifatSurat" name="sifat_surat" required>
                    <option value="biasa">Biasa</option>
                    <option value="penting">Penting</option>
                    <option value="rahasia">Rahasia</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Klasifikasi Surat</label>
                <select class="form-control" name="klasifikasi_surat">
                    <option value="">Pilih Klasifikasi</option>
                    <option value="umum">Umum</option>
                    <option value="penting">Penting</option>
                    <option value="rahasia">Rahasia</option>
                    <option value="sangat_rahasia">Sangat Rahasia</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Derajat Keamanan</label>
                <select class="form-control" name="derajat_keamanan">
                    <option value="">Pilih Derajat</option>
                    <option value="terbuka">Terbuka</option>
                    <option value="terbatas">Terbatas</option>
                    <option value="rahasia">Rahasia</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Pembuatan</label>
                <input type="text" class="form-control" name="tempat_pembuatan" placeholder="Contoh: Yogyakarta">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jabatan Pembuat</label>
                <input type="text" class="form-control" name="jabatan_pembuat" placeholder="Contoh: Kepala Bagian" value="<?php echo isset($_SESSION['jabatan']) ? $_SESSION['jabatan'] : ''; ?>">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Catatan Tambahan</label>
            <textarea class="form-control" name="catatan_tambahan" rows="3" placeholder="Catatan tambahan (opsional)"></textarea>
        </div>
        <div class="form-group">
                <label for="diterima_oleh">Klasifikasi Surat</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">-- Pilih Penerima --</option>
                    @foreach ($coba as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->jabatan }} ({{ $item->nama_lengkap }})
                        </option>
                    @endforeach
                </select>
            </div>
         <!-- <div class="col-md-12 mb-3">
                  <label class="form-label">Klasifikasi Surat</label>
                 <select id="user_id" name="user_id" class="form-control">
              <option value="">--- User ---</option>
              @foreach($coba as $item)
              
        <option value=2 @if (old('user_id') == "2") {{ 'selected' }} @endif>Male</option>
        <option value=2 @if (old('user_id') == "3") {{ 'selected' }} @endif>Female</option>
                  @endforeach  
               
            </select>



            </div> -->
        
       <!-- <div class="col-md-6 mb-3">
                <label class="form-label">file</label>
                <input type="file" class="form-control" name="documen" placeholder="ds">
            </div> -->
        <!-- <form id="suratForm">
    <input type="text" name="nama" placeholder="Nama">
    <textarea name="alamat" placeholder="Alamat"></textarea> -->

    
<!-- </form> -->

<div id="previewBox">
    </div>
        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Surat
            </button>
            <button type="button" id="tombol_preview" class="btn btn-warning d-flex gap-2 flex-wrap">
                Lihat Pratinjau Surat
            </button>
            <!-- <button type="button" class="btn btn-outline-secondary" onclick="loadTemplate()">
                <i class="bi bi-file-earmark-text"></i> Load Template
            </button> -->
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
        </div>
    </form>
     <!-- <div class="preview-area">
            <h1>Pratinjau Surat</h1>
            <div id="previewBox" class="preview-box">
                
                <p>Silakan isi formulir untuk melihat pratinjau.</p>
            </div>
        </div>
</div> -->

<!-- Template Modal -->
<div class="modal fade" id="templateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Template Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="undangan">
                            <div class="card-body">
                                <h6 class="card-title">Surat Undangan</h6>
                                <p class="card-text">Template untuk surat undangan rapat atau kegiatan</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="edaran">
                            <div class="card-body">
                                <h6 class="card-title">Surat Edaran</h6>
                                <p class="card-text">Template untuk surat edaran internal</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="pengumuman">
                            <div class="card-body">
                                <h6 class="card-title">Surat Pengumuman</h6>
                                <p class="card-text">Template untuk surat pengumuman</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 template-card" data-template="tugas">
                            <div class="card-body">
                                <h6 class="card-title">Surat Tugas</h6>
                                <p class="card-text">Template untuk surat tugas perintah</p>
                                <button class="btn btn-sm btn-outline-primary">Pilih</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent" class="border p-4" style="min-height: 400px;">
                    <!-- Preview content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
         $(document).ready(function() {
        // Kode jQuery Anda akan berada di sini
          // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                 // Fungsi untuk mereset form
            function resetForm() {
                $('#letterForm')[0].reset();
                $('#letter_id').val('');
                $('#form-mode').text('Tambah');
                $('#saveLetterBtn').text('Simpan Surat');
                $('#cancelEditBtn').hide();
                $('#letter_type_selector').val(''); // Reset pilihan template
            }

              // --- Template Loading via AJAX ---
            $('#letter_type_selector').on('change', function() {
                var selectedJenisSurat = $(this).val();

                 if (selectedJenisSurat && selectedJenisSurat !== 'lain-lain') {
                    $.ajax({
                        url: "{{ route('get.surat.template') }}",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            jenis: selectedJenisSurat
                        },
                        success: function(response) {
                            $('#isi_surat').val(response.isi_surat);
                        },
                        error: function(xhr, status, error) {
                            console.error("Gagal memuat template:", error);
                            showNotification("Gagal memuat template surat.", "danger");
                        }
                    });
                } else if (selectedJenisSurat === 'lain-lain') {
                    $('#isi_surat').val(""); // Kosongkan jika memilih 'Lain-lain' atau tidak ada template
                } else {
                     $('#isi_surat').val(""); // Kosongkan jika tidak ada template dipilih
                }
            });

    });
            </script>
             <!-- <script>
        $(document).ready(function() {
            // Event listener untuk setiap perubahan pada form
            $('#suratForm input, #suratForm textarea').on('keyup', function() {
                // Ambil data dari form
                let formData = $('#suratForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('surat.preview.ajax') }}",
                    data: formData,
                    success: function(response) {
                        // Perbarui konten previewBox dengan respons HTML
                        $('#previewBox').html(response);
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan saat memuat pratinjau:', xhr);
                    }
                });
            });
        });
    </script> -->
    <!-- <script>
    $(document).ready(function() {
        // Variabel untuk menampung data formulir yang siap dikirim
        let latestFormData = $('#suratForm').serialize();
        let debounceTimer;
        
        // 1. FUNGSI UTAMA AJAX UNTUK MEMUAT PRATINJAU
        function loadPreview() {
            // Gunakan data terakhir yang sudah di-serialize
            const formData = latestFormData; 

            $.ajax({
                type: 'POST',
                url: "{{ route('surat.preview.ajax') }}",
                data: formData,
                // Pastikan Anda menyertakan CSRF Token untuk request POST di Laravel
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    // Perbarui konten previewBox dengan respons HTML
                    $('#previewBox').html(response);
                },
                error: function(xhr) {
                    console.error('Terjadi kesalahan saat memuat pratinjau:', xhr);
                }
            });
        }

        // 2. EVENT LISTENER UNTUK INPUT (Hanya untuk mengumpulkan data, TIDAK MENGIRIM AJAX)
        $('#suratForm input, #suratForm textarea, #suratForm select').on('input change', function() {
            // Terapkan Debounce untuk menghindari terlalu sering serialize data
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function() {
                // HANYA UPDATE data yang akan dikirim, TIDAK MENGIRIM AJAX
                latestFormData = $('#suratForm').serialize();
                console.log("Data formulir diperbarui, siap untuk pratinjau.");
                
                // Opsional: Beri umpan balik visual (misalnya, ubah warna tombol) bahwa ada pratinjau baru yang tersedia
                $('#tombol_preview').addClass('btn-warning').removeClass('btn-primary'); 
            }, 300); 
        });

        // 3. EVENT LISTENER UNTUK TOMBOL KLIK (Ini adalah pemicu AJAX sebenarnya)
        // Pastikan Anda memiliki tombol dengan ID='tombol_preview' di HTML Anda
        $('#tombol_preview').on('click', function(e) {
            e.preventDefault(); // Mencegah form submit jika tombol ada di dalam <form>
            
            // Panggil fungsi AJAX untuk memuat pratinjau
            loadPreview();
            
            // Kembalikan tombol ke status normal setelah diklik
            $(this).removeClass('btn-warning').addClass('btn-primary');
        });
        
        // 4. Inisialisasi: Muat data formulir awal saat halaman dimuat
        latestFormData = $('#suratForm').serialize();
    });
</script> -->
<script>
    $(document).ready(function() {
        // Sembunyikan kotak pratinjau di awal
        $('#previewBox').hide();

        let latestFormData = $('#suratForm').serialize();
        let debounceTimer;

        // 1. FUNGSI UTAMA UNTUK MENGELOLA TAMPILAN/TUTUP PRATINJAU
        function togglePreview() {
            const $previewBox = $('#previewBox');
            const $previewButton = $('#tombol_preview');

            // Cek apakah pratinjau sedang tersembunyi
            if ($previewBox.is(':hidden')) {
                // STATUS: TERSEMBUNYI -> TAMPILKAN

                // Ambil data terbaru dari formulir (pastikan data sudah diperbarui oleh event input)
                const formData = latestFormData; 

                // Lakukan Panggilan AJAX untuk memuat konten
                $.ajax({
                    type: 'POST',
                    url: "{{ route('surat.preview.ajax') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    beforeSend: function() {
                        // Tampilkan loading spinner saat memuat
                        $previewBox.html('<p class="text-center">Memuat Pratinjau...</p>').slideDown(200);
                    },
                    success: function(response) {
                        // Perbarui konten dan pastikan kotak tampil
                        $previewBox.html(response).slideDown(200);
                        
                        // Ubah status tombol menjadi 'TUTUP'
                        $previewButton.text('Tutup Pratinjau').removeClass('btn-primary').addClass('btn-danger');
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan saat memuat pratinjau:', xhr);
                        $previewBox.html('<p class="text-danger">Gagal memuat pratinjau.</p>');
                        // Jika gagal, biarkan tombol tetap 'Lihat Pratinjau' (atau ubah kembali jika perlu)
                    }
                });

            } else {
                // STATUS: TAMPIL -> SEMBUNYIKAN/TUTUP

                // Sembunyikan kotak pratinjau
                $previewBox.slideUp(200, function() {
                     // Kosongkan konten setelah disembunyikan (opsional)
                     $previewBox.empty(); 
                });
                
                // Ubah status tombol kembali menjadi 'LIHAT'
                $previewButton.text('Lihat Pratinjau Surat').removeClass('btn-danger').addClass('btn-primary');
            }
        }

        // 2. EVENT LISTENER UNTUK INPUT (Hanya untuk mengumpulkan data)
        $('#suratForm input, #suratForm textarea, #suratForm select').on('input change', function() {
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function() {
                // Update data terbaru
                latestFormData = $('#suratForm').serialize();
                console.log("Data formulir diperbarui, siap untuk pratinjau.");
                
                // Opsional: Jika pratinjau sedang terbuka, tutup dan beri indikasi bahwa harus dimuat ulang
                if ($('#previewBox').is(':visible')) {
                    $('#previewBox').slideUp(200).empty();
                    $('#tombol_preview').text('Lihat Pratinjau Baru').removeClass('btn-primary btn-danger').addClass('btn-warning');
                }
            }, 300); 
        });

        // 3. EVENT LISTENER UNTUK TOMBOL KLIK (Ini adalah pemicu toggle)
        $('#tombol_preview').on('click', function(e) {
            e.preventDefault(); 
            // Panggil fungsi toggle
            togglePreview();
        });
        
        // 4. Inisialisasi
        latestFormData = $('#suratForm').serialize();
    });
    //=========================================kodesimpedlnya
    
    
</script>
<script>
    // Tampilkan toast secara otomatis jika ada
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('successToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });
</script>

