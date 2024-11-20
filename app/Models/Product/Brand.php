<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_brands');
    }

    public function scopeWhereHasProducts(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query->whereHas('products', function (EloquentBuilder $query) use ($product_name) {
            $this->whereProductName($query, $product_name);
        });
    }

    public function whereProductName(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query
            ->where('name', 'like', $product_name)
            ->orWhereHas('categories', function (EloquentBuilder $query) use ($product_name) {
                $query->where('name', 'like', '%'.$product_name.'%');
            });
    }
}
