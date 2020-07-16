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
            ['menu' => 'Profile'],
            ['menu' => 'Users Management'],
            ['menu' => 'Supplier'],
            ['menu' => 'POS Management'],
            ['menu' => 'Customers'],
            ['menu' => 'Cashier']
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
