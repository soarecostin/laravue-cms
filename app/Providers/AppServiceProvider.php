<?php

namespace App\Providers;

use App\Menu;
use App\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->viewComposers();
        $this->registerBladeComponents();
        $this->explicitRouteBindings();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    protected function viewComposers()
    {
        view()->composer('admin.layouts.app', function($view) {
            $nav = config('admin.nav');
            $nav = $this->filterDeniedItems($nav, 'admin');
            $view->with('nav', $nav);
        });

        view()->composer('layouts.user.partials.topnav', function($view) {
            $nav = config('user.nav');
            $nav = $this->filterDeniedItems($nav, 'web');
            $view->with('nav', $nav);
        });

        view()->composer('layouts.main.partials.topnav', function($view) {
            $menu = Menu::select('id', 'title')
                        ->where('position', 'header')
                        ->first();                            
            
            $menuItems = collect([]);
            if ($menu) {
                $menuItems = MenuItem::select(['id', 'title', 'url', 'published', 'parent_id'])
                            ->where('published', 1)
                            ->where('menu_id', $menu->id)
                            ->defaultOrder()
                            ->get();
            }

            $view->with('menuItems', $menuItems);
        });
    }
    
    protected function filterDeniedItems($nav, $guard) {
        
        if (!Auth::guard($guard)->check() || empty($nav)) {
            return [];
        }
        
        foreach ($nav as $navKey => $navItem) {
            if (empty($navItem['gates'])) {
                continue;
            }

            foreach ($navItem['gates'] as $gate) {
                if (Gate::denies($gate)) {
                    unset($nav[$navKey]);

                    continue 2;
                }
            }
        }
        return $nav;
    }
    
    protected function registerBladeComponents()
    {
        // Aliasing Components
        Blade::component('components.form.input', 'input');
        Blade::component('components.form.checkbox', 'checkbox');
        Blade::component('components.form.selectbox', 'selectbox');
        Blade::component('components.form.textarea', 'textarea');
        Blade::component('components.form.wysywig', 'wysywig');
        Blade::component('components.form.file', 'file');
        Blade::component('components.form.radio', 'radio');
    }
    
    protected function explicitRouteBindings()
    {
        Route::bind('page', function($value) {
            return \App\Page::where('id', $value)->firstOrFail();
        });
        Route::bind('pageSection', function($value) {
            return \App\PageSection::where('id', $value)->firstOrFail();
        });
        Route::bind('menu', function($value) {
            return \App\Menu::where('id', $value)->firstOrFail();
        });
        Route::bind('menuItem', function($value) {
            return \App\MenuItem::where('id', $value)->firstOrFail();
        });
    }
}
