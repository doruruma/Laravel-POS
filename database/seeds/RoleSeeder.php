<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
        DB::table('roles')->truncate();

        // Fill the data
        $roles = [
            ['role' => 'Admin'],
            ['role' => 'User'],
            ['role' => 'Kasir'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
