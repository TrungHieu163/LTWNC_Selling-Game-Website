<div class="w-full bg-[#121212] py-12">

    <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

        <!-- ==================== BANNER CHÍNH ==================== -->
        <div class="flex flex-col lg:flex-row gap-6 h-[520px]">

            <!-- Banner lớn -->
            <div class="w-full lg:w-3/4 relative rounded-3xl overflow-hidden">
                <img src="/images/banner_game_1.jpg" alt="EA SPORTS FC 26" class="w-full h-full object-cover">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-10 flex flex-col justify-end">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-3">EA SPORTS FC™ 26</h2>
                    <p class="text-lg text-gray-300 max-w-md mb-8">
                        Chơi theo cách riêng của bạn, giảm 75% tới ngày 21/04!
                    </p>
                    <a href="#"
                        class="bg-white text-black px-10 py-4 rounded-2xl font-bold text-base hover:bg-gray-200 transition w-fit inline-block">
                        Mua ngay
                    </a>
                </div>
            </div>

            <!-- Danh sách game bên phải -->
            <div class="w-full lg:w-1/4 flex flex-col gap-3 overflow-y-auto pr-2 custom-scrollbar">
                <a href="#" class="p-5 rounded-2xl bg-white/10 hover:bg-white/20 transition block">
                    <span class="text-white font-semibold block">EA SPORTS FC™ 26</span>
                </a>
                <a href="#" class="p-5 rounded-2xl hover:bg-white/10 transition block">
                    <span class="text-white font-semibold block">Genshin Impact</span>
                </a>
                <a href="#" class="p-5 rounded-2xl hover:bg-white/10 transition block">
                    <span class="text-white font-semibold block">Fortnite</span>
                </a>
                <a href="#" class="p-5 rounded-2xl hover:bg-white/10 transition block">
                    <span class="text-white font-semibold block">Borderlands 4</span>
                </a>
                <a href="#" class="p-5 rounded-2xl hover:bg-white/10 transition block">
                    <span class="text-white font-semibold block">Cyberpunk 2077</span>
                </a>
            </div>
        </div>

        <!-- ==================== KHÁM PHÁ TRÒ CHƠI MỚI ==================== -->
        <div class="mt-20" x-data="{ currentSlide: 0 }">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-2xl font-bold">Khám phá trò chơi mới</h2>

                <div class="flex gap-3">
                    <button @click="currentSlide = Math.max(0, currentSlide - 1)"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition">
                        ←
                    </button>
                    <button @click="currentSlide = Math.min(2, currentSlide + 1)"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition">
                        →
                    </button>
                </div>
            </div>

            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out"
                    :style="'transform: translateX(-' + (currentSlide * 33.333) + '%)'">

                    <!-- Game 1 -->
                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_1.jpg"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <h3 class="text-white font-semibold">I Hate This Place</h3>
                            <p class="text-emerald-400 text-sm">560.000 ₫</p>
                        </div>
                    </div>

                    <!-- Game 2 -->
                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_2.jpg"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <h3 class="text-white font-semibold">1348 Ex Voto</h3>
                            <p class="text-emerald-400 text-sm">218.000 ₫</p>
                        </div>
                    </div>

                    <!-- Game 3 -->
                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_3.jpg"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <h3 class="text-white font-semibold">Docked</h3>
                            <p class="text-emerald-400 text-sm">400.000 ₫</p>
                        </div>
                    </div>
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
                        <img src="/images/gta6.jpeg" alt="Game Name"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-gray-300 transition">
                            Grand Theft Auto VI
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Ra mắt: 19/11/2026
                        </p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/hw2.png" alt="Game Name"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-gray-300 transition">
                            Hogwarts Legacy 2
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Ra mắt: đâu đó trong năm 2027
                        </p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/mw.jpg" alt="Game Name"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-gray-300 transition">
                            Marvel Wolverine
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Ra mắt: 15/09/2026
                        </p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/halo.png" alt="Game Name"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-gray-300 transition">
                            Halo: Campaign Evolved
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Ra mắt: 28/06/2026
                        </p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4] mb-4 bg-[#1a1a1a]">
                        <img src="/images/batman.jpg" alt="Game Name"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white font-semibold text-base mb-1 line-clamp-1 group-hover:text-gray-300 transition">
                            LEGO Batman Legacy of The Dark Knight
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Ra mắt: 23/05/2026
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== TRÒ CHƠI MIỄN PHÍ ==================== -->
        <div class="mt-20">
            <div class="bg-[#1a1a1a] rounded-3xl p-8 pb-10">

                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <h2 class="text-white text-2xl font-bold">Trò chơi miễn phí</h2>
                    </div>
                    <a href="#"
                        class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-xl transition">
                        Xem thêm
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        class="group cursor-pointer bg-[#121212] rounded-2xl overflow-hidden hover:bg-[#252525] transition-all">
                        <div class="relative h-56">
                            <img src="/images/free_1.jpg" alt="TOMAK"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-500"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-white font-semibold text-lg line-clamp-2">TOMAK: Save the Earth Regeneration
                            </h3>
                        </div>
                    </div>

                    <div
                        class="group cursor-pointer bg-[#121212] rounded-2xl overflow-hidden hover:bg-[#252525] transition-all">
                        <div class="relative h-56">
                            <img src="/images/free_2.jpg" alt="Prop Sumo"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-500"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-white font-semibold text-lg line-clamp-2">Prop Sumo</h3>
                        </div>
                    </div>

                    <div
                        class="group cursor-pointer bg-[#121212] rounded-2xl overflow-hidden hover:bg-[#252525] transition-all">
                        <div class="relative h-56">
                            <img src="/images/free_3.jpg" alt="The Stone of Madness"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-purple-500"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-white font-semibold text-lg line-clamp-2">The Stone of Madness</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-20 bg-transparent">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 mb-8 text-white group">
                <h2 class="text-2xl font-bold group-hover:text-gray-400 transition">Tin tức nổi bật</h2>
                <span class="text-2xl text-gray-500 group-hover:text-white transition">›</span>
            </a>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <a href="{{ route('news.show') }}" class="group block">
                    <div class="relative overflow-hidden rounded-2xl aspect-video mb-5 bg-[#1a1a1a]">
                        <img src="/images/news_1.jpg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>

                    <div class="flex flex-col">
                        <h3
                            class="text-white text-xl font-bold mb-3 group-hover:text-gray-300 transition min-h-[3.5rem] line-clamp-2">
                            Rung cảm với hoài niệm của Mixtape
                        </h3>

                        <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 min-h-[4.5rem]">
                            Tìm hiểu cách nhà phát triển Beethoven & Dinosaur tìm thấy nguồn cảm hứng cho cuộc phiêu lưu
                            tuổi mới lớn này.
                        </p>

                        <span
                            class="text-white text-sm font-bold border-b-2 border-transparent group-hover:border-white transition-all pb-1 uppercase tracking-wider w-fit mt-4">
                            Đọc thêm
                        </span>
                    </div>
                </a>

                <a href="{{ route('news.show') }}" class="group block">
                    <div class="relative overflow-hidden rounded-2xl aspect-video mb-5 bg-[#1a1a1a]">
                        <img src="/images/news_2.jpg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white text-xl font-bold mb-3 group-hover:text-gray-300 transition min-h-[3.5rem] line-clamp-2">
                            Một cuộc chiến bằng cả lời nói và lưỡi kiếm
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 min-h-[4.5rem]">
                            At Fate's End kết hợp lối chơi phiêu lưu trỏ và nhấp cùng hành động trong một cuộc ân oán
                            gia tộc.
                        </p>
                        <span
                            class="text-white text-sm font-bold border-b-2 border-transparent group-hover:border-white transition-all pb-1 uppercase tracking-wider w-fit mt-4">
                            Đọc thêm
                        </span>
                    </div>
                </a>

                <a href="{{ route('news.show') }}" class="group block">
                    <div class="relative overflow-hidden rounded-2xl aspect-video mb-5 bg-[#1a1a1a]">
                        <img src="/images/news_3.jpg"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <h3
                            class="text-white text-xl font-bold mb-3 group-hover:text-gray-300 transition min-h-[3.5rem] line-clamp-2">
                            Kho tàng truyện
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 min-h-[4.5rem]">
                            Tham gia nguồn dữ liệu độc quyền, tính năng, phỏng vấn và hướng dẫn của chúng tôi.
                        </p>
                        <span
                            class="text-white text-sm font-bold border-b-2 border-transparent group-hover:border-white transition-all pb-1 uppercase tracking-wider w-fit mt-4">
                            Đọc thêm
                        </span>
                    </div>
                </a>

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
                    <a href="#"
                        class="bg-[#007dfc] hover:bg-[#0069d2] text-white font-bold py-3.5 px-8 rounded-xl transition duration-300 uppercase text-sm tracking-wider">
                        Mua ngay
                    </a>
                </div>
            </div>
        </div>

    </div>


    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 10px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Tinh chỉnh thanh cuộn như cũ */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 10px;
        }

        h2,
        h3 {
            letter-spacing: -0.02em;
        }
    </style>