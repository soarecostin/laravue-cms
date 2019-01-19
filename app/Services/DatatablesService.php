<?php

namespace App\Services;

use Yajra\Datatables\Datatables;

class DatatablesService
{
    public static function hasOrder()
    {
        if (request()->has('sortBy') && !is_null(request('sortBy')) && request('sortBy') != 'null') {
            return true;
        }
        return false;
    }

    public static function order($query)
    {
        if (request()->has('sortBy') && !is_null(request('sortBy')) && request('sortBy') != 'null') {
            $sortBy = 'asc';
            if (request()->has('sortDesc') && request('sortDesc') == 'true') {
                $sortBy = 'desc';
            }
            $query->orderBy(request('sortBy'), $sortBy);
        }
        return $query;
    }
    
    public static function retrieveParams($settings)
    {
        return [
            'currentPage' => session($settings['routePath'] . '.currentPage', 1),
            'sortBy' => session($settings['routePath'] . '.sortBy', ''),
            'sortDesc' => session($settings['routePath'] . '.sortDesc', 'false')
        ];
    }

    public static function storeParams($settings)
    {
        session([$settings['routePath'] . '.currentPage' => request('currentPage')]);
        session([$settings['routePath'] . '.sortBy' => request('sortBy')]);
        session([$settings['routePath'] . '.sortDesc' => request('sortDesc')]);
    }
    
    public static function draw($entities, $settings, $data)
    {
        self::storeParams($settings);
        
        if (isset($data['order']) && !self::hasOrder()) {
            $entities->defaultOrder();
        }
        
        $datatables = Datatables::of($entities);
        $datatables = $datatables->order(function($query) {
            return self::order($query);
        });
        
        $datatables->addColumn('settings', function($entity) use ($settings, $data) {
            if (!$data['settings']) {
                return;
            }

            return self::renderButtons($entity, $data['settings'], $settings);
        });

        return $datatables;
    }

    protected static function renderButtons($entity, $datatablesSettings, $settings)
    {
        $buttons = [];
        foreach ($datatablesSettings as $buttonDetails) {
            if (!isset($buttonDetails['type'])) {
                continue;
            }
            
            $disabled = isset($buttonDetails['disabled_attr']) ? $entity->{$buttonDetails['disabled_attr']} : false;
            
            $buttons[] = self::{'render' . ucfirst($buttonDetails['type']) . 'Btn'}($entity, $buttonDetails, $settings, $disabled);
        }

        return $buttons;
    }
    
    protected static function renderSwitchBtn($entity, $buttonDetails, $settings, $disabled)
    {
        return [
            'type' => 'switch',
            'urls' => [
                'on' => route($settings['routePath'] . '.publish', [$entity->id]),
                'off' => route($settings['routePath'] . '.unpublish', [$entity->id])
            ],
            'value' => $entity->published,
            'disabled' => $disabled,
        ];
    }
    
    protected static function renderChildrenBtn($entity, $buttonDetails, $settings, $disabled)
    {
        return [
            'icon' => $buttonDetails['icon'] ?? 'fas fa-bars',
            'title' => $buttonDetails['title'] ?? '',
            'variant' => $buttonDetails['variant'] ?? 'info',
            'url' => route($settings['routePath'] . "." . ($buttonDetails['url'] ?? 'items') . ".index", [$entity->id]),
        ];
    }
    
    protected static function renderEditBtn($entity, $buttonDetails, $settings, $disabled)
    {
        return [
            'icon' => 'fas fa-pencil-alt',
            'title' => $buttonDetails['title'] ?? 'Edit',
            'variant' => 'primary',
            'url' => route($settings['routePath'] . ".edit", [$entity->id]),
            'disabled' => $disabled,
        ];
    }

    protected static function renderDeleteBtn($entity, $buttonDetails, $settings, $disabled)
    {
        return [
            'type' => 'delete',
            'url' => route($settings['routePath'] . ".destroy", [$entity->id]),
            'disabled' => $disabled,
        ];
    }

    protected static function renderShowBtn($entity, $buttonDetails, $settings, $disabled)
    {
        return [
            'icon' => 'far fa-eye',
            'title' => $buttonDetails['title'] ?? 'Show',
            'variant' => 'primary',
            'target' => $buttonDetails['target'] ?? '',
            'url' => route($settings['routePath'] . '.show', [$entity->id]),
        ];
    }
    
    protected static function renderCustomBtn($entity, $buttonDetails, $settings, $disabled)
    {
        $data = [
            'icon' => $buttonDetails['icon'] ?? '',
            'title' => $buttonDetails['title'] ?? '',
            'variant' => $buttonDetails['variant'] ?? 'info',
            'url' => $buttonDetails['url'] ?? '',
            'disabled' => $disabled,
        ];
        
        if (isset($buttonDetails['route'])) {
            $data['url'] = route($settings['routePath'] . '.' . $buttonDetails['route'], [$entity->id]);
        }

        if (isset($buttonDetails['pill'])) {
            $data['pill'] = $entity->{$buttonDetails['pill']};
        }

        return $data;
    }
}