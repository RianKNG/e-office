<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinas extends Model
{
   
    use HasFactory;
    public $incrementing = false;
    // protected $guarded = [];
     protected $fillable = [
    'nomor_nota',
    'tanggal_nota',
    'perihal',
    'isi_nota',
    'lampiran',
    'status',
    'created_by',
    'approved_by',
    'approved_at',
    // tambahkan field lain yang perlu
];
    public $timestamps = false;
 
}
