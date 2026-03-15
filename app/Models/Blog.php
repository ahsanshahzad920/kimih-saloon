<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'blog_type_id',
        'updated_by',
        'title',
        'image',
        'body',
        'slug',
        'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function blogType()
    {
        return $this->belongsTo(BlogType::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
