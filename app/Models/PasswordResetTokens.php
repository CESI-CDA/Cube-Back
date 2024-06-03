<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetTokens extends Model
{
    use HasFactory;
    protected $table = 'password_reset_tokens';
    protected $fillable = ['created_at', 'token', 'email'];
    public $timestamps = true;
    const UPDATED_AT = null;
}
