<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tìm kiếm game') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen text-white" 
        x-data="{ 
            searchQuery: '{{ request('search') }}', 
            isSearched: {{ request()->hasAny(['search', 'category_id']) ? 'true' : 'false' }},
            showDropdown: false,
            suggestions: [],
            async fetchSuggestions() {
                if (this.searchQuery.length < 2) {
                    this.suggestions = [];
                    this.showDropdown = false;
                    return;
                }
                const response = await fetch(`/api/search-suggestions?q=${this.searchQuery}`);
                this.suggestions = await response.json();
                this.showDropdown = this.suggestions.length > 0;
            }
         }">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            {{-- TÌM KIẾM THEO TÊN --}}
            <form action="{{ route('search') }}" method="GET" class="mb-8">
                <div class="relative flex gap-4">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        
                        <input type="text" name="search" x-model="searchQuery" 
                            @input.debounce.300ms="fetchSuggestions()"
                            @click.away="showDropdown = false" 
                            @focus="if(suggestions.length > 0) showDropdown = true"
                            placeholder="Nhập tên game cần tìm..."
                            class="w-full bg-[#202020] border-none text-white pl-10 pr-4 py-3 rounded-md focus:ring-2 focus:ring-blue-500 transition shadow-lg">

                        {{-- Dropdown gợi ý --}}
                        <div x-show="showDropdown" x-cloak
                            class="absolute z-50 w-full mt-2 bg-[#252525] rounded-md shadow-2xl border border-gray-700 overflow-hidden">
                            <div class="p-2">
                                <template x-for="game in suggestions" :key="game.id">
                                    <a :href="'/games/' + game.id" class="flex items-center gap-4 p-2 hover:bg-[#303030] rounded transition group">
                                        <img :src="'/storage/' + game.image" class="w-16 aspect-video object-cover rounded" onerror="this.src='https://via.placeholder.com/40x50'">
                                        <div>
                                            <div class="text-sm font-bold group-hover:text-blue-500" x-text="game.name"></div>
                                            <div class="text-xs" :class="game.price > 0 ? 'text-gray-400' : 'text-green-500 font-bold'"
                                                x-text="game.price > 0 ? new Intl.NumberFormat().format(game.price) + ' VNĐ' : 'MIỄN PHÍ'">
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>
                            <button type="submit" class="w-full py-3 bg-[#303030] text-center text-sm font-bold hover:bg-blue-600 transition uppercase tracking-tighter">
                                Xem tất cả kết quả cho "<span x-text="searchQuery"></span>"
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-bold transition uppercase tracking-widest shadow-lg">
                        Tìm kiếm
                    </button>
                </div>
            </form>

            <hr class="border-gray-800 mb-10">

            {{-- LỌC THEO THỂ LOẠI --}}
            <div class="mb-10">
                <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-4 italic">Duyệt theo thể loại</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @foreach ($categories as $category)
                    <form action="{{ route('search') }}" method="GET">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <button type="submit" 
                            class="w-full p-4 rounded-lg border transition text-center text-sm font-medium
                            {{ request('category_id') == $category->id 
                                ? 'bg-blue-900/30 border-blue-500 text-blue-400' 
                                : 'bg-[#202020] border-transparent hover:bg-[#2a2a2a] text-gray-300' }}">
                            {{ $category->name }}
                        </button>
                    </form>
                    @endforeach
                </div>
            </div>

            {{-- HIỂN THỊ KẾT QUẢ --}}
            <div x-show="isSearched" x-cloak class="space-y-6 mt-12 border-t border-gray-800 pt-8">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">
                        @if(request('search'))
                            Kết quả tìm kiếm: "{{ request('search') }}"
                        @elseif(request('category_id'))
                            Thể loại: {{ $categories->find(request('category_id'))->name ?? 'Không xác định' }}
                        @endif
                    </h2>
                    <a href="{{ route('search') }}" class="text-gray-500 hover:text-white text-sm font-bold uppercase transition">
                        ✕ Làm mới bộ lọc
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mt-8">
                    @forelse ($games as $game)
                    <div class="group cursor-pointer">
                        <a href="{{ route('games.show', $game->id) }}">
                            <div class="aspect-video overflow-hidden rounded-lg mb-3 bg-[#1a1a1a]">
                                <img src="{{ Storage::url($game->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    onerror="this.src='https://via.placeholder.com/300x400'">
                            </div>
                            <h4 class="font-bold text-gray-200 group-hover:text-blue-500 transition line-clamp-1">{{ $game->name }}</h4>
                            <p class="text-white mt-1">
                                @if($game->price > 0)
                                    {{ number_format($game->price) }} VNĐ
                                @else
                                    <span class="text-green-500 font-bold uppercase text-sm">Miễn phí</span>
                                @endif
                            </p>
                        </a>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 text-gray-500">
                        <p class="text-lg">Không tìm thấy game nào khớp với yêu cầu của bạn.</p>
                    </div>
                    @endforelse
                </div>
                
                <div class="mt-8">
                    {{ $games->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>