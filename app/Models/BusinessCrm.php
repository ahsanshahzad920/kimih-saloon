<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCrm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'sub_title',
        'header_image',
        'capterra_image',
        'capterra_rating',
        'capterra_review',
        'top_rating_title',
        'top_rating_description',
        'business_partner_count',
        'business_partner_title',
        'appointmens_count',
        'appointmens_title',
        'stylists_count',
        'stylists_title',
        'countries_count',
        'countries_title',
    ];
}
