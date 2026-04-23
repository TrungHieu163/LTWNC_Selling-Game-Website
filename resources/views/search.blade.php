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
                // Gọi API để lấy gợi ý game
                const response = await fetch(`/api/search-suggestions?q=${this.searchQuery}`);
                this.suggestions = await response.json();
                this.showDropdown = this.suggestions.length > 0;
            }
         }">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            <form action="{{ route('search') }}" method="GET">
                <div class="relative mb-12 flex gap-4">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        
                        <input type="text" name="search" x-model="searchQuery" 
                            @input.debounce.300ms="fetchSuggestions()"
                            @click.away="showDropdown = false" 
                            @focus="if(suggestions.length > 0) showDropdown = true"
                            placeholder="Nhập tên game..."
                            class="w-full bg-[#202020] border-none text-white pl-10 pr-4 py-3 rounded-md focus:ring-2 focus:ring-blue-500 transition shadow-lg">

                        <div x-show="showDropdown" x-cloak
                            class="absolute z-50 w-full mt-2 bg-[#252525] rounded-md shadow-2xl border border-gray-700 overflow-hidden">
                            
                            <div class="p-2">
                                <template x-for="game in suggestions" :key="game.id">
                                    <a :href="'/games/' + game.id" class="flex items-center gap-4 p-2 hover:bg-[#303030] rounded transition group">
                                        <img :src="'/storage/' + game.image" class="w-16 aspect-video object-cover rounded" onerror="this.src='https://via.placeholder.com/40x50'">
                                        <div>
                                            <div class="text-sm font-bold group-hover:text-blue-500" x-text="game.name"></div>
                                            <div class="text-xs" 
                                                :class="game.price > 0 ? 'text-gray-400' : 'text-green-500 font-bold'"
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

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-bold transition uppercase tracking-widest shadow-lg">
                        Tìm ngay
                    </button>
                </div>

                <div x-show="!isSearched" x-transition>
                    <div class="mb-10">
                        <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-4">Thể loại game</h3>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            @foreach ($categories as $category)
                            <label class="cursor-pointer group">
                                <input type="radio" name="category_id" value="{{ $category->id }}" 
                                    class="hidden peer" {{ request('category_id') == $category->id ? 'checked' : '' }}>
                                <div
                                    class="bg-[#202020] p-4 rounded-lg border border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-900/20 group-hover:bg-[#2a2a2a] transition text-center text-sm">
                                    {{ $category->name }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-center mt-12">
                        <button type="submit"
                            class="bg-transparent border border-gray-700 hover:border-blue-500 text-white px-12 py-4 rounded-md font-bold transition uppercase text-xs tracking-widest">
                            Áp dụng bộ lọc
                        </button>
                    </div>
                </div>
            </form>

            <div x-show="isSearched" x-cloak class="space-y-6 mt-12">
                <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                    <h2 class="text-2xl font-bold italic">
                        Kết quả cho: "{{ request('search') ?: 'Tất cả game' }}"
                        @if(request('category_id'))
                             - Thể loại: {{ $categories->find(request('category_id'))->name ?? '' }}
                        @endif
                    </h2>
                    <a href="{{ route('search') }}"
                        class="text-blue-500 hover:text-blue-400 text-sm font-bold uppercase tracking-tighter">
                        ✕ Xóa tìm kiếm & Lọc lại
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mt-8">
                    @forelse ($games as $game)
                    <div class="group cursor-pointer">
                        <a href="{{ route('games.show', $game->id) }}">
                            <div class="aspect-video overflow-hidden rounded-lg mb-3">
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
                    <div class="col-span-full text-center py-10 text-gray-500">
                        Không tìm thấy game nào khớp với yêu cầu.
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