<?php

namespace App\Rules\Products\Characteristics;

use App\Exceptions\CustomException;
use App\Models\Product\Characteristic;
use App\Models\Product\CharacteristicAttribute;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CharacteristicsAttributeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty($value)) {
            $countAttributes = CharacteristicAttribute::query()->whereIn('id', $value)->count();
            if ($countAttributes !== count($value)) {
                $fail('Неверные значения');
            }
        }

    }
}
