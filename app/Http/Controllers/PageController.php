<?php

namespace App\Http\Controllers;

use App\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug = '/')
    {
        $slug = str_start($slug, '/');
        
        $page = Page::where('url', $slug)
                    ->where('published', 1)
                    ->first();
        
        if ($page) {
            return view('page', [
                'page' => $page,
            ]);
        }
        
        return abort(404);
    }
}