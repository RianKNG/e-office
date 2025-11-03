<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotaDinasCon extends Controller
{
    public function index()
    {
        return view('notadinas.v_index');
    }

    public function semua()
    {
        $notadinas = DB::table('nota_dinas as dn')
            ->select('dn.*', 'dna.nama_lengkap as nama')
            ->leftJoin('users as dna', 'dna.id', '=', 'dn.created_by')
            ->get();

        return response()->json(['data' => $notadinas]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_nota' => 'required|date',
            'perihal'      => 'required|string|max:255',
            'isi_nota'     => 'required|string',
            'status',
            'created_by'   => 'nullable|integer|exists:users,id',
            'approved_by'  => 'nullable|integer|exists:users,id',
            'lampiran'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Generate nomor nota
        $tanggal = Carbon::parse($validated['tanggal_nota']);
        $bulan = $tanggal->format('m');
        $tahun = $tanggal->format('Y');
        $prefix = 'ND';

        $lastNumber = NotaDinas::whereMonth('tanggal_nota', $bulan)
            ->whereYear('tanggal_nota', $tahun)
            ->count();

        $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $nomorNota = "{$prefix}/{$nomorUrut}/{$bulan}/{$tahun}";

        // Siapkan data untuk insert
        $data = [
            'nomor_nota'   => $nomorNota,
            'tanggal_nota' => $validated['tanggal_nota'] ?? null,
            'perihal'      => $validated['perihal'] ?? null,
            'isi_nota'     => $validated['isi_nota'] ?? null,
            'status'       => $validated['status'] ?? null,
            'created_by'   => $validated['created_by'] ?? null,
            'approved_by'  => $validated['approved_by'] ?? null,
        ];

        // Simpan data
        $notadinas = NotaDinas::create($data);

        // Simpan lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lemari'), $filename);
            $notadinas->update(['lampiran' => $filename]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Nota dinas berhasil disimpan.',
            'data'    => $notadinas
        ]);
    }

    public function edit($id)
    {
        $nota = DB::table('nota_dinas as dn')
            ->select('dn.*', 'dna.nama_lengkap as nama')
            ->leftJoin('users as dna', 'dna.id', '=', 'dn.created_by')
            ->where('dn.id', $id)
            ->first();

        if (!$nota) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        return response()->json($nota);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_nota'   => 'required|string',
            'tanggal_nota' => 'required|date',
            'perihal'      => 'required|string|max:255',
            'isi_nota'     => 'required|string',
            'status'       => 'required|string',
            'created_by'   => 'nullable|integer|exists:users,id',
            'approved_by'  => 'nullable|integer|exists:users,id',
            'lampiran'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $notadinas = NotaDinas::findOrFail($id);

        // Update data dasar
        $notadinas->update([
            'nomor_nota'   => $validated['nomor_nota'],
            'tanggal_nota' => $validated['tanggal_nota'],
            'perihal'      => $validated['perihal'],
            'isi_nota'     => $validated['isi_nota'],
            'status'       => $validated['status'],
            'created_by'   => $validated['created_by'] ?? null,
            'approved_by'  => $validated['approved_by'] ?? null,
        ]);

        // Update lampiran jika diupload
        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($notadinas->lampiran && file_exists(public_path('lemari/' . $notadinas->lampiran))) {
                unlink(public_path('lemari/' . $notadinas->lampiran));
            }

            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lemari'), $filename);
            $notadinas->update(['lampiran' => $filename]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $notadinas = NotaDinas::find($id);

        if (!$notadinas) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        // Hapus file lampiran jika ada
        if ($notadinas->lampiran && file_exists(public_path('lemari/' . $notadinas->lampiran))) {
            unlink(public_path('lemari/' . $notadinas->lampiran));
        }

        $notadinas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Nota dinas berhasil dihapus.'
        ]);
    }
}