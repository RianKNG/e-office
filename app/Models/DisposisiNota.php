<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisposisiNota extends Model
{
    protected $table = 'disposisi_nota';
    public $timestamps = false;
    protected $fillable = [
        'nomor_disposisi', 'id_nota_dinas', 'dari_user', 'kepada_user',
        'instruksi', 'catatan', 'batas_waktu', 'prioritas', 'status', 'created_at'
    ];

    public function nota()
    {
        return $this->belongsTo(NotaDinas::class, 'id_nota_dinas');
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