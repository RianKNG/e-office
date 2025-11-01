<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisi';
    public $timestamps = false;
    protected $fillable = [
        'nomor_disposisi', 'id_surat_masuk', 'dari_user', 'kepada_user',
        'id_disposisi_induk', 'instruksi', 'catatan', 'batas_waktu',
        'prioritas', 'status', 'created_at'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat_masuk');
    }

    public function dari()
    {
        return $this->belongsTo(User::class, 'dari_user');
    }

    public function kepada()
    {
        return $this->belongsTo(User::class, 'kepada_user');
    }
}