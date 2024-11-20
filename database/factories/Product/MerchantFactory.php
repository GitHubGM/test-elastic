<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->company(),
            'description'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(),
            'email'=>$this->faker->unique()->safeEmail(),
            'phone'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
            'is_active'=>true,
            'position'=>$this->faker->numberBetween(1,100)
        ];
    }
}
