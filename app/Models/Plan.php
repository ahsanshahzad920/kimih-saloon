<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'price', 'name', 'image'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function planServices()
    {
        return $this->hasMany(PlanService::class);
    }
}
