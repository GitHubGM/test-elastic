<?php

namespace Database\Seeders;

use App\Models\Product\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::factory()->count(1000)->create();
    }
}
