<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Trang chủ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('inventory')" :active="request()->routeIs('inventory')">
                        {{ __('Kho game') }}
                    </x-nav-link>

                    <x-nav-link :href="route('search')" :active="request()->routeIs('search')">
                        {{ __('Tìm kiếm') }}
                    </x-nav-link>

                    <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.*')">
                        {{ __('Tin tức') }}
                    </x-nav-link>

                    <x-nav-link :href="route('library')" :active="request()->routeIs('libary')">
                        {{ __('Thư viện cá nhân') }}
                    </x-nav-link>

                    <x-nav-link :href="route('giohang')" :active="request()->routeIs('giohang')">
                        <div class="flex items-center gap-2 py-2"> {{-- Thêm py-2 để tạo khoảng trống phía trên không bị cấn viền Navbar --}}
                            {{-- Bọc ĐỘC LẬP Icon và Badge số lượng vào đây --}}
                            <div class="relative flex items-center justify-center w-8 h-8">
                                {{-- Icon giỏ hàng --}}
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2m2-2h10m0 0l2 2M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>

                                @php
                                    $cart = session('cart', []);
                                    // Logic tính tổng số lượng key game
                                    $cartCount = array_sum(array_column($cart, 'quantity')); 
                                @endphp

                                @if($cartCount > 0)
                                    <span class="absolute top-0 right-0 bg-red-600 text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center transform translate-x-1 -translate-y-1 z-10">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </div>

                            <span class="text-sm font-medium text-gray-300">Giỏ hàng</span>
                        </div>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Cài đặt tài khoản') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="/logout">
                            @csrf

                            <x-dropdown-link href="/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            @guest
            <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 transition">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-sm bg-white text-black hover:bg-gray-100 px-5 py-2 rounded-md font-medium transition">
                        Đăng ký
                    </a>
                </div>
            @endguest

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Trang chủ') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Cài đặt tài khoản') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="/logout">
                    @csrf

                    <x-responsive-nav-link href="/logout" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Đăng xuất') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>