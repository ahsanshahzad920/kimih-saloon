<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'expected_date',
        'total_fees',
        'sub_total',
        'grand_total',
        'status',
        'created_by', 'updated_by','deleted_by'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderItems()
    {
        return $this->hasMany(StockOrderItem::class);
    }

    public function fees()
    {
        return $this->hasMany(StockOrderFee::class);
    }
}
