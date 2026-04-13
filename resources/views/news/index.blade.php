<x-app-layout>
    <div class="bg-[#121212] min-h-screen text-white py-12">
        <div class="max-w-[80%] mx-auto px-6">

            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tin tức') }}
                </h2>
            </x-slot>

            <div class="mb-20">
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
                            class="bg-white text-black px-10 py-4 rounded-xl font-bold uppercase text-sm w-fit hover:bg-gray-200 transition">
                            Xem chi tiết
                        </span>
                    </div>
                </a>
            </div>

            <div class="border-t border-gray-800 mb-16"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">

                <a href="/news/detail" class="group block">
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
                        <div class="mt-4 flex items-center">
                            <span
                                class="text-white text-xs font-bold border-b-2 border-transparent group-hover:border-white transition-all pb-1 uppercase tracking-widest">Tìm
                                hiểu thêm</span>
                        </div>
                    </div>
                </a>

                <div class="group block opacity-50 italic text-gray-600">... các tin khác ...</div>
                <div class="group block opacity-50 italic text-gray-600">... các tin khác ...</div>

            </div>
        </div>
    </div>
</x-app-layout>