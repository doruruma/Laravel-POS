<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the table data
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('products')->truncate();

        // Fill the data
        $products = [
            ['name' => 'Kertas A4', 'description' => 'kertas ukuran A4', 'stock' => 90, 'price' => 500, 'category_id' => 1],
            ['name' => 'Mouse Logitech B82', 'description' => 'Input Device Mouse Logitech B82', 'stock' => 20, 'price' => 75000, 'category_id' => 2]
        ];
        foreach($products as $product) {
            Product::create($product);
        }
    }
}
