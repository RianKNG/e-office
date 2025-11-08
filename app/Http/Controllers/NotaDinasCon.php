<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class NotaDinasCon extends Controller
{
    public function index()
    {
        // $data = NotaDinas::orderBy('id','ASC')->get();
        // $data=DB::table('nota_dinas as dn')
        // ->select(['dn.*','dna.nama_lengkap'
        //   ])
        //    ->leftJoin('users as dna','dna.id','=','dn.created_by')->get();
        // // dd($data);
        return view('notadinas.v_index');
    }
     public function semua()
    {
        // $data = NotaDinas::orderBy('id','ASC')->get();
        $notadinas=DB::table('nota_dinas as dn')
        ->select(['dn.*','dna.nama_lengkap as nama'])
           ->leftJoin('users as dna','dna.id','=','dn.created_by')->get();
        // dd($notadinas);
        // return view('data.v_index',compact('data'));
        // $notadinas=NotaDinas::all();
        return response()->json(['data'=>$notadinas]);
    }
   
     public function updateStatus(Request $request)
        {
//   $request->validate([
//         'id' => 'required|exists:notadinas,id',
//         'status' => 'required|in:disetujui,ditunda,ditolak'
//     ]);

    NotaDinas::where('id', $request->id)->update(['status' => $request->status]);

    return response()->json(['message' => 'Status berhasil diperbarui']);
    }
    
    public function edit($id)
{
     $nota=DB::table('nota_dinas as dn')
        ->select(['dn.*','dna.nama_lengkap as nama'])
    
           ->leftJoin('users as dna','dna.id','=','dn.created_by')
           
        ->where('dn.id', $id)
        ->first();
    //  $nota = NotaDinas::findOrFail($id);
         return response()->json($nota);
    }
    
   
    public function update(Request $request, $id)
    {
   
     $request->validate([
            
            'nomor_nota'=>'required',
            'tanggal_nota',
            'perihal'=>'required',
            'isi_nota',
            'lampiran',
            'status'=>'required',
            'created_by', 
            'approved_by']);

    // Ambil data lama untuk hapus file jika diganti
    // $notaLama = DB::table('nota_dinas')->where('id', $id)->first();

     $data = NotaDinas::findOrFail($id)->update([
            
             'nomor_nota'=>$request->nomor_nota,
            'tanggal_nota'=>$request->tanggal_nota,
            'perihal'=>$request->perihal,
            'isi_nota' =>$request->isi_nota,
            'lampiran'=>$request->lampiran,
            'status'=>$request->status,
            'created_by'=>$request->created_by, 
            'approved_by'=>$request->approved_by,
            'approved_at'=>$request->approved_at,
            // 'created_at'=>$request->created_at,

         ]);

    if ($data) {
        return response()->json(['message' => 'Data dan lampiran berhasil diperbarui.']);
    }

    return response()->json(['message' => 'Tidak ada perubahan.'], 200);
}

    
    // public function update(Request $request,$id)
    // {
    //     $data = NotaDinas::find($id);
    //     $data->update($request->all());
    //     return response()->json($data);
    // }
    public function delete(Request $request) {
		$id = $request->id;
		$notdin = NotaDinas::find($id);
		if (Storage::delete('public/lemari/' . $notdin->lampiran)) {
			NotaDinas::destroy($id);
		}
	}
    public function storeDisposisi(Request $request, $id)
    {
        $request->validate([
            'nomor_disposisi' => 'required',
            'instruksi' => 'required',
             'catatan' => 'required',
            'batas_waktu' => 'required',
             'prioritas' => 'required',
            'status' => 'required',
        ]);

        DB::table('disposisi_nota')->insert([
             'nomor_disposisi'=> $request->nomor_disposisi,
            'id_nota_dinas'   => $id,
            'dari_user'         => 1, // atau bisa $request->user_id kalau manual
            'kepada_user'     => $id,
            'instruksi'   => $request->instruksi,
            'catatan'=> $request->catatan,
            'prioritas'=> $request->prioritas,
            'status'=> $request->status,
            // 'created_at'      => now(),
            // 'updated_at'      => now(),
        ]);

        return response()->json(['message' => 'Disposisi berhasil ditambahkan!']);
    }

    public function getDisposisi($id)
    {
        $data = DB::table('disposisi_nota as d')
            ->leftJoin('users as u', 'u.id', '=', 'd.dari_user')
            ->leftJoin('users as u', 'u.id', '=', 'd.kepada_user')
            ->select('d.id', 'd.tujuan_disposisi', 'd.nomor_disposisi','d.catatan','d.instruksi','d.batas_waktu','d.prioritas','d.status','u.name as nama_user', 'd.created_at','d.updated_at')
            ->where('d.nota_dinas_id', $id)
            ->orderBy('d.created_at', 'desc')
            ->get();

        return response()->json($data);
    }
//     public function store(Request $request)
// {
//     $request->validate([
//         'tanggal_nota' => 'required|date',
//         'perihal'      => 'required|string|max:255',
//         'isi_nota'     => 'required|string',
//           'lampiran'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
//         'status'       => 'required|string',
//         'created_by'   => 'nullable|integer',
//         'approved_by'  => 'nullable|integer',
      
//     ]);

//     $tanggalNota = Carbon::parse($request->tanggal_nota);
//     $bulan = $tanggalNota->format('m');
//     $tahun = $tanggalNota->format('Y');
//     $prefix = 'ND';

//     $lastNumber = NotaDinas::whereMonth('tanggal_nota', $bulan)
//         ->whereYear('tanggal_nota', $tahun)
//         ->count();

//     $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
//     $nomorNota = "{$prefix}/{$nomorUrut}/{$bulan}/{$tahun}";

//     // Simpan data dasar
//     $notadinas = NotaDinas::create([
//         'nomor_nota'   => $nomorNota,
//         'tanggal_nota' => $request->tanggal_nota,
//         'perihal'      => $request->perihal,
//         'isi_nota'     => $request->isi_nota,
//         'status'       => $request->status,
//         'created_by'   => $request->created_by,
//         'approved_by'  => $request->approved_by,
//         'lampiran'     => $request->lampiran,
//     ]);


//      if ($request->hasFile('lampiran')) {
//         $file = $request->file('lampiran');
//         $filename = time() . '_' . $file->getClientOriginalName(); // tambah timestamp agar unik
//         $file->move(public_path('lemari'), $filename); // ✅ gunakan public_path()
//         $notadinas->lampiran = $filename;
//            $notadinas->update(['lampiran' => $filename]); // ✅ gunakan update()
//         }
//     // Jika ada file, update
//     // if ($request->hasFile('lampiran')) {
//     //     $file = $request->file('lampiran');
//     //     $filename = time() . '_' . $file->getClientOriginalName();
//     //     $file->move(public_path('lemari'), $filename);
//     //     $notadinas->update(['lampiran' => $filename]); // ✅ gunakan update()
//     // }

//     return response()->json(['success' => true, 'message' => 'Nota dinas berhasil disimpan.']);
// }
// }
 public function store(Request $request)
{
    $request->validate([
        // 'nomor_nota'   => 'required|string|max:50',
        'tanggal_nota' => 'required|date',
        'perihal'      => 'required|string',
        'isi_nota'     => 'required|string',
        'lampiran' => 'nullable|file|max:10240', // max 10MB
        'status'       => 'nullable|string',
        'created_by'   => 'required|integer',
        'approved_by'  => 'required|integer',
    ]);
        $tanggalNota = Carbon::parse($request->tanggal_nota);
    $bulan = $tanggalNota->format('m');
    $tahun = $tanggalNota->format('Y');
    $prefix = 'ND';

    $lastNumber = NotaDinas::whereMonth('tanggal_nota', $bulan)
        ->whereYear('tanggal_nota', $tahun)
        ->count();

    $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    $nomorNota = "{$prefix}/{$nomorUrut}/{$bulan}/{$tahun}";


    try {
        $lampiranPath = null;

        if ($request->hasFile('lampiran') && $request->file('lampiran')->isValid()) {
            // Simpan file ke folder public/lampiran/
            $lampiranPath = $request->file('lampiran')->storeAs(
                'lampiran', // folder tujuan
                time() . '_' . $request->file('lampiran')->getClientOriginalName(), // nama unik
                'public' // disk
            );
        }

        $nota = NotaDinas::create([
          'nomor_nota'   => $nomorNota,
            'tanggal_nota' => $request->tanggal_nota,
            'perihal'      => $request->perihal,
            'isi_nota'     => $request->isi_nota,
            'lampiran'     => $lampiranPath, // simpan nama file, bukan path sementara!
            'status'       => $request->status,
            'created_by'   => $request->created_by,
            'approved_by'  => $request->approved_by,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nota dinas berhasil disimpan.',
            'data'    => $nota
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage()
        ], 500);
    }
}
}   

