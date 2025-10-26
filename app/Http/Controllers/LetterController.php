<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Letter; // Import model Letter
use Illuminate\Support\Facades\Validator; // Import Validator

class LetterController extends Controller
{
    /**
     * Menampilkan daftar surat.
     * Mengembalikan view dengan data surat.
     */
    public function index()
    {
        $letters = Letter::orderBy('created_at', 'desc')->get();
        return view('letters.index', compact('letters'));
    }

    /**
     * Menyimpan surat baru.
     * Mengembalikan JSON response.
     */
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

        $letter = Letter::create($request->all());

        return response()->json(['message' => 'Surat berhasil disimpan!', 'letter' => $letter]); //
    }

    /**
     * Menampilkan detail surat untuk diedit.
     * Mengembalikan JSON response.
     */
    public function edit(Letter $letter)
    {
        return response()->json($letter);
    }

    /**
     * Memperbarui surat yang ada.
     * Mengembalikan JSON response.
     */
    public function update(Request $request, Letter $letter)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'letter_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); //
        }

        $letter->update($request->all());

        return response()->json(['message' => 'Surat berhasil diperbarui!', 'letter' => $letter]);
    }

    /**
     * Menghapus surat.
     * Mengembalikan JSON response.
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();

        return response()->json(['message' => 'Surat berhasil dihapus!']);
    }

    /**
     * Mengambil konten template surat berdasarkan jenisnya.
     * Mengembalikan JSON response.
     */
    public function getTemplate(Request $request)
    {
        $jenisSurat = $request->input('jenis');
        $isiSurat = '';
        

        switch ($jenisSurat) {
            case 'undangan_rapat':
                $isiSurat = "Yth. Bapak/Ibu/Sdr/i,\n\nDengan hormat,\n\nSehubungddddddddddddan akan diadakannya rapat koordinasi, kami mengundang Bapak/Ibu/Sdr/i untuk hadir pada:\n\nHari/Tanggal: [Hari/Tanggal]\nWaktu: [Waktu]\nTempat: [Tempat]\n\nAtas perhatian dan kehadirannya, kami ucapkan terima kasih.\n\nHormat kami,\n[Nama Penanggung Jawab]";
                break;
            case 'permohonan_izin':
                $isiSurat = "Hal: Permohonan Izin\n\nKepada Yth. [Nama Pihak Tertuju],\nDi tempat\n\nDengan hormat,\n\nSaya yang bertanda tangan di bawah ini:\nNama: [Nama Anda]\nJabatan: [Jabatan Anda]\n\nDengan ini mengajukan permohonan izin untuk tidak masuk kerja/kuliah pada tanggal [Tanggal Izin] dikarenakan [Alasan Izin].\n\nDemikian permohonan ini saya sampaikan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.\n\nHormat saya,\n\n[Nama Anda]";
                break;
            case 'pemberitahuan':
                $isiSurat = "Nomor: [Nomor Surat]\nPerihal: Pemberitahuan\n\nKepada Yth. [Pihak Penerima],\n\nBersama ini kami beritahukan bahwa akan diadakan [Kegiatan] pada [Tanggal Kegiatan].\n\nDemikian untuk diketahui dan dilaksanakan.\n\n[Kota], [Tanggal]\n[Jabatan],\n\n[Nama Pejabat]";
                break;
            default:
                $isiSurat = "Pilih jenis surat untuk memuat templat.";
                break;
        }

        return response()->json([
            'content' => $isiSurat
        ]);
    }
     // Pemilihan Template & Pratinjau
   public function preview(Request $request)
    {
        
        // Ambil data dari request AJAX
        // Data dummy untuk kwitansi.
        // Dalam aplikasi nyata, data ini bisa berasal dari database.
        // Ambil data dari request
        $title = $request->input('subject');
        $recipient = $request->input('content');
        $content = $request->input('letter_type');

        // Kembalikan pratinjau sebagai HTML mentah
        return view('letter.preview', compact('subject', 'letter_type', 'content'));
    }
}
