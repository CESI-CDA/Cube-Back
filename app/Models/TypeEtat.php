<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEtat extends Model
{
    use HasFactory;
    protected $table = 'type_etat';
    protected $fillable = ['intitule_type_eta'];
    public $timestamps = false;
}
