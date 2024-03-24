<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienRessourceUserEtat extends Model
{
    use HasFactory;

    protected $table = 'lien_ressource_user_etat';
    protected $fillable = ['id_res', 'id_user', 'id_etat', 'deleted'];
    public $timestamps = true;
}
