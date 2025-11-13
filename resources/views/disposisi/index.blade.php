@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk dan Nota Dinas')
@section('content')

<div class="container-fluid">
    <!-- Statistik -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Tindakan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['menunggu'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai Diproses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['selesai'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--     <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pegawai Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pegawai_aktif'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">
        <!-- Daftar Disposisi -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Disposisi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Nomor Dokumen</th>
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Instruksi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gabungan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($item['jenis'] === 'surat')
                                            <span class="badge badge-primary">Surat</span>
                                        @else
                                            <span class="badge badge-info">Nota</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['nomor_dokumen'] }}</td>
                                    <td>{{ $item['dari_nama'] }}</td>
                                    <td>{{ $item['kepada_nama'] }}</td>
                                    <td>{{ Str::limit($item['instruksi'], 30) }}</td>
                                    <td>{{ $item['created_at'] ? \Carbon\Carbon::parse($item['created_at'])->format('d M Y') : '—' }}</td>
                                    <td>
                                        @if($item['status'] === 'menunggu')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($item['status'] === 'diproses')
                                            <span class="badge badge-info">Diproses</span>
                                        @else
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-view"
                                                data-id="{{ $item['id'] }}"
                                                data-jenis="{{ $item['jenis'] }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary btn-edit"
                                                data-id="{{ $item['id'] }}"
                                                data-jenis="{{ $item['jenis'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Contoh untuk menghapus surat ID 5 -->
<!-- <button class="btn btn-danger delete-btn" data-id="{{ $item['id'] }}" data-jenis="surat" id="xcxc">Hapus Surat</button> -->

<!-- Contoh untuk menghapus nota ID 10 -->

            @php
             
                $buttonLabel = ($item['jenis'] === 'surat') ? 'Hapus Surat' : 'Hapus Nota';
            @endphp
            
            <button 
                class="btn btn-danger delete-btn" id="xcxc"
                data-id="{{ $item['id'] }}" 
                data-jenis="{{ $item['jenis'] }}"
            >
                {{ $buttonLabel }}
            </button>
<!-- <button class="btn btn-danger delete-btn" data-id="{{ $item['id'] }}" data-jenis="nota" id="xcxc">Hapus Nota</button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Disposisi Saya -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Disposisi Saya</h6>
                </div>
                <div class="card-body">
                    @if($disposisiSaya->isEmpty())
                        <p class="text-muted">Tidak ada disposisi untuk Anda.</p>
                    @else
                        @foreach($disposisiSaya as $item)
                            <div class="d-flex align-items-center mb-3">
                                <div class="mr-2">
                                    @if($item['status'] === 'menunggu')
                                        <span class="badge badge-warning" style="width:12px;height:12px;border-radius:50%;display:inline-block;"></span>
                                    @elseif($item['status'] === 'diproses')
                                        <span class="badge badge-info" style="width:12px;height:12px;border-radius:50%;display:inline-block;"></span>
                                    @else
                                        <span class="badge badge-success" style="width:12px;height:12px;border-radius:50%;display:inline-block;"></span>
                                    @endif
                                </div>
                                <div>
                                    <div><strong>{{ $item['nomor_dokumen'] }}</strong></div>
                                    <small class="text-muted">Tanggal: {{ $item['created_at'] }}</small><br>
                                    <small class="text-muted">Dari: {{ $item['dari_nama'] }}</small><br>
                                    <small class="text-muted">Status: {{ ucfirst($item['status']) }}</small>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Disposisi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Diisi via JS -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Disposisi -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Disposisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_jenis" name="jenis">
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">
                    <!-- Jenis Dokumen -->
                    <div class="form-group">
                        <label>Jenis Dokumen</label>
                        <input type="text" class="form-control" id="edit_jenis_label" readonly>
                    </div>

                    <!-- Nomor Dokumen -->
                    <div class="form-group">
                        <label>Nomor Dokumen</label>
                        <input type="text" class="form-control" id="edit_nomor_dokumen" readonly>
                    </div>

                    <!-- Dari -->
                    <div class="form-group">
                        <label>Dari</label>
                        <input type="text" class="form-control" id="edit_dari" readonly>
                    </div>

                    <!-- Kepada -->
                    <div class="form-group">
                        <label>Kepada</label>
                        <select class="form-control" id="edit_kepada_user" name="kepada_user" required>
                            <option value="">Pilih Pegawai</option>
                            <!-- Diisi via JS -->
                        </select>
                    </div>

                    <!-- Instruksi -->
                    <div class="form-group">
                        <label>Instruksi</label>
                        <textarea class="form-control" id="edit_instruksi" name="instruksi" rows="3" required></textarea>
                    </div>

                    <!-- Catatan -->
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" id="edit_catatan" name="catatan" rows="2"></textarea>
                    </div>

                    <!-- Batas Waktu -->
                    <div class="form-group">
                        <label>Batas Waktu</label>
                        <input type="date" class="form-control" id="edit_batas_waktu" name="batas_waktu">
                    </div>

                    <!-- Prioritas -->
                    <div class="form-group">
                        <label>Prioritas</label>
                        <select class="form-control" id="edit_prioritas" name="prioritas" required>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="segera">Segera</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="menunggu">Menunggu</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        "pageLength": 10, // Jumlah baris per halaman
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "order": [[7, "desc"]], // Urutkan berdasarkan kolom Tanggal (index 7)
        // "columnDefs": [
        //     { "orderable": false, "targets": [0, 9] } // Nonaktifkan sort di No dan Aksi
        // ]
    });
});
</script>

<script>
$(document).ready(function () {
    $('.btn-view').click(function () {
        let id = $(this).data('id');
        let jenis = $(this).data('jenis');
        $.get(`/disposisi/${jenis}/${id}/detail`, function (data) {
            let progress = 0;
            if (data.status === 'selesai') progress = 100;
            else if (data.status === 'diproses') progress = 50;
            else progress = 0;

            $('#detailContent').html(`
                <p><strong>Jenis:</strong> ${data.jenis === 'surat' ? 'Surat Masuk' : 'Nota Dinas'}</p>
                <p><strong>Nomor Disposisi:</strong> ${data.nomor_disposisi}</p>
                <p><strong>Nomor Dokumen:</strong> ${data.nomor_dokumen}</p>
                <p><strong>Dari:</strong> ${data.dari_nama}</p>
                <p><strong>Kepada:</strong> ${data.kepada_nama}</p>
                <p><strong>Instruksi:</strong> ${data.instruksi}</p>
                <p><strong>Catatan:</strong> ${data.catatan || '—'}</p>
                <p><strong>Batas Waktu:</strong> ${data.batas_waktu || '—'}</p>
                <p><strong>Prioritas:</strong> ${data.prioritas}</p>
                <p><strong>Status:</strong> ${data.status}</p>
                <p><strong>Dibuat:</strong> ${data.created_at}</p>

                <h6>Riwayat Perjalanan</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>${data.created_at}</strong><br>
                        ${data.dari_nama} membuat disposisi
                    </li>
                    <li class="list-group-item">
                        ${data.kepada_nama} menerima disposisi
                    </li>
                </ul>

                <div class="mt-3">
                    <div class="progress">
                        <div class="progress-bar bg-${progress === 100 ? 'success' : progress === 50 ? 'info' : 'warning'}" 
                             role="progressbar" style="width: ${progress}%"></div>
                    </div>
                    <small class="text-muted">${progress}% Selesai</small>
                </div>
            `);
            $('#modalDetail').modal('show');
        });
    });
});
</script>

<!-- dipslaytabel -->
<script>
    $(document).ready(function () {
    // Tombol Edit
    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let jenis = $(this).data('jenis');

        $.get(`/disposisi/${jenis}/${id}/edit`, function (data) {
            // Isi field hidden
            $('#edit_jenis').val(jenis);
            $('#edit_id').val(id);

            // Isi field readonly
            $('#edit_jenis_label').val(jenis === 'surat' ? 'Surat Masuk' : 'Nota Dinas');
            $('#edit_nomor_dokumen').val(data.dokumen);
            $('#edit_dari').val(data.dari_nama);

            // Isi field edit
            $('#edit_kepada_user').empty().append('<option value="">Pilih Pegawai</option>');
            data.users.forEach(user => {
                $('#edit_kepada_user').append(
                    `<option value="${user.id}" ${user.id == data.kepada_user ? 'selected' : ''}>${user.nama_lengkap} - ${user.jabatan || '—'}</option>`
                );
            });
            $('#edit_instruksi').val(data.instruksi);
            $('#edit_catatan').val(data.catatan || '');
            $('#edit_batas_waktu').val(data.batas_waktu || '');
            $('#edit_prioritas').val(data.prioritas);
            $('#edit_status').val(data.status);

            $('#modalEdit').modal('show');
        });
    });

    // Simpan Perubahan
    $('#formEdit').on('submit', function (e) {
        e.preventDefault();
        let jenis = $('#edit_jenis').val();
        let id = $('#edit_id').val();

        $.ajax({
            url: `/disposisi/${jenis}/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    location.reload(); // atau update row tanpa reload
                }
            },
            error: function (xhr) {
                alert('Gagal menyimpan: ' + xhr.responseJSON?.message || 'Error tidak diketahui');
            }
        });
    });
});
 $('body').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var jenis = $(this).data('jenis'); 

        if (!id || !jenis) { 
            alert('ID atau Jenis tidak ditemukan pada elemen HTML.'); 
            return; 
        }
        
        // Konfirmasi sebelum menghapus
        if (!confirm('Apakah Anda yakin ingin menghapus data ' + jenis + ' ID ' + id + '?')) {
            return;
        }

        var deleteUrl = '/disposisi/' + jenis + '/' + id;
         
        $.ajax({
            url: deleteUrl,
            type: 'DELETE', // Method DELETE
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(res) {
                // Tampilkan alert sukses dan refresh halaman
                alert('Sukses: ' + res.message);
                window.location.reload(); // Refresh halaman setelah sukses
            },
            error: function(xhr) {
                // Tampilkan alert error
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan saat menghapus.';
                alert('Error: ' + errorMessage);
            }
        });
    });





 // end ready
</script>


@endpush