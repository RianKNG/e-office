<form id="suratForm">
    @csrf
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama"><br>
    <label for="alamat">Alamat:</label><br>
    <textarea id="alamat" name="alamat"></textarea><br>
    <button type="button" id="previewButton">Preview PDF</button>
</form>

<div id="pdf-preview-container" style="margin-top: 20px;">
    <!-- iFrame akan diisi di sini -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#previewButton').on('click', function() {
        $.ajax({
            url: "{{ route('letter.preview') }}",
            type: "POST",
            data: $('#suratForm').serialize(),
            success: function(response) {
                // Hapus preview lama jika ada
                $('#pdf-preview-container').empty();

                // Buat iFrame dan tambahkan ke container
                var iframe = $('<iframe>', {
                    src: response.url,
                    width: '100%',
                    height: '600px',
                    style: 'border: none;'
                });
                $('#pdf-preview-container').append(iframe);
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat membuat pratinjau PDF.');
                console.error(xhr.responseText);
            }
        });
    });
</script>
