<?php

namespace App\Http\Controllers;

use App\Models\Jadi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator; // Import Validator

class JadiCon extends Controller
{
    public function tampil()
    {
        //  $data = Jadi::orderBy('created_at', 'desc')->get();
        //  dd($data);
        return view('jadi.index');
    }
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'letter_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); //
        }

        $data = Jadi::create($request->all());

        return response()->json(['message' => 'Jdi Coba berhasil disimpan!', 'data' => $data]); //
    }

  
}
