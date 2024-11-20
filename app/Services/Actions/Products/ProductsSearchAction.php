<?php

namespace App\Services\Actions\Products;

use App\Http\Resources\Categories\CategoriesResource;
use App\Http\Resources\Characteristics\CharacteristicsWithAttributesResource;
use App\Services\Dto\Products\ProductsSearchDto;
use App\Services\Tasks\Categories\GetCategoriesByFilterTask;
use App\Services\Tasks\Products\ProductRelationsCollector;
use App\Services\Tasks\Products\GetProductsByFilterTask;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsSearchAction
{
    private readonly GetCategoriesByFilterTask $getCategoriesByFilterTask;
    private readonly GetProductsByFilterTask   $getProductsTask;
    private readonly ProductRelationsCollector $productRelationsCollector;

    public function __construct()
    {
        $this->getCategoriesByFilterTask = new GetCategoriesByFilterTask();
        $this->getProductsTask = new GetProductsByFilterTask();
        $this->productRelationsCollector = new ProductRelationsCollector();
    }

    public function run(ProductsSearchDto $dto): array
    {
        $newDto = clone $dto;
        $categories = $this->getCategories($newDto);
        $paginatedProducts = $this->getProductsTask->run($newDto);
        $productsData = $this->productRelationsCollector->run($paginatedProducts);
        $characteristics = $this->getCharacteristics($categories['count'], $categories['collection']);

        return [
            'data' => [
                'lastPage'        => $paginatedProducts->lastPage(),
                'total'           => $paginatedProducts->total(),
                'products'        => $productsData['products'],
                'categories'      => $categories['resource'],
                'characteristics' => $characteristics,
                'brands'          => $productsData['brands'],
                'merchants'       => $productsData['merchants']
            ]
        ];
    }

    protected function getCategories(ProductsSearchDto $dto): array
    {
        $categories = $this->getCategoriesByFilterTask->run($dto);
        return [
            'collection'     => $categories,
            'resource' => CategoriesResource::collection($categories),
            'count'    => $categories->count()
        ];
    }

    protected function getCharacteristics(int $categoriesCount, EloquentCollection $categories): JsonResource|array
    {
        if ($categoriesCount == 1) {
            $categoryCharacteristics = $categories->first()->load('characteristics.attributes')->characteristics;
            return CharacteristicsWithAttributesResource::collection($categoryCharacteristics);
        }
        return [];

    }
}