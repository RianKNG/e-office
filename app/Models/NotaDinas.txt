<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinas extends Model
{
   
    use HasFactory;
    public $incrementing = false;
    protected $guarded = [];
    protected $table = 'nota_dinas';
    public $timestamps = false;
 
}
