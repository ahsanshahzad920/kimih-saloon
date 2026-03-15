<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
