<?php

use App\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
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
        DB::table('customers')->truncate();

        // Fill the table
        $customers = [
            ['email' => 'paijo@email.com', 'name' => 'paijo', 'address' => 'Jl Karang', 'phone' => '089321381238'],
            ['email' => 'suketi@email.com', 'name' => 'suketi', 'address' => 'Jl Batu Bata', 'phone' => '083897418489']
        ];
        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }

}
