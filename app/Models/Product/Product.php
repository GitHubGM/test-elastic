<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property $id
 * @property $name
 * @property $description
 * @property $slug
 * @property $sku
 * @property $price
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'sku',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->slug == null)
                $model->slug = Str::slug($model->name);
        });
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class,'products_categories');
    }

    public function brands():BelongsToMany
    {
        return $this->belongsToMany(Brand::class,'products_brands');
    }

    public function merchants():BelongsToMany
    {
        return $this->belongsToMany(Merchant::class,'products_merchants')
            ->withPivot('price', 'quantity');

    }

    public function attributes():BelongsToMany
    {
        return $this->belongsToMany(
            CharacteristicAttribute::class,
            'products_attributes',
            'product_id',
            'attribute_id'
        )->withPivot('value');
    }

    public function averages():HasMany
    {
        return $this->hasMany(ProductAverage::class);
    }

    public function getPriceAttribute():int|null
    {
        return $this->merchants?->first()?->pivot->price;
    }

    public function scopeWhereHasMerchants(Builder $query):Builder
    {
        return $query->whereHas('merchants');
    }
}
