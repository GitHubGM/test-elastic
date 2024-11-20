<?php

namespace App\Services\Dto\Products;

class ProductsSearchDtoAction
{
    public static function fromRequest(array $data): ProductsSearchDto
    {
        return new ProductsSearchDto(
            search: $data['search'] ?? '',
            page: $data['page'] ?? 1,
            per_page: $data['per_page'] ?? 30,
            category_slug: $data['category_slug'] ?? null,
            price_from: $data['price_from'] ?? null,
            price_to: $data['price_to'] ?? null,
            brands: $data['brands'] ?? null,
            merchants: $data['merchants'] ?? null,
            order_by_price: $data['order_by_price'] ?? null,
            characteristicsAttributes: $data['characteristicsAttribute'] ?? []
        );
    }
}