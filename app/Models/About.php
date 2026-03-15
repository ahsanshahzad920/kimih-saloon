<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'heading',
        'title',
        'description',
        'images',
        'video_link',
        'video_background_image',
        'section_heading',
        'section_title',
        'section_image',
    ];
}
