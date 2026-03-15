<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'services',
        'sessions',
        'no_of_session',
        'valid_for',
        'price',
        'tax_rate',
        'online_sale',
        'term_condition',
        'created_by', 'updated_by','deleted_by'
    ];

    // public function memberships()
    // {
    //     return $this->hasMany(Membership::class);
    // }

    public function paidPlans(){
        return $this->hasMany(PaidPlan::class);
    }

    public function shop(){
        return $this->belongsTo(User::class);
    }

    public function getServicesAttribute()
    {
        $serviceIds = explode(',',$this->attributes['services']);
        $services = Service::whereIn('id',$serviceIds)->get();
        return $services;


    }

    
}
