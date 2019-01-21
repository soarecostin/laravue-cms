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

        App\Section::create([
            'id' => 2,
            'section_type_name' => 'cta',
            'title' => 'Call to action 16',
            'thumbnail' => '/img/blocks/cta-16.png',
            'template_name' => 'call-to-action-16',
            'fields' => json_encode([
                'fields' => [
                    [
                        'type' => 'input',
                        'inputType' => 'text',
                        'label' => 'Title',
                        'model' => 'tpl_title',
                        'required' => true,
                        'inputName' => 'tpl_title',
                        'placeholder' => 'Title'
                    ],
                    [
                        'type' => 'select',
                        'label' => 'Image',
                        'model' => 'tpl_image',
                        'inputName' => 'tpl_image',
                        'default' => 'blue',
                        'values' => [
                            [
                                'id' => 'blue',
                                'name' =>'Blue'
                            ],
                            [
                                'id' => 'purple',
                                'name' => 'Purple'
                            ],
                            [
                                'id' => 'red',
                                'name' => 'Red'
                            ],
                            [
                                'id' => 'yellow',
                                'name' => 'Yellow'
                            ],
                        ]
                    ],
                    [
                        'type' => 'input',
                        'inputType' => 'text',
                        'label' => 'Button label',
                        'model' => 'tpl_btn_label',
                        'required' => true,
                        'inputName' => 'tpl_btn_label',
                        'placeholder' => 'Button text'
                    ],
                    [
                        'type' => 'input',
                        'inputType' => 'text',
                        'label' => 'Button link',
                        'model' => 'tpl_btn_url',
                        'required' => true,
                        'inputName' => 'tpl_btn_url',
                        'placeholder' => '#'
                    ]
                ]
            ]),
        ]);

        App\Section::create([
            'id' => 3,
            'section_type_name' => 'contents',
            'title' => 'Content 31',
            'thumbnail' => '/img/blocks/content-31.png',
            'template_name' => 'content-31',
            'fields' => json_encode([
                'groups' => [
                    [
                        'legend' => "Column #1",
                        'fields' => [
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Title #1',
                                'model' => 'tpl_title_1',
                                'required' => true,
                                'inputName' => 'tpl_title_1',
                                'placeholder' => 'Title'
                            ],
                            [
                                'type' => 'textArea',
                                'label' => 'Description #1',
                                'model' => 'tpl_content_1',
                                'required' => true,
                                'inputName' => 'tpl_content_1',
                                'placeholder' => 'Description'
                            ],
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Button label #1',
                                'model' => 'tpl_btn_label_1',
                                'required' => true,
                                'inputName' => 'tpl_btn_label_1',
                                'placeholder' => 'Button text'
                            ],
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Button link',
                                'model' => 'tpl_btn_url_1',
                                'required' => true,
                                'inputName' => 'tpl_btn_url_1',
                                'placeholder' => '#'
                            ],
                        ]
                    ],
                    [
                        'legend' => "Column #2",
                        'fields' => [
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Title #2',
                                'model' => 'tpl_title_2',
                                'required' => true,
                                'inputName' => 'tpl_title_2',
                                'placeholder' => 'Title'
                            ],
                            [
                                'type' => 'textArea',
                                'label' => 'Description #2',
                                'model' => 'tpl_content_2',
                                'required' => true,
                                'inputName' => 'tpl_content_2',
                                'placeholder' => 'Description'
                            ],
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Button label #2',
                                'model' => 'tpl_btn_label_2',
                                'required' => true,
                                'inputName' => 'tpl_btn_label_2',
                                'placeholder' => 'Button text'
                            ],
                            [
                                'type' => 'input',
                                'inputType' => 'text',
                                'label' => 'Button link',
                                'model' => 'tpl_btn_url_2',
                                'required' => true,
                                'inputName' => 'tpl_btn_url_2',
                                'placeholder' => '#'
                            ],
                        ]
                    ],
                    [
                        'legend' => "Image",
                        'fields' => [
                            [
                                'type' => 'select',
                                'label' => 'Image',
                                'model' => 'tpl_image',
                                'inputName' => 'tpl_image',
                                'default' => 'tabs',
                                'values' => [
                                    [
                                        'id' => 'tabs',
                                        'name' =>'Tabs'
                                    ],
                                    [
                                        'id' => 'opened',
                                        'name' =>'Opened Mail'
                                    ],
                                ]
                            ],
                        ]
                    ],
                ]
            ]),
        ]);
    }
}
