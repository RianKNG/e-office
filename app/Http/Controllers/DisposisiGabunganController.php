<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use App\Models\DisposisiNota;
use App\Models\User;

class DisposisiGabunganController extends Controller
{
    /**
     * Tampilkan halaman disposisi gabungan (surat + nota)
     */
    public function index()
    {
        // Pastikan user sudah login
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['Silakan login terlebih dahulu.']);
        }

        // === Ambil Disposisi Surat Masuk ===
        $suratDisposisi = Disposisi::with(['surat', 'dari', 'kepada'])
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
                    'catatan' => $item->catatan,
                    'batas_waktu' => $item->batas_waktu,
                    'prioritas' => $item->prioritas,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                ];
            });

        // === Ambil Disposisi Nota Dinas ===
        $notaDisposisi = DisposisiNota::with(['nota', 'dari', 'kepada'])
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
                    'catatan' => $item->catatan,
                    'batas_waktu' => $item->batas_waktu,
                    'prioritas' => $item->prioritas,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                ];
            });

        // Gabung dan urutkan
        $gabungan = $suratDisposisi->merge($notaDisposisi)
            ->sortByDesc('created_at')
            ->values();

        // Filter "Disposisi Saya" → hanya yang ditujukan ke user login
        $disposisiSaya = $gabungan->where('kepada_user_id', $userId);

        // Statistik
        $stats = [
            'total' => $gabungan->count(),
            'menunggu' => $gabungan->where('status', 'menunggu')->count(),
            'selesai' => $gabungan->where('status', 'selesai')->count(),
            'pegawai_aktif' => User::where('status', 'aktif')->count(),
        ];

        return view('disposisi.index', compact('gabungan', 'disposisiSaya', 'stats'));
    }

    /**
     * Tampilkan data untuk modal detail
     */
    public function showDetail($jenis, $id)
    {
        if ($jenis === 'surat') {
            $data = Disposisi::with(['surat', 'dari', 'kepada'])->findOrFail($id);
            return response()->json([
                'jenis' => 'surat',
                'nomor_disposisi' => $data->nomor_disposisi,
                'nomor_dokumen' => $data->surat->nomor_surat ?? '—',
                'dari_nama' => optional($data->dari)->nama_lengkap ?? '—',
                'kepada_nama' => optional($data->kepada)->nama_lengkap ?? '—',
                'instruksi' => $data->instruksi,
                'catatan' => $data->catatan,
                'batas_waktu' => $data->batas_waktu,
                'prioritas' => $data->prioritas,
                'status' => $data->status,
                'created_at' => $data->created_at,
            ]);
        } else {
            $data = DisposisiNota::with(['nota', 'dari', 'kepada'])->findOrFail($id);
            return response()->json([
                'jenis' => 'nota',
                'nomor_disposisi' => $data->nomor_disposisi,
                'nomor_dokumen' => $data->nota->nomor_nota ?? '—',
                'dari_nama' => optional($data->dari)->nama_lengkap ?? '—',
                'kepada_nama' => optional($data->kepada)->nama_lengkap ?? '—',
                'instruksi' => $data->instruksi,
                'catatan' => $data->catatan,
                'batas_waktu' => $data->batas_waktu,
                'prioritas' => $data->prioritas,
                'status' => $data->status,
                'created_at' => $data->created_at,
            ]);
        }
    }

    /**
     * Tampilkan form edit (data JSON untuk modal)
     */
    public function showEditForm($jenis, $id)
    {
        if ($jenis === 'surat') {
            $item = Disposisi::with(['surat', 'dari', 'kepada'])->findOrFail($id);
            $dokumen = $item->surat->nomor_surat ?? '—';
        } else {
            $item = DisposisiNota::with(['nota', 'dari', 'kepada'])->findOrFail($id);
            $dokumen = $item->nota->nomor_nota ?? '—';
        }

        return response()->json([
            'jenis' => $jenis,
            'id' => $id,
            'dokumen' => $dokumen,
            'dari_nama' => optional($item->dari)->nama_lengkap ?? '—',
            'kepada_user_id' => $item->kepada_user,
            'instruksi' => $item->instruksi,
            'catatan' => $item->catatan,
            'batas_waktu' => $item->batas_waktu,
            'prioritas' => $item->prioritas,
            'status' => $item->status,
            'users' => User::where('status', 'aktif')->get(),
        ]);
    }

    /**
     * Simpan perubahan disposisi
     */
    public function update(Request $request, $jenis, $id)
    {
        $request->validate([
            'kepada_user' => 'required|exists:users,id',
            'instruksi' => 'required|string',
            'batas_waktu' => 'nullable|date',
            'prioritas' => 'required|in:rendah,sedang,tinggi,segera',
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        if ($jenis === 'surat') {
            $model = Disposisi::findOrFail($id);
        } else {
            $model = DisposisiNota::findOrFail($id);
        }

        $model->update($request->only([
            'kepada_user', 'instruksi', 'catatan', 'batas_waktu', 'prioritas', 'status'
        ]));

        return response()->json(['success' => true]);
    }
}