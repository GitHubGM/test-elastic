<?php

namespace App\Http\Requests\Products;

use App\Rules\Products\Characteristics\CharacteristicsAttributeRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductsSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search'          => ['nullable', 'string', 'max:255'],
            'page'            => ['sometimes', 'required', 'integer'],
            'per_page'        => ['sometimes', 'required', 'integer'],
            'category_slug'   => ['sometimes', 'required', 'string', 'max:255'],
            'price_from'      => ['sometimes', 'required', 'numeric'],
            'price_to'        => ['sometimes', 'required', 'numeric'],
            'brands'          => [ 'array'],
            'merchants'       => [ 'array'],
            'order_by_price'  => ['sometimes', 'required', 'string', 'max:255', 'in:asc,desc'],
            'characteristicsAttribute' => ['array',new CharacteristicsAttributeRule()],
        ];
    }
}
