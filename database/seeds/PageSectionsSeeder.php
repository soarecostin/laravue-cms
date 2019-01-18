<?php

use Illuminate\Database\Seeder;

class PageSectionsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\PageSection::create([
            'title' => 'Hompage Test Section',
            'page_id' => 1,
            'section_id' => 1,
            'content' => '<h1>Html content here</h1>',
            'sort_order' => 3,
            'published' => 1
        ]);
    }
}
