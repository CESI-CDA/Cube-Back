<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilise extends Model
{
    use HasFactory;
    protected $table = 'utilise';
    protected $fillable = ['nombre_uti', 'derniere_uti'];
    public $timestamps = false;
}
