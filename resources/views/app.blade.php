<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-mode="light" class="scroll-smooths group" data-theme-color="green">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">


        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @routes
        @vite([
            'resources/js/app.js',
            // 'resources/js/admin.js'
            ])

        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia


        <script src="{{asset('assets/user/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
        <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>

    </body>
</html>
