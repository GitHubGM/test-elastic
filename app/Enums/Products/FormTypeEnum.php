<?php

namespace App\Enums\Products;

enum FormTypeEnum: string
{
    case multi_select  = 'multi_select';
    case single_select = 'single_select';
    case boolean       = 'boolean';

    public function types(): array
    {
        return [
            'multi_select'  => 'Multi Select',
            'single_select' => 'Single Select',
            'boolean'       => 'Boolean'
        ];
    }
}
