<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\MenuItem;
use App\Traits\Publishable;
use App\Services\DatatablesService;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ResourceController;

class MenuItemsController extends ResourceController
{
    use Publishable;

    protected $settings = [
        'title'     => 'Menu Items',
        'resource'  => 'Menu Item',
        'model'     => 'App\MenuItem',
        'routePath' => 'admin.menus.items',
        'viewPath'  => 'admin.menus.items',
        'navPath'   => 'admin.menus',
    ];

    protected $rules = [
        'title' => 'required',
        'url' => 'required',
    ];

    protected $datatables = [
        'fields' => [
            ['key' => 'title', 'sortable' => false, 'class' => 'd-flex align-items-center'],
            ['key' => 'url', 'sortable' => false],
            ['key' => 'settings', 'sortable' => false],
        ],
        'settings' => [
            ['type' => 'switch'],
            ['type' => 'edit'],
            ['type' => 'delete'],
        ]
    ];

    protected function additionalParams(Model $entity = null)
    {
        $menuId = null;
        $rootMenuItems = [];
        if (!is_null($entity)) {
            if ($entity instanceof \App\Menu) {
                $menuId = $entity->id;
            }
            if ($entity instanceof \App\MenuItem) {
                $menuId = $entity->menu->id;
            }
        }
        if ($menuId != null) {
            $rootMenuItems = MenuItem::select('id', 'title')
                                ->where('parent_id', NULL)
                                ->where('menu_id', $menuId)
                                ->pluck('title', 'id')
                                ->all();
        }
        return [
            'parents' => array_merge([
                0 => "None"
            ], $rootMenuItems)
        ];
    }

    protected function saveRoutine(Model $entity, Model $parentEntity = null)
    {
        $entity->fill(request()->only(['title', 'url', 'parent_id', 'published']));
        if (!is_null($parentEntity)) {
            $entity->menu()->associate($parentEntity);
        }
        $entity->save();

        return $entity;
    }
    
    protected function redirectAfterUpdate(Model $entity = null)
    {
        return route($this->settings['routePath'] . '.index', [$entity->menu]);
    }

    public function draw(Menu $menu)
    {
        $entities = MenuItem::select(['id', 'title', 'url', 'published', 'parent_id'])
                            ->where('menu_id', $menu->id)
                            ->defaultOrder();
        
        $datatable = DatatablesService::draw($entities, $this->settings, $this->datatables);
        
        $datatable->editColumn('title', function($entity) {
            if (!is_null($entity->parent_id)) {
                return '<i class="fas fa-angle-double-right pl-3 pr-2 align-middle"></i>' . $entity->title;
            }
            return '<b>' . $entity->title . '</b>';
        });

        $datatable->rawColumns(['title']);

        return $datatable->make(true);
    }
}