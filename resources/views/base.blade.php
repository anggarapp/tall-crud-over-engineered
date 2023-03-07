<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @livewireStyles
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    @yield('sidebar')
    @yield('body')
    @yield('script')
    @livewireScripts
</body>

</html>