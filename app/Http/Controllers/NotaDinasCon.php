<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function addData(Request $request)
    {

         $request->validate([
                    'nomor_nota' => $request->nomor_nota, 
                    'tanggal_nota' => $request->tanggal_nota, 
                    'perihal' => $request->perihal, 
                    'isi_nota' => $request->isi_nota, 
                    'lampiran' => $request->lampiran,
                    // 'berkas_surat' => 'required|mimes:jpeg,png,jpg,gif|max:2048', // Membatasi ke tipe gambar tertentu dan ukuran maks 2MB
                    'status' => $request->status, 
                    'created_by' => $request->created_by, 
                    'approved_by' => $request->approved_by, 
                    'approved_at' => $request->approved_at, 
                    'post' => $request->isi_nota, 
                    'created_at' => $request->created_at
         ]);
            $data = NotaDinas::create($request->all());
        //          if($request->file('berkas_surat')){
        //             $request->file('berkas_surat')->move('lemari/', $request->file('berkas_surat')->getClientOriginalName());
        //             $data->berkas_surat=$request->file('berkas_surat')->getClientOriginalName();
        //             $data->save();
        // }
         return response()->json($data);
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
    // handle insert a new employee ajax request
	public function store(Request $request) {
		$file = $request->file('lampiran');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storage('public/lemari', $fileName);
		$empData = ['id' => $request->id, 
                    'nomor_nota' => $request->nomor_nota, 
                    'tanggal_nota' => $request->tanggal_nota, 
                    'perihal' => $request->perihal, 
                    'isi_nota' => $request->isi_nota, 
                    'lampiran' => $request->lampiran, 
                    'status' => $request->status, 
                    'created_by' => $request->created_by, 
                    'approved_by' => $request->approved_by, 
                    'approved_at' => $request->approved_at, 
                    'post' => $request->isi_nota, 
                    'created_at' => $request->created_at];
		NotaDinas::create($empData);
		return response()->json([
			'status' => 200,
		]);
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
    
    // $nota = NotaDinas::findOrFail($id);
    // dd($nota);
    // public function updateData(Request $request)
    // {
    //     $fileName = '';
	// 	$notdin = NotaDinas::find($request->id);
	// 	if ($request->hasFile('lampiran')) {
	// 		$file = $request->file('lampiran');
	// 		$fileName = time() . '.' . $file->getClientOriginalExtension();
	// 		$file->storeAs('public/lemari', $fileName);
	// 		if ($notdin->lampiran) {
	// 			Storage::delete('public/lemari/' . $notdin->lampiran);
	// 		}
	// 	} else {
	// 		$fileName = $request->lampiran;
	// 	}
	// 	$notdinData = ['id' => $request->id, 
    //                 'nomor_nota' => $request->nomor_nota, 
    //                 'tanggal_nota' => $request->tanggal_nota, 
    //                 'perihal' => $request->perihal, 
    //                 'isi_nota' => $request->isi_nota, 
    //                 'lampiran' => $request->lampiran, 
    //                 'status' => $request->status, 
    //                 'created_by' => $request->created_by, 
    //                 'isi_notat' => $request->isi_nota, 
    //                 'approved_by' => $request->approved_by, 
    //                 'approved_at' => $request->approved_at, 
    //                 'post' => $request->isi_nota, 
    //                 'avatar' => $fileName];
    //     $notdin->update($notdinData);
	// 	return response()->json([
	// 		'status' => 200,
	// 	]);
	// }
    
    public function update(Request $request, $id)
    {
    //    $request->validate([
    //     'nomor_nota' => 'required|string|max:100',
    //     'tanggal_nota' => 'required|date',
    //     'perihal' => 'required|string',
    //     'isi_nota' => 'required|string',
    //      'lampiran_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // max 10MB
    //     'status' => 'required|in:disetujui,ditunda,ditolak',
    //     'created_by' => 'string',
    //     'approved_by' => 'string',
    //     'approved_at' => 'string',
    //    'created_at' => 'required|date',
    // ]);
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
    
}
