
@extends('layout.v_template')
@section('title','surat')
@section('bawah','Kelola Surat Masuk')
@section('content')

<!-- @endstack -->

<!-- Begin Page Content -->
  <div class="container-fluid">
      <!-- Button trigger modal -->
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
          </div>
          <div class="card-body">
              <div class="table-responsive">
   <table class="table table-bordered data-table-saya">
     <thead>
         <tr>
             <th>No</th>
             <th>Name</th>
 <th>Perihal</th>
  <th>Keamanan</th>
   <th>Tempat</th>
   <th>Jabatan</th>
             <th>Sifat</th>
             <th width="280px">Action</th>
         </tr>
     </thead>
     <tbody>
     </tbody>
    </table>
  
              </div>
          </div>
      </div>
  </div>
  <!-- /.container-fluid -->
   
            </div>
            </div>
            </div>
            <!-- Button trigger modal -->


<!-- Modal -->
 @include('surat._edit_modal')
 @endsection
@push('masuk') 
<script>
           
$(document).ready(function() { 
$.ajaxSetup({
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
 });
 var table = $('.data-table-saya').DataTable({
   processing: true,
   serverSide: true,
   ajax: "{{ route('surat.masuk') }}",
   columns: [
     { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
     { data: 'nomor_surat', name: 'dn.nomor_surat' },
     { data: 'perihal', name: 'dn.perihal' },
     { data: 'derajat_keamanan', name: 'dn.derajat_keamanan' },
     { data: 'tempat_pembuatan', name: 'dn.tempat_pembuatan' },
     { data: 'jabatan_pembuat', name: 'dn.jabatan_pembuat' },
      { data: 'sifat_surat', name: 'dn.sifat_surat' },
     
     {
     name: 'aksi',
     orderable: false,
     searchable: false,
     render: function(data, type, row) {
         let pdfIcon = `<a href="/surat/download-pdf/${row.id}" class="btn btn-sm btn-danger" title="Unduh PDF"><i class="fas fa-file-pdf"></i></a>`;
         let wordIcon = `<a href="/surat/download-word/${row.id}" class="btn btn-sm btn-primary" title="Unduh Word"><i class="fas fa-file-word"></i></a>`;

         // Jika format_output disimpan di database, gunakan itu
         // Jika tidak, tampilkan keduanya
         return `
             ${pdfIcon} ${wordIcon}
             <button class="tombol-edit btn btn-warning btn-sm" data-id="${row.id}">
   <i class="fas fa-edit"></i>
             </button>
         `;
     }
    }
     ]
    });
$('.munculkan').on('click',function(e){
  e.preventDefault();
  $('#contohModal').modal('show');
        alert('cek ajak jalan apa kagak');
  });
});

// Buka Modal Edit
    $('body').on('click', '.tombol-edit', function () {
        var id = $(this).data('id');
        $.get("/surat/edit/" + id, function (data) {
            $('#edit_id').val(data.result.id);
            $('input[name="jenis_surat"]').val(data.result.jenis_surat);
            $('input[name="nomor_surat"]').val(data.result.nomor_surat);
            $('input[name="tanggal_surat"]').val(data.result.tanggal_surat);
            $('input[name="perihal"]').val(data.result.perihal);
            $('textarea[name="isi_surat"]').val(data.result.isi_surat);
            $('select[name="sifat_surat"]').val(data.result.sifat_surat);
            $('select[name="klasifikasi_surat"]').val(data.result.klasifikasi_surat);
            $('select[name="derajat_keamanan"]').val(data.result.derajat_keamanan);
            $('input[name="tempat_pembuatan"]').val(data.result.tempat_pembuatan);
            $('input[name="jabatan_pembuat"]').val(data.result.jabatan_pembuat);
            $('textarea[name="catatan_tambahan"]').val(data.result.catatan_tambahan);
            $('#editSuratModal').modal('show');
        });
    });

    // Simpan Perubahan
    $('#editSuratForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#edit_id').val();
        var formData = new FormData(this);

        $.ajax({
            url: "/surat/update/" + id,
            method: 'POST',
             formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#editSuratModal').modal('hide');
                table.ajax.reload(); // Refresh DataTable
                toastr.success(response.message);
            },
            error: function (xhr) {
                toastr.error('Gagal memperbarui surat.');
            }
        });
    });
  
 </script>
 @endpush