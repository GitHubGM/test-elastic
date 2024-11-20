<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'title',
      'description',
      'form_type_id',
      'measurement_unit_id',
      'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function attributes()
    {
        return $this->hasMany(CharacteristicAttribute::class,'characteristic_id','id');
    }
}
