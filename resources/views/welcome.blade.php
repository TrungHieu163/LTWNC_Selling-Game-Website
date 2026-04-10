<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>MIXIGAMING Shop</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">

    <!-- Navigation Bar - Đã thay màu giống ảnh -->
    <nav class="bg-[#1e2937] border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="MIXIGAMING Shop"
                            class="w-9 h-9 rounded-full object-contain">
                        <span class="text-white font-semibold tracking-tight text-xl">
                            MIXIGAMING Shop
                        </span>
                    </a>
                </div>

                <!-- Đăng nhập & Đăng ký -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 transition">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-sm bg-white text-black hover:bg-gray-100 px-5 py-2 rounded-md font-medium transition">
                        Đăng ký
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- Phần nội dung chính -->
    <div class="flex-1 flex items-center justify-center w-full">
        <!-- Nội dung của bạn sẽ nằm ở đây -->
    </div>
    @include('layouts.footer')

</body>

</html>