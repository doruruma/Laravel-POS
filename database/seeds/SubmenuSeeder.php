<?php

use App\Submenu;
use Illuminate\Database\Seeder;
use PhpParser\Node\Identifier;

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
            // Profile Menu
            ['submenu' => 'Edit Profile', 'route' => 'profile.edit', 'icon' => 'fas fa-user-tie', 'identifier' => 'profile', 'menu_id' => 1, 'active' => 1],
            ['submenu' => 'Change Password', 'route' => 'profile.password', 'icon' => 'fas fa-lock', 'identifier' => 'password', 'menu_id' => 1, 'active' => 1],
            // Users Management Menu
            ['submenu' => 'Users List', 'route' => 'user', 'icon' => 'fas fa-users', 'identifier' => 'user', 'menu_id' => 2, 'active' => 1],
            ['submenu' => 'Role', 'route' => 'role', 'icon' => 'fas fa-cogs', 'identifier' => 'role', 'menu_id' => 2, 'active' => 1],
            // Supplier Menu
            ['submenu' => 'Supplier Data', 'route' => 'supplier', 'icon' => 'fas fa-people-carry', 'identifier' => 'supplier', 'menu_id' => 3, 'active' => 1],
            // Product Menu
            ['submenu' => 'Categories', 'route' => 'category', 'icon' => 'fas fa-th', 'identifier' => 'category', 'menu_id' => 4, 'active' => 1],
            ['submenu' => 'Products', 'route' => 'product', 'icon' => 'fas fa-archive', 'identifier' => 'product', 'menu_id' => 4, 'active' => 1],
            ['submenu' => 'Products Supply', 'route' => 'supply', 'icon' => 'fas fa-box-open', 'identifier' => 'supply', 'menu_id' => 4, 'active' => 1],
            // Cashier Menu
            ['submenu' => 'Cashier Transaction', 'route' => 'cashier', 'icon' => 'fas fa-cash-register', 'identifier' => 'cashier', 'menu_id' => 5, 'active' => 1],
            ['submenu' => 'Cart', 'route' => 'cart', 'icon' => 'fas fa-shopping-cart', 'identifier' => 'cart', 'menu_id' => 5, 'active' => 1],
        ];
        foreach ($submenus as $submenu) {
            Submenu::create($submenu);
        }
    }
}
