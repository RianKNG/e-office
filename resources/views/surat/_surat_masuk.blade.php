@extends('layout.v_template')
@section('title','surat')
@section('bawah','Kelola Surat Masuk')
@section('content')

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
      <button class="btn btn-primary btn-sm" id="btnTambahSurat">
    <i class="fas fa-plus"></i> Tambah Surat
  </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered data-table-saya">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor Surat</th>
              <th>Berkas</th>
              <th>Tempat Pembuatan</th>
              <th>Jabatan Pembuat</th>
              <th width="280px">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include('surat._add_modal') {{-- kalau ada --}}
{{-- Modal Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="formEditSurat" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Edit Surat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Jenis Surat</label>
              <input type="text" id="edit_jenis_surat" name="jenis_surat" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Nomor Surat</label>
              <input type="text" id="edit_nomor_surat" name="nomor_surat" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Tanggal Surat</label>
              <input type="date" id="edit_tanggal_surat" name="tanggal_surat" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Perihal</label>
              <input type="text" id="edit_perihal" name="perihal" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Isi Surat</label>
            <textarea id="edit_isi_surat" name="isi_surat" rows="4" class="form-control"></textarea>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Sifat</label>
              <input type="text" id="edit_sifat" name="sifat_surat" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Klasifikasi</label>
              <input type="text" id="edit_klasifikasi" name="klasifikasi_surat" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Derajat Keamanan</label>
              <input type="text" id="edit_derajat" name="derajat_keamanan" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Tempat Pembuatan</label>
              <input type="text" id="edit_tempat" name="tempat_pembuatan" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Jabatan Pembuat</label>
              <input type="text" id="edit_jabatan" name="jabatan_pembuat" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Catatan Tambahan</label>
            <textarea id="edit_catatan" name="catatan_tambahan" rows="2" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label>Berkas (opsional - unggah jika ingin mengganti)</label>
            <input type="file" id="edit_berkas" name="berkas_surat" class="form-control-file">
            <small id="currentFile" class="form-text text-muted"></small>
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

@push('masuk')
<!-- Pastikan jQuery & Bootstrap & DataTables sudah dimuat di layout -->
<!-- Jika belum ada, kamu bisa menambahkan CDN berikut (letakkan di layout) -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function() {
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

  // Inisialisasi DataTable dan render kolom aksi di client-side
  var table = $('.data-table-saya').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('surat.masuk') }}",
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'nomor_surat', name: 'dn.nomor_surat' },
      { data: 'berkas_surat', name: 'dn.berkas_surat', orderable: false, searchable: false },
      { data: 'tempat_pembuatan', name: 'dn.tempat_pembuatan' },
      { data: 'jabatan_pembuat', name: 'dn.jabatan_pembuat' },
      {
        data: null,
        name: 'aksi',
        orderable: false,
        searchable: false,
        render: function(data, type, row) {
          // pastikan row.id ada (cek response network)
          var id = row.id || '';
          var pdf = `<a href="/surat/download-pdf/${id}" class="btn btn-sm btn-danger" title="PDF"><i class="fas fa-file-pdf"></i></a>`;
          var word = `<a href="/surat/download-word/${id}" class="btn btn-sm btn-primary" title="Word"><i class="fas fa-file-word"></i></a>`;
          var print = `<a href="/surat/stream/${id}" class="btn btn-sm btn-success" target="_blank" title="Print"><i class="fas fa-print"></i></a>`;
          var edit = `<button class="btn btn-warning btn-sm tombol-edit" data-id="${id}" title="Edit"><i class="fas fa-edit"></i></button>`;
          var hapus = `<button class="btn btn-danger btn-sm tombol-hapus" data-id="${id}" title="Hapus"><i class="fas fa-trash"></i></button>`;
          return pdf + ' ' + word + ' ' + print + ' ' + edit + ' ' + hapus;
        }
      }
    ]
  });
// Tombol untuk buka modal tambah
$('#btnTambahSurat').on('click', function() {
  $('#formTambahSurat')[0].reset(); // reset form
  $('#tambahModal').modal('show');
});

// Submit form tambah
$('#formTambahSurat').on('submit', function(e) {
  e.preventDefault();

  let formData = new FormData(this);

  $.ajax({
    url: '/surat/tambah', // pastikan route ini ada
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(res) {
      $('#tambahModal').modal('hide');
      $('.data-table-saya').DataTable().ajax.reload();
      Swal.fire('Sukses', res.message || 'Surat berhasil ditambahkan!', 'success');
    },
    error: function(xhr) {
      console.error(xhr.responseText);
      Swal.fire('Gagal', 'Tidak bisa menambah surat.', 'error');
    }
  });
});

  // Klik tombol Edit -> ambil data -> buka modal
  $('body').on('click', '.tombol-edit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    if (!id) { alert('ID surat tidak ditemukan'); return; }

    $.get("/surat/edit/" + id, function(response) {
      var d = response.result;
      $('#edit_id').val(d.id);
      $('#edit_jenis_surat').val(d.jenis_surat || '');
      $('#edit_nomor_surat').val(d.nomor_surat || '');
      $('#edit_tanggal_surat').val(d.tanggal_surat ? d.tanggal_surat.split(' ')[0] : '');
      $('#edit_perihal').val(d.perihal || '');
      $('#edit_isi_surat').val(d.isi_surat || '');
      $('#edit_sifat').val(d.sifat_surat || '');
      $('#edit_klasifikasi').val(d.klasifikasi_surat || d.klsifikasi_surat || '');
      $('#edit_derajat').val(d.derajat_keamanan || '');
      $('#edit_tempat').val(d.tempat_pembuatan || '');
      $('#edit_jabatan').val(d.jabatan_pembuat || '');
      $('#edit_catatan').val(d.catatan_tambahan || '');
      if (d.bs) { $('#currentFile').text('Berkas saat ini: ' + d.bs); } else { $('#currentFile').text(''); }
      $('#editModal').modal('show');
    }).fail(function() {
      alert('Gagal memuat data surat. Cek console/network.');
    });
  });

  // Submit edit form (gunakan FormData untuk file)
  $('#formEditSurat').on('submit', function(e) {
    e.preventDefault();
    var id = $('#edit_id').val();
    if (!id) { alert('ID kosong'); return; }

    var form = new FormData(this);

    $.ajax({
      url: '/surat/update/' + id,
      method: 'POST',
      data: form,
      processData: false,
      contentType: false,
      success: function(res) {
        $('#editModal').modal('hide');
        table.ajax.reload(null, false);
        Swal.fire('Sukses', (res.message || 'Surat berhasil diperbarui'), 'success');
      },
      error: function(xhr) {
        console.error(xhr);
        Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui.', 'error');
      }
    });
  });

  // Hapus dengan SweetAlert2
  $('body').on('click', '.tombol-hapus', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    if (!id) { alert('ID surat tidak ditemukan'); return; }

    Swal.fire({
      title: 'Yakin?',
      text: "Data surat akan dihapus permanen.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/surat/delete/' + id,
          type: 'DELETE',
          success: function(res) {
            table.ajax.reload(null, false);
            Swal.fire('Terhapus!', (res.message || 'Surat berhasil dihapus.'), 'success');
          },
          error: function(xhr) {
            console.error(xhr);
            Swal.fire('Gagal', 'Gagal menghapus surat.', 'error');
          }
        });
      }
    });
  });

}); // end ready
</script>
@endpush
