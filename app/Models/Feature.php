<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'title', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setIconAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes['icon'] = $value->store('icons', 'public');
        } else {
            $this->attributes['icon'] = $value;
        }
    }
}
