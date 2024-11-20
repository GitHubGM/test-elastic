<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'status',
        'position',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if ($category->slug == null)
                $category->slug = Str::slug($category->name);
        });
    }

    public function children():BelongsToMany
    {
        return $this->belongsToMany(self::class, 'categories_children','parent_id','child_id');
    }

    public function allChildren():BelongsToMany
    {
        return $this->children()->with('children');
    }

    public function parent():BelongsToMany
    {
        return $this->belongsToMany(self::class, 'categories_children','child_id','parent_id');
    }
    public function parentRecursive():BelongsToMany
    {
        return $this->parent()->with('parent');
    }

    public function characteristics():BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class,'categories_characteristics','category_id','characteristic_id');
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'products_categories');
    }
}
