<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisposisiCon extends Controller
{
    public function index()
    {
        // $data = Disposisi::orderBy('id','ASC')->get();
        // $data = DB::table('disposisi_nota as dn')
        //   ->select(['dn.id','dn.nomor_disposisi','dn.id_nota_dinas','dn.dari_user',
        //             'dn.kepada_user','dn.instruksi','dn.catatan','dn.batas_waktu',
        //             'dn.prioritas','dn.status','dn.created_at','us.username','dna.nomor_nota','sm.nomor_surat'
        //   ])
        //    ->leftJoin('nota_dinas as dna','dna.id','=','dna.id','dna.nomor_nota')
        //    ->leftJoin('users as us','dna.id','=','us.id','us.username')
        //     ->leftJoin('surat_masuk as sm','dna.id','=','sm.id','sm.nomor_surat')
        //    ->get();
        return view('disposisi.index');
    }
      public function allData()
    {
        $data = Disposisi::all();
       
        return response()->json($data);
    }
    public function addData(Request $request)
     {

        //   $request->validate([
        //             'nomor_disposisi' => $request->nomor_disposisi, 
        //             'instruksi' => $request->instruksi, 
        //             'catatan' => $request->catatan, 
        //             'batas_waktu' => $request->batas_waktu, 
        //             'prioritas' => $request->prioritas,
        //             // 'berkas_surat' => 'required|mimes:jpeg,png,jpg,gif|max:2048', // Membatasi ke tipe gambar tertentu dan ukuran maks 2MB
        //             'status' => $request->status, 
                    
        //  ]);
            $data = Disposisi::create($request->all());

         return response()->json($data);
     }
}
