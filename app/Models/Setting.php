<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'site_name',
        'logo',
        'logo_front',
        'logo_with_site_name',

        'privacy_policy',
        'term_of_service',
        'cancellation_policy',
        'partner_terms',
    ];
}
