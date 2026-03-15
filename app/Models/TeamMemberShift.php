<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMemberShift extends Model
{
    use HasFactory;
    protected $fillable = ['team_member_id', 'shift_id', 'start_time', 'end_time','created_by','updated_by','deleted_by'];


}
