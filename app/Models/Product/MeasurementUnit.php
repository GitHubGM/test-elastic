<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'symbol',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
