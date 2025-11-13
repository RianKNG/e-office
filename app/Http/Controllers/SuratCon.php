<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuratCon extends Controller
{
    public function index()
    {
        $coba = User::all();
        return view('surat.index', compact('coba'));
    }
    public function tambah(Request $request)
{
    $request->validate([
        'jenis_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'perihal' => 'required',
        'isi_surat' => 'required',
    ]);

    $tanggalSurat = \Carbon\Carbon::parse($request->tanggal_surat);
    $bulan = $tanggalSurat->format('m');
    $tahun = $tanggalSurat->format('Y');

    $map = [
        'Surat Undangan' => 'SU',
        'Surat Edaran' => 'SE',
    ];
    $prefix = $map[$request->jenis_surat] ?? 'SM';

    $lastNumber = \App\Models\Surat::where('jenis_surat', $request->jenis_surat)
        ->whereMonth('tanggal_surat', $bulan)
        ->whereYear('tanggal_surat', $tahun)
        ->count();

    $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    $nomorSurat = "{$prefix}/{$nomorUrut}/{$bulan}/{$tahun}";

    $data = $request->except('nomor_surat');
    $data['nomor_surat'] = $nomorSurat;

    $surat = \App\Models\Surat::create($data);

    if ($request->file('berkas_surat')) {
        $file = $request->file('berkas_surat');
        $filename = $file->getClientOriginalName();
        $file->move('lemari/', $filename);
        $surat->berkas_surat = $filename;
        $surat->save();
    }

    return response()->json(['message' => 'Surat berhasil ditambahkan!']);
}


    public function tampil(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('surat_masuk as dn')
                ->leftJoin('users as dna', 'dna.id', '=', 'dn.user_id')
                ->select([
                    'dn.id',
                    'dn.nomor_surat',
                    'dn.tanggal_surat',
                    'dn.perihal',
                    'dn.letter_type',
                    'dn.isi_surat',
                    'dn.berkas_surat as bs',
                    'dn.sifat_surat',
                    'dn.klasifikasi_surat',
                    'dn.derajat_keamanan',
                    'dn.tempat_pembuatan',
                    'dn.jabatan_pembuat',
                    'dn.catatan_tambahan',
                    'dn.user_id',
                    'dna.nama_lengkap as nama_lengkap'
                ]);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('berkas_surat', function ($data) {
                    $urlFile = asset('lemari/' . $data->bs);
                    $fileExtension = pathinfo($data->bs, PATHINFO_EXTENSION);

                    if (strtolower($fileExtension) === 'pdf') {
                        return '<a href="#" onclick="showPdf(\'' . $urlFile . '\')"><i class="fa fa-eye"></i> Lihat PDF</a>';
                    } elseif (in_array(strtolower($fileExtension), ['docx', 'doc'])) {
                        $viewerLink = 'https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($urlFile);
                        return '<a href="' . $viewerLink . '" target="_blank"><i class="fa fa-eye"></i> Lihat Word</a>';
                    } else {
                        return '<a href="' . $urlFile . '" download><i class="fa fa-download"></i> Unduh</a>';
                    }
                })
                ->addColumn('aksi', function ($row) {
                    // Tombol langsung dirender dalam string HTML
                    $pdf = '<a href="/surat/download-pdf/' . $row->id . '" class="btn btn-sm btn-danger" title="PDF"><i class="fas fa-file-pdf"></i></a>';
                    $word = '<a href="/surat/download-word/' . $row->id . '" class="btn btn-sm btn-primary" title="Word"><i class="fas fa-file-word"></i></a>';
                    $print = '<a href="/surat/stream/' . $row->id . '" target="_blank" class="btn btn-sm btn-success" title="Cetak"><i class="fas fa-print"></i></a>';
                    $edit = '<button class="btn btn-warning btn-sm tombol-edit" data-id="' . $row->id . '" title="Edit"><i class="fas fa-edit"></i></button>';
                    $hapus = '<button class="btn btn-danger btn-sm tombol-hapus" data-id="' . $row->id . '" title="Hapus"><i class="fas fa-trash"></i></button>';

                    return $pdf . ' ' . $word . ' ' . $print . ' ' . $edit . ' ' . $hapus;
                })
                ->rawColumns(['berkas_surat', 'aksi'])
                ->make(true);
        }

        return view('surat._surat_masuk');
    }

    // ----------------------- EDIT --------------------------
    public function edit($id)
    {
        $data = Surat::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    // ----------------------- UPDATE ------------------------
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update($request->all());
        return response()->json(['message' => 'Surat berhasil diperbarui.']);
    }

    // ----------------------- HAPUS -------------------------
    public function destroy($id)
{
    $surat = Surat::find($id);
    if (!$surat) {
        return response()->json(['message' => 'Surat tidak ditemukan.'], 404);
    }

    $surat->delete();
    return response()->json(['message' => 'Surat berhasil dihapus.']);
}

    // ----------------------- STORE -------------------------
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:Surat Edaran,Surat Undangan,Surat Pengumuman,Surat Tugas,Surat Keputusan,Surat Pemberitahuan',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'isi_surat' => 'required',
        ]);

        $tanggalSurat = Carbon::parse($request->tanggal_surat);
        $bulan = $tanggalSurat->format('m');
        $tahun = $tanggalSurat->format('Y');

        $map = [
            'Surat Undangan' => 'SU',
            'Surat Edaran'   => 'SE',
        ];

        $prefix = $map[$request->jenis_surat] ?? 'SM';

        $lastNumber = Surat::where('jenis_surat', $request->jenis_surat)
            ->whereRaw('MONTH(tanggal_surat) = ?', [$bulan])
            ->whereRaw('YEAR(tanggal_surat) = ?', [$tahun])
            ->count();

        $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $nomorSurat = "{$prefix}/{$nomorUrut}/{$bulan}/{$tahun}";

        $data = $request->except('nomor_surat');
        $data['nomor_surat'] = $nomorSurat;
        

        $surat = Surat::create($data);

        if ($request->file('berkas_surat')) {
            $file = $request->file('berkas_surat');
            $filename = $file->getClientOriginalName();
            $file->move('lemari/', $filename);
            $surat->berkas_surat = $filename;
            $surat->save();
        }

        return redirect()->back()->with('success', 'Surat berhasil ditambahkan!');
    }

    // ------------------- DOWNLOAD PDF / WORD / STREAM -------------------

    public function downloadPdf($id)
    {
        try {
            $surat = Surat::findOrFail($id);

            $cleanNomor = preg_replace('/[\/:*?"<>|\\\\]/', '_', $surat->nomor_surat);
            $fileName = 'Surat_' . Str::slug($cleanNomor, '_') . '.pdf';

            $pdf = PDF::loadView('surat._pdf_template', compact('surat'));
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            \Log::error('Gagal download PDF: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunduh PDF.');
        }
    }

    public function downloadWord($id)
    {
        $surat = Surat::findOrFail($id);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Nomor: {$surat->nomor_surat}", ['bold' => true]);
        $section->addText("Perihal: {$surat->perihal}", ['bold' => true]);
        $section->addTextBreak();
        $section->addText($surat->isi_surat);
        $section->addTextBreak(2);
        $section->addText("{$surat->tempat_pembuatan}, " . \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y'));
        $section->addText($surat->jabatan_pembuat);

        $filename = "Surat_{$surat->nomor_surat}.docx";
        $tempFile = storage_path("app/temp/{$filename}");

        if (!is_dir(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0775, true);
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    public function streamPdf($id)
    {
        $surat = Surat::findOrFail($id);
        $pdf = Pdf::loadView('surat._pdf_template', compact('surat'));
        return $pdf->stream('surat_' . $surat->id . '.pdf');
    }
}
