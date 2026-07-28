<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['default_category_id', 'is_active', 'name', 'description','icon', 'created_by', 'updated_by','deleted_by'];

    public function services()
    {
        return $this->hasMany(Service::class, 'service_category');
    }

    public function defaultCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'default_category_id');
    }

    public function clones()
    {
        return $this->hasMany(ServiceCategory::class, 'default_category_id');
    }
}
