<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienRessourceUserArchive extends Model
{
    use HasFactory;

    protected $table = 'lien_ressource_user_archive';
    protected $fillable = ['id_res', 'id_user', 'deleted'];
    public $timestamps = true;
}
