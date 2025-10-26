<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
     use HasFactory;
    // protected $dateFormat='m-d-Y';
    // public $incrementing = false;
    protected $guarded = [];
    protected $table = 'surat_masuk';
    protected $tableKey = ['id'];
    // public $created_at = false;
    // public $updated_at = false;
        // public $user_id = false;
        public $timestamps = false;
    

     protected $fillable = ['id','jenis_surat',
                                'nomor_surat',
                                'tanggal_surat',
                                'perihal',
                                'letter_type',
                                'isi_surat',
                              'berkas_surat',
                              //   'lampiran',
                                'sifat_surat',
                                'klasifikasi surat',
                                'derajat_keamanan',
                                'tempat_pembuatan',
                                'jabatan_pembuat',
                                'catatan_tambahan',
                                // 'berkas_surat',
                              'user_id'];
   

}
