@extends('layout.v_template')
@section('title','Laporan')
@section('bawah','Laporan')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
                            <div class="card shadow mb-4">
    <div class="card">
        <div class="card-header">
            <h5>Filter Laporan</h5>
        </div>
        <div class="card-body">
             <form action="{{ route('laporan.generate') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Jenis Laporan</label>
                        <select name="jenis_laporan" class="form-control">
                            <option value="Semua Dokumen">Semua Dokumen</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                            <!-- tambahkan opsi lain -->
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Periode</label>
                        <select name="periode" class="form-control">
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                            <option value="Harian">Harian</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Dari Tanggal</label>
                        <input type="text" name="dari_tanggal" class="form-control" value="01/10/2025" placeholder="DD/MM/YYYY">
                    </div>

                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                        <input type="text" name="sampai_tanggal" class="form-control" value="31/10/2025" placeholder="DD/MM/YYYY">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-chart-bar"></i> Generate Laporan
                    </button>

                      <a href="{{ route('laporan.export.pdf') }}?{{ http_build_query(request()->all()) }}" 
                       class="btn btn-outline-secondary">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>

                    <a href="{{ route('laporan.export.excel') }}?{{ http_build_query(request()->all()) }}" 
                       class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                   
                </div>
            </form>
        </div>
    </div>
</div>


</div>
 <!-- Approach -->

   <div class="container-fluid">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                                                Surat Masuk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $surat }}</div>
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
                                                Surat Keluar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suratkeluar}}</div>
                                          
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
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nota Dinas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                           
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$notadinas}}</div>
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

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Disposisi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$disposisi}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Status Surat Masuk</h6>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-number text-info">{{$smmenunggu}}</div>
                                <small>menunggu</small>
                            </div>
                            <div class="col-4">
                                <div class="stat-number text-warning">{{$smdiproses}}</div>
                                <small>Diproses</small>
                            </div>
                            <div class="col-4">
                                <div class="stat-number text-success">{{$smselesai}}</div>
                                <small>Selesai</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Status Nota Dinas</h6>
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="stat-number text-secondary">{{$notdindraf}}</div>
                            <small>Draft</small>
                            </div>
                            <div class="col-3">
                                <div class="stat-number text-warning">{{$notdinmenunggu}}</div>
                                <small>Menunggu</small>
                            </div>
                            <div class="col-3">
                                <div class="stat-number text-info">{{$notdindisetujui}}</div>
                                <small>Disetujui</small>
                            </div>
                            <div class="col-3">
                                <div class="stat-number text-success">{{$notdinselesai}}</div>
                                <small>Selesai</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        
    <!-- <div class="container-fluid"> -->
    <div class="row g-0">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <!-- 1. Card Header - Hanya untuk Judul -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Visualisasi Data</h6>
                    <!-- ELEMEN CHART HIGHCHARTS DIHAPUS DARI SINI -->
                </div>

                <!-- 2. Card Body - Tempatkan Grafik di sini agar mendapat lebar penuh -->
                <div class="card-body">
                    
                    <!-- Highcharts Figure (Grafik Batang) dipindahkan ke sini -->
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>

                    <!-- Elemen Chart Canvas (jika ini adalah chart terpisah, pertahankan) -->
                    <!-- Jika Anda hanya ingin menampilkan chart dari Highcharts di atas, Anda bisa menghapus bagian chart-area ini. -->
                    <!-- Jika ini adalah bagian dari chart lain (misalnya Chart.js), biarkan saja. -->
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('grafik')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/themes/adaptive.js"></script>


<script>
      let a =  {!! json_encode($surat) !!};
         let b =  {!! json_encode($disposisi) !!};
            let c =  {!! json_encode($notadinas) !!};
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Data Surat'
    },
    subtitle: {
        text: '<?php
                    echo "Today is " . date("Y/m/d") . "<br>";
                ?>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b>{point.y:.1f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Browsers',
            colorByPoint: true,
            data: [
                {
                    name: 'Surat Masuk',
                    y: a,
                    // drilldown: 'Surat Masuk'
                },
                {
                    name: 'Nota Dinas',
                    y: c,
                    // drilldown: 'Nota Dinas'
                },
                {
                    name: 'Disposisi',
                    y: b,
                    // drilldown: 'Disposisi'
                }

            ]
        }
    ],

});

</script>
<script>
    // Optional: Gunakan flatpickr atau datepicker untuk input tanggal
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("input[name='dari_tanggal']", { dateFormat: "d/m/Y" });
        flatpickr("input[name='sampai_tanggal']", { dateFormat: "d/m/Y" });
    });
</script>
@endpush