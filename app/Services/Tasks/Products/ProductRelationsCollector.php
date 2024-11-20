<?php

namespace App\Services\Tasks\Products;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class ProductRelationsCollector
{
    public function run(
        EloquentCollection|LengthAwarePaginator $products
    ): array {
        $brands = collect();
        $merchants = collect();
        $convertedProducts = collect();
        $this->collect($brands, $merchants, $convertedProducts, $products);
        return [
            'brands'    => $brands->values(),
            'merchants' => $merchants->values(),
            'products'  => $convertedProducts
        ];
    }

    private function collect(
        SupportCollection $brands,
        SupportCollection $merchants,
        SupportCollection $convertedProducts,
        LengthAwarePaginator $products
    ): void {
        foreach ($products as $product) {
            $this->collectBrands($brands, $product->brands);
            $this->collectMerchants($merchants, $product->merchants);
            $merchants->push();
            $convertedProducts->push([
                'id'          => $product->id,
                'name'        => $product->name,
                'slug'        => $product->slug,
                'sku'         => $product->sku,
                'price'       => $product->price,
                'description' => $product->description,
            ]);
        }
    }

    private function collectBrands(
        SupportCollection $brands,
        EloquentCollection $productBrands
    ): void {
        foreach ($productBrands as $brand) {
            if ($brands->has($brand->id)) {
                $arrBrand = $brands->get($brand->id);
                $arrBrand['products_count'] += 1;
                $brands->put($brand->id,
                    $arrBrand
                );
            } else {
                $brands->put($brand->id, [
                    'id'             => $brand->id,
                    'name'           => $brand->name,
                    'products_count' => 1
                ]);
            }
        }
    }

    private function collectMerchants(
        SupportCollection $merchants,
        EloquentCollection $productMerchants
    ): void {
        foreach ($productMerchants as $merchant) {
            if ($merchants->has($merchant->id)) {
                $arrMerchant = $merchants->get($merchant->id);
                $arrMerchant['merchants_count'] += 1;
                $merchants->put($merchant->id,
                    $arrMerchant
                );
            } else {
                $merchants->put($merchant->id, [
                    'id'              => $merchant->id,
                    'name'            => $merchant->name,
                    'merchants_count' => 1
                ]);
            }
        }
    }
}