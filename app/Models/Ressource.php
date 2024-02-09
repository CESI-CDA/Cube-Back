<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $table = 'ressource';
    protected $fillable = ['id_res', 'titre_res', 'contenu_res', 'url_res'];
    public $timestamps = false;
}
