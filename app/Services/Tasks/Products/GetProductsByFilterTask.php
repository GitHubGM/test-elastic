<?php

namespace App\Services\Tasks\Products;

use App\Models\Product\Product;
use App\Services\Dto\Products\ProductsSearchDto;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class GetProductsByFilterTask
{
    protected readonly ProductsSearchDto $dto;

    public function run(ProductsSearchDto $dto): LengthAwarePaginator
    {
        $this->initDto($dto);
        $query = $this->filterQuery();
        return $this->paginateQuery($query);
    }

    protected function initDto(ProductsSearchDto $dto): void
    {
        $this->dto = $dto;
    }

    protected function filterQuery(): EloquentBuilder
    {
        $query = Product::query()
            ->join('products_merchants', function ($join) {
                $join->on('products.id', '=', 'products_merchants.product_id')
                    ->whereRaw('products_merchants.price = (SELECT MIN(price) FROM products_merchants WHERE products_merchants.product_id = products.id)');
            })
            ->select(['products.*', 'products_merchants.price as price'])
            ->when(!empty($this->dto->getSearch()), function ($query) {
                $query->where('name', 'like', '%'.$this->dto->getSearch());
            });
        $this->queryFilterCharacteristic($query);

        $this->queryFilterCategory($query);

        $this->queryFilterBrands($query);

        $this->queryFilterMerchants($query);

        $this->filterPrice($query);

        $this->orderByPrice($query);

        $this->relations($query);

        return $query;
    }

    protected function paginateQuery(EloquentBuilder $query): LengthAwarePaginator
    {
        return $query->paginate($this->dto->getPerPage(), ['*'], 'page', $this->dto->getPage());
    }
    protected function queryFilterCharacteristic(EloquentBuilder $query):void
    {
        $attributes = $this->dto->getCharacteristicsAttributes();
        if (!empty($attributes)) {
            foreach ($attributes as $attributeId) {
                $query->whereHas('attributes', function ($query) use ($attributeId) {
                    $query->where('id', $attributeId);
                });
            }
        }
    }



    protected function queryFilterCategory(EloquentBuilder $query): void
    {
        if (!empty($this->dto->getCategorySlug())) {
            $query->whereHas('categories', function ($query) {
                $query->where('slug', $this->dto->getCategorySlug());
            });
        }
    }

    protected function queryFilterBrands(EloquentBuilder $query): void
    {
        if (!empty($this->dto->getBrands())) {
            $query->whereHas('brands', function ($query) {
                $query->whereIn('id', $this->dto->getBrands());
            });
        }
    }

    protected function queryFilterMerchants(EloquentBuilder $query): void
    {
        if (!empty($this->dto->getMerchants())) {
            $query->whereHas('merchants', function ($query) {
                $query->whereIn('id', $this->dto->getMerchants());
            });
        }
    }

    protected function relations(EloquentBuilder $query): void
    {
        $query->with([
            'merchants' => function ($query) {
                $query
                    ->select('id', 'name')
                    ->when(!empty($this->dto->getMerchants()), function ($query) {
                        $query->whereIn('id', $this->dto->getMerchants());
                    })
                    ->orderBy('price')
                    ->limit(50);
            },
            'brands'    => function ($query) {
                $query
                    ->select('id', 'name')
                    ->when(!empty($this->dto->getBrands()), function ($query) {
                        $query->whereIn('id', $this->dto->getBrands());
                    })
                    ->limit(50);
            },
        ]);
    }

    protected function filterPrice(EloquentBuilder $query): void
    {
        $priceFrom = $this->dto->getPriceFrom();
        $priceTo = $this->dto->getPriceTo();;
        if ($priceFrom !== null) {
            $query->where('price', '>=', $priceFrom);
        }
        if ($priceTo !== null) {
            $query->where('price', '<=', $priceTo);
        }
    }

    protected function orderByPrice(EloquentBuilder $query): void
    {
        if (!empty($this->dto->getOrderByPrice())) {
            $query->orderBy('price', $this->dto->getOrderByPrice());
        }
    }
}