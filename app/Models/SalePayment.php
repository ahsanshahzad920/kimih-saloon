<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'client_id',
        'cash_received_by',
        'payment_date',
        'payment_method',
        'paid_amount',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
        'stripe_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    public function cashReceiverId()
    {
        return $this->belongsTo(TeamMember::class,'cash_received_by');
    }
}
