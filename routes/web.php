<?php

use App\Models\Disposisi;
use App\Models\DisposisiNota;
use App\Http\Controllers\JadiCon;
use App\Http\Controllers\SuratCon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisposisiCon;
use App\Http\Controllers\NotaDinasCon;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiGabunganController;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//userlogin
Route::get('/', function () { return view('auth.login'); })->name('login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [DashboardController::class, 'index']);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});


// Route::get('admin/users', [UserController::class, 'index']);
// Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
// Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
// Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
// Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
// Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/allData', [NotaDinasCon::class, 'semua']);
// Route::post('/notadinas/addData', [NotaDinasCon::class,'addData']);
Route::post('/notdin/update/status', [NotaDinasCon::class, 'updateStatus']);
Route::get('notadinas',[NotaDinasCon::class,'index'])->name('notadinas');
Route::get('/fetchall', [NotaDinasCon::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [NotaDinasCon::class, 'delete'])->name('delete');
Route::get('/notadinas/edit/{id}', [NotaDinasCon::class, 'edit']);
Route::post('/notadinas/update/{id}', [NotaDinasCon::class, 'update']);
Route::post('/notadinas/disposisi/{id}', [NotaDinasCon::class, 'storeDisposisi']);
Route::get('/notadinas/disposisi/{id}', [NotaDinasCon::class, 'getDisposisi']);
Route::post('/notadinas/store', [NotaDinasCon::class, 'store']);
// routes/web.php
Route::get('/disposisi', [DisposisiCon::class, 'index'])->name('disposisi.index');
Route::get('/api/disposisi/sumber', [DisposisiCon::class, 'listSumberDisposisi'])->name('disposisi.sumber');



//laporan

Route::prefix('laporan')->group(function () {
    Route::get('/laporanexel', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
    Route::get('/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/',[LaporanController::class,'laporan'])->name('laporan');
});

Route::get('/disposisi/{jenis}/{id}/edit', [DisposisiGabunganController::class, 'showEditForm']);
Route::put('/disposisi/{jenis}/{id}', [DisposisiGabunganController::class, 'update']);
Route::get('/disposisi', [DisposisiGabunganController::class, 'index'])->name('disposisi.index');
Route::get('/disposisi/{jenis}/{id}/detail', function ($jenis, $id) {
    if ($jenis === 'surat') {
        $data = \App\Models\Disposisi::with(['surat', 'dari', 'kepada'])->findOrFail($id);
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
        $data = \App\Models\DisposisiNota::with(['nota', 'dari', 'kepada'])->findOrFail($id);
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
});


//Surat
Route::get('/surat',[SuratCon::class,'index'])->name('surat');
Route::get('/tampil',[SuratCon::class,'tampil'])->name('tampil');
Route::post('/surat/store', [SuratCon::class, 'store']);
Route::get('/surat/edit/{id}', [SuratCon::class, 'edit']);
Route::get('/surat/update/{id}', [SuratCon::class, 'update']);
Route::post('/get-letter-template', [SuratCon::class, 'store'])->name('get.letter.template');
Route::get('/surat-masuk',[SuratCon::class,'tampil'])->name('surat.masuk');
Route::get('/surat/download-pdf/{id}', [SuratCon::class, 'downloadPdf']);
Route::get('/surat/download-word/{id}', [SuratCon::class, 'downloadWord']);
Route::get('/surat/stream/{id}', [SuratCon::class, 'streamPdf']);



//test
// Route AJAX untuk mengambil template surat
Route::get('/get-surat-template', [SuratCon::class, 'getTemplate'])->name('get.surat.template');

Route::resource('tests', TestController::class)->except(['create', 'show', 'edit']);
Route::get('/get-template', [TestController::class, 'getTemplate'])->name('get.template');
Route::get('/surats/edit/{surat}', [TestController::class, 'edit'])->name('surats.edit');
Route::post('/preview-surat', [TestController::class, 'preview'])->name('surats.preview');
// Endpoint AJAX untuk pratinjau surat
Route::post('/surat/preview-ajax', [SuratCon::class, 'previewAjax'])->name('surat.preview.ajax');

// Route::middleware(['auth'])->group(function () {
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/export', [BackupController::class, 'export'])->name('backup.export');
    Route::post('/backup/import', [BackupController::class, 'import'])->name('backup.import');
// });


