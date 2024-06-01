<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatCommentaire extends Model
{
    use HasFactory;
    protected $table = 'etat_commentaire';
    protected $fillable = ['id', 'intitule', 'deleted'];
    public $timestamps = true;
}
