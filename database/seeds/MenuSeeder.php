<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
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
        DB::table('menus')->truncate();

        // Fill the data
        $menus = [
            ['menu' => 'Profile'],  // 1
            ['menu' => 'Users Management'], // 2
            ['menu' => 'Supplier Management'], // 3
            ['menu' => 'Product Management'],   // 4
            ['menu' => 'Cashier']   // 5
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
