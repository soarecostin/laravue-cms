<?php

namespace App\Services;

use Illuminate\Http\Request;

class FilterTable
{
    public static function init(&$filters)
    {
        foreach ($filters as &$settings) {
            $settings['selected'] = $settings['default'];
                
            // Check if the filter value is kept in session
            if (request()->session()->has($settings['session'])) {
                $settings['selected'] = request()->session()->get($settings['session']);
            }
        }
    }

    public static function select($settings, Request $request)
    {
        $values = [];
        foreach ($settings['options'] as $opt) {
            $values[] = $opt['value'];
        }
        
        $selected = $settings['default'];
        if ($request->has($settings['name']) && in_array($request->query($settings['name']), $values)) {
            // Store in session
            $request->session()->put($settings['session'], $request->query($settings['name']));

            $selected = $request->query($settings['name']);
        }

        return $selected;
    }
}