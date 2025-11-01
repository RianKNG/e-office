<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
     use HasFactory;
    // protected $dateFormat='m-d-Y';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'disposisi';
    // Pastikan kolom yang dikirim dari form tercantum di sini
    protected $fillable = [
        'nomor_disposisi', // <<< TAMBAHKAN INI
        'id_surat_masuk', 
         'dari_user', 
        'kepada_user', 
        'instruksi', 
        'catatan', 
        'batas_waktu', 
        'prioritas', 
        'status',
        // tambahkan semua kolom lain yang Anda insert
    ];
    
    // ... properti lain
  
}
