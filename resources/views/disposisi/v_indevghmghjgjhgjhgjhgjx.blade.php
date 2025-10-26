
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

                            <!-- Roitation Utilities -->
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel Nota Dinas</h6>
                                </div>
                                <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        {{-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Nota DInas</h6>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Surat</th>
                                            <th>Dari User</th>
                                            <th>Kepada User</th>
                                            <th>Instruksi</th>
                                             <th>Nomor Surat</th>
                                            <th>Waktu</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($data as $index => $dn)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td> 
                                            <td>{{ $dn->nomor_disposisi }}</td> 
                                            <td>{{ $dn->username }}</td>
                                            <td>{{ $dn->username }}</td>
                                               <td>{{ $dn->instruksi }}</td>
                                                  <td>{{ $dn->nomor_surat }}</td>
                                                   <td>{{ $dn->created_at }}</td>
                                                   
                                           
                                        </tr>   
                                         @endforeach                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                            </div>

                        </div>
                         <div class="col-lg-4">

                            <!-- Overflow Hidden -->
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Nota Dinas Saya</h6>
                                </div>
                                {{-- <div class="card-body">
                                    Use <code>.o-hidden</code> to set the overflow property of any element to hidden.
                                </div> --}}
                            </div>
                    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
                    {{-- <p class="mb-4">Tabel Nota Dinas
                        </p> --}}

                    

                </div>
                <!-- /.container-fluid -->
            </div>
        </div>
        
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
   $('.tbl_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('notadinas') }}",
        columns: [
            { data: 'id', name: 'id' },
               { data: 'status', name: 'status' },
          
        ]
    });
 });
</script>
@endpush
