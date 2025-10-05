@props(['breadcrumbs' => []])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/0c1d2c3fb6.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ sidebarOpen: false }">

    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')


    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <div class="flex justify-between item-center">
                @include('layouts.partials.admin.breadcrumb')

                @isset($action)
                    <div>{{ $action }}</div>
                @endisset

            </div>
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')
    @if (session('swal'))
        <script>
            Swal.fire( @json(session('swal')) );
        </script>
    @endif
</body>

</html>
