
@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@section('content')
<body class="p-4">
    <h1>Preview Kwitansi</h1>
    <div class="row">
        <div class="col-md-4">
            <form id="kwitansiForm">
                @CSRF
                <div class="mb-3">
                    <label for="subject" class="form-label">subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Nama Pelanggan">
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">contact:</label>
                    <textarea class="form-control" id="contact" name="contact" rows="3" placeholder="Alamat Pelanggan"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Pratinjau PDF</button>
            </form>
        </div>
        <div class="col-md-8">
            <div id="pdf-preview-container" class="mt-4">
                <!-- Pratinjau PDF akan dimuat di sini -->
                <p class="text-muted">Klik "Pratinjau PDF" untuk menampilkan kwitansi.</p>
            </div>
        </div>
    </div>
@endsection

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#kwitansiForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                
                $.ajax({
                    url: '/kwitansi-preview',
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
                    error: function(xhr, status, error) {
                        $('#pdf-preview-container').html('<p class="text-danger">Gagal membuat pratinjau PDF.</p>');
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>

