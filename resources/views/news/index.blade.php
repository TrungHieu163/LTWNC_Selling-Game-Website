<x-app-layout>
    {{-- 1. CHÈN FONT CHUẨN TIẾNG VIỆT VÀ FIX CỨNG CHIỀU CAO --}}
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

    .font-vietnam {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    /* Đảm bảo banner có chiều cao cố định để không bị nhảy layout */
    .banner-container {
        min-height: 520px;
    }

    @media (max-width: 1024px) {
        .banner-container {
            min-height: 700px;
        }
    }
    </style>

    @php
    // Xử lý dữ liệu
    $p12 = collect($news)->firstWhere('id', 'p12');
    $others = collect($news)->where('id', '!=', 'p12');

    // Carousel gồm p12 và 6 bài đầu
    $carouselNews = collect([$p12])->merge($others->take(6))->filter();

    // 6 bài tiếp theo cho Grid
    $gridNews = $others->slice(6, 6);

    // Lọc tin theo TAG cho 3 cột cuối
    $pcConsoleNews = collect($news)->filter(fn($item) => in_array('pc-console', $item['tags'] ?? []))->take(3);
    $devNews = collect($news)->filter(fn($item) => in_array('nguoi-lam-game', $item['tags'] ?? []))->take(3);
    $esportNews = collect($news)->filter(fn($item) => in_array('esports', $item['tags'] ?? []))->take(3);
    @endphp

    <div class="bg-[#121212] min-h-screen text-white py-12 font-vietnam" x-data="{ 
            activeNews: 1, 
            timer: 0, 
            total: {{ $carouselNews->count() }}, 
            next() { this.activeNews = this.activeNews < this.total ? this.activeNews + 1 : 1; this.timer = 0; },
            prev() { this.activeNews = this.activeNews > 1 ? this.activeNews - 1 : this.total; this.timer = 0; }
         }">

        <div class="max-w-[85%] mx-auto px-6">

            {{-- PHẦN 1: BANNER CAROUSEL (ĐÃ FIX CỐ ĐỊNH CHIỀU CAO) --}}
            <div class="relative mb-6 banner-container">
                @foreach($carouselNews as $index => $item)
                <div x-show="activeNews === {{ $index + 1 }}" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute inset-0 w-full h-full" style="display: none;">

                    <a href="{{ route('news.show', $item['id']) }}"
                        class="group flex flex-col lg:flex-row gap-10 items-center h-full">
                        <div class="w-full lg:w-2/3 overflow-hidden rounded-3xl aspect-video bg-[#1a1a1a]">
                            <img src="{{ asset($item['thumbnail']) }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        </div>

                        <div class="w-full lg:w-1/3 flex flex-col justify-center">
                            <span class="text-blue-500 font-bold uppercase text-xs tracking-widest mb-4">
                                {{ $item['id'] === 'p12' ? 'Tin tiêu điểm' : 'Tin mới nhất' }}
                            </span>
                            <h2
                                class="text-3xl lg:text-4xl font-extrabold mb-6 leading-tight group-hover:text-gray-300 transition line-clamp-3">
                                {{ $item['title'] }}
                            </h2>
                            <p class="text-gray-400 text-lg leading-relaxed mb-8 line-clamp-3 lg:line-clamp-4">
                                {{ $item['summary'] }}
                            </p>
                            <span
                                class="bg-white text-black px-8 py-3 rounded-xl font-bold uppercase text-sm w-fit hover:bg-gray-200 transition">
                                Xem chi tiết
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            {{-- ĐIỀU HƯỚNG CHẤM TRÒN (VỊ TRÍ CỐ ĐỊNH) --}}
            <div class="flex items-center justify-center gap-8 mb-20"
                x-init="setInterval(() => { timer += 1; if(timer >= 100) { next(); } }, 100)">

                <button @click="prev()" class="p-2 text-gray-500 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="flex gap-4">
                    @foreach($carouselNews as $index => $item)
                    <button @click="activeNews = {{ $index + 1 }}; timer = 0"
                        class="relative flex items-center justify-center w-6 h-6">
                        <svg class="absolute inset-0 w-full h-full -rotate-90" x-show="activeNews === {{ $index + 1 }}">
                            <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2" fill="transparent"
                                stroke-dasharray="62.83" :stroke-dashoffset="62.83 - (62.83 * timer) / 100" />
                        </svg>
                        <div class="w-2 h-2 rounded-full transition-all duration-300"
                            :class="activeNews === {{ $index + 1 }} ? 'bg-white scale-125' : 'bg-gray-600 hover:bg-gray-400'">
                        </div>
                    </button>
                    @endforeach
                </div>

                <button @click="next()" class="p-2 text-gray-500 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {{-- PHẦN 2: GRID TIN TỨC CHÍNH --}}
            <div class="border-t border-gray-800 mb-16 pt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
                    @foreach($gridNews as $item)
                    <a href="{{ route('news.show', $item['id']) }}" class="group block">
                        <div class="relative overflow-hidden rounded-2xl aspect-video mb-6 bg-[#1a1a1a]">
                            <img src="{{ asset($item['thumbnail']) }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <span
                            class="text-blue-400 text-xs font-bold uppercase mb-3 block tracking-widest">{{ $item['tags'][0] ?? 'Tin tức' }}</span>
                        <h3 class="text-white text-xl font-bold mb-4 line-clamp-2 leading-snug">{{ $item['title'] }}
                        </h3>
                        <p class="text-gray-400 text-sm line-clamp-3 leading-relaxed">{{ $item['summary'] }}</p>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- PHẦN 3: 3 CỘT THEO TAG (PC-CONSOLE, DEV, ESPORT) --}}
            <div class="border-t border-gray-800 mt-24 pt-16 mb-20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                    {{-- Cột Tag mẫu --}}
                    @php
                    $sections = [
                    ['title' => 'PC - Console', 'data' => $pcConsoleNews, 'tag' => 'PC-CONSOLE'],
                    ['title' => 'Người làm game', 'data' => $devNews, 'tag' => 'NGƯỜI LÀM GAME'],
                    ['title' => 'Esport', 'data' => $esportNews, 'tag' => 'ESPORT']
                    ];
                    @endphp

                    @foreach($sections as $section)
                    <div>
                        <div class="flex items-center gap-2 mb-8 group w-fit cursor-pointer">
                            <h2 class="text-xl font-bold text-white uppercase tracking-wider">{{ $section['title'] }}
                            </h2>
                            <span class="text-gray-500 group-hover:text-white transition">›</span>
                        </div>
                        <div class="space-y-8">
                            @foreach($section['data'] as $item)
                            <a href="{{ route('news.show', $item['id']) }}" class="flex gap-4 group items-start">
                                <div class="w-20 h-24 flex-shrink-0 overflow-hidden rounded-xl bg-[#1a1a1a]">
                                    <img src="{{ asset($item['thumbnail']) }}"
                                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                </div>
                                <div class="flex flex-col">
                                    <h4
                                        class="text-[15px] font-bold text-white group-hover:text-blue-400 transition line-clamp-3 leading-snug">
                                        {{ $item['title'] }}
                                    </h4>
                                    <span
                                        class="text-[11px] text-gray-500 mt-2 font-semibold uppercase tracking-widest">{{ $section['tag'] }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>