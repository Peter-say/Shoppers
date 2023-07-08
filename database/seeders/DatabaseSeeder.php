<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

// $fakar->addProvider(new ProductFactory($fakar));


class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProductCategorySeeder::class);
        \App\Models\Product::factory(10)->create();
        $this->call(CurrencyTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);

    }
}
