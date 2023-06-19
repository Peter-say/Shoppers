<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = glob(public_path('web/images/*'));
        $random_images = $images[array_rand($images)];

        $datas = [
            [
                'image' => $random_images,
                'name' => 'Wristwatch',
                'parent_id' => null,
            ],

            [
                'image' => $random_images,
                'name' => 'Shoes',
                'parent_id' => 1,
            ],

            [
                'image' => $random_images,
                'name' => 'Cap',
                'parent_id' => 1,
            ],

            [
                'image' => $random_images,
                'name' => 'Phones',
                'parent_id' => 2,
            ],

            [
                'image' => $random_images,
                'name' => 'T-shirt',
                'parent_id' => 2,
            ],
        ];

        foreach ($datas as $key => $data) {
            ProductCategory::create($data);
        }
    }
}
