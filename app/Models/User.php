<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ HARUS ADA

class User extends Authenticatable
{
    protected $table = 'users';
      protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $primaryKey = 'id'; // Contoh: 'user_id'

    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'email', 'role', 'jabatan', 'status'
    ];
    public $timestamps = false;
}