<?php

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| ADMIN BREADCRUMBS
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

// Home
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('Home', route('admin.dashboard'));
});

/*
|--------------------------------------------------------------------------
| Menus
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('admin.menus.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Menus', route('admin.menus.index'));
});

Breadcrumbs::for('admin.menus.create', function ($trail) {
    $trail->parent('admin.menus.index');
    $trail->push('Create Menu');
});

Breadcrumbs::for('admin.menus.edit', function ($trail, $entity) {
    $trail->parent('admin.menus.index');
    $trail->push('Edit Menu ['.$entity->id.']');
});

/*
|--------------------------------------------------------------------------
| Menu items
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('admin.menus.items.index', function ($trail, $menu) {
    $trail->parent('admin.menus.index');
    $trail->push($menu->title, route('admin.menus.items.index', $menu));
});

Breadcrumbs::for('admin.menus.items.create', function ($trail, $menu) {
    $trail->parent('admin.menus.items.index', $menu);
    $trail->push('Create Menu Item');
});

Breadcrumbs::for('admin.menus.items.edit', function ($trail, $entity) {
    $trail->parent('admin.menus.items.index', $entity->menu);
    $trail->push('Edit Menu Item ['.$entity->id.']');
});