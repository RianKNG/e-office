<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }

    public function export()
    {
        $filename = 'backup_eoffice_' . now()->format('Y-m-d_His') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        // Buat direktori jika belum ada
        if (!is_dir(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        $output = "-- E-OFFICE PDAM Backup\n";
        $output .= "-- Generated: " . now()->format('Y-m-d H:i:s') . "\n\n";

        // Dapatkan semua nama tabel
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableName = current($table);
            $output .= "\n-- Table structure for table `$tableName`\n";
            $output .= "DROP TABLE IF EXISTS `$tableName`;\n";

            // Ambil struktur tabel
            $createTable = DB::select("SHOW CREATE TABLE `$tableName`");
            $output .= $createTable[0]->{'Create Table'} . ";\n\n";

            // Ambil data
            $rows = DB::table($tableName)->get();
            if ($rows->count() > 0) {
                $output .= "-- Dumping data for table `$tableName`\n";
                foreach ($rows as $row) {
                    $columns = array_keys((array)$row);
                    $values = array_map(function ($value) {
                        return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                    }, (array)$row);

                    $output .= "INSERT INTO `$tableName` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ");\n";
                }
                $output .= "\n";
            }
        }

        // Simpan ke file
        file_put_contents($path, $output);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function import(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|mimes:sql|max:51200',
        ]);

        $file = $request->file('sql_file');
        $content = file_get_contents($file->getPathname());

        try {
            DB::unprepared($content);
        } catch (\Exception $e) {
            \Log::error('Restore gagal: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengimpor database. Periksa format file SQL.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Database berhasil dipulihkan.']);
    }
}