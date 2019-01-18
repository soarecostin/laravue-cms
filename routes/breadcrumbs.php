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

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Pages', route('admin.pages.index'));
});

Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Create Page');
});

Breadcrumbs::for('admin.pages.edit', function ($trail, $entity) {
    $trail->parent('admin.pages.index');
    $trail->push('Edit Page ['.$entity->id.']');
});

/*
|--------------------------------------------------------------------------
| Page Sections
|--------------------------------------------------------------------------
*/

Breadcrumbs::for('admin.pages.sections.index', function ($trail, $page) {
    $trail->parent('admin.pages.index');
    $trail->push($page->title, route('admin.pages.sections.index', $page));
});

Breadcrumbs::for('admin.pages.sections.create', function ($trail, $page) {
    $trail->parent('admin.pages.sections.index', $page);
    $trail->push('Create Page Section');
});

Breadcrumbs::for('admin.pages.sections.edit', function ($trail, $entity) {
    $trail->parent('admin.pages.sections.index', $entity->page);
    $trail->push('Edit Page Section ['.$entity->id.']');
});
