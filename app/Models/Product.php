<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // add this line
        'name',
        'sku',
        'category_id',
        'brand_id',
        'product_short_description',
        'description',
        'measureType',
        'amount',
        'supply_price',
        'retail_sales',
        'retail_price',
        'marked',
        'sales_tax',
        'team_memeber_commission',
        'supplier_id',
        'track_stock_quantity',
        'current_stock_quantity',
        'low_stock_level',
        'reorder_quantity',
        'low_stock_noti',
        'created_by', 'updated_by','deleted_by'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }

    // Accessor to calculate the save percentage
    public function getSavePercentageAttribute()
    {
        if ($this->retail_price > 0) {
            $savePercentage = (($this->retail_price - $this->supply_price) / $this->retail_price) * 100;
            return round($savePercentage, 2); // Rounds to 2 decimal places
        }
        return 0;
    }

    



}
