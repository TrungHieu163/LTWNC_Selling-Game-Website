<x-app-layout>
    <div class="py-12 bg-[#121212] min-h-screen text-white">

        <div class="max-w-7xl mx-auto px-6">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Thư viện game cá nhân') }}
                </h2>
            </x-slot>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($libraryItems as $item)
                    <div
                        class="group bg-[#1a1a1a] rounded-3xl overflow-hidden border border-gray-800 hover:border-blue-500 transition-all">

                        <!-- Ảnh game -->
                        <div class="relative aspect-video bg-black overflow-hidden">
                            <img src="{{ $item->game->image ? asset('storage/' . $item->game->image) : 'https://via.placeholder.com/600x338/1a1a1a/666666?text=No+Image' }}"
                                alt="{{ $item->game->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <a href="{{ route('library', $item->game->id) }}"
                                    class="bg-white text-black px-8 py-3 rounded-full font-bold text-sm hover:bg-blue-600 hover:text-white transition">
                                    Xem mã Key
                                </a>
                            </div>
                        </div>

                        <!-- Thông tin game -->
                        <div class="p-5">
                            <h3 class="font-bold text-xl line-clamp-2 group-hover:text-blue-400">
                                {{ $item->game->name }}
                            </h3>

                            <div class="flex flex-wrap gap-2 mt-3">
                                @foreach ($item->game->categories as $category)
                                    <span class="text-xs bg-gray-800 px-3 py-1 rounded-full">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="mt-6 text-xs text-gray-400 flex justify-between">
                                <span>Ngày mua:</span>
                                <span class="text-emerald-400 font-medium">{{ $item->order->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-2xl text-gray-500">Thư viện của bạn đang trống</p>
                        <p class="mt-3 text-gray-600">Hãy mua game để xây dựng thư viện của mình</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>