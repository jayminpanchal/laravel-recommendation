<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleProducts = [
            // Clothing
            ["name" => "Shirt", "category" => "CLOTHING", "price" => 19.99, "brand" => "Brand A", "rating" => 4.2],
            ["name" => "Jeans", "category" => "CLOTHING", "price" => 49.99, "brand" => "Brand A", "rating" => 4.7],
            ["name" => "Hoodie", "category" => "CLOTHING", "price" => 39.99, "brand" => "Brand B", "rating" => 4.1],

            // Footwear
            ["name" => "Running Shoes", "category" => "FOOTWEAR", "price" => 79.99, "brand" => "Brand B", "rating" => 4.8],
            ["name" => "Sneakers", "category" => "FOOTWEAR", "price" => 69.99, "brand" => "Brand C", "rating" => 3.9],
            ["name" => "Hiking Boots", "category" => "FOOTWEAR", "price" => 89.99, "brand" => "Brand C", "rating" => 4.5],

            // Accessories
            ["name" => "Baseball Cap", "category" => "ACCESSORIES", "price" => 14.99, "brand" => "Brand D", "rating" => 4.3],
            ["name" => "Leather Wallet", "category" => "ACCESSORIES", "price" => 29.99, "brand" => "Brand D", "rating" => 4.6],
            ["name" => "Sunglasses", "category" => "ACCESSORIES", "price" => 24.99, "brand" => "Brand E", "rating" => 4.0]
        ];

        $products = [];

        for ($i = 0; $i < 100; $i++) {
            $sample = $sampleProducts[array_rand($sampleProducts)];

            $products[] = [
                'name' => $sample['name'] . $i,
                'category' => $sample['category'],
                'price' => $sample['price'] + $i,
                'brand' => $sample['brand'],
                'rating' => $sample['rating'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert into database
        DB::table('products')->insert($products);
    }
}
