<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name') }}</title>
        
        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/38516d3f67.js" crossorigin="anonymous"></script>
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}" type="image/x-icon">


        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="">
        @inertia
    </body>
</html>
