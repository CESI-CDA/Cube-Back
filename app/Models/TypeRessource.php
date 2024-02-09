<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRessource extends Model
{
    use HasFactory;

    protected $table = 'type_ressource';
    protected $fillable = ['intitule_type_res'];
    public $timestamps = false;
}
