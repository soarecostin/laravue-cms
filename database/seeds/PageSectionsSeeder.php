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
            'title' => 'Header CTA',
            'page_id' => 1,
            'section_id' => App\Section::where('template_name', 'call-to-action-13')->first()->id,
            'template_data' => json_encode([
                'tpl_title' => 'Laravue CMS',
                'tpl_subtitle' => 'A CMS built with Laravel and Vue, using Bootstrap and Froala Blocks.',
                'tpl_image' => 'purple',
                'tpl_icon' => 'coffee',
                'tpl_btn_label' => 'Star on Github',
                'tpl_btn_url' => 'https://github.com/soarecostin/laravue-cms'
            ]),
            'sort_order' => 1,
            'published' => 1
        ]);

        App\PageSection::create([
            'title' => 'Content block',
            'page_id' => 1,
            'section_id' => App\Section::where('template_name', 'content-31')->first()->id,
            'template_data' => json_encode([
                'tpl_title_1' => 'Your Website',
                'tpl_content_1' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.',
                'tpl_btn_label_1' => 'Read more',
                'tpl_btn_url_1' => '#',
                'tpl_title_2' => 'Amazing Design',
                'tpl_content_2' => 'Right at the coast of the Semantics, a large language ocean. A small river named Dude a rge language ocean there live the blind.',
                'tpl_btn_label_2' => 'Read more',
                'tpl_btn_url_2' => '#',
                'tpl_image' => 'tabs',
            ]),
            'sort_order' => 2,
            'published' => 1
        ]);
        
    }
}
