<div class="w-full bg-[#121212] py-12">
    <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

        <div class="flex flex-col lg:flex-row gap-6 h-[520px]" x-data="{ 
                activeBanner: 0, 
                totalBanners: {{ $bannerGames->count() }},
                progress: 0,
                interval: null,
                duration: 5000, // 5 giây đổi game một lần
                startTimer() {
                    this.progress = 0;
                    if (this.interval) clearInterval(this.interval);
                    
                    let startTime = Date.now();
                    this.interval = setInterval(() => {
                        let elapsed = Date.now() - startTime;
                        this.progress = (elapsed / this.duration) * 100;
                        
                        if (elapsed >= this.duration) {
                            this.nextBanner();
                        }
                    }, 10);
                },
                nextBanner() {
                    this.activeBanner = (this.activeBanner + 1) % this.totalBanners;
                    this.startTimer();
                },
                selectBanner(index) {
                    this.activeBanner = index;
                    this.startTimer();
                }
            }" x-init="startTimer()">

            <div class="w-full lg:w-3/4 relative rounded-3xl overflow-hidden shadow-2xl bg-[#1a1a1a]">
                @foreach($bannerGames as $index => $game)
                    <div x-show="activeBanner === {{ $index }}" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute inset-0">
                        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/20 to-transparent p-10 flex flex-col justify-end">
                            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-3">{{ $game->name }}</h2>
                            <p class="text-lg text-gray-300 max-w-md mb-8 line-clamp-2">{{ $game->description }}</p>
                            <a href="{{ route('games.show', $game->id) }}"
                                class="bg-white text-black px-10 py-4 rounded-2xl font-bold text-base hover:bg-gray-200 transition w-fit inline-block">
                                Mua ngay
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="w-full lg:w-1/4 flex flex-col gap-2 overflow-y-auto pr-2 custom-scrollbar">
                @foreach($bannerGames as $index => $game)
                    <button @click="selectBanner({{ $index }})"
                        class="relative p-4 rounded-2xl transition text-left flex items-center gap-3 group overflow-hidden bg-transparent">

                        <div x-show="activeBanner === {{ $index }}"
                            class="absolute inset-0 bg-white/10 z-0 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 top-0 bg-white/20 z-0"
                                :style="'width: ' + (activeBanner === {{ $index }} ? progress : 0) + '%'">
                            </div>
                        </div>

                        <div class="relative z-10 flex items-center gap-3 w-full">
                            <img src="{{ asset('storage/' . $game->image) }}"
                                class="w-12 h-16 object-cover rounded-lg shadow-md flex-shrink-0">
                            <span class="text-white font-semibold block text-sm line-clamp-2 transition"
                                :class="activeBanner === {{ $index }} ? 'text-white' : 'text-gray-400 group-hover:text-gray-200'">
                                {{ $game->name }}
                            </span>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="mt-20" x-data="{ currentSlide: 0, totalItems: {{ $newGames->count() }}, itemsPerPage: 3 }">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-2xl font-bold">Khám phá trò chơi mới</h2>
                <div class="flex gap-3">
                    <button
                        @click="currentSlide = (currentSlide === 0) ? Math.ceil(totalItems/itemsPerPage)-1 : currentSlide - 1"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition border border-white/5">←</button>
                    <button
                        @click="currentSlide = (currentSlide >= Math.ceil(totalItems/itemsPerPage)-1) ? 0 : currentSlide + 1"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition border border-white/5">→</button>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out"
                    :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                    @foreach($newGames as $game)
                        <div class="w-1/3 flex-shrink-0 px-3">
                            <a href="{{ route('games.show', $game->id) }}" class="group block">
                                <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                    <img src="{{ asset('storage/' . $game->image) }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                </div>
                                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">{{ $game->name }}
                                </h3>
                                <p class="text-emerald-400 text-sm font-medium">
                                    {{ number_format($game->price, 0, ',', '.') }} ₫
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-2xl font-bold">Sắp ra mắt</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/gta6.jpeg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-blue-400 transition">
                        Grand Theft Auto VI</h3>
                    <p class="text-gray-500 text-sm font-medium">Ra mắt: 19/11/2026</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/hw2.png"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-blue-400 transition">
                        Hogwarts Legacy 2</h3>
                    <p class="text-gray-500 text-sm font-medium">Ra mắt: Năm 2027</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/mw.jpg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-blue-400 transition">
                        Marvel Wolverine</h3>
                    <p class="text-gray-500 text-sm font-medium">Ra mắt: 15/09/2026</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/halo.png"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-blue-400 transition">
                        Halo: Campaign Evolved</h3>
                    <p class="text-gray-500 text-sm font-medium">Ra mắt: 28/06/2026</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/batman.jpg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-blue-400 transition">
                        LEGO Batman Legacy</h3>
                    <p class="text-gray-500 text-sm font-medium">Ra mắt: 23/05/2026</p>
                </div>
            </div>
        </div>

        <div class="mt-20 flex flex-col md:flex-row items-center gap-10 py-10">

            <div class="w-full md:w-[65%]">
                <div class="relative overflow-hidden rounded-3xl shadow-2xl">
                    <img src="images/alovuavu.jpg" alt="Alo vũ à vũ"
                        class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                </div>
            </div>

            <div class="w-full md:w-[35%] flex flex-col gap-5">
                <h2 class="text-white text-3xl md:text-4xl font-extrabold leading-tight">
                    Alo vũ à vũ
                </h2>

                <p class="text-gray-400 text-lg leading-relaxed">
                    Nếu em là Vũ thì mua game ngay để nhận 10 hộp khô gà nhá Vũ
                </p>

                <div class="flex items-center gap-4 mt-2">
                    <a href="inventory"
                        class="bg-[#007dfc] hover:bg-[#0069d2] text-white font-bold py-3.5 px-8 rounded-xl transition duration-300 uppercase text-sm tracking-wider">
                        Mua ngay
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-20 bg-transparent">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 mb-8 text-white group">
                <h2 class="text-2xl font-bold group-hover:text-gray-400 transition">Tin tức nổi bật</h2>
                <span class="text-2xl text-gray-500 group-hover:text-white transition">›</span>
            </a>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($homeNews as $item)
                    <a href="{{ route('news.show', $item['id']) }}" class="group block">
                        <div class="relative overflow-hidden rounded-2xl aspect-video mb-5 bg-[#1a1a1a]">
                            <img src="{{ asset($item['thumbnail']) }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>

                        <div class="flex flex-col">
                            <h3
                                class="text-white text-xl font-bold mb-3 group-hover:text-gray-300 transition min-h-[3.5rem] line-clamp-2">
                                {{ $item['title'] }}
                            </h3>

                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 min-h-[4.5rem]">
                                {{ $item['summary'] }}
                            </p>

                            <span
                                class="text-white text-sm font-bold border-b-2 border-transparent group-hover:border-white transition-all pb-1 uppercase tracking-wider w-fit mt-4">
                                Đọc thêm
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-2xl font-bold">Trò chơi miễn phí</h2>
                <a href="{{ route('search', ['category_id' => 'free']) }}"
                    class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-xl transition border border-white/5">
                    Xem thêm
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($freeGames as $game)
                    <a href="{{ route('games.show', $game->id) }}" class="group block">
                        <div class="relative overflow-hidden rounded-2xl aspect-video mb-4 bg-[#1a1a1a] shadow-lg">
                            <img src="{{ asset('storage/' . $game->image) }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-500 shadow-[0_0_10px_#3b82f6]"></div>
                        </div>
                        <h3 class="text-white font-semibold text-lg group-hover:text-blue-400 transition">{{ $game->name }}
                        </h3>
                        <p class="text-gray-400 text-sm">Miễn phí</p>
                    </a>
                @endforeach
            </div>
        </div>

        @php
            $usedIds = collect();
            $col1 = $recentlyReleased->shuffle()->take(5);
            $usedIds = $usedIds->merge($col1->pluck('id'));
            $col2 = $topRated->whereNotIn('id', $usedIds)->shuffle()->take(5);
            $usedIds = $usedIds->merge($col2->pluck('id'));
            $col3 = App\Models\Game::whereNotIn('id', $usedIds)->inRandomOrder()->take(5)->get();
        @endphp

        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 border-t border-white/10 pt-12">
            <div>
                <h2 class="text-white text-lg font-bold mb-6 flex items-center hover:text-gray-300 cursor-pointer">Mới
                    phát hành <span class="ml-2 text-sm">›</span></h2>
                <div class="flex flex-col gap-2">
                    @foreach($col1 as $game)
                        <a href="{{ route('games.show', $game->id) }}"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                            <img src="{{ asset('storage/' . $game->image) }}" class="w-16 h-20 object-cover rounded-lg">
                            <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                                <h4
                                    class="text-white font-semibold text-sm line-clamp-1 group-hover:text-blue-400 transition">
                                    {{ $game->name }}
                                </h4>
                                <p class="text-gray-400 text-xs mt-1">{{ number_format($game->price, 0, ',', '.') }} ₫</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-white text-lg font-bold mb-6 flex items-center hover:text-gray-300 cursor-pointer">Đánh
                    giá cao <span class="ml-2 text-sm">›</span></h2>
                <div class="flex flex-col gap-2">
                    @foreach($col2 as $game)
                        <a href="{{ route('games.show', $game->id) }}"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                            <img src="{{ asset('storage/' . $game->image) }}" class="w-16 h-20 object-cover rounded-lg">
                            <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                                <h4
                                    class="text-white font-semibold text-sm line-clamp-1 group-hover:text-blue-400 transition">
                                    {{ $game->name }}
                                </h4>
                                <p class="text-gray-400 text-xs mt-1">{{ number_format($game->price, 0, ',', '.') }} ₫</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-white text-lg font-bold mb-6 flex items-center hover:text-gray-300 cursor-pointer">Có
                    thể bạn thích <span class="ml-2 text-sm">›</span></h2>
                <div class="flex flex-col gap-2">
                    @foreach($col3 as $game)
                        <a href="{{ route('games.show', $game->id) }}"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                            <img src="{{ asset('storage/' . $game->image) }}" class="w-16 h-20 object-cover rounded-lg">
                            <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                                <h4
                                    class="text-white font-semibold text-sm line-clamp-1 group-hover:text-blue-400 transition">
                                    {{ $game->name }}
                                </h4>
                                <p class="text-gray-400 text-xs mt-1">Khám phá ngay</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #444;
    }
</style>