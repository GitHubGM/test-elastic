<?php

namespace App\Services\Tasks\Merchants;

use App\Http\Resources\Merchants\MerchantsResource;
use App\Models\Product\Merchant;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMerchantsByProductTask
{
    public function run(string $product_name):JsonResource
    {
        $merchants = Merchant::query()
            ->whereActive()
            ->withCount([
                'products' => function (EloquentBuilder $query) use ($product_name) {
                    $this->whereProductName($query,$product_name);
                }
            ])
            ->whereHasProducts($product_name)
            ->limit(40)
            ->orderBy('position')
            ->get();
        return MerchantsResource::collection($merchants);
    }

    private function whereProductName(EloquentBuilder $query, string $product_name): EloquentBuilder
    {
        return $query
            ->where('name', 'like', '%' . $product_name)
            ->orWhereHas('categories', function (EloquentBuilder $query) use ($product_name) {
                $query->where('name', 'like', '%'.$product_name.'%');
            });
    }
}