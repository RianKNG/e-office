<?php

use App\Http\Controllers\JadiCon;
use App\Http\Controllers\SuratCon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisposisiCon;
use App\Http\Controllers\NotaDinasCon;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotaDinasController;

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


//Nota Dinas
Route::get('/', [DashboardController::class, 'index']);





Route::get('/allData', [NotaDinasCon::class, 'semua']);
Route::post('/notadinas/addData', [NotaDinasCon::class,'addData']);
Route::post('/notdin/update/status', [NotaDinasCon::class, 'updateStatus']);
Route::get('notadinas',[NotaDinasCon::class,'index'])->name('notadinas');
Route::get('/fetchall', [NotaDinasCon::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [NotaDinasCon::class, 'delete'])->name('delete');
Route::get('/notadinas/edit/{id}', [NotaDinasCon::class, 'edit']);
Route::post('/notadinas/update/{id}', [NotaDinasCon::class, 'update']);
Route::post('/notadinas/disposisi/{id}', [NotaDinasCon::class, 'storeDisposisi']);
Route::get('/notadinas/disposisi/{id}', [NotaDinasCon::class, 'getDisposisi']);




//Disposisi
Route::get('disposisi',[DisposisiCon::class,'index'])->name('disposisi');
Route::get('/disposisi/all',[DisposisiCon::class,'allData']);
Route::post('/disposisi/add', [DisposisiCon::class, 'addData']);



//Surat
Route::get('/surat',[SuratCon::class,'index'])->name('surat');
Route::get('/tampil',[SuratCon::class,'tampil'])->name('tampil');
Route::post('/surat/store', [SuratCon::class, 'store']);
Route::get('/surat/edit/{id}', [SuratCon::class, 'edit']);
Route::get('/surat/update/{id}', [SuratCon::class, 'update']);
Route::post('/get-letter-template', [SuratCon::class, 'store'])->name('get.letter.template');
Route::get('/surat-masuk',[SuratCon::class,'tampil'])->name('surat.masuk');
//test
// Route AJAX untuk mengambil template surat
Route::get('/get-surat-template', [SuratCon::class, 'getTemplate'])->name('get.surat.template');

Route::resource('tests', TestController::class)->except(['create', 'show', 'edit']);
Route::get('/get-template', [TestController::class, 'getTemplate'])->name('get.template');
Route::get('/surats/edit/{surat}', [TestController::class, 'edit'])->name('surats.edit');
Route::post('/preview-surat', [TestController::class, 'preview'])->name('surats.preview');
// Endpoint AJAX untuk pratinjau surat
Route::post('/surat/preview-ajax', [SuratCon::class, 'previewAjax'])->name('surat.preview.ajax');

//laporan

Route::prefix('laporan')->group(function () {
    Route::get('/laporanexel', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
    Route::get('/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan',[LaporanController::class,'laporan']);
});




