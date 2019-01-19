<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Section;
use App\PageSection;
use App\SectionType;
use App\Traits\Publishable;
use Illuminate\Http\Request;
use App\Services\DatatablesService;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ResourceController;

class PageSectionsController extends ResourceController
{
    use Publishable;

    protected $settings = [
        'title'     => 'Page Sections',
        'resource'  => 'Page Section',
        'model'     => 'App\PageSection',
        'routePath' => 'admin.pages.sections',
        'viewPath'  => 'admin.pages.sections',
        'navPath'   => 'admin.pages',
        'master'    => 'admin',
    ];
    
    protected $rules = [
        'title' => 'required',
    ];

    protected $datatables = [
        'fields' => [
            ['key' => 'template', 'class' => 'col d-flex align-items-center'],
            ['key' => 'settings', 'class' => 'col-3 ml-auto d-flex align-items-center justify-content-center'],
        ],
    ];

    protected function additionalParams(Model $entity = null)
    {
        $sections = Section::select(['id', 'section_type_name', 'title', 'desc', 'thumbnail', 'template_name', 'fields'])->get();
        $sectionTypes = SectionType::select()->get()->pluck('label', 'name');

        return [
            'sections' => $sections,
            'sectionTypes' => $sectionTypes
        ];
    }

    protected function saveRoutine(Model $entity, Model $parentEntity = null)
    {
        $templateData = collect(request()->all())->filter(function($value, $key) {
            return substr($key, 0, 4) == "tpl_";
        });
        
        $entity->fill(request()->only(['title', 'content', 'section_id']));
        $entity->template_data = json_encode($templateData->all());

        // For create
        if (!is_null($parentEntity)) {
            $entity->sort_order = PageSection::nextSortIndex($parentEntity->id);
            $entity->page()->associate($parentEntity);
        }

        $entity->save();

        return $entity;
    }

    protected function redirectAfterUpdate(Model $entity = null)
    {
        return route($this->settings['routePath'] . '.index', $entity->page);
    }
    
    public function draw(Page $page)
    {
        $items = PageSection::select(['id', 'page_id', 'section_id', 'title', 'template_data', 'content', 'published'])
                            ->where('page_id', $page->id)
                            ->orderBy('sort_order')
                            ->get();
        
        $itemsVue = $items->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'template' => [
                    'id' => $item->section_id,
                    'name' => $item->section->template_name,
                    'data' => $item->template_data,
                    'content' => $item->content
                ],
                'settings' => [
                    [ 
                        'type' => 'switch',
                        'urls' => [
                            'on' => route($this->settings['routePath'] . '.publish', [$item->id]),
                            'off' => route($this->settings['routePath'] . '.unpublish', [$item->id])
                        ],
                        'value' => $item->published,
                    ],
                    [
                        'type' => 'edit',
                        'icon' => 'fas fa-pencil-alt',
                        'title' => 'Edit',
                        'variant' => 'primary',
                        'url' => route($this->settings['routePath'] . ".edit", [$item->id]),
                    ],
                    [
                        'type' => 'delete',
                        'url' => route($this->settings['routePath'] . ".destroy", [$item->id]),
                    ]
                ]
            ];
        });

        return response()->json($itemsVue);
    }
    
    public function saveOrder(Page $page, Request $request)
    {
        if ($request->has('items')) {
            $items = json_decode($request->input('items'));

            foreach ($items as $item) {
                PageSection::updateOrCreate(
                    ['id' => $item->id, 'page_id' => $page->id],
                    ['sort_order' => $item->sort_order]
                );
            }
        }
        return response()->json(true);
    }
}