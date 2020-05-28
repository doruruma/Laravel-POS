<?php

use App\Submenu;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
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
        DB::table('submenus')->truncate();

        // Fill the data
        $submenus = [
            ['submenu' => 'Edit Profile', 'route' => 'profile.edit', 'icon' => 'fas fa-user-tie', 'identifier' => 'profile', 'menu_id' => 1, 'active' => 1],
            ['submenu' => 'Change Password', 'route' => 'profile.password', 'icon' => 'fas fa-lock', 'identifier' => 'password', 'menu_id' => 1, 'active' => 1],
            ['submenu' => 'Users List', 'route' => 'user', 'icon' => 'fas fa-users', 'identifier' => 'user', 'menu_id' => 2, 'active' => 1],
            ['submenu' => 'Role', 'route' => 'role', 'icon' => 'fas fa-cogs', 'identifier' => 'role', 'menu_id' => 2, 'active' => 1],
            ['submenu' => 'Categories', 'route' => 'category', 'icon' => 'fas fa-th', 'identifier' => 'category', 'menu_id' => 4, 'active' => 1],
            ['submenu' => 'Products', 'route' => 'product', 'icon' => 'fas fa-file', 'identifier' => 'product', 'menu_id' => 4, 'active' => 1],
            ['submenu' => 'Cashier Transaction', 'route' => 'cashier', 'icon' => 'fas fa-money', 'identifier' => 'cashier', 'menu_id' => 5, 'active' => 1],
        ];
        foreach ($submenus as $submenu) {
            Submenu::create($submenu);
        }
    }
}
