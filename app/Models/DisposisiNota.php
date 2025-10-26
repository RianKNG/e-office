<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiNota extends Model
{
    use HasFactory;
    protected $table = 'disposisi_nota';
    protected $fillable = ['nomor_disposisi','id_surat_masuk','dari_user','kepada_user', 'instruksi', 'catatan','batas_waktu','prioritas','status','created_at','updated_at'];
}
