@section('page-content')
<div class="row">
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        @if($errors->has('message'))
            <div class="alert alert-danger">
                {{ $errors->first('message') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header bg-dark text-light">
                <div class="panel-title hidden-xs lead">
                    {{ $settings['title'] }}
                </div>
            </div>
            
            <div class="card-body">
                
                @section('resource-header')
                <div id="header-btn-wrapper" class="mb-4">
                    <a href="{{ $create }} " class="btn {{ isset($viewer) && $viewer == 'provider' ? 'btn-contrast' : 'btn-primary' }}">
                        <span class="fa fa-plus pr-1"></span> Create
                    </a>
                </div>
                @show

                @section('resource-index')
                <vue-table
                    csrf-token="{{ csrf_token() }}"
                    draw-url="{{ $drawUrl ?? '' }}"
                    :fields="{{ json_encode($fields) }}"
                    :initial-page="{{ $currentPage ?? 1 }}"
                    initial-sort-by="{{ $sortBy ?? '' }}"
                    :initial-sort-desc="{{ $sortDesc ?? 'false' }}"
                    :initial-filters="{{ isset($filters) ? json_encode($filters) : '{}' }}"
                ></vue-table>
                @show

            </div>
        </div>
    </div>
</div>
@endsection