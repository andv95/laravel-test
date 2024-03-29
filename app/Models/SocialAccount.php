<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Contracts\Provider;

class SocialAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider', 'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
