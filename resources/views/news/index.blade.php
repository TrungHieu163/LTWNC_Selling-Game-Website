<x-app-layout>
    @php
        $p12 = collect($news)->firstWhere('id', 'p12');

        $others = collect($news)->where('id', '!=', 'p12');

        $carouselNews = collect([$p12])->merge($others->take(6))->filter();

        $gridNews = $others->slice(6, 6);

        $pcConsoleNews = collect($news)->filter(fn($item) => in_array('pc-console', $item['tags'] ?? []))->take(3);
        $devNews = collect($news)->filter(fn($item) => in_array('nguoi-lam-game', $item['tags'] ?? []))->take(3);
        $esportNews = collect($news)->filter(fn($item) => in_array('esport', $item['tags'] ?? []))->take(3);
    @endphp

    <div class="bg-[#121212] min-h-screen text-white py-12" x-data="{ 
            activeNews: 1, 
            timer: 0, 
            total: {{ $carouselNews->count() }}, 
            next() { this.activeNews = this.activeNews < this.total ? this.activeNews + 1 : 1; this.timer = 0; },
            prev() { this.activeNews = this.activeNews > 1 ? this.activeNews - 1 : this.total; this.timer = 0; }
         }">

        <div class="max-w-[80%] mx-auto px-6">

            <div class="relative mb-10 h-auto">
                @foreach($carouselNews as $index => $item)
                    <div x-show="activeNews === {{ $index + 1 }}" x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        style="display: none;"> {{-- Tránh bị giật khi load trang --}}

                        <a href="{{ route('news.show', $item['id']) }}"
                            class="group flex flex-col lg:flex-row gap-10 items-center">
                            <div class="w-full lg:w-2/3 overflow-hidden rounded-3xl aspect-video bg-[#1a1a1a]">
                                <img src="{{ asset($item['thumbnail']) }}"
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            </div>
                            <div class="w-full lg:w-1/3 flex flex-col justify-center">
                                <span class="text-blue-500 font-bold uppercase text-xs tracking-[0.2em] mb-4">
                                    @if($item['id'] === 'p12') Tin tiêu điểm @else Tin mới nhất @endif
                                </span>
                                <h2 class="text-4xl font-extrabold mb-6 leading-[1.2] group-hover:text-gray-300 transition">
                                    {{ $item['title'] }}
                                </h2>
                                <p class="text-gray-400 text-lg leading-relaxed mb-8 line-clamp-3">
                                    {{ $item['summary'] }}
                                </p>
                                <span
                                    class="bg-white text-black px-10 py-4 rounded-xl font-bold uppercase text-sm w-fit hover:bg-gray-200 transition">
                                    Xem chi tiết
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-center gap-8 mb-20" x-init="setInterval(() => { 
                    timer += 1; 
                    if(timer >= 100) { next(); }
                 }, 100)">

                <button @click="prev()" class="p-2 text-gray-500 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
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
                                :class="activeNews === {{ $index + 1 }} ? 'bg-white scale-110' : 'bg-gray-600 hover:bg-gray-400'">
                            </div>
                        </button>
                    @endforeach
                </div>

                <button @click="next()" class="p-2 text-gray-500 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="border-t border-gray-800 mb-16"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
                @foreach($gridNews as $item)
                    <a href="{{ route('news.show', $item['id']) }}" class="group block transition">
                        <div class="relative overflow-hidden rounded-2xl aspect-video mb-6 bg-[#1a1a1a]">
                            <img src="{{ asset($item['thumbnail']) }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div>
                            <span
                                class="text-blue-400 text-xs font-bold uppercase mb-3 block tracking-widest">{{ $item['tags'][0] ?? 'Tin tức' }}</span>
                            <h3 class="text-white text-xl font-bold mb-4 line-clamp-2">{{ $item['title'] }}</h3>
                            <p class="text-gray-400 text-sm line-clamp-3 leading-relaxed">{{ $item['summary'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="border-t border-gray-800 mt-24 pt-16 mb-20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                    <div>
                        <div class="flex items-center gap-2 mb-8 group w-fit">
                            <h2 class="text-xl font-bold text-white uppercase tracking-wider">PC - Console</h2>
                            <span class="text-gray-500 group-hover:text-white transition">›</span>
                        </div>
                        <div class="space-y-8">
                            @foreach($pcConsoleNews as $item)
                                <a href="{{ route('news.show', $item['id']) }}" class="flex gap-4 group items-start">
                                    <div class="w-20 h-24 flex-shrink-0 overflow-hidden rounded-xl bg-[#1a1a1a]">
                                        <img src="{{ asset($item['thumbnail']) }}"
                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    </div>
                                    <div class="flex flex-col">
                                        <h4
                                            class="text-[15px] font-bold text-white group-hover:text-blue-400 transition line-clamp-3 leading-tight">
                                            {{ $item['title'] }}
                                        </h4>
                                        <span
                                            class="text-[11px] text-gray-500 mt-2 font-semibold uppercase tracking-widest">PC-CONSOLE</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-8 group w-fit">
                            <h2 class="text-xl font-bold text-white uppercase tracking-wider">Người làm game</h2>
                            <span class="text-gray-500 group-hover:text-white transition">›</span>
                        </div>
                        <div class="space-y-8">
                            @foreach($devNews as $item)
                                <a href="{{ route('news.show', $item['id']) }}" class="flex gap-4 group items-start">
                                    <div class="w-20 h-24 flex-shrink-0 overflow-hidden rounded-xl bg-[#1a1a1a]">
                                        <img src="{{ asset($item['thumbnail']) }}"
                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    </div>
                                    <div class="flex flex-col">
                                        <h4
                                            class="text-[15px] font-bold text-white group-hover:text-blue-400 transition line-clamp-3 leading-tight">
                                            {{ $item['title'] }}
                                        </h4>
                                        <span
                                            class="text-[11px] text-gray-500 mt-2 font-semibold uppercase tracking-widest">NGƯỜI
                                            LÀM GAME</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-8 group w-fit">
                            <h2 class="text-xl font-bold text-white uppercase tracking-wider">Esport</h2>
                            <span class="text-gray-500 group-hover:text-white transition">›</span>
                        </div>
                        <div class="space-y-8">
                            @foreach($esportNews as $item)
                                <a href="{{ route('news.show', $item['id']) }}" class="flex gap-4 group items-start">
                                    <div class="w-20 h-24 flex-shrink-0 overflow-hidden rounded-xl bg-[#1a1a1a]">
                                        <img src="{{ asset($item['thumbnail']) }}"
                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    </div>
                                    <div class="flex flex-col">
                                        <h4
                                            class="text-[15px] font-bold text-white group-hover:text-blue-400 transition line-clamp-3 leading-tight">
                                            {{ $item['title'] }}
                                        </h4>
                                        <span
                                            class="text-[11px] text-gray-500 mt-2 font-semibold uppercase tracking-widest">ESPORT</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>