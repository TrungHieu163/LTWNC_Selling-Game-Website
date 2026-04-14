<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tìm kiếm') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen text-white" x-data="{ 
            searchQuery: '', 
            isSearched: false,
            showDropdown: false 
         }">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            <div class="relative mb-12 flex gap-4">
                <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" x-model="searchQuery" @input="showDropdown = searchQuery.length > 0"
                        @click.away="showDropdown = false" placeholder="Nhập tên game..."
                        class="w-full bg-[#202020] border-none text-white pl-10 pr-4 py-3 rounded-md focus:ring-2 focus:ring-blue-500 transition shadow-lg">

                    <div x-show="showDropdown" x-cloak
                        class="absolute z-50 w-full mt-2 bg-[#252525] rounded-md shadow-2xl border border-gray-700 overflow-hidden">

                        <div class="p-2">
                            @for ($i = 1; $i <= 4; $i++) <a href="#"
                                class="flex items-center gap-4 p-2 hover:bg-[#303030] rounded transition group">
                                <img src="https://via.placeholder.com/40x50" class="w-10 h-12 object-cover rounded">
                                <div>
                                    <div class="text-sm font-bold group-hover:text-blue-500">Game Name Example {{ $i }}
                                    </div>
                                    <div class="text-xs text-gray-400">500.000 VNĐ</div>
                                </div>
                                </a>
                                @endfor
                        </div>

                        <button @click="isSearched = true; showDropdown = false"
                            class="w-full py-3 bg-[#303030] text-center text-sm font-bold hover:bg-blue-600 transition uppercase tracking-tighter">
                            Xem tất cả kết quả cho "<span x-text="searchQuery"></span>"
                        </button>
                    </div>
                </div>

                <button @click="isSearched = true; showDropdown = false"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-bold transition uppercase tracking-widest shadow-lg">
                    Tìm ngay
                </button>
            </div>

            <div x-show="!isSearched" x-transition>
                <div class="mb-10">
                    <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-4">Số lượng người chơi</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <label class="cursor-pointer group">
                            <input type="checkbox" class="hidden peer">
                            <div
                                class="bg-[#202020] p-4 rounded-lg border border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-900/20 group-hover:bg-[#2a2a2a] transition text-center uppercase text-xs font-bold">
                                Single Player
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="checkbox" class="hidden peer">
                            <div
                                class="bg-[#202020] p-4 rounded-lg border border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-900/20 group-hover:bg-[#2a2a2a] transition text-center uppercase text-xs font-bold">
                                Multi Player
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-4">Thể loại khác</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @php $genres = ['Hành động', 'Phiêu lưu', 'Kinh dị', 'Chiến thuật', 'Đua xe', 'Thế giới mở',
                        'RPG', 'Giải đố', 'Indie', 'Thể thao']; @endphp
                        @foreach ($genres as $genre)
                        <label class="cursor-pointer group">
                            <input type="checkbox" class="hidden peer">
                            <div
                                class="bg-[#202020] p-4 rounded-lg border border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-900/20 group-hover:bg-[#2a2a2a] transition text-center text-sm">
                                {{ $genre }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-12">
                    <button @click="isSearched = true"
                        class="bg-transparent border border-gray-700 hover:border-blue-500 text-white px-12 py-4 rounded-md font-bold transition uppercase text-xs tracking-widest">
                        Áp dụng bộ lọc
                    </button>
                </div>
            </div>

            <div x-show="isSearched" x-cloak class="space-y-6">
                <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                    <h2 class="text-2xl font-bold italic">Kết quả cho: "<span x-text="searchQuery || 'Bộ lọc'"></span>"
                    </h2>
                    <button @click="isSearched = false; searchQuery = ''"
                        class="text-blue-500 hover:text-blue-400 text-sm font-bold uppercase tracking-tighter">
                        ✕ Xóa tìm kiếm & Lọc lại
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mt-8">
                    @for ($i = 0; $i < 10; $i++) <div class="group cursor-pointer">
                        <div class="aspect-[3/4] overflow-hidden rounded-lg mb-3">
                            <img src="https://via.placeholder.com/300x400"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <h4 class="font-bold text-gray-200 group-hover:text-blue-500 transition line-clamp-1">Tên Game
                            Kết Quả {{ $i + 1 }}</h4>
                        <p class="text-white mt-1">500.000 VNĐ</p>
                </div>
                @endfor
            </div>
        </div>

    </div>
    </div>

    <style>
    [x-cloak] {
        display: none !important;
    }

    /* Tùy chỉnh thanh cuộn cho dropdown nếu cần */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #444;
        border-radius: 10px;
    }
    </style>
</x-app-layout>