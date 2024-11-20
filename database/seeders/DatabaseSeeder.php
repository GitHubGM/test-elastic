<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\DeleteAllSeeder::class,
            \Database\Seeders\FormTypeSeeder::class,
            \Database\Seeders\BrandsSeeder::class,
            \Database\Seeders\MerchantsSeeder::class,
            \Database\Seeders\CategoriesSeeder::class,
            \Database\Seeders\ProductsSeeder::class,
            ProductMerchantsSeeder::class,
        ]);
    }
}
