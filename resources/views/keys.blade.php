<x-app-layout>
    <div class="py-12 bg-[#121212] min-h-screen text-white" x-data="{ 
        copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            alert('Đã sao chép mã Key!');
        }
    }">
        <div class="max-w-4xl mx-auto px-6">
            {{-- Điều hướng quay lại thư viện --}}
            <a href="{{ route('library') }}" class="inline-flex items-center text-gray-500 hover:text-blue-500 transition mb-8 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại thư viện
            </a>

            <div class="bg-[#1a1a1a] border border-gray-800 rounded-3xl overflow-hidden shadow-2xl">
                
                {{-- Header hiển thị linh hoạt --}}
                <div class="p-8 border-b border-gray-800 bg-gradient-to-r from-blue-900/20 to-transparent">
                    <h1 class="text-3xl font-black uppercase tracking-tighter italic">Mã kích hoạt của bạn</h1>
                    <p class="text-gray-500 text-sm mt-1 uppercase tracking-widest font-bold">
                        @if(request()->game_id)
                            Danh sách tất cả mã Key đã mua của game
                        @else
                            Mã đơn hàng: #{{ $order->id }} • Ngày mua: {{ $order->created_at->format('d/m/Y') }}
                        @endif
                    </p>
                </div>

                <div class="p-8 space-y-6">
                    {{-- Lặp qua danh sách Key game --}}
                    @forelse($order->gameKeys as $key)
                        <div class="flex flex-col md:flex-row items-center gap-8 p-6 bg-[#202020] rounded-2xl border border-gray-800 hover:border-blue-500/30 transition">
                            
                            {{-- Poster Game --}}
                            <div class="w-28 aspect-[3/4] flex-shrink-0 rounded-lg overflow-hidden shadow-lg border border-gray-700">
                                <img src="{{ $key->game->image ? asset('storage/' . $key->game->image) : 'https://via.placeholder.com/150x200' }}" 
                                     class="w-full h-full object-cover" 
                                     alt="{{ $key->game->name }}">
                            </div>

                            {{-- Thông tin chi tiết mã --}}
                            <div class="flex-grow w-full">
                                <div class="flex justify-between items-start">
                                    <h2 class="text-2xl font-bold text-white mb-1 uppercase tracking-tight italic">
                                        {{ $key->game->name }}
                                    </h2>
                                    {{-- Hiện ngày mua của từng Key nếu đang xem danh sách tổng hợp --}}
                                    @if(request()->game_id)
                                        <span class="text-[10px] text-gray-500 font-mono">Mua ngày: {{ $key->created_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="bg-blue-600/10 text-blue-500 text-[10px] font-black px-2 py-0.5 rounded uppercase tracking-widest border border-blue-500/20">
                                        Bản quyền chính thức
                                    </span>
                                </div>
                                
                                <div class="relative">
                                    <label class="text-[10px] uppercase font-bold text-gray-500 mb-1.5 block tracking-widest">Mã kích hoạt (Key Code)</label>
                                    <div class="flex items-center gap-3">
                                        <input type="text" readonly value="{{ $key->key_code }}"
                                            class="w-full bg-black border border-gray-800 text-blue-400 font-mono text-xl py-3.5 px-5 rounded-xl focus:ring-1 focus:ring-blue-500 transition">
                                        
                                        <button @click="copyToClipboard('{{ $key->key_code }}')" 
                                            class="p-4 bg-blue-600 hover:bg-blue-700 rounded-xl transition active:scale-95 shadow-lg shadow-blue-900/20">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div class="text-gray-600 mb-4">
                                <svg class="w-16 h-16 mx-auto opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 italic text-lg">Không tìm thấy mã kích hoạt nào.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Chú ý bảo mật --}}
                <div class="p-6 bg-black/40 border-t border-gray-800">
                    <div class="flex items-start gap-4 text-amber-500/80">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-xs leading-relaxed">
                            <strong class="uppercase">Quan trọng:</strong> Hãy bảo mật mã này. Bạn có thể sử dụng mã trên các nền tảng phân phối game như Steam, Epic Games hoặc Launcher chính thức của trò chơi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>