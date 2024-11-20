<?php

namespace Database\Seeders;

use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Category::query()
            ->with('characteristics.attributes')
            ->chunk(100, function ($categories) {
                $categories->each(function (Category $category) {
                    $productsId = [];
                    $characteristics = $category->characteristics;
                    if (count($characteristics)) {
                        $products = Product::factory()
                            ->count(500)->create();
                        $products->each(function (Product $product) use (&$productsId, $characteristics) {
                            $attributeIds = [];
                            $characteristics->each(function ($characteristic) use (&$attributeIds) {
                                $attribute = $characteristic->attributes;
                                if (count($attribute)){
                                    $attribute = $attribute->random();
                                    $attributeIds[] = $attribute->id;
                                }
                            });
                            $product->brands()->attach(Brand::query()->inRandomOrder()->value('id'));
                            $product->attributes()->attach($attributeIds);
                            $productsId[] = $product->id;
                        });

                    } else {
                        $products = Product::factory()
                            ->count(30)->create()
                            ->each(function (Product $product) {
                                $product->brands()->attach(Brand::query()->inRandomOrder()->value('id'));
                            });

                        $productsId = $products->pluck('id')->toArray();
                    }
                    $category->products()->attach($productsId);
                });
            });

    }
}
