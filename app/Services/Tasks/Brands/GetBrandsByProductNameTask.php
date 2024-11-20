<?php

namespace App\Services\Tasks\Brands;

use App\Http\Resources\Brands\BrandsResource;
use App\Models\Product\Brand;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class GetBrandsByProductNameTask
{
    public function run(string $product_name)
    {
        $brands = Brand::query()
            ->withCount([
                'products' => function (EloquentBuilder $query) use ($product_name) {
                    $this->whereProductName($query,$product_name);
                }
            ])
            ->whereHasProducts($product_name)
            ->limit(40)
            ->get();

        return BrandsResource::collection($brands);
    }

    private function whereProductName(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query
            ->where('name', 'like','%'. $product_name)
            ->orWhereHas('categories', function (EloquentBuilder $query) use ($product_name) {
                $query->where('name', 'like', '%'.$product_name.'%');
            });
    }

}