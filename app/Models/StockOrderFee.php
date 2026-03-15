<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOrderFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_order_id',
        'name',
        'amount',
    ];

    public function stockOrder()
    {
        return $this->belongsTo(StockOrder::class);
    }

}
