<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Traits\Publishable;
use App\Services\DatatablesService;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ResourceController;

class PagesController extends ResourceController
{
    use Publishable;

    protected $settings = [
        'title'     => 'Pages',
        'resource'  => 'Page',
        'model'     => 'App\Page',
        'routePath' => 'admin.pages',
        'viewPath'  => 'admin.pages',
        'navPath'   => 'admin.pages',
        'master'    => 'admin',
    ];
    
    protected $rules = [
        'title' => 'required',
        'url' => 'required'
    ];

    protected $datatables = [
        'order' => true,
        'fields' => [
            ['key' => 'id', 'sortable' => false],
            ['key' => 'title', 'sortable' => false],
            ['key' => 'url', 'sortable' => false],
            ['key' => 'settings', 'sortable' => false, 'tdClass' => 'w-25'],    
        ],
        'settings' => [
            ['type' => 'switch'],
            [
                'type' => 'custom',
                'route' => 'sections.index',
                'icon' => 'fa-fw fas fa-bars',
                'variant' => 'info',
                'title' => 'View Sections'
            ],
            ['type' => 'edit'],
            ['type' => 'delete'],
        ]
    ];

    protected function additionalParams(Model $entity = null)
    {
        $rootPages = Page::select('id', 'title')
                    ->where('parent_id', NULL)
                    ->pluck('title', 'id');

        return [
            'parents' => array_replace(
                [
                    0 => "None"
                ],
                $rootPages->all()
            )
        ];
    }

    public function draw()
    {
        $entities = Page::select(['id', 'title', 'url', 'published', 'parent_id'])
                            ->with('sections');

        $datatable = DatatablesService::draw($entities, $this->settings, $this->datatables);
        
        $datatable->editColumn('title', function($entity) {
            if (!is_null($entity->parent_id)) {
                return '<i class="fas fa-angle-double-right pl-3 pr-2 align-middle"></i>' . $entity->title;
            }
            return $entity->title;
        });
        
        return $datatable->rawColumns(['title'])->toJson();
    }
}