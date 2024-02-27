<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ressource extends Model
{
    use HasFactory;

    protected $table = 'ressource';
    protected $fillable = ['id_res', 'titre_res', 'contenu_res', 'url_res', 'id_type_res', 'id_rel', 'id_vis', 'id_cat'];
    public $timestamps = false;

    public function getTypeRessource(): BelongsTo
    {
        return $this->belongsTo(TypeRessource::class, 'id_type_res');
    }

    public function getRelationRessource(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'id_rel');
    }

    public function getVisibiliteRessource(): BelongsTo
    {
        return $this->belongsTo(Visibilite::class, 'id_vis');
    }

    public function getCategorieRessource(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'id_cat');
    }
}
