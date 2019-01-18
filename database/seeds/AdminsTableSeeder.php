<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Admin::create([
            'name' => "Costin Soare",
            'email' => "admin@soa.re",
            'password' => Hash::make("Admin123"),
            'type' => 1
        ]);
    }
}