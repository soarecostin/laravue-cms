<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Section::create([
            'id' => 1,
            'section_type_name' => 'contents',
            'title' => 'Custom (HTML/Content)',
            'desc' => 'Build your own, custom section type',
            'thumbnail' => '/img/blocks/custom-html-thumb.png',
            'template_name' => '',
            'fields' => '',
        ]);
    }
}
