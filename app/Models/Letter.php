<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
     public $timestamps = false;
    protected $fillable = ['subject', 'content', 'letter_type','created_at'];
}
