<x-app-layout>
    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h1 class="text-3xl font-extrabold uppercase tracking-tighter">Thư viện của tôi</h1>
                    <p class="text-gray-500 text-sm mt-1">Quản lý các trò chơi bạn đã sở hữu</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($orders as $order)
                    @foreach($order->items as $item)
                        <div class="group">
                            <div class="relative aspect-video overflow-hidden rounded-2xl bg-[#1a1a1a] shadow-2xl border-2 border-transparent transition duration-300 group-hover:border-blue-500">
                                <img src="{{ asset('storage/' . $item->game->image) }}" 
                                     class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('libary', $order->id) }}"
                                       class="bg-white text-black font-black px-8 py-3 rounded-full uppercase text-sm tracking-widest hover:bg-blue-600 hover:text-white transition transform translate-y-4 group-hover:translate-y-0 duration-300">
                                        Lấy mã Key
                                    </a>
                                </div>
                            </div>

                            <div class="mt-5 px-1">
                                <h3 class="font-black text-2xl text-gray-100 group-hover:text-blue-500 transition line-clamp-1 italic">
                                    {{ $item->game->name }}
                                </h3>
                                <p class="text-xs uppercase font-bold tracking-widest text-gray-500 mt-2">
                                    Nhà phát triển: {{ $item->game->description['developer'] ?? 'N/A' }}
                                </p>
                                <p class="text-[10px] text-blue-400 mt-1">MUA NGÀY: {{ $order->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="col-span-full text-center py-20 text-gray-500">
                        Thư viện của bạn đang trống.
                    </div>
                @endforelse
            </div>

            <div class="mt-20 flex justify-center border-t border-gray-800 pt-10">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>