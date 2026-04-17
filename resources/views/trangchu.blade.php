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
        <div class="mt-20" x-data="{ currentSlide: 0, totalItems: 6, itemsPerPage: 3 }">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-white text-2xl font-bold">Khám phá trò chơi mới</h2>

                <div class="flex gap-3">
                    <button
                        @click="currentSlide = (currentSlide === 0) ? (totalItems / itemsPerPage) - 1 : currentSlide - 1"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition">
                        ←
                    </button>

                    <button
                        @click="currentSlide = (currentSlide >= (totalItems / itemsPerPage) - 1) ? 0 : currentSlide + 1"
                        class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition">
                        →
                    </button>
                </div>
            </div>

            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out"
                    :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">

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

                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_4.jpg" class="w-full h-full object-cover rounded-2xl">
                            </div>
                            <h3 class="text-white font-semibold">Game 4</h3>
                            <p class="text-emerald-400 text-sm">100.000 ₫</p>
                        </div>
                    </div>
                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_5.jpg" class="w-full h-full object-cover rounded-2xl">
                            </div>
                            <h3 class="text-white font-semibold">Game 5</h3>
                            <p class="text-emerald-400 text-sm">200.000 ₫</p>
                        </div>
                    </div>
                    <div class="w-1/3 flex-shrink-0 px-3">
                        <div class="group cursor-pointer">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-4 bg-[#1a1a1a]">
                                <img src="/images/new_6.jpg" class="w-full h-full object-cover rounded-2xl">
                            </div>
                            <h3 class="text-white font-semibold">Game 6</h3>
                            <p class="text-emerald-400 text-sm">300.000 ₫</p>
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
                    <a href="inventory"
                        class="bg-[#007dfc] hover:bg-[#0069d2] text-white font-bold py-3.5 px-8 rounded-xl transition duration-300 uppercase text-sm tracking-wider">
                        Mua ngay
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 border-t border-white/10 pt-12">

            <div>
                <div class="flex items-center justify-between mb-6 group cursor-pointer w-fit">
                    <h2 class="text-white text-lg font-bold group-hover:text-gray-400 transition">Mới phát hành <span
                            class="text-sm ml-1">›</span></h2>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/thumb_1.jpg" class="w-16 h-20 object-cover rounded-lg shadow-md"
                            alt="Task Time">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4
                                class="text-white font-semibold text-sm group-hover:text-gray-300 transition line-clamp-1">
                                Task Time</h4>
                            <p class="text-gray-400 text-xs mt-1">84.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/thumb_2.jpg" class="w-16 h-20 object-cover rounded-lg shadow-md"
                            alt="Under Par">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4
                                class="text-white font-semibold text-sm group-hover:text-gray-300 transition line-clamp-1">
                                Under Par Golf Architect</h4>
                            <p class="text-gray-400 text-xs mt-1">209.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/thumb_3.jpg" class="w-16 h-20 object-cover rounded-lg shadow-md"
                            alt="Lucky Tower">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4
                                class="text-white font-semibold text-sm group-hover:text-gray-300 transition line-clamp-1">
                                Lucky Tower Ultimate</h4>
                            <p class="text-gray-400 text-xs mt-1 italic">Hiện đang có mặt</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/thumb_4.jpg" class="w-16 h-20 object-cover rounded-lg shadow-md"
                            alt="Knightfall">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4
                                class="text-white font-semibold text-sm group-hover:text-gray-300 transition line-clamp-1">
                                Knightfall Requiem</h4>
                            <p class="text-gray-400 text-xs mt-1">52.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/thumb_5.jpg" class="w-16 h-20 object-cover rounded-lg shadow-md" alt="Summer">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4
                                class="text-white font-semibold text-sm group-hover:text-gray-300 transition line-clamp-1">
                                Summer's Heartbeat</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span
                                    class="bg-blue-600 text-white text-[10px] px-1.5 py-0.5 rounded font-bold">-10%</span>
                                <p class="text-gray-500 text-xs line-through">209.000 ₫</p>
                                <p class="text-gray-300 text-xs">188.100 ₫</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-6 group cursor-pointer w-fit">
                    <h2 class="text-white text-lg font-bold group-hover:text-gray-400 transition">Trò chơi đánh giá cao
                        nhất <span class="text-sm ml-1">›</span></h2>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/top_1.jpg" class="w-16 h-20 object-cover rounded-lg" alt="RimWorld">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">RimWorld</h4>
                            <p class="text-gray-400 text-xs mt-1">445.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/top_2.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Dave">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">DAVE THE DIVER</h4>
                            <p class="text-gray-400 text-xs mt-1">260.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/top_3.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Blasphemous">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Blasphemous</h4>
                            <p class="text-gray-400 text-xs mt-1">300.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/top_4.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Kingdom Hearts">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">KINGDOM HEARTS III</h4>
                            <p class="text-gray-400 text-xs mt-1">1.250.000 ₫</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/top_5.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Monument">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Monument Valley 2</h4>
                            <p class="text-gray-400 text-xs mt-1">115.000 ₫</p>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-6 group cursor-pointer w-fit">
                    <h2 class="text-white text-lg font-bold group-hover:text-gray-400 transition">Sắp ra mắt <span
                            class="text-sm ml-1">›</span></h2>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/soon_1.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Better Mart">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Better Mart</h4>
                            <p class="text-gray-500 text-[10px] mt-1 uppercase font-bold tracking-wider">Có sẵn vào
                                17/04/26</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/soon_2.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Bunny Guys">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Bunny Guys!</h4>
                            <p class="text-gray-500 text-[10px] mt-1 uppercase font-bold tracking-wider">Có sẵn vào
                                18/04/26</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/soon_3.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Word Search">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1 italic">WORD SEARCH BY JGABRIB</h4>
                            <p class="text-gray-500 text-[10px] mt-1 uppercase font-bold tracking-wider italic">Chạy lần
                                đầu - 18/04</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/soon_4.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Island">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Treasure Island</h4>
                            <p class="text-gray-500 text-[10px] mt-1 uppercase font-bold tracking-wider">Có sẵn vào
                                20/04/26</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition group">
                        <img src="/images/soon_5.jpg" class="w-16 h-20 object-cover rounded-lg" alt="Creepy Scary">
                        <div class="flex-1 border-b border-white/5 pb-2 group-last:border-0">
                            <h4 class="text-white font-semibold text-sm line-clamp-1">Creepy Scary</h4>
                            <p class="text-gray-500 text-[10px] mt-1 uppercase font-bold tracking-wider">Có sẵn vào
                                21/04/26</p>
                        </div>
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