<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'email', 'role', 'jabatan', 'status'
    ];
    public $timestamps = false;
}