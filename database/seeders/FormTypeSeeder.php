<?php

namespace Database\Seeders;

use App\Enums\Products\FormTypeEnum;
use App\Models\Product\FormType;
use Illuminate\Database\Seeder;

class FormTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = FormTypeEnum::cases();
        $insertData = [];
        foreach ($data as $typeEnum) {
            $insertData[] = [
                'name'        => $typeEnum->value,
                'description' => $typeEnum->value,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
        FormType::query()->insert($insertData);
    }

}
