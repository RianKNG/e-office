<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
   // READ: Menampilkan semua surat
    public function index()
    {
        $tests = Test::all();
        // dd($tests);
        return view('tests.crud', compact('tests'));
    }

    // CREATE: Menyimpan surat baru
    public function store(Request $request)
    {       
        // $request->validate([
        //     'template' => 'required',
        //     'data' => 'required',
        // ]);

      
        $test = Test::create([
            'template' => $request->template,
            'data' => $request->except('_token', 'template')
        ]);
       
       
        return response()->json(['success' => true, 'message' => 'test berhasil disimpan.']);
    }
    public function getTemplate(Request $request)
    {
        $templateType = $request->input('type');
        $templateContent = '';

        switch ($templateType) {
            case 'surat_resmi':
                $templateContent = "Yth. Bapak/Ibu,\n\nDengan hormat,\n\nBersama ini kami sampaikan bahwa...\n\nDemikian surat ini kami sampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.\n\nHormat kami,\n\n[Nama Anda]";
                break;
            case 'surat_undangan':
                $templateContent = "Kepada Yth. Bapak/Ibu [Nama Penerima],\n\nDengan hormat,\n\nKami mengundang Bapak/Ibu untuk menghadiri acara...\n\nAcara akan dilaksanakan pada:\nHari/Tanggal: [Hari/Tanggal]\nWaktu: [Waktu]\nTempat: [Tempat]\n\nAtas kehadiran Bapak/Ibu, kami mengucapkan terima kasih.\n\nHormat kami,\n\n[Panitia Acara]";
                break;
            case 'surat_internal':
                $templateContent = "Kepada:\nDari:\nHal:\nTanggal:\n\nDengan ini diberitahukan bahwa...\n\nDemikian, untuk menjadi perhatian dan dilaksanakan.";
                break;
            default:
                $templateContent = "Pilih template untuk melihat isinya.";
                break;
        }

        return response()->json([
            'content' => $templateContent
        ]);
    }
public function add(Request $request)
    {
       
         $data = Test::insert([
            'template' => $request->template,
            'wilayah' => $request->data,
       


         ]);
         $data = Test::create($request->all());
// dd($data);
         return response()->json($data);
    }

    // UPDATE: Menampilkan form edit untuk test
    public function edit(Test $test)
    {
        return response()->json($test);
    }

    // UPDATE: Memperbarui test
    public function update(Request $request, Test $test)
    {
        $test->update([
            'template' => $request->template,
            'data' => $request->except('_token', 'template', '_method')
        ]);
        return response()->json(['success' => true, 'message' => 'test berhasil diperbarui.']);
    }

    // DELETE: Menghapus test
    public function destroy(Test $test)
    {
        $test->delete();
        return response()->json(['success' => true, 'message' => 'test berhasil dihapus.']);
    }

    // Pemilihan Template & Pratinjau
    public function preview(Request $request)
    {
        return $request->all();
        $template = $request->input('subject');
        $data = $request->except('template', '_token');

        $renderedHtml = View::make('tests.templates.' . $template, ['data' => $data])->render();

        return response()->json(['html' => $renderedHtml]);
    }
}