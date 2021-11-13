<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href= {{ asset("/css/normalize.css") }}>
    @stack('styles')
    @stack('libs')
</head>
<body>
    <div class="wrapper">
        <x-action-bar></x-action-bar>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src = {{ asset("/js/config.js") }}></script>
    <script src = {{ asset("/js/scripts.js") }}></script>
    <script src= {{ asset("/js/api.js") }}></script>
    <script src= {{ asset("/js/action_bar.js") }}></script>
    @stack('scripts')
</body>
</html>