<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan'; // sesuaikan dengan nama tabel Anda
    protected $fillable = ['jenis_laporan', 'tanggal', 'data_lainnya']; // kolom yang bisa diisi
    protected $dates = ['tanggal']; // jika kolom tanggal adalah tipe date/datetime

    // Contoh scope untuk filter berdasarkan rentang tanggal dan jenis
    public function scopeFilterBy($query, $filters)
    {
        if ($filters['jenis_laporan'] && $filters['jenis_laporan'] != 'Semua Dokumen') {
            $query->where('jenis_laporan', $filters['jenis_laporan']);
        }

        if ($filters['periode'] == 'Bulanan') {
            // Jika periode bulanan, kita gunakan rentang dari-sampai
            $query->whereBetween('tanggal', [
                $filters['dari_tanggal'],
                $filters['sampai_tanggal']
            ]);
        }

        return $query;
    }
}