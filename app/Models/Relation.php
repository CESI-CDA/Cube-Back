<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $table = 'relation';
    protected $fillable = ['intitule_rel'];
    public $timestamps = false;
}
