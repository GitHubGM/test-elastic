<?php

namespace Database\Seeders;

use App\Models\Product\Brand;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(100)->create();
    }
}
