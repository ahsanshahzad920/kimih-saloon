<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'business_name',
        'about_us',
        'slug',
        'website',
        'services',
        'team_size',
        'location',
        'latitude',
        'longitude',
        'city',
        'state',
        'country',
        'country_code',

    ];

    public function images(){
        return $this->hasMany(BusinessImage::class);
    }

    
}
