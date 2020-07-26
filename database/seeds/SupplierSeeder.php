<?php

use App\Supplier;
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
        $suppliers = [
            [
                'name' => 'Supplier 1',
                'address' => 'JL Batako NO 2',
                'phone' => '000099992222'
            ],
            [
                'name' => 'Supplier 2',
                'address' => 'JL Tanah Merah NO 14',
                'phone' => '888822223333'
            ]
        ];
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
