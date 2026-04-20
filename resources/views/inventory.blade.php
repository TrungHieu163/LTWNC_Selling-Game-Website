<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kho game trực tuyến') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                {{-- Sử dụng biến $games từ Controller truyền sang --}}
                @foreach($games as $game)
                <div class="group">
                    <a href="{{ route('games.show', $game->id) }}" class="block">
                        <div class="relative aspect-[3/4] overflow-hidden rounded-xl bg-[#1a1a1a] mb-4 shadow-lg transition duration-300 group-hover:shadow-blue-900/40 border border-gray-800 group-hover:border-blue-500">
                            {{-- Hiển thị ảnh từ storage --}}
                            <img src="{{ asset('storage/images/' . $game->image) }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                onerror="this.src='https://via.placeholder.com/450x600?text=No+Image'">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-6">
                                <span class="bg-blue-600 text-white text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-widest shadow-lg">Chi tiết</span>
                            </div>
                        </div>
                        <div class="px-1">
                            <h4 class="text-white font-bold text-lg leading-tight group-hover:text-blue-500 transition line-clamp-1">
                                {{ $game->name }}
                            </h4>
                            <p class="text-gray-500 text-xs font-bold uppercase mt-1 tracking-widest">
                                {{-- Lấy tên thể loại đầu tiên nếu có --}}
                                {{ $game->categories->first()->name ?? 'Chưa phân loại' }}
                            </p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-white font-black text-base">
                                    {{ number_format($game->price, 0, ',', '.') }} VNĐ
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-20 flex justify-center border-t border-gray-800 pt-10">
                {{ $games->links() }}
            </div>

        </div>
    </div>

    <style>
    [x-cloak] {
        display: none !important;
    }
    </style>
</x-app-layout>