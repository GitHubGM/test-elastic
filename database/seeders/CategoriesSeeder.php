<?php

namespace Database\Seeders;

use App\Models\Product\Category;
use App\Models\Product\Characteristic;
use App\Models\Product\CharacteristicAttribute;
use App\Models\Product\MeasurementUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->delete();
        Characteristic::query()->delete();
        CharacteristicAttribute::query()->delete();
        MeasurementUnit::query()->delete();
        $jsonFile = Storage::get('folders/categories.json');
        if (!$jsonFile) {
            return;
        }
        $categories = json_decode($jsonFile, true);
        DB::transaction(function () use ($categories) {
            $this->storeCategories($categories['treeCategory']['items']);
        });
    }

    private function storeCategories(array $categories,?int $parent_id = null)
    {
        foreach ($categories as $category){
            $own = $this->createCategory($category['title']??'123',$category['id']);
            $this->createCharacteristics($category,$own);
            if ($parent_id){
                DB::table('categories_children')->insert([
                    'parent_id' => $parent_id,
                    'child_id' => $own->id,
                ]);
            }
            $children = $category['items'] ?? [];
            if (count($children) ){
                $this->storeCategories($children,$own->id);
            }
        }
    }

    private function createCategory(string $title,string $id):Category
    {
        /** @var Category */
       return Category::query()
            ->create([
                'name' => $title,
                'slug' => Str::slug(str_replace(':category:','',$id)) ,
                'status' => true,
            ]);
    }

    private function createCharacteristics(array $category,Category $model)
    {
        $characteristics = $category['characters'] ?? [];
        if ( count($characteristics) ){
            foreach ($characteristics as $characteristic){
                $unit = $characteristic['unit'] ?? null;
                $measurment = null;
                if ($unit) {
                    $measurment = MeasurementUnit::query()->updateOrCreate([
                        'name' => $unit
                    ], [
                        'name' => $unit,
                        'symbol' => $unit,
                        'is_active' => true,
                    ]);
                }
                $character = Characteristic::query()->updateOrCreate(
                    ['name'=>$characteristic['name']
                    ],[
                    'name' => $characteristic['name'],
                    'title'=> $characteristic['title'],
                    'description'=> $characteristic['description'] ?? null,
                    'measurement_unit_id'=>$measurment ? $measurment->id : null,
                    'is_active' => true,
                ]);
                $model->characteristics()
                    ->attach($character->id);
                $attributes = $characteristic['rows'] ?? [];
                if ( count($attributes) ){
                    foreach ($attributes as $attribute){
                        $characterAttribute = CharacteristicAttribute::query()->updateOrCreate([
                            'name' => $attribute['name']
                        ],[
                            'characteristic_id' => $character->id,
                            'name' => $attribute['name'],
                            'is_active' => true,
                        ]);
                    }}
            }
        }
    }
}
