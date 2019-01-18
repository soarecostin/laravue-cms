@extends('layouts.main.app')

@section('content')
    @if ($page->activeSections->count())
        @foreach ($page->activeSections as $section)
            @if ($section['section_id'] == 1 && $section['content'])
                {!! $section['content'] !!}
            @else
                <dynamic-template 
                    component="{{ $section->section['template_name'] }}"
                    :data="{{ $section->template_data }}">
                </dynamic-template>
            @endif
        @endforeach
    @endif
@endsection