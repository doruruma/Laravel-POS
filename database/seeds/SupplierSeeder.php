<?php

use App\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
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
        DB::table('suppliers')->truncate();

        // Fill the data
        $faker = Factory::create('id_ID');
        for ($i=1; $i <= 50; $i++) { 
            $supplier = new Supplier;
            $supplier->name = $faker->name;
            $supplier->address = $faker->address;
            $supplier->phone = $faker->phoneNumber;
            $supplier->save();
        }
    }
}
