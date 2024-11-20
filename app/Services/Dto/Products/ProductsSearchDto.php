<?php

namespace App\Services\Dto\Products;

class ProductsSearchDto
{
    public function __construct(
        private ?string $search = '',
        private readonly int $page =1,
        private readonly int $per_page = 30,
        private readonly ?string $category_slug = null,
        private readonly ?float $price_from = null,
        private readonly ?float $price_to = null,
        private readonly ?array $brands = null,
        private readonly ?array $merchants = null,
        private readonly ?string $order_by_price = null,
        private readonly array $characteristicsAttributes = []
    )
    {

    }

    public function getSearch(): string
    {
        return $this->search;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->per_page;
    }

    public function getCategorySlug(): ?string
    {
        return $this->category_slug;
    }

    public function getPriceFrom(): ?float
    {
        return $this->price_from;
    }

    public function getPriceTo(): ?float
    {
        return $this->price_to;
    }

    public function getBrands(): ?array
    {
        return $this->brands;
    }

    public function getMerchants(): ?array
    {
        return $this->merchants;
    }

    public function getOrderByPrice(): ?string
    {
        return $this->order_by_price;
    }
    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }


    public function getCharacteristicsAttributes():array
    {
        return $this->characteristicsAttributes;
    }

}