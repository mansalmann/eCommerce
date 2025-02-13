<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider_name',
        'provider_token',
        'provider_refresh_token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
