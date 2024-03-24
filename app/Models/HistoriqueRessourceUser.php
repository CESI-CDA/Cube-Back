<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueRessourceUser extends Model
{
    use HasFactory;

    protected $table = 'historique_ressource_user';
    protected $fillable = ['id_res', 'id_user', 'nombre_consultation', 'derniere_utilisation', 'deleted'];
    public $timestamps = true;
}
