<?php

namespace App\Services\Actions\Products;

use App\Http\Resources\Products\ProductsListResource;
use App\Models\Product\Product;
use App\Services\Dto\Products\ProductsSearchDto;
use App\Services\Elastic\ElasticSearch;

class ProductsSearchEsAction
{

    public function run(ProductsSearchDto $dto): array
    {
        $products = $this->getProductsEs($dto);
        return [
            'data' => $products
        ];
    }

    protected function getProducts(ProductsSearchDto $dto)
    {
        return ProductsListResource::collection(
            Product::query()
                ->where('name', 'like', '%'.$dto->getSearch()
                )
                ->with('merchants')
                ->paginate(perPage: 40, page: 1));
    }

    protected function getProductsEs(ProductsSearchDto $dto)
    {
        $elastic = ElasticSearch::getClient();
        $params = [
            'index' => 'products',
            'body'  => [
                'query' => [
                    'match' => [
                        'name' => $dto->getSearch()
                    ]
                ],
            ],
        ];
        $response = $elastic->search($params)['hits'];
        $products = $response['hits'];
        $total = $response['total']['value'];

        return $products;
    }
}