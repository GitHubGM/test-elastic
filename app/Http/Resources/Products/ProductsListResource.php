<?php

namespace App\Http\Resources\Products;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var  $this Product */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'slug'        => $this->slug,
            'sku'         => $this->sku,
            'price'       => $this->price,
        ];
    }
}
