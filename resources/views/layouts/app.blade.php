<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MIXIGAMING Shop') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#121212] text-white">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @isset($header)
        <header class="bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="flex-1">
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Thành công!',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#1a1a1a',
                color: '#ffffff',
                confirmButtonColor: '#2563eb'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Lỗi!',
                text: "{{ session('error') }}",
                icon: 'error',
                background: '#1a1a1a',
                color: '#ffffff',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</body>

</html>