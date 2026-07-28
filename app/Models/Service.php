<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'default_service_id',
        'is_active',
        'service_name',
        'service_type',
        'service_category',
        'available_for',
        'aftercare_description',
        'service_description',
        'online_bookings',
        'team_member',
        'team_memeber_commission',
        'duration',
        'price_type',
        'price',
        'notify',
        'notify_count',
        'notify_days',
        'sales_tax',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category');
    }

    public function defaultService()
    {
        return $this->belongsTo(Service::class, 'default_service_id');
    }

    public function clones()
    {
        return $this->hasMany(Service::class, 'default_service_id');
    }


    // public function team()
    // {
    //     return $this->belongsTo(User::class, 'team_member');
    // }

}
