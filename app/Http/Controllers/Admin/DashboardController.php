<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $settings = [
        'resource'  => 'Dashboard',
        'navPath'   => 'admin.dashboard',
        'routePath' => 'admin.dashboard',
        'viewPath'  => 'admin.dashboard',
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->settings['viewPath'], [
            'settings' => $this->settings,
        ]);
    }
}