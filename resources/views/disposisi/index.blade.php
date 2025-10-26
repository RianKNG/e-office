
@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                      <!-- Content Row -->
                    <div class="row">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

  <div class="col-lg-8">

    <div class="card shadow mb-4">
        
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Disposisi</h6> 
            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div> 
        
        <div class="card-body">
            
            <div id="status-pesan" class="mb-3"></div> 
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Disposisi</th>
                            <th>Dari User</th>
                            <th>Kepada User</th>
                            <th>Instruksi</th>
                            <th>Nomor Surat</th>
                            <th>Batas Waktu</th>
                            <th>Priotitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nota Dinas Saya</h6>
        </div>
        <div class="card-body">
            Konten tambahan atau informasi pendukung.
        </div>
    </div>
</div>
@include('disposisi._add_modal')
@include('disposisi._edit_modal')
@endsection
@push('disposisi')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    xhrFields:{
                        withCredentials:'true',
                    }
                })
                // -------------------------------------startget all from data--------------------------------------
        function allData(){
            
        
            $.ajax({
              type : "GET",
              dataType: "json",
              url: "{{ url('/disposisi/all') }}",
              beforeSend:function(){
              // Tampilkan pesan loading
        $('#status-pesan').html('Mengirim data, mohon tunggu...');
        $(".loader-div").show(); // Tampilkan loader
              },
                success:function(response){
                  // Menampilkan pesan sukses
        $('#status-pesan').html('Data berhasil dikirim!');
            
                    var data ="";
                     // Deklarasikan variabel nomor urut di sini
                   
                   $.each(response, function(key,value){
                    // Gunakan 'key + 1' sebagai nomor urut
                    var nomor_urut = key + 1; // Deklarasikan variabel nomor urut di sini

                    data =data + "<tr>" // Tambahkan pembuka <tr> untuk setiap baris

                    // Nomor urut otomatis
                    data =data+"<td>"+nomor_urut+"</td>" // <-- DIGANTI DENGAN 'nomor_urut'

                    data =data+"<td>"+value.nomor_disposisi+"</td>"
                    // data =data+"<td>"+value.id_surat_masuk+"</td>"
                    data =data+"<td>"+value.dari_user+"</td>"
                    data =data+"<td>"+value.kepada_user+"</td>"
                    data =data+"<td>"+value.instruksi+"</td>"
                    data =data+"<td>"+value.catatan+"</td>"
                    data =data+"<td>"+value.batas_waktu+"</td>"
                    data =data+"<td>"+value.prioritas+"</td>"
                    data =data+"<td>"+value.status+"</td>"

                    data =data+"<td>"
                    data =data+"<button class='btn btn-primary btn-sm-2 mr-2' data-toggle='modal' data-target='#editModal' onclick='editData("+value.id+")'>edit</button>"
                    data =data+"<button class='btn btn-danger btn-sm-2' onclick='deleteData("+value.id+")'>dlt</button>"
                    data =data+"</td>"
                    data =data+"</tr>"
                    })
                    $('tbody').html(data);
                    setTimeout(function() {
            $('#status-pesan').html(''); 
        }, 3000)
                }
            })
        }
        allData();

        // -------------------------------------start add from data--------------------------------------
function addData(){
    // 1. Ambil data dari semua field input
    var nomor_disposisi = $('#add_nomor_disposisi').val(); // and
    var surat_masuk = $('#add_id_surat_masuk').val();     // asm (diperbaiki dari asm)
    var dari_user = 1;           // aiu (diperbaiki dari aiu)
    var kepada_user = 1;       // aku
    var instruksi = $('#add_instruksi').val();           // ain
    var catatan = $('#add_catatan').val();               // aca
    var batas_waktu = $('#add_batas_waktu').val();       // abw
    var prioritas = $('#add_prioritas').val();           // apr
    var status = $('#add-status').val();                 // ast

    // Ambil nilai dari field tambahan
    var created_by = $('#edit_created_by').val();
    
    // Ambil CSRF Token dari form (Anda sudah punya @csrf di form)
    var csrf_token = $('input[name="_token"]').val(); 

    // 2. Kirimkan data menggunakan AJAX
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/disposisi/add",
        
        // Objek data berisi SEMUA variabel yang ingin Anda kirim
        data: {
            _token: csrf_token, // WAJIB untuk POST di Laravel
            nomor_disposisi: nomor_disposisi,
            id_surat_masuk: 2,
            dari_user: 2,
            kepada_user: 1,
            instruksi: instruksi,
            catatan: catatan,
            batas_waktu: batas_waktu,
            prioritas: prioritas,
            status: status,
            created_by: created_by
            // Jika ada field lain, tambahkan di sini
        },
        
        success: function(data){
            console.log('Data Berhasil Ditambahkan');
            
            // Tutup modal setelah sukses
            $('#exampleModal').modal('hide'); 
            
            // Bersihkan form (jika fungsi clearData() tersedia)
            // clearData(); 
            
            // Muat ulang data tabel
            allData(); 
        },
        
        error: function(error){
            // Tampilkan pesan error validasi (jika server mengirimkan response JSON errors)
            if (error.responseJSON && error.responseJSON.errors) {
                 $.each(error.responseJSON.errors, function(key, value){
                    // Contoh: tampilkan error di console
                    console.error(key + ': ' + value);
                    // Anda bisa menampilkan error di bawah field form yang sesuai
                 });
            } else {
                 console.error("Terjadi kesalahan server.");
            }
        }
    });
}
// -------------------------------------end add from data--------------------------------------
       // -------------------------------------end add from data--------------------------------------
</script>
@endpush

