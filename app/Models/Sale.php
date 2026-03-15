<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'client_id',
        'date',
        'discount',
        'sub_total',
        'grand_total',
        'payment_method',
        'cash_received',
        'cash_return',
        'due_amount',
        'sale_note',
        'status',
        'cash_received_by',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function payments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }

    public function cashReceivedBy()
    {
        return $this->belongsTo(TeamMember::class,'cash_received_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
