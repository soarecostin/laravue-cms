<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);

        $this->viewComposers($request);
        $this->registerBladeComponents();
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
    
    protected function viewComposers(Request $request)
    {
        view()->composer('admin.layouts.app', function ($view) {
            $nav = config('admin.nav');
            $nav = $this->filterDeniedItems($nav, 'admin');
            $view->with('nav', $nav);
        });

        view()->composer('layouts.user.partials.topnav', function ($view) {
            $nav = config('user.nav');
            $nav = $this->filterDeniedItems($nav, 'web');
            $view->with('nav', $nav);
        });
    }
    
    protected function filterDeniedItems($nav, $guard) {
        
        if (!Auth::guard($guard)->check()) {
            return [];
        }
        if (empty($nav)) {
            return $nav;
        }
        foreach ($nav as $navKey => $navItem) {
            if (!empty($navItem['gates'])) {
                $denied = false;
                foreach ($navItem['gates'] as $gate) {
                    if (Gate::denies($gate)) {
                        $denied = true;
                    }
                }
                if ($denied) {
                    unset($nav[$navKey]);
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
}
