<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'test';
    protected $fillable = ['template', 'data'];
    public $timestamps = false;
    protected $casts = ['data' => 'array']; // Otomatis mengonversi kolom 'data' ke array
}
