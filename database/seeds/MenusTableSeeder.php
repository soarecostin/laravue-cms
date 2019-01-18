<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Menu::create([
            'id' => 1,
            'title' => 'Main Menu',
            'position' => 'header',
        ]);
    }
}
