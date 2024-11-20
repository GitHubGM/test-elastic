<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'email',
        'phone',
        'address',
        'is_active',
        'position'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'products_merchants');
    }

    public function scopeWhereActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeWhereHasProducts(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query->whereHas('products', function (EloquentBuilder $query) use ($product_name) {
            $this->whereProductName($query,$product_name);
        });
    }

    public function whereProductName(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query
            ->where('name', 'like', '%'.$product_name)
            ->orWhereHas('categories', function (EloquentBuilder $query) use ($product_name) {
                $query->where('name', 'like','%'. $product_name.'%');
            });
    }

}
