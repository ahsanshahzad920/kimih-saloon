<?php

namespace App\Models;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'address',
        'start_date',
        'end_date',
        'note',
        'services',
        'image',
        'job_title',
        'created_by', 'updated_by','deleted_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class, 'team_member_shifts')
                    ->withPivot('start_time', 'end_time')
                    ->withTimestamps();
    }

    public function schedules()
    {
        return $this->hasMany(TeamSchedule::class);
    }


}
