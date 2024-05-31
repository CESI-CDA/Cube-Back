<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LienUserRestriction extends Model
{
    use HasFactory;

    protected $table = 'lien_user_restriction';
    protected $fillable = ['id_user', 'date', 'commentaire', 'deleted'];
    public $timestamps = true;

    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user')->where('deleted', false)->select(['id', 'nom', 'prenom', 'pseudonyme', 'email']);
    }
}
