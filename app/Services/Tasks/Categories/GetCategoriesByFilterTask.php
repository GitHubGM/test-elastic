<?php

namespace App\Services\Tasks\Categories;

use App\Models\Product\Category;
use App\Services\Dto\Products\ProductsSearchDto;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class GetCategoriesByFilterTask
{

    protected ProductsSearchDto $dto;

    public function run(ProductsSearchDto $dto):EloquentCollection
    {
        $this->initDto($dto);
        $categoryQuery = Category::query();
        $this->queryFilterBySearch($categoryQuery);
        $this->queryFilterBySlug($categoryQuery);
        return $categoryQuery->with(['children', 'parentRecursive'])->get();
    }

    private function initDto(ProductsSearchDto $dto):void
    {
        $this->dto = $dto;
    }

    protected function queryFilterBySearch (EloquentBuilder $categoryQuery):void
    {
        $existsCategoryName = false;

        if (!empty($this->dto->getSearch())) {
            $existsCategoryName = (clone $categoryQuery)->where('name', $this->dto->getSearch())
                ->orWhere('name', 'like', '%'.$this->dto->getSearch().'%')
                ->whereDoesntHave('products', function (EloquentBuilder $query){
                    $query->where('name', $this->dto->getSearch());
                })
                ->exists();
        }
        if ($existsCategoryName) {
            $categoryQuery
                ->where('name', $this->dto->getSearch())
                ->orWhere('name', 'like', '%'.$this->dto->getSearch().'%');
            $this->dto->setSearch('');
        } else {
            $categoryQuery
                ->whereHas('products', function ($query) {
                    $query->where('name', 'like', $this->dto->getSearch());
                });
        }
    }

    protected function queryFilterBySlug(EloquentBuilder $categoryQuery):void
    {
        if (!empty($this->dto->getCategorySlug())) {
            $categoryQuery
                ->where('slug', $this->dto->getCategorySlug());
        }
    }
}