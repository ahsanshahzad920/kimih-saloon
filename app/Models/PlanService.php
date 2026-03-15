<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plan_id',
        'user_id',
    ];

    public function plans()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
