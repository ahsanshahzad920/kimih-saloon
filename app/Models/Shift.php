<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['shift_date','created_by','updated_by','deleted_by'];

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class, 'team_member_shifts')
                    ->withPivot('start_time', 'end_time')
                    ->withTimestamps();
    }

    protected $dates = ['shift_date'];
}
