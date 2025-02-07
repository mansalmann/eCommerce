<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetTokens extends Model
{
    protected $table = 'password_reset_tokens';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'user_id',
        'token',
        'created_at'
    ];
}
