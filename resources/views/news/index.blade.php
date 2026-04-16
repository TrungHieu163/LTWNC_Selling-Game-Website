<x-app-layout>
    <div class="bg-[#121212] min-h-screen text-white py-12" x-data="{ 
            activeNews: 1, 
            timer: 0, 
            total: 4,
            next() { this.activeNews = this.activeNews < this.total ? this.activeNews + 1 : 1; this.timer = 0; },
            prev() { this.activeNews = this.activeNews > 1 ? this.activeNews - 1 : this.total; this.timer = 0; }
         }">

        <div class="max-w-[80%] mx-auto px-6">

            <div class="mb-10">
                <a href="/news/detail" class="group flex flex-col lg:flex-row gap-10 items-center">
                    <div class="w-full lg:w-2/3 overflow-hidden rounded-3xl aspect-video bg-[#1a1a1a]">
                        <img src="images/news_hero.jpg"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    </div>
                    <div class="w-full lg:w-1/3 flex flex-col justify-center">
                        <span class="text-blue-500 font-bold uppercase text-xs tracking-[0.2em] mb-4">Tin mới
                            nhất</span>
                        <h2 class="text-4xl font-extrabold mb-6 leading-[1.2] group-hover:text-gray-300 transition">
                            Rung cảm với hoài niệm của Mixtape
                        </h2>
                        <p class="text-gray-400 text-lg leading-relaxed mb-8 line-clamp-3">
                            Khám phá cách những giai điệu cổ điển và phong cách nghệ thuật độc đáo tạo nên một cuộc
                            phiêu lưu đầy cảm xúc.
                        </p>
                        <span
                            class="bg-white text-black px-10 py-4 rounded-xl font-bold uppercase text-sm w-fit hover:bg-gray-200 transition cursor-pointer">
                            Xem chi tiết
                        </span>
                    </div>
                </a>
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
                    <template x-for="i in total">
                        <button @click="activeNews = i; timer = 0"
                            class="relative flex items-center justify-center w-6 h-6">
                            <svg class="absolute inset-0 w-full h-full -rotate-90" x-show="activeNews === i">
                                <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2" fill="transparent"
                                    stroke-dasharray="62.83" :stroke-dashoffset="62.83 - (62.83 * timer) / 100" />
                            </svg>

                            <div class="w-2 h-2 rounded-full transition-all duration-300"
                                :class="activeNews === i ? 'bg-white scale-110' : 'bg-gray-600 hover:bg-gray-400'">
                            </div>
                        </button>
                    </template>
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
                <a href="/news/detail" class="group block transition duration-500" x-show="activeNews === 1"
                    x-transition:enter="opacity-0 translate-y-4">
                    <div class="relative overflow-hidden rounded-2xl aspect-video mb-6 bg-[#1a1a1a]">
                        <img src="images/news_1.jpg"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-500 text-xs font-bold uppercase mb-3 tracking-widest">Sự kiện</span>
                        <h3
                            class="text-white text-xl font-bold mb-4 group-hover:text-gray-300 transition min-h-[3.5rem] line-clamp-2">
                            Một cuộc chiến bằng cả lời nói và lưỡi kiếm
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 min-h-[4.5rem]">
                            Tìm hiểu về hệ thống đối thoại mới giúp thay đổi cục diện trận đấu trong At Fate's End.
                        </p>
                    </div>
                </a>

                <template x-if="activeNews !== 1">
                    <div class="col-span-3 text-center py-20 text-gray-600 italic">
                        Đang hiển thị nội dung cho Trang báo số <span x-text="activeNews"></span>...
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-app-layout>