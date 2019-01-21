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
        $nextSortIndex = 1;

        App\PageSection::create([
            'title' => 'Header CTA',
            'page_id' => 1,
            'section_id' => App\Section::where('template_name', 'call-to-action-13')->first()->id,
            'template_data' => json_encode([
                'tpl_title' => 'Laravue CMS',
                'tpl_subtitle' => 'A CMS built with Laravel and Vue, using Bootstrap and Froala Blocks.',
                'tpl_image' => 'purple',
                'tpl_icon' => 'navigation',
                'tpl_btn_label' => 'Star on Github',
                'tpl_btn_url' => 'https://github.com/soarecostin/laravue-cms'
            ]),
            'sort_order' => $nextSortIndex++,
            'published' => 1
        ]);

        App\PageSection::create([
            'title' => 'Features 3 col',
            'page_id' => 1,
            'section_id' => App\Section::where('template_name', 'feature-9')->first()->id,
            'template_data' => json_encode([
                'tpl_title' => 'Features',
                'tpl_feature_icon_1' => 'layers',
                'tpl_feature_title_1' => 'Feature 1',
                'tpl_feature_desc_1' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia',
                
                'tpl_feature_icon_2' => 'gift',
                'tpl_feature_title_2' => 'Feature 2',
                'tpl_feature_desc_2' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large ocean.',
                
                'tpl_feature_icon_3' => 'cloud',
                'tpl_feature_title_3' => 'Feature 3',
                'tpl_feature_desc_3' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia',
            ]),
            'sort_order' => $nextSortIndex++,
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
            'sort_order' => $nextSortIndex++,
            'published' => 1
        ]);
    }
}
