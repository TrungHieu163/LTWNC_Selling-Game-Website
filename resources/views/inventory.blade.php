<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kho game trực tuyến') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen">
        <div class="max-w-[80%] mx-auto px-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @php
                $dummyGames = collect(range(1, 12))->map(function ($i) {
                return (object) [
                'name' => 'Siêu Phẩm Game ' . $i,
                'price' => rand(100, 900) * 1000,
                'category' => 'Hành động',
                'image' => 'https://via.placeholder.com/450x600?text=Poster+' . $i
                ];
                });
                @endphp

                @foreach($dummyGames as $game)
                <div class="group">
                    <a href="#" class="block">
                        <div
                            class="relative aspect-[3/4] overflow-hidden rounded-xl bg-[#1a1a1a] mb-4 shadow-lg transition duration-300 group-hover:shadow-blue-900/40 border border-gray-800 group-hover:border-blue-500">
                            <img src="{{ $game->image }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-6">
                                <span
                                    class="bg-blue-600 text-white text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-widest shadow-lg">Chi
                                    tiết</span>
                            </div>
                        </div>
                        <div class="px-1">
                            <h4
                                class="text-white font-bold text-lg leading-tight group-hover:text-blue-500 transition line-clamp-1">
                                {{ $game->name }}
                            </h4>
                            <p class="text-gray-500 text-xs font-bold uppercase mt-1 tracking-widest">
                                {{ $game->category }}
                            </p>
                            <div class="mt-3 flex items-center justify-between">
                                <span
                                    class="text-white font-black text-base">{{ number_format($game->price, 0, ',', '.') }}
                                    VNĐ</span>
                                <button class="text-gray-400 hover:text-white transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-20 flex justify-center border-t border-gray-800 pt-10">
                <div class="inline-flex rounded-md shadow-sm items-center gap-1">
                    <button
                        class="p-2.5 bg-[#1a1a1a] border border-gray-800 text-gray-400 rounded-md hover:bg-gray-800 hover:text-white transition group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <button
                        class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white font-bold rounded-md shadow-lg shadow-blue-900/20">1</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center bg-[#1a1a1a] border border-gray-800 text-gray-400 rounded-md hover:bg-gray-800 transition">2</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center bg-[#1a1a1a] border border-gray-800 text-gray-400 rounded-md hover:bg-gray-800 transition">3</button>

                    <button
                        class="p-2.5 bg-[#1a1a1a] border border-gray-800 text-gray-400 rounded-md hover:bg-gray-800 hover:text-white transition group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <style>
    [x-cloak] {
        display: none !important;
    }
    </style>
</x-app-layout>