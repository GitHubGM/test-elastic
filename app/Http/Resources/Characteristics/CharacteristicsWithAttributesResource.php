<?php

namespace App\Http\Resources\Characteristics;

use App\Http\Resources\Characteristics\Attributes\AttributesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacteristicsWithAttributesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attributes'=>AttributesResource::collection($this->attributes) ,
        ];
    }
}
