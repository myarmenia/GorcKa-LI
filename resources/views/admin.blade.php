<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-mode="light" class="scroll-smooths group" data-theme-color="green">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="shortcut icon" href="./img/fav.png" type="image/x-icon">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        {{-- <link rel="stylesheet" type="text/css" href="css/style.css"> --}}


        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @routes
        @vite(['resources/js/admin.js'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">

        @inertia


        {{-- <script src="{{asset('assets/admin/js/scripts.js')}}"></script> --}}
    </body>
</html>
