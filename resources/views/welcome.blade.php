<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Penting untuk AJAX POST/PUT/DELETE -->
</head>
<body>
    <div class="container mt-5">
        <h1>Manajemen Surat</h1>

        <!-- Form Tambah/Edit Surat -->
        <div class="card mb-4">
            <div class="card-header">
                Form Surat (<span id="form-mode">Tambah</span>)
            </div>
            <div class="card-body">
                
                <form id="letterForm">
                     @csrf 
                    <input type="hidden" id="letter_id" name="id">
                    <div class="form-group">
                        <label for="subject">Subjek Surat:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
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
                    <div class="form-group">
                        <label for="content">Isi Surat:</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="saveLetterBtn">Simpan Surat</button>
                </div> 
                </div>
                    <button type="button" class="btn btn-secondary" id="cancelEditBtn" style="display:none;">Batal Edit</button>
                </form>
                  <button type="button" id="previewButton">Preview PDF</button>
                <div id="pdf-preview-container" style="margin-top: 20px;">
    <!-- iFrame akan diisi di sini -->
</div>
            </div>
        </div>

        <!-- Notifikasi -->
        <div id="ajax-alert" class="alert alert-dismissible fade show" role="alert" style="display:none;">
            <span id="alert-message"></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Tabel Daftar Surat -->
        <div class="card">
            <div class="card-header">
                Daftar Surat
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subjek</th>
                            <th>Jenis Surat</th>
                            <th>Isi Surat (Ringkas)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="letters-table-body">
                        @foreach ($letters as $letter)
                            <tr id="letter-{{ $letter->id }}">
                                <td>{{ $letter->id }}</td>
                                <td>{{ $letter->subject }}</td>
                                <td>{{ Str::replace('_', ' ', Str::title($letter->letter_type)) }}</td>
                                <td>{{ Str::limit($letter->content, 100) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-letter" data-id="{{ $letter->id }}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-letter" data-id="{{ $letter->id }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Fungsi untuk menampilkan notifikasi
            function showNotification(message, type = 'success') {
                $('#ajax-alert').removeClass('alert-success alert-danger').addClass('alert-' + type).find('#alert-message').text(message);
                $('#ajax-alert').fadeIn().delay(3000).fadeOut(); // Tampilkan 3 detik
            }

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
                        url: "{{ route('get.letter.template') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            jenis: selectedJenisSurat
                        },
                        success: function(response) {
                            $('#content').val(response.content);
                        },
                        error: function(xhr, status, error) {
                            console.error("Gagal memuat template:", error);
                            showNotification("Gagal memuat template surat.", "danger");
                        }
                    });
                } else if (selectedJenisSurat === 'lain-lain') {
                    $('#content').val(""); // Kosongkan jika memilih 'Lain-lain' atau tidak ada template
                } else {
                     $('#content').val(""); // Kosongkan jika tidak ada template dipilih
                }
            });

            // --- CREATE / UPDATE (Simpan Surat) via AJAX ---
            $('#letterForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize(); // Serialize data form
                var letterId = $('#letter_id').val();
                var url = letterId ? `/letters/${letterId}` : `/letters`; // URL untuk Update atau Create
                var method = letterId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, 'success');
                        resetForm();
                        // Perbarui tabel
                        if (method === 'POST') {
                            // Tambahkan baris baru ke tabel
                            var newRow = `<tr id="letter-${response.letter.id}">
                                <td>${response.letter.id}</td>
                                <td>${response.letter.subject}</td>
                                <td>${response.letter.letter_type.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase())}</td>
                                <td>${response.letter.content.substring(0, 100)}...</td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-letter" data-id="${response.letter.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-letter" data-id="${response.letter.id}">Hapus</button>
                                </td>
                            </tr>`;
                            $('#letters-table-body').prepend(newRow); // Tambahkan di paling atas
                        } else {
                            // Update baris yang sudah ada
                            var updatedRow = `<tr id="letter-${response.letter.id}">
                                <td>${response.letter.id}</td>
                                <td>${response.letter.subject}</td>
                                <td>${response.letter.letter_type.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase())}</td>
                                <td>${response.letter.content.substring(0, 100)}...</td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-letter" data-id="${response.letter.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-letter" data-id="${response.letter.id}">Hapus</button>
                                </td>
                            </tr>`;
                            $(`#letter-${response.letter.id}`).replaceWith(updatedRow);
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = "Terjadi kesalahan:\n";
                        if (errors) {
                            $.each(errors, function(key, value) {
                                errorMessage += "- " + value[0] + "\n";
                            });
                        } else {
                            errorMessage += "Silakan coba lagi.";
                        }
                        showNotification(errorMessage, 'danger');
                        console.error("Error Response:", xhr.responseJSON);
                    }
                });
            });

            // --- READ (Edit) via AJAX ---
            $(document).on('click', '.edit-letter', function() {
                var letterId = $(this).data('id');
                $.ajax({
                    url: `/letters/${letterId}/edit`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#letter_id').val(response.id);
                        $('#subject').val(response.subject);
                        $('#letter_type_selector').val(response.letter_type);
                        $('#content').val(response.content);
                        $('#form-mode').text('Edit');
                        $('#saveLetterBtn').text('Perbarui Surat');
                        $('#cancelEditBtn').show();
                        // Scroll ke atas form
                        $('html, body').animate({
                            scrollTop: $('#letterForm').offset().top - 50
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data surat:", error);
                        showNotification("Gagal memuat data surat untuk diedit.", "danger");
                    }
                });
            });

            // --- DELETE via AJAX ---
            $(document).on('click', '.delete-letter', function() {
                if (!confirm("Apakah Anda yakin ingin menghapus surat ini?")) {
                    return;
                }
                var letterId = $(this).data('id');
                $.ajax({
                    url: `/letters/${letterId}`,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, 'success');
                        $(`#letter-${letterId}`).remove(); // Hapus baris dari tabel
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal menghapus surat:", error);
                        showNotification("Gagal menghapus surat.", "danger");
                    }
                });
            });

            // Tombol Batal Edit
            $('#cancelEditBtn').on('click', function() {
                resetForm();
            });
            
         $(document).on('click', '#previewButton', function() {
          

                var formData = $(this).serialize(); // Serialize data form
                var letterId = $('#letterForm').val();
                // var url = "{{ route('letter.preview') }}";
                // var method = POST;
        $.ajax({
             url: '/preview/letter',
             
                    method: 'POST',
                    data: formData,
                    xhrFields: {
                        responseType: 'blob' // Respons harus berupa blob (binary large object)
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // Tampilkan loading spinner atau pesan
                        $('#pdf-preview-container').html('<p class="text-center">Memuat pratinjau...</p>');
                    },
                    success: function(response) {
                        var blobUrl = window.URL.createObjectURL(response);
                        var iframe = '<iframe src="' + blobUrl + '"></iframe>';
                        $('#pdf-preview-container').html(iframe);
                    },
                    // error: function(xhr, status, error) {
                    //     $('#pdf-preview-container').html('<p class="text-danger">Gagal membuat pratinjau PDF.</p>');
                    //     console.error("Error:", error);
                    // }
                });
            });
        });
        
    </script>
</body>
</html>
