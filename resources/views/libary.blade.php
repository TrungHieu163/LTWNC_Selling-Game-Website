<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thư viện cá nhân') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            <div class="flex justify-between items-end mb-12">
                <div>
                    <h1 class="text-3xl font-extrabold uppercase tracking-tighter">Thư viện của tôi</h1>
                    <p class="text-gray-500 text-sm mt-1">Quản lý các trò chơi bạn đã sở hữu</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                @php
                // Giả lập lấy 12 game (Trong thực tế dùng $games từ Controller)
                $myGames = range(1, 12);
                @endphp

                @foreach($myGames as $index)
                <div class="group">
                    <div
                        class="relative aspect-video overflow-hidden rounded-2xl bg-[#1a1a1a] shadow-2xl border-2 border-transparent transition duration-300 group-hover:border-blue-500">
                        <img src="https://via.placeholder.com/800x450"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <button
                                class="bg-white text-black font-black px-8 py-3 rounded-full uppercase text-sm tracking-widest hover:bg-blue-600 hover:text-white transition transform translate-y-4 group-hover:translate-y-0 duration-300">
                                Chơi ngay
                            </button>
                        </div>
                    </div>

                    <div class="mt-5 px-1">
                        <h3
                            class="font-black text-2xl text-gray-100 group-hover:text-blue-500 transition line-clamp-1 italic">
                            Game Title {{ $index }}
                        </h3>
                        <p class="text-xs uppercase font-bold tracking-widest text-gray-500 mt-2">Tổng thời gian:
                            {{ $index * 10 }} giờ</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 flex justify-center border-t border-gray-800 pt-10">
                <nav class="inline-flex shadow-sm rounded-md shadow-blue-900/10">
                    <a href="#"
                        class="px-4 py-3 bg-[#1a1a1a] border border-gray-800 rounded-l-md text-gray-400 hover:bg-[#252525] hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="#"
                        class="px-6 py-3 bg-blue-600 border border-blue-600 text-white font-bold transition">1</a>
                    <a href="#"
                        class="px-6 py-3 bg-[#1a1a1a] border border-gray-800 text-gray-400 hover:bg-[#252525] hover:text-white transition font-bold">2</a>
                    <a href="#"
                        class="px-6 py-3 bg-[#1a1a1a] border border-gray-800 text-gray-400 hover:bg-[#252525] hover:text-white transition font-bold text-xs flex items-center">...</a>
                    <a href="#"
                        class="px-6 py-3 bg-[#1a1a1a] border border-gray-800 text-gray-400 hover:bg-[#252525] hover:text-white transition font-bold font-bold">10</a>

                    <a href="#"
                        class="px-4 py-3 bg-[#1a1a1a] border border-gray-800 rounded-r-md text-gray-400 hover:bg-[#252525] hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>