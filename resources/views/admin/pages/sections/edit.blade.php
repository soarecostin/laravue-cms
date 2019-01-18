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
                        'attributes' => 'required',
                        'label' => 'Section title'
                    ])
                    @endinput
                    
                    <page-sections
                        db-content="{{ (old('content') ?: (isset($entity) ? $entity->content : '')) }}"
                        :db-section-types="{{ json_encode($sectionTypes) }}"
                        
                        :db-sections="{{ json_encode($sections) }}"
                        :db-selected-section-id="{{ isset($entity) ? $entity->section_id : 'null' }}"
                        
                        :db-template-data="{{ isset($entity) && !is_null($entity->template_data) ? $entity->template_data : '{}' }}"
                    >
                    </page-sections>

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