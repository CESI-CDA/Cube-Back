<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LienRessourceRelation extends Model
{
    use HasFactory;
    protected $table = 'lien_ressource_relation';
    protected $fillable = ['id_res', 'id_rel', 'deleted'];
    public $timestamps = true;

    public function getRelationRessource(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'id_rel')->where('deleted', false)->select(['id', 'intitule_rel']);
    }
}
