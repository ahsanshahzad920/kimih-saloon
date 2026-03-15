<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'first_name',
        'last_name',
        'phone',
        'telephone',
        'email',
        'website',
        'street',
        'suburb',
        'city',
        'state',
        'zip_code',
        'country',
        'same_as_postal_address',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }




}
