<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id',
        'ref',
        'client_id',
        'title',
        'description',
        'location',
        'start',
        'end',
        'color',
        'service_ids',
        'status',
        'payment_status',
        'grand_total',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // public function services()
    // {
    //     return $this->belongsToMany(Service::class, 'appointment_services', 'appointment_id', 'service_id')->withPivot('price');
    // }

    public function services()
    {
        return $this->hasMany(AppointmentServices::class, 'appointment_id', 'id');
    }

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function userCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    
}
