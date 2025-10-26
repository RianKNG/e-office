<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NotaDinas; // Contoh model


class DashboardController extends Controller
{
     public function index()
    {
        // Ambil data dari model, misalnya 5 posting terbaru
        $surat = DB::table('surat_masuk')->count();
        $notdin = DB::table('nota_dinas')->count();
        $notdis = DB::table('disposisi_nota')->count();
// dd($notdin);
        // Kirim data ke view
        return view('v_home', compact('notdin','surat','notdis'));
    }
}
