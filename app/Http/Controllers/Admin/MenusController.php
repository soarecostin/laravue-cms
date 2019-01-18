<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Traits\Publishable;
use App\Services\DatatablesService;
use App\Http\Controllers\ResourceController;

class MenusController extends ResourceController
{
    use Publishable;

    protected $settings = [
        'title'     => 'Menus',
        'resource'  => 'Menu',
        'model'     => 'App\Menu',
        'routePath' => 'admin.menus',
        'viewPath'  => 'admin.menus',
        'navPath'   => 'admin.menus',
    ];
    
    protected $rules = [
        'title' => 'required',
        'position' => 'required',
    ];

    protected $datatables = [
        'select' => ['id', 'title', 'position'],
        'fields' => [
            [ 'key' => 'id', 'sortable' => true ],
            [ 'key' => 'title', 'sortable' => false ],
            [ 'key' => 'position', 'sortable' => false, 'label' => 'Placement' ],
            [ 'key' => 'settings', 'sortable' => false ],
        ],
        'settings' => [
            [ 'type' => 'children', 'title' => 'Menu Items' ],
            [ 'type' => 'edit' ],
            [ 'type' => 'delete' ],
        ]
    ];

    public function draw()
    {
        $entities = Menu::select($this->datatables['select']);
        
        return DatatablesService::draw($entities, $this->settings, $this->datatables)->make(true);
    }
}