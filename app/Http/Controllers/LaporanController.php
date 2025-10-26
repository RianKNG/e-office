<?php

namespace App\Http\Controllers;


use App\Models\Laporan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf; // jika pakai dompdf
use App\Exports\LaporanExport; // pastikan sudah buat export class
use Maatwebsite\Excel\Facades\Excel; // jika pakai maatwebsite/excel

class LaporanController extends Controller
{
    public function laporan()
    {
      
        $surat = DB::table('surat_masuk')->count();
        $notadinas = DB::table('nota_dinas')->count();
        $disposisi = DB::table('disposisi_nota')->count();
        $suratkeluar = 000000;
        $notdindraf = DB::table('nota_dinas')->where('status', 'draf')->count();
          $notdindisetujui = DB::table('nota_dinas')->where('status', 'disetujui')->count();
            $notdinmenunggu = DB::table('nota_dinas')->where('status', 'menunggu')->count();
              $notdinselesai = DB::table('nota_dinas')->where('status', 'selesai')->count();




              //===========================disnot==========================
              $smmenunggu = DB::table('disposisi')->where('status', 'menunggu')->count();
            $smdiproses = DB::table('disposisi')->where('status', 'diproses')->count();
              $smselesai = DB::table('disposisi')->where('status', 'selesai')->count();


        
        
        return view('laporan.index',compact('surat','notadinas','disposisi','suratkeluar',
                    'notdindraf','notdindisetujui','notdinmenunggu','notdinselesai','smmenunggu',
                    'smdiproses','smselesai'));
    }
    public function index()
    {
        // Tampilkan form filter
        return view('laporan.index');
    }

    public function generate(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_laporan' => 'nullable|string',
            'periode' => 'required|string|in:Bulanan,Tahunan,Harian',
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ]);

        // Ambil data berdasarkan filter
        $filters = $request->only(['jenis_laporan', 'periode', 'dari_tanggal', 'sampai_tanggal']);

        $data = Laporan::filterBy($filters)->get();

        // Kirim ke view untuk ditampilkan
        return view('laporan.hasil', compact('data', 'filters'));
    }

    public function exportPdf(Request $request)
    {
        $this->validate($request, [
            'jenis_laporan' => 'nullable|string',
            'periode' => 'required|string|in:Bulanan,Tahunan,Harian',
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ]);

        $filters = $request->only(['jenis_laporan', 'periode', 'dari_tanggal', 'sampai_tanggal']);
        $data = Laporan::filterBy($filters)->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'filters'));
        return $pdf->download('laporan_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $this->validate($request, [
            'jenis_laporan' => 'nullable|string',
            'periode' => 'required|string|in:Bulanan,Tahunan,Harian',
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ]);

        $filters = $request->only(['jenis_laporan', 'periode', 'dari_tanggal', 'sampai_tanggal']);

        return Excel::download(new LaporanExport($filters), 'laporan_' . now()->format('Ymd_His') . '.xlsx');
    }
}

