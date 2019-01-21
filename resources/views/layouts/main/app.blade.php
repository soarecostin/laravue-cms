<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name') }}</title>

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        @stack('header-extra')
    </head>
    <body>
        
        <div class="loader-wrapper" id="preloading">
            <div class="loader"></div>
        </div>

        <div id="app">
            @include('layouts.main.header')

            <main class="main-container">
                @yield('content')
            </main>
    
            @include('layouts.main.footer')
        </div>
        
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>

        @stack('footer-scripts')
    </body>
</html>