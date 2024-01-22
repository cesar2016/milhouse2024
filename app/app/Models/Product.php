<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'code',
        'name',
        'stock',
        'price_purchase',
        'price_sale',
        'status',
        'date_purchase',
        'category_id',
        'brand_product_id'

    ];
}
