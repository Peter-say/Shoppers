<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // protected static $productNames = [
    //     'T-shirt',
    //     'Short',
    //     'Boxers',
    //     'Goggles',
    //     'Necklace'
    // ];

    // public function productName()
    // {
    //     return static::rand(static::$productNames);
    // }

    public function definition(): array
    {
        $images = glob(public_path('web/images/*'));
        $random_images = $images[array_rand($images)];

        return [
            'user_id' => '1',
            'category_id' => mt_rand(1, 2),
            'name' => $this->faker->name,
            'price_per_unit' =>  $this->faker->randomFloat(10, 2),
            'basic_unit' =>  'kg',
            'quantity' =>  5,
            'size' =>  'medium',
            'color' => 'blue',
            'description' => $this->faker->sentence(),
            'images' => $random_images,
            'active_for_sale' => '10',
            'status' => 'active',

        ];
    }
}
