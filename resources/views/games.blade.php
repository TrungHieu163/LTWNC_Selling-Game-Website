<x-app-layout>
    {{-- Toast thông báo khi thêm vào giỏ hàng --}}
    <div x-data="{ 
            showToast: false, 
            timeout: null,
            openToast() {
                this.showToast = true;
                if (this.timeout) clearTimeout(this.timeout);
                this.timeout = setTimeout(() => { this.showToast = false }, 10000); 
            }
         }" @add-to-cart.window="openToast()" class="fixed top-24 left-6 z-[100]" x-cloak>

        <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-10" @click="showToast = false"
            class="bg-[#202020] border-l-4 border-blue-500 p-4 rounded shadow-2xl cursor-pointer flex items-center gap-4 min-w-[320px] hover:bg-[#252525] transition border border-gray-800">

            <div class="bg-blue-500/20 p-2 rounded">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div class="flex-grow">
                <p class="text-white font-bold text-sm">Đã thêm vào giỏ hàng!</p>
            </div>
            <button class="text-gray-500 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-12">
                    {{-- Phần Media (Trailer & Ảnh) --}}
                    <div x-data="{ activeMedia: '{{ $game->trailer_url ? 'video' : 'image1' }}' }" class="space-y-6">
                        <div class="aspect-video bg-black rounded-lg overflow-hidden shadow-2xl border border-gray-800">
                            @if($game->trailer_url)
                                <template x-if="activeMedia === 'video'">
                                    <iframe class="w-full h-full" 
                                            src="https://www.youtube.com/embed/{{$game->youtube_id}}"
                                            frameborder="0" allowfullscreen></iframe>
                                </template>
                            @endif
                            <template x-if="activeMedia === 'image1'">
                                <img src="{{ Storage::url($game->image) }}" class="w-full h-full object-cover">
                            </template>
                        </div>

                        <div class="flex justify-center items-center gap-4 py-2 border-t border-gray-800">
                            @if($game->trailer_url)
                                <button @click="activeMedia = 'video'"
                                    class="w-32 aspect-video bg-gray-900/80 rounded flex-shrink-0 border-2 transition flex items-center justify-center overflow-hidden hover:scale-105"
                                    :class="activeMedia === 'video' ? 'border-blue-500' : 'border-gray-700'">
                                    <span class="text-xs text-white font-bold uppercase tracking-wider">Trailer</span>
                                </button>
                            @endif

                            <button @click="activeMedia = 'image1'"
                                class="w-32 aspect-video bg-gray-900/80 rounded flex-shrink-0 border-2 transition overflow-hidden hover:scale-105"
                                :class="activeMedia === 'image1' ? 'border-blue-500' : 'border-gray-700'">
                                <img src="{{ Storage::url($game->image) }}" class="w-full h-full object-cover">
                            </button>
                        </div>
                    </div>

                    {{-- Giới thiệu trò chơi --}}
                    <div class="text-gray-300">
                        <h2 class="text-2xl font-bold text-white mb-4 italic">GIỚI THIỆU TRÒ CHƠI</h2>
                        <div class="leading-relaxed text-lg prose prose-invert max-w-none">
                            {{-- Sử dụng phần intro trong description hoặc hiển thị mặc định --}}
                            {!! nl2br(e($game->description['intro'] ?? 'Thông tin giới thiệu về trò chơi đang được cập nhật.')) !!}
                        </div>
                    </div>

                    {{-- Thể loại & Nổi bật --}}
                    <div class="grid grid-cols-2 gap-8 py-6 border-t border-gray-800">
                        <div>
                            <span class="text-gray-500 text-sm block mb-3 font-bold uppercase tracking-widest italic">Thể loại</span>
                            <div class="flex flex-wrap gap-4 font-medium text-sm">
                                @foreach($game->categories as $category)
                                    <a href="{{ route('search', ['category_id' => $category->id]) }}"
                                       class="text-white hover:text-blue-400 transition underline decoration-gray-700 underline-offset-4">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="border-l border-gray-800 pl-8">
                            <span class="text-gray-500 text-sm block mb-3 font-bold uppercase tracking-widest italic">Tính năng</span>
                            <div class="flex flex-wrap gap-4 font-medium text-sm text-white">
                                {{ $game->description['features'] ?? 'Chơi đơn' }}
                            </div>
                        </div>
                    </div>

                    {{-- Yêu cầu hệ thống --}}
                    <div class="bg-gray-900/30 p-8 rounded-xl border border-gray-800">
                        <h2 class="text-xl font-bold text-white mb-8 uppercase tracking-tighter italic">Yêu cầu hệ thống</h2>
                        <div class="grid md:grid-cols-2 gap-12">
                            {{-- Cấu hình tối thiểu --}}
                            <div class="space-y-4">
                                <h3 class="text-gray-500 uppercase text-xs font-black mb-4 border-b border-gray-800 pb-2 italic">Tối thiểu</h3>
                                <ul class="space-y-4 text-sm">
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">HĐH</span> <span class="font-bold">{{ $game->description['min_os'] ?? 'Windows 10 64-bit' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">CPU</span> <span class="font-bold">{{ $game->description['min_cpu'] ?? 'Intel Core i5' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">RAM</span> <span class="font-bold">{{ $game->description['min_ram'] ?? '8 GB' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">Đồ họa</span> <span class="font-bold">{{ $game->description['min_gpu'] ?? 'NVIDIA GTX 1050' }}</span></li>
                                </ul>
                            </div>
                            {{-- Cấu hình khuyến nghị --}}
                            <div class="space-y-4">
                                <h3 class="text-gray-500 uppercase text-xs font-black mb-4 border-b border-gray-800 pb-2 italic">Khuyến nghị</h3>
                                <ul class="space-y-4 text-sm">
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">HĐH</span> <span class="font-bold">{{ $game->description['rec_os'] ?? 'Windows 11 64-bit' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">CPU</span> <span class="font-bold">{{ $game->description['rec_cpu'] ?? 'Intel Core i7' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">RAM</span> <span class="font-bold">{{ $game->description['rec_ram'] ?? '16 GB' }}</span></li>
                                    <li class="flex flex-col"><span class="text-gray-500 text-[11px] uppercase">Đồ họa</span> <span class="font-bold">{{ $game->description['rec_gpu'] ?? 'NVIDIA RTX 2060' }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar: Giá và Mua hàng --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-10 bg-[#1a1a1a] p-8 rounded-xl border border-gray-800 shadow-2xl overflow-hidden relative">
                        <div class="absolute -top-4 -right-4 opacity-5 pointer-events-none">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0L1.5 6v12L12 24l10.5-6V6L12 0z" />
                            </svg>
                        </div>

                        <h1 class="text-4xl font-black text-white mb-2 tracking-tighter">{{ $game->name }}</h1>
                        <div class="inline-block bg-gray-800 px-2 py-1 rounded text-[10px] font-bold uppercase mb-6 tracking-widest text-gray-400 italic">
                            Bản Quyền Chính Thức
                        </div>

                        <div class="text-3xl font-black text-white mb-8">
                            {{ number_format($game->price, 0, ',', '.') }} VNĐ
                        </div>

                        <div class="space-y-4">
                            {{-- Form mua hàng trực tiếp --}}
                            <form action="{{ route('cart.add', $game->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="buy_now" value="1">
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded uppercase tracking-[0.2em] text-sm transition shadow-lg shadow-blue-900/20 active:scale-95">
                                    Mua ngay
                                </button>
                            </form>

                            {{-- Nút thêm vào giỏ hàng qua AJAX/Dispatch --}}
                            <form action="{{ route('cart.add', $game->id) }}" method="POST" 
                                  @submit.prevent="fetch($el.action, { method: 'POST', body: new FormData($el), headers: { 'X-Requested-With': 'XMLHttpRequest' } }).then(() => $dispatch('add-to-cart'))">
                                @csrf
                                <button type="submit"
                                    class="w-full text-white border border-gray-700 hover:bg-gray-800 font-bold py-4 px-4 rounded transition uppercase text-xs tracking-widest flex items-center justify-center gap-3 group active:scale-95">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>

                        <div class="mt-10 space-y-4 border-t border-gray-800 pt-8">
                            <div class="flex justify-between text-[13px]">
                                <span class="text-gray-500 font-medium italic">Nhà phát triển</span>
                                <span class="text-white font-bold underline decoration-gray-700 underline-offset-4">{{ $game->description['developer'] ?? 'Đang cập nhật' }}</span>
                            </div>
                            <div class="flex justify-between text-[13px]">
                                <span class="text-gray-500 font-medium italic">Nhà phát hành</span>
                                <span class="text-white font-bold underline decoration-gray-700 underline-offset-4">{{ $game->description['publisher'] ?? 'Youthink Store' }}</span>
                            </div>
                            <div class="flex justify-between text-[13px]">
                                <span class="text-gray-500 font-medium italic">Ngày phát hành</span>
                                <span class="text-white font-bold italic">{{ isset($game->description['released_at']) ? \Carbon\Carbon::parse($game->description['released_at'])->format('d/m/Y') : $game->created_at->format('d/m/Y')}}</span>                            
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
    [x-cloak] { display: none !important; }
    body { background-color: #121212; }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #121212; }
    ::-webkit-scrollbar-thumb { background: #252525; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #303030; }
    </style>
</x-app-layout>