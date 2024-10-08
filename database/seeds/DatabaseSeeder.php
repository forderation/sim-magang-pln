<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'full_name' => 'admin PLN',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
