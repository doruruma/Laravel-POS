<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
        DB::table('users')->truncate();

        // Fill the table
        $users = [
            [
                'name' => 'doruruma',
                'email' => 'doruruma@email.com',
                'password' => bcrypt('doruruma'),
                'image' => 'default_profile.png',
                'role_id' => 1
            ], [
                'name' => 'calciffer',
                'email' => 'calciffer@email.com',
                'password' => bcrypt('calciffer'),
                'image' => 'default_profile.png',
                'role_id' => 2
            ], [
                'name' => 'saulden',
                'email' => 'saulden@email.com',
                'password' => bcrypt('saulden'),
                'image' => 'default_profile.png',
                'role_id' => 3
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
