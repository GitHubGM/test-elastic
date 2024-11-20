<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'rating',
        'quantity',
        'review_count',
    ];
}
