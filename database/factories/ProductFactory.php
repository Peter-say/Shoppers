<?php

namespace Database\Factories;

use App\Constants\Finance\CurrencyConstants;
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
        // cover images generation
        $cover_image = glob(public_path('product/cover_images/*'));
        $randonCoverImages  = basename($cover_image[array_rand($cover_image)]);

        // other images generation
        $images = glob(public_path('product/cover_images/*'));
        $random_images = basename($images[array_rand($images)]);
       

        $faker = \Faker\Factory::create();
        $meta_keyword = implode(',', $faker->words(mt_rand(3, 5)));

        return [
            'user_id' => 1,
            'category_id' => mt_rand(1, 2),
            'store_id' => mt_rand(1, 5),
            'brand_id' => mt_rand(1, 5),
            'currency_id' => 1,
            'name' => $this->faker->name,
            'amount' =>  $amount =   $this->faker->randomFloat(8, 2, 1000),
            'discount_price' =>  $discount_price =  $this->faker->randomFloat(4, 2, 100),
            'discount_percent' => (($amount - $discount_price) / $amount) * 100,
            'discount_period' => null,
            'basic_unit' =>  'kg',
            'description' => $this->faker->paragraph($nbSentences = 30),
            'meta_description' => $this->faker->text($nbSentences  = 5),
            'meta_keyword' => $meta_keyword,
            'images' => $random_images,
            'cover_image' =>  $randonCoverImages ,
            'stock_status' => 'Available',
            'status' => 'active',

        ];
    }
}
