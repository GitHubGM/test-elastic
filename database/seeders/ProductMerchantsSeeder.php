<?php

namespace Database\Seeders;

use App\Models\Product\Merchant;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class ProductMerchantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->chunk(100, function ($products) {
            $products->each(function ($product) {
                $merchant_id = Merchant::query()->inRandomOrder()->value('id');
                $product->merchants()->attach([
                    $merchant_id => [
                        'price' => rand(100, 1000000),
                        'quantity' => rand(1, 100),
                    ]
                ]);
            });
        });
    }
}
