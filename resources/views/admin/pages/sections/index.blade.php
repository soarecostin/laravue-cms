@extends('admin.layouts.master.index')

@section('breadcrumbs', Breadcrumbs::render($settings['routePath'].'.index', $parentEntity))

@section('resource-index')
    <vue-sortable-list
        csrf-token="{{ csrf_token() }}"
        draw-url="{{ $drawUrl ?? '' }}"
        :fields="{{ json_encode($fields) }}"
        save-order-url="{{ route($settings['routePath'] . '.saveOrder', [$parentEntity->id]) }}"
    >
    </vue-sortable-list>
@endsection