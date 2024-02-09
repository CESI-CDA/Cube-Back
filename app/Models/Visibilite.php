<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibilite extends Model
{
    use HasFactory;
    protected $table = 'visibilite';
    protected $fillable = ['intitule_vis'];
    public $timestamps = false;
}
