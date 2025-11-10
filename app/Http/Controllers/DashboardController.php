<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NotaDinas; // Contoh model


class DashboardController extends Controller
{
     public function index()
    {
//   dd(Auth::check(), Auth::user());
//    $inisial=Auth::user()->nama_lengkap;
//    dd($inisial);

    // dd('Anda sudah login sebagai: ' . Auth::user()->name);
        // Ambil data dari model, misalnya 5 posting terbaru
        $surat = DB::table('surat_masuk')->count();
        $notdin = DB::table('nota_dinas')->count();
        $notdis = DB::table('disposisi_nota')->count();
// dd($notdin);



    $data = Surat::selectRaw('month(tanggal_surat) as month, year(tanggal_surat) as year, count(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
        // dd($data);
        // Kirim data ke view
        return view('v_home', compact('notdin','surat','notdis','data'));
    }
}
