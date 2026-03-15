<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['provider', 'provider_id', 'user_id', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
