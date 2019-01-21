<?php

use Illuminate\Database\Seeder;

class SectionTypesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\SectionType::create([
            'name' => 'cta',
            'label' => 'Call to action',
        ]);
        
        App\SectionType::create([
            'name' => 'features',
            'label' => 'Features',
        ]);
        
        App\SectionType::create([
            'name' => 'contents',
            'label' => 'Contents',
        ]);
        
        // App\SectionType::create([
        //     'name' => 'teams',
        //     'label' => 'Teams',
        // ]);
        
        // App\SectionType::create([
        //     'name' => 'testimonials',
        //     'label' => 'Testimonials',
        // ]);
    }
}