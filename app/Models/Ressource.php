<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ressource extends Model
{
    use HasFactory;

    protected $table = 'ressource';
    protected $fillable = ['titre_res', 'contenu_res', 'url_res', 'id_type_res', 'id_vis', 'id_createur', 'date_creation', 'is_archive', 'id_etat', 'deleted'];
    public $timestamps = true;

    public function getTypeRessource(): BelongsTo
    {
        return $this->belongsTo(TypeRessource::class, 'id_type_res')->where('deleted', false)->select(['id', 'intitule_type_res']);
    }

    public function getVisibilite(): BelongsTo
    {
        return $this->belongsTo(Visibilite::class, 'id_vis')->where('deleted', false)->select(['id', 'intitule_vis']);
    }

    public function getCreateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_createur')->where('deleted', false)->select(['id', 'nom', 'prenom', 'pseudonyme']);
    }

    public function getLienRessourceRelation(): HasMany
    {
        return $this->hasMany(LienRessourceRelation::class, 'id_res', 'id')->where('deleted', false)->select(['id_res', 'id_rel']);
    }

    public function getLienRessourceCategorie(): HasMany
    {
        return $this->hasMany(LienRessourceCategorie::class, 'id_res', 'id')->where('deleted', false)->select(['id_res', 'id_cat']);
    }

    public function getLienRessourceCommentaire(): HasMany
    {
        return $this->hasMany(LienRessourceCommentaire::class, 'id_res', 'id')->where('deleted', false)->where('id_etat', 2)->select(['id', 'id_res', 'id_user', 'date', 'commentaire', 'id_commentaire_parent', 'id_etat']);
    }

    public function getEtat(): BelongsTo
    {
        return $this->belongsTo(Etat::class, 'id_etat')->where('deleted', false)->select(['id', 'intitule']);
    }
}
