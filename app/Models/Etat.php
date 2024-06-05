<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;
    protected $table = 'etat';
    protected $fillable = ['id', 'intitule', 'deleted'];
    public $timestamps = true;
}
