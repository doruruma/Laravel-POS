<?php

use App\Access;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessSeeder extends Seeder
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
        DB::table('accesses')->truncate();

        // Fill the data
        $accesses = [
            // Admin
            ['role_id' => '1', 'menu_id' => '1'],
            ['role_id' => '1', 'menu_id' => '2'],
            ['role_id' => '1', 'menu_id' => '3'],
            ['role_id' => '1', 'menu_id' => '4'],
            ['role_id' => '1', 'menu_id' => '5'],
            // User
            ['role_id' => '2', 'menu_id' => '1'],
            ['role_id' => '2', 'menu_id' => '3'],
            ['role_id' => '2', 'menu_id' => '4'],
            // Cashier
            ['role_id' => '3', 'menu_id' => '1'],
            ['role_id' => '3', 'menu_id' => '5']
            
        ];
        foreach ($accesses as $access) {
            Access::create($access);
        }
    }
}
