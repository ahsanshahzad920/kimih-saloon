<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'home_title',
        'section1_title',
        'section1_image',
        'section1_desc',
        'section2_title',
        'section2_video_link',
        'last_section_title',
        'last_section_desc',
        'last_section_image',
    ];
}
