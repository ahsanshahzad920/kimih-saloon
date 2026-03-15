<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'item_id',
        'type',
        'quantity',
        'price',
        'discount',
        'sub_total',
        'team_member',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function productItem()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function membershipItem()
    {
        return $this->belongsTo(Membership::class, 'item_id');
    }

    public function appointmentItem()
    {
        return $this->belongsTo(Appointment::class, 'item_id');
    }

    public function serviceItem()
    {
        return $this->belongsTo(Service::class, 'item_id');
    }


}
