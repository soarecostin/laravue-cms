<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Page::create([
            'title' => 'Homepage',
            'url' => '/',
            'published' => 1,
        ]);
    }
}