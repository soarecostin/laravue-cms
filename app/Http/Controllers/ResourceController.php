<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilterTable;
use App\Services\DatatablesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;

abstract class ResourceController extends Controller
{
    protected $settings = [];
    protected $rules = [];
    protected $filters = [];
    protected $datatables = [];

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $parentEntity
     * @return \Illuminate\Http\Response
     */
    public function index(Model $parentEntity = null)
    {
        if (!is_null($this->filters)) {
            FilterTable::init($this->filters);
        }

        return view($this->settings['viewPath'] . '.index', array_merge([
            'settings' => $this->settings,
            'fields' => $this->datatables['fields'],
            'parentEntity' => $parentEntity,
            'filters' => $this->filters,
            'create' => $parentEntity ? route($this->settings['routePath'] . '.create', [$parentEntity])
                                      : route($this->settings['routePath'] . '.create'),
            'drawUrl' => $parentEntity ? route($this->settings['routePath'] . '.draw', [$parentEntity])
                                       : route($this->settings['routePath'] . '.draw'),
        ], DatatablesService::retrieveParams($this->settings)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $parentEntity
     * @return \Illuminate\Http\Response
     */
    public function create(Model $parentEntity = null)
    {
        $params = [
            'settings' => $this->settings,
            'entity' => null,
            'parentEntity' => $parentEntity,
            'route' => $parentEntity ? route($this->settings['routePath'] . '.store', [$parentEntity])
                                     : route($this->settings['routePath'] . '.store'),
        ];

        $additionalParams = $this->additionalParams($parentEntity);

        if (!empty($additionalParams)) {
            $params = array_merge($params, $additionalParams);
        }

        return view($this->settings['viewPath'] . '.edit', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $parentEntity
     * @return \Illuminate\Http\Response
     */
    public function store(Model $parentEntity = null)
    {
        $this->validate(request(), $this->rules);
        
        $entity = new $this->settings['model'];
        $entity = $this->saveRoutine($entity, $parentEntity);
        
        return redirect(
            $this->redirectAfterCreate($parentEntity)
        )->with('message', $this->settings['resource'] . ' created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $entity)
    {
        $params = [
            'settings' => $this->settings,
            'entity' => $entity,
            'route' => route($this->settings['routePath'] . '.update', [$entity->id]),
        ];
        
        $additionalParams = $this->additionalParams($entity);
        
        if (!empty($additionalParams)) {
            $params = array_merge($params, $additionalParams);
        }

        return view($this->settings['viewPath'] . '.edit', $params);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Model $entity)
    {
        if (isset($this->rules['email'])) {
            $this->rules['email'] .= ','.$this->excludeIdFromEmailCheck($entity); // Exclude the current resource from the query
        }

        $this->validate(request(), $this->rules);

        $entity = $this->saveRoutine($entity);
        
        return redirect(
            $this->redirectAfterUpdate($entity)
        )->with('message', $this->settings['resource'] . ' updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $entity, Request $request)
    {
        $this->deleteRoutine($entity);
        
        $request->session()->flash('message', $this->settings['resource'].' deleted successfully');
        
        return response()->json(true);
    }
    
    /**
     * Additional view params for create/edit routes
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return Array
     */
    protected function additionalParams(Model $entity = null) //extraViewsParams
    {
        return [];
    }

    /**
     * Specific save routine to the database.
     * 
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @param  \Illuminate\Database\Eloquent\Model  $parentEntity
     * @return \Illuminate\Database\Eloquent\Model  $entity
     */
    protected function saveRoutine(Model $entity, Model $parentEntity = null)
    {
        if (isset($this->settings['fill']) && !empty($this->settings['fill'])) {
            $entity->fill(request()->only($this->settings['fill']));
        } else {
            $entity->fill(request()->all());
        }

        $entity->save();

        return $entity;
    }
    
    /**
     * Specific save routine to the database.
     * 
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return void
     */
    protected function deleteRoutine(Model $entity)
    {
        $entity->delete();
    }

    /**
     * Get route to redirect to after the resource is created
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return \Illuminate\Routing\Route
     */
    protected function redirectAfterCreate(Model $parentEntity = null)
    {
        $routeParams = $parentEntity ? [$parentEntity] : [];
        return route($this->settings['routePath'] . '.index', $routeParams);
    }

    /**
     * Get route to redirect to after the resource is updated
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return \Illuminate\Routing\Route
     */
    protected function redirectAfterUpdate(Model $entity = null)
    {
        return route($this->settings['routePath'] . '.index');
    }
    
    /**
     * Return the id of the row to exclude from the email unique check
     *
     * @param  \Illuminate\Database\Eloquent\Model  $entity
     * @return integer
     */
    protected function excludeIdFromEmailCheck(Model $entity)
    {
        return $entity->id;
    }
}