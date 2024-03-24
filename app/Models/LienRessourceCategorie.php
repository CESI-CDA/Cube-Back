<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LienRessourceCategorie extends Model
{
    use HasFactory;

    protected $table = 'lien_ressource_categorie';
    protected $fillable = ['id_res', 'id_cat', 'deleted'];
    public $timestamps = true;

    public function getCategorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'id_cat')->where('deleted', false)->select(['id', 'intitule_cat']);
    }
}
