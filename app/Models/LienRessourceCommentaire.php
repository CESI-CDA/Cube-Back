<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LienRessourceCommentaire extends Model
{
    use HasFactory;

    protected $table = 'lien_ressource_commentaire';
    protected $fillable = ['id_res', 'id_user', 'date', 'commentaire', 'id_commentaire_parent', 'id_etat', 'deleted'];
    public $timestamps = true;

    public function getUtilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user')->where('deleted', false)->select(['id', 'nom', 'prenom', 'pseudonyme']);
    }
}
