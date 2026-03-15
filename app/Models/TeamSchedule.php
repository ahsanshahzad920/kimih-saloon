<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_member_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_off',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
