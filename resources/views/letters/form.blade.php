<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kwitansi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        iframe {
            border: 1px solid #ccc;
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body class="p-4">
    <h1>Preview Kwitansi</h1>
    <div class="row">
        <div class="col-md-4">
            <form id="kwitansiForm">
                <div class="mb-3">
                    <label for="kepada" class="form-label">Kepada:</label>
                    <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Nama Pelanggan">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Pelanggan"></textarea>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
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
</body>
</html>
