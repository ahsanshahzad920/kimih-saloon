<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'pronouns',
        'preferred_language',
        'client_source',
        'occupation',
        'country',
        'additional_email',
        'additional_phone',
        'e_primary_name',
        'e_primary_relationship',
        'e_primary_email',
        'e_primary_phone',
        'e_secondary_name',
        'e_secondary_relationship',
        'e_secondary_email',
        'e_secondary_phone',
        'created_by', 'updated_by','deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
