<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => "Costin Soare",
            'email' => "user@soa.re",
            'password' => Hash::make("User123"),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
