<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'characteristic_id',
        'name',
        'is_active',
        'position',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
