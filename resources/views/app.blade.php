<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-mode="light" class="scroll-smooths group" data-theme-color="green">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('assets/user/images/FavIcon.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        {{-- <link rel="stylesheet" href="{{asset('assets/user/libs/choices.js/public/assets/styles/choices.min.css')}}"> --}}
        <link href="https://cdn.jsdelivr.net/npm/preline@1.0.0/dist/preline.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">


        <!-- Scripts -->

        @routes
        @vite(['resources/js/app.js'])

        @inertiaHead


    </head>
    <body class="font-sans antialiased bg-white dark:bg-neutral-800">

        @inertia


        {{-- <script src="{{asset('assets/user/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/modules/user/job-list.init.js')}}"></script> --}}

<script>
//   var singleLocation = new Choices('#choices-single-location');

// var singleCategorie = document.getElementById('choices-single-categories');
// if (singleCategorie) {
//     var singleCategories = new Choices('#choices-single-categories');
// }
//  document.addEventListener("DOMContentLoaded", () => {
//      window.Echo.channel('aaa')
//             .listen("NotifyEvent", (e) => {
//                 console.log( 'ashxatum e aaa ---nnn', e.message)

//             });
//  })

</script>
{{-- <script src="./node_modules/preline/dist/preline.js"></script> --}}
        <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>

    </body>
</html>
