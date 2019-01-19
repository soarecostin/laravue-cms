<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $settings = [
        'resource'  => 'Dashboard',
        'navPath'   => 'user.dashboard',
        'routePath' => 'user.dashboard',
        'viewPath'  => 'user.dashboard',
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