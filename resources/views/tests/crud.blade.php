<!DOCTYPE html>
<html lang="en">

<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Template Surat HTML</title>
    <!-- Inline CSS di sini untuk klien email yang mendukung -->
    <style type="text/css">
        body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        p { display: block; margin: 13px 0; }

        @media only screen and (max-width: 600px) {
            .full-width-table { width: 100% !important; }
            .content-padding { padding: 10px !important; }
            .header img { max-width: 100%; height: auto; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: red;">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h3>Buat/Edit Surat</h3>
            <form id="surat-form">
                <input type="hidden" name="_method" id="method-input" value="POST">
                <input type="hidden" name="surat_id" id="surat_id">

                <div class="mb-3">
                    <label for="template-select" class="form-label">Pilih Template</label>
                    <select class="form-control" id="template-select" name="template">
                        <option value="template1">Template Sederhana</option>
                        <option value="template2">Template Pemberitahuan</option>
                    </select>
                </div>

                <div id="form-fields"></div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" id="preview-btn">Pratinjau</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
            <textarea name="lihat" class="form-control" id="lihat"></textarea>
        </div>
        
        <div class="col-md-6">
            <h3>Daftar Surat</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Template</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="surat-list">
                @foreach($tests as $surat)
                    <tr id="surat-{{ $surat->id }}">
                        <td>{{ $surat->template }}</td>
                        <td>
                            <button class="btn btn-sm btn-info edit-btn" data-id="{{ $surat->id }}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $surat->id }}">Hapus</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
                    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        function loadFormFields(template, data = {}) {
            let html = '';
            if (template === 'template1') {
                html = `
                    <div class="mb-3"><label class="form-label">Nama Penerima</label><input type="text" class="form-control" name="nama_penerima" value="${data.nama_penerima || ''}"></div>
                    <div class="mb-3"><label class="form-label">Isi Surat</label><textarea class="form-control" name="isi_surat" rows="3">${data.isi_surat || ''}</textarea></div>
                `;
            } else if (template === 'template2') {
                html = `
                    <div class="mb-3"><label class="form-label">Perihal</label><input type="text" class="form-control" name="perihal" value="${data.perihal || ''}"></div>
                    <div class="mb-3"><label class="form-label">Nama Penerima</label><input type="text" class="form-control" name="nama_penerima" value="${data.nama_penerima || ''}"></div>
                    <div class="mb-3"><label class="form-label">Isi Pemberitahuan</label><textarea class="form-control" name="isi_surat" rows="3">${data.isi_surat || ''}</textarea></div>
                `;
            }
            $('#form-fields').html(html);
        }

        // Pemuatan awal saat halaman dimuat
        loadFormFields($('#template-select').val());

        // Event perubahan template
        $('#template-select').change(function () {
            loadFormFields($(this).val());
        });

        // Event pratinjau
        $('#preview-btn').click(function (e) {
             e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ route('surats.preview') }}",
                
                 dataType: 'json',
                data: $('#surat-form').serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    $('#preview-area-test').val(response.html);
                    //   console.log("success", response);
                    // console.log(response);
                    
                    //  $('#preview-area-test').val(response);
                }
              
            });
        });

        // CREATE & UPDATE
        $('#surat-form').submit(function (e) {
            e.preventDefault();
            const url = $('#surat_id').val() ? `/tests/${$('#surat_id').val()}` : '/tests';
            const method = $('#method-input').val();
            $.ajax({
                url:"tests",
                type: method,
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    // alert(response.message);
                    location.reload(); // Sederhana: reload halaman
                    //  console.log("Permintaan AJAX berhasil:", response);
                }
            });
            //  console.log("Permintaan AJAX berhasil:", e);
        });

        // READ (bagian EDIT)
        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');
            $.ajax({
                url: `/surats/edit/${id}`,
                type: 'GET',
                success: function (surat) {
                    $('#surat_id').val(surat.id);
                    $('#method-input').val('PUT');
                    $('#template-select').val(surat.template).change();
                    // Mengisi field formulir
                    loadFormFields(surat.template, surat.data);
                }
            });
        });

        // DELETE
        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus surat ini?')) {
                $.ajax({
                    url: `/surat/${id}`,
                    type: 'PUT',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        alert(response.message);
                        $(`#surat-${id}`).remove();
                    }
                });
            }
        });
    });
</script>
</body>
</html>
