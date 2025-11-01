<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\NotaDinas;
use App\Models\User;
use App\Models\Disposisi;
use App\Models\DisposisiNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DisposisiCon extends Controller
{
    public function index()
{
    // Ambil disposisi surat masuk
    $suratDisposisi = \App\Models\Disposisi::with(['surat', 'dari', 'kepada'])
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'jenis' => 'surat',
                'nomor_disposisi' => $item->nomor_disposisi,
                'nomor_dokumen' => $item->surat->nomor_surat ?? '—',
                'dari_user_id' => $item->dari_user,
                'kepada_user_id' => $item->kepada_user,
                'dari_nama' => optional($item->dari)->nama_lengkap ?? optional($item->dari)->username ?? '—',
                'kepada_nama' => optional($item->kepada)->nama_lengkap ?? optional($item->kepada)->username ?? '—',
                'instruksi' => $item->instruksi,
                'status' => $item->status,
                'prioritas' => $item->prioritas,
                'created_at' => $item->created_at,
                'batas_waktu' => $item->batas_waktu,
                'catatan' => $item->catatan,
            ];
        });

    // Ambil disposisi nota dinas
    $notaDisposisi = \App\Models\DisposisiNota::with(['nota', 'dari', 'kepada'])
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'jenis' => 'nota',
                'nomor_disposisi' => $item->nomor_disposisi,
                'nomor_dokumen' => $item->nota->nomor_nota ?? '—',
                'dari_user_id' => $item->dari_user,
                'kepada_user_id' => $item->kepada_user,
                'dari_nama' => optional($item->dari)->nama_lengkap ?? optional($item->dari)->username ?? '—',
                'kepada_nama' => optional($item->kepada)->nama_lengkap ?? optional($item->kepada)->username ?? '—',
                'instruksi' => $item->instruksi,
                'status' => $item->status,
                'prioritas' => $item->prioritas,
                'created_at' => $item->created_at,
                'batas_waktu' => $item->batas_waktu,
                'catatan' => $item->catatan,
            ];
        });

    // Gabungkan
    $gabungan = $suratDisposisi->merge($notaDisposisi)
        ->sortByDesc('created_at')
        ->values();

    // Statistik
    $stats = [
        'total' => $gabungan->count(),
        'menunggu' => $gabungan->where('status', 'menunggu')->count(),
        'selesai' => $gabungan->where('status', 'selesai')->count(),
        'pegawai_aktif' => \App\Models\User::where('status', 'aktif')->count(),
    ];

    // Data untuk dropdown
    $users = \App\Models\User::all();
    $suratList = \App\Models\Surat::all()->pluck('nomor_surat', 'id');
    $notaList = \App\Models\NotaDinas::all()->pluck('nomor_nota', 'id');

    return view('disposisi.index', compact(
        'gabungan', 
        'stats', 
        'users', 
        'suratList', 
        'notaList'
    ));
}
}