<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutUs = App\MenuItem::create([
            'title' => 'About us',
            'url' => '#',
            'menu_id' => 1,
        ]);

        App\MenuItem::create([
            'title' => 'About us #1',
            'url' => '#',
            'parent_id' => $aboutUs->id,
            'menu_id' => 1,
        ]);

        App\MenuItem::create([
            'title' => 'About us #2',
            'url' => '#',
            'parent_id' => $aboutUs->id,
            'menu_id' => 1,
        ]);

        App\MenuItem::create([
            'title' => 'About us #3',
            'url' => '#',
            'parent_id' => $aboutUs->id,
            'menu_id' => 1,
        ]);

        $services = App\MenuItem::create([
            'title' => 'Our Services',
            'url' => '#',
            'menu_id' => 1,
        ]);

        App\MenuItem::create([
            'title' => 'Services #1',
            'url' => '#',
            'menu_id' => 1,
            'parent_id' => $services->id
        ]);

        App\MenuItem::create([
            'title' => 'Services #2',
            'url' => '#',
            'menu_id' => 1,
            'parent_id' => $services->id
        ]);

        App\MenuItem::create([
            'title' => 'Services #3',
            'url' => '#',
            'parent_id' => 16,
            'menu_id' => 1,
            'parent_id' => $services->id
        ]);
    }
}
