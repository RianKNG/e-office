@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@push('suratcss')
    <!-- Menambahkan CSS khusus untuk halaman ini -->
           
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
   
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
   
@endpush
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
                <input type="file" class="form-control" name="berkas_surat" accept=".pdf,.doc,.docx,.xls,.jpeg,.xlsx">
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
        
        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Surat
            </button>
            <button type="button" class="btn btn-outline-primary" onclick="previewSurat()">
                <i class="bi bi-eye"></i> Preview
            </button>
            <button type="button" class="btn btn-outline-secondary" onclick="loadTemplate()">
                <i class="bi bi-file-earmark-text"></i> Load Template
            </button>
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
        </div>
    </form>
     <div class="preview-area">
            <h1>Pratinjau Surat</h1>
            <div id="previewBox" class="preview-box">
                <!-- Konten pratinjau akan ditampilkan di sini -->
                <p>Silakan isi formulir untuk melihat pratinjau.</p>
            </div>
        </div>
</div>

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
@push('suratjs')
  <!-- jquery -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#suratForm').on('submit', function(e) {
        e.preventDefault(); // Mencegah reload form default

        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "{{ route('surat.preview.ajax') }}",
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Terjadi kesalahan saat menyimpan data.'
                });
            }
        });
    });
});

$('#suratForm input, #suratForm textarea').on('keyup', function() {
    let formData = $('#suratForm').serialize();

    $.ajax({
        type: 'POST',
        url: "{{ route('surat.preview.ajax') }}",
        data: formData,
        success: function(response) {
            // Misalnya update isi preview box saja
            $('#previewBox').html(response.preview_html);
        },
        error: function(xhr) {
            console.error('Terjadi kesalahan saat memuat pratinjau:', xhr);
        }
    });
});

    </script>
    <!-- <script>
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
             <script>
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
                        // Perbarui konten previewBox dengan respons HTMLalert('Data berhasil diupdate!');
                         // Tangani respons sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response.message, // Asumsikan server mengirim pesan sukses
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    // Lakukan tindakan lanjutan, misal: me-reload tabel
                    location.reload();
                });
                                      },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan saat memuat pratinjau:', xhr);
                          // Tangani kesalahan jika ada
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Terjadi kesalahan saat menyimpan data.'
                });
                    }
                });
            });
        });

        //============================================================================
    //      document.addEventListener('DOMContentLoaded', function() {
    //     var toastEl = document.getElementById('successToast');
    //     if (toastEl) {
    //         var toast = new bootstrap.Toast(toastEl);
    //         toast.show();
    //     }
    // });
    </script> -->
    @endpush

