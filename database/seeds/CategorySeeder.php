<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
        DB::table('categories')->truncate();

        // Fill the data
        $categories = [
            ['name' => 'ATK', 'description' => 'Alat Tulis Kantor'],
            ['name' => 'Peripheral', 'description' => 'Perangkat Peripheral Kantor']
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }

}
