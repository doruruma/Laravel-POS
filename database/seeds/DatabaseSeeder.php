<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(AccessSeeder::class);
        $this->call(SubmenuSeeder::class);
    }
}
