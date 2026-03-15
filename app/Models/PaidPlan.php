<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'membership_id',
        'type',
        'start_date',
        'end_date',
        'total_charged',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function client(){
        return $this->belongsTo(User::class);
    }

    public function membership(){
        return $this->belongsTo(Membership::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }


}
