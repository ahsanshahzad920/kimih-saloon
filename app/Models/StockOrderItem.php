<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function stockOrder()
    {
        return $this->belongsTo(StockOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
