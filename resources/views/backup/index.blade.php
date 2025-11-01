@extends('layout.v_template')
@section('title','Backup & Restore')
@section('bawah','Kelola Backup dan Restore Database')
@section('content')

<div class="container-fluid">

    <!-- Card Backup -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Backup Database</h6>
        </div>
        <div class="card-body">
            <p class="text-muted">Ekspor seluruh data sistem ke dalam file SQL.</p>
            <button id="btnBackup" class="btn btn-success">
                <i class="fas fa-download"></i> Backup Sekarang
            </button>
            <div id="backupResult" class="mt-3" style="display: none;">
                <div class="alert alert-info">
                    <strong>Backup berhasil!</strong><br>
                    File SQL telah di-generate dan siap diunduh.
                </div>
                <a id="downloadLink" href="#" class="btn btn-outline-primary mt-2">
                    <i class="fas fa-file-download"></i> Unduh File SQL
                </a>
            </div>
        </div>
    </div>

    <!-- Card Restore -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Restore Database</h6>
        </div>
        <div class="card-body">
            <p class="text-muted">Impor data dari file SQL untuk mengembalikan database ke kondisi sebelumnya.</p>
            <form id="restoreForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="sqlFile">Pilih File SQL</label>
                    <input type="file" class="form-control-file" id="sqlFile" name="sql_file" accept=".sql" required>
                </div>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-upload"></i> Restore Sekarang
                </button>
            </form>
            <div id="restoreResult" class="mt-3" style="display: none;"></div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Backup
    $('#btnBackup').on('click', function () {
        if (!confirm('⚠️ Peringatan!\n\nApakah Anda yakin ingin mengekspor seluruh database?\nProses ini akan menghasilkan file SQL yang berisi semua data.')) {
            return;
        }

        $.ajax({
            url: '{{ route("backup.export") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (blob) {
                // Tampilkan notifikasi
                $('#backupResult').show();

                // Buat link unduh
                const url = window.URL.createObjectURL(blob);
                $('#downloadLink').attr('href', url);
                $('#downloadLink').attr('download', 'backup_eoffice_' + new Date().toISOString().slice(0,10) + '.sql');
            },
            error: function () {
                alert('Gagal membuat backup. Pastikan server memiliki izin akses ke mysqldump.');
            }
        });
    });

    // Restore
    $('#restoreForm').on('submit', function (e) {
        e.preventDefault();

        if (!confirm('⚠️ PERINGATAN KRITIS!\n\nRestore akan MENIMPA seluruh data database saat ini!\n\nPastikan Anda telah melakukan backup terlebih dahulu.\n\nLanjutkan?')) {
            return;
        }

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("backup.import") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#restoreResult').html(`
                    <div class="alert alert-success">
                        <strong>Berhasil!</strong> Database telah dipulihkan.
                    </div>
                `).show();
            },
            error: function (xhr) {
                let msg = 'Gagal restore database.';
                if (xhr.responseJSON?.message) {
                    msg += ' ' + xhr.responseJSON.message;
                }
                $('#restoreResult').html(`
                    <div class="alert alert-danger">
                        <strong>Error!</strong> ${msg}
                    </div>
                `).show();
            }
        });
    });
});
</script>
@endpush