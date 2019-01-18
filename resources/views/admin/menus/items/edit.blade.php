@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render($settings['routePath'].'.'.(is_null($entity)?'create':'edit'), is_null($entity) ? ($parentEntity ?? null) : $entity) }}
@endsection

@section('page-content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header bg-dark text-light">
                <div class="panel-title hidden-xs lead">
                    {{ Breadcrumbs::current()->title }}
                </div>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ $route }}" autocomplete="off">
                    @csrf
                    
                    @if (!is_null($entity))
                        @method('put')
                    @endif

                    @input([
                        'name' => 'title',
                        'object' => $entity,
                        'attributes' => 'required'
                    ])
                    @endinput

                    @input([
                        'name' => 'url',
                        'object' => $entity,
                        'attributes' => 'required'
                    ])
                    @endinput
                    
                    @selectbox([
                        'name' => 'parent_id',
                        'label' => 'Parent',
                        'object' => $entity,
                        'options' => $parents
                    ])
                    @endselectbox

                    @checkbox([
                        'name' => 'published',
                        'label' => 'Published',
                        'object' => $entity,
                    ])
                    @endcheckbox

                    <button type="submit" class="btn btn-primary">
                        @if (is_null($entity))
                            Create
                        @else
                            Edit
                        @endif
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection