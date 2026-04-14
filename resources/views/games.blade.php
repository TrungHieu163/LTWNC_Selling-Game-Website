<x-app-layout>
    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-12">

                    <div x-data="{ activeMedia: 'video' }" class="space-y-6">

                        <div class="aspect-video bg-black rounded-lg overflow-hidden shadow-2xl">
                            <template x-if="activeMedia === 'video'">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                                    frameborder="0" allowfullscreen></iframe>
                            </template>
                            <template x-if="activeMedia === 'image1'">
                                <img src="https://via.placeholder.com/1280x720" class="w-full h-full object-cover">
                            </template>
                        </div>

                        <div class="flex justify-center items-center gap-4 py-2 border-t border-gray-800">

                            <button @click="activeMedia = 'video'"
                                class="w-32 aspect-video bg-gray-900/80 rounded flex-shrink-0 border-2 transition flex items-center justify-center overflow-hidden hover:scale-105"
                                :class="activeMedia === 'video' ? 'border-blue-500' : 'border-gray-700'">
                                <span class="text-xs text-white font-bold uppercase tracking-wider">Trailer</span>
                            </button>

                            <button @click="activeMedia = 'image1'"
                                class="w-32 aspect-video bg-gray-900/80 rounded flex-shrink-0 border-2 transition overflow-hidden hover:scale-105"
                                :class="activeMedia === 'image1' ? 'border-blue-500' : 'border-gray-700'">
                                <img src="https://via.placeholder.com/1280x720"
                                    class="w-full h-full object-cover object-center">
                            </button>

                        </div>
                    </div>
                    <div class="text-gray-300">
                        <h2 class="text-2xl font-bold text-white mb-4">Giới thiệu về trò chơi</h2>
                        <p class="leading-relaxed text-lg">
                            Mô tả ngắn gọn về trò chơi của bạn ở đây. Một câu tóm tắt đầy ấn tượng để thu hút người chơi
                            ngay từ cái nhìn đầu tiên.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 py-6 border-t border-gray-800">
                        <div>
                            <span class="text-gray-500 text-sm block mb-3">Thể loại</span>
                            <div class="flex flex-wrap gap-4">
                                <a href="#" class="text-white hover:underline decoration-gray-400">Dẫn truyện</a>
                                <a href="#" class="text-white hover:underline decoration-gray-400">Hành động</a>
                                <a href="#" class="text-white hover:underline decoration-gray-400">Thế giới mở</a>
                            </div>
                        </div>
                        <div class="border-l border-gray-800 pl-8">
                            <span class="text-gray-500 text-sm block mb-3">Nổi bật</span>
                            <div class="flex flex-wrap gap-4">
                                <a href="#" class="text-white hover:underline decoration-gray-400">Một người chơi</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-gray-300 space-y-4">
                        <h2 class="text-2xl font-bold text-white mb-4">Cốt truyện</h2>
                        <p class="leading-relaxed">
                            Bắt đầu cuộc hành trình huyền thoại của bạn tại đây. Trong một thế giới đang trên bờ vực sụp
                            đổ, bạn sẽ vào vai một chiến binh vô danh...
                        </p>
                        <p class="leading-relaxed">
                            Khám phá những vùng đất chưa từng được biết đến, đối mặt với những kẻ thù hùng mạnh và đưa
                            ra những quyết định thay đổi hoàn toàn vận mệnh của thế giới. Mọi lựa chọn của bạn đều có
                            sức nặng riêng.
                        </p>
                    </div>

                    <div class="bg-gray-900/50 p-6 rounded-lg border border-gray-800">
                        <h2 class="text-xl font-bold text-white mb-6">Yêu cầu hệ thống</h2>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3
                                    class="text-gray-500 uppercase text-sm font-semibold mb-4 border-b border-gray-800 pb-2">
                                    Tối thiểu</h3>
                                <ul class="space-y-3 text-sm">
                                    <li><span class="text-gray-500">HĐH:</span> Windows 10</li>
                                    <li><span class="text-gray-500">CPU:</span> Intel Core i5</li>
                                    <li><span class="text-gray-500">RAM:</span> 8 GB</li>
                                </ul>
                            </div>
                            <div>
                                <h3
                                    class="text-gray-500 uppercase text-sm font-semibold mb-4 border-b border-gray-800 pb-2">
                                    Khuyến nghị</h3>
                                <ul class="space-y-3 text-sm">
                                    <li><span class="text-gray-500">HĐH:</span> Windows 11</li>
                                    <li><span class="text-gray-500">CPU:</span> Intel Core i7</li>
                                    <li><span class="text-gray-500">RAM:</span> 16 GB</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-8 bg-[#1a1a1a] p-6 rounded-xl border border-gray-800 shadow-2xl">
                        <h1
                            class="text-3xl font-extrabold text-white mb-2 underline decoration-blue-500 decoration-4 underline-offset-8">
                            Game Title</h1>
                        <div class="text-2xl font-bold text-white mb-6 mt-4">500.000 VNĐ</div>

                        <div class="space-y-3">
                            <x-primary-button
                                class="w-full justify-center py-4 bg-blue-600 hover:bg-blue-700 uppercase tracking-widest font-bold">
                                Mua ngay
                            </x-primary-button>

                            <button
                                class="w-full text-white border border-gray-700 hover:bg-gray-800 font-bold py-3 px-4 rounded-md transition uppercase text-xs">
                                Thêm vào giỏ hàng
                            </button>
                        </div>

                        <div class="mt-8 space-y-4 border-t border-gray-800 pt-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Nhà phát triển</span>
                                <span class="text-white font-medium">Studio XYZ</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Nhà phát hành</span>
                                <span class="text-white font-medium">Studio ABC</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Ngày phát hành</span>
                                <span class="text-white font-medium">13/04/2026</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>