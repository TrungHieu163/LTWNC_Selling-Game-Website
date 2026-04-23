<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<footer class="bg-[#0a0a0a] text-gray-400 pt-16 pb-14 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Ba cột ngang -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-16 gap-y-12">

            <!-- Cột 1: Trò chơi -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">Trò chơi</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Fortnite</a></li>
                    <li><a href="#" class="hover:text-white transition">Valorant</a></li>
                    <li><a href="#" class="hover:text-white transition">League of Legends</a></li>
                    <li><a href="#" class="hover:text-white transition">Sifu</a></li>
                    <li><a href="#" class="hover:text-white transition">Hades</a></li>
                    <li><a href="#" class="hover:text-white transition">Minecraft</a></li>
                </ul>
            </div>

            <!-- Cột 2: Nguồn tài nguyên -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">Nguồn tài nguyên</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="https://github.com/TrungHieu163/LTWNC_Selling-Game-Website" target="_blank"
                            class="hover:text-white transition">GitHub Repository</a>
                    </li>
                    <li>
                        <a href="https://github.com/HuuTheng" target="_blank" class="hover:text-white transition">Nguyễn
                            Hữu Thành</a>
                    </li>
                    <li>
                        <a href="https://github.com/TrungHieu163" target="_blank"
                            class="hover:text-white transition">Nguyễn Trung Hiếu</a>
                    </li>
                    <li>
                        <a href="https://github.com/phuc3015-bit" target="_blank"
                            class="hover:text-white transition">Nguyễn Trọng Phúc</a>
                    </li>
                    <li>
                        <a href="https://youtu.be/dQw4w9WgXcQ?si=zUkgTTUjddMwW0kl" target="_blank"
                            class="hover:text-white transition">About Us</a>
                    </li>
                </ul>
            </div>

            <!-- Cột 3: Liên kết (Logo không nền, không viền) -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-5 uppercase tracking-wider">Liên kết</h3>
                <div class="flex flex-col gap-3 w-fit">

                    <a href="https://discord.com/invite/mixigaming" target="_blank"
                        class="group flex items-center gap-3 p-2 pr-5 bg-gray-800/50 rounded-xl hover:bg-indigo-600 transition-all duration-300 min-w-[160px]">
                        <div class="w-7 h-7 flex items-center justify-center">
                            <img src="{{ asset('images/discord.png') }}" alt="Discord"
                                class="h-full w-full object-contain brightness-100 group-hover:brightness-125 transition-all">
                        </div>
                        <span class="text-gray-300 group-hover:text-white text-sm font-medium">Discord</span>
                    </a>

                    <a href="https://www.youtube.com/@MixiGaming3con" target="_blank"
                        class="group flex items-center gap-3 p-2 pr-5 bg-gray-800/50 rounded-xl hover:bg-red-600 transition-all duration-300 min-w-[160px]">
                        <div class="w-7 h-7 flex items-center justify-center">
                            <img src="{{ asset('images/youtube.png') }}" alt="YouTube"
                                class="h-full w-full object-contain brightness-100 group-hover:brightness-125 transition-all">
                        </div>
                        <span class="text-gray-300 group-hover:text-white text-sm font-medium">YouTube</span>
                    </a>

                    <a href="https://web.facebook.com/MixiGaming/?_rdc=1&_rdr#" target="_blank"
                        class="group flex items-center gap-3 p-2 pr-5 bg-gray-800/50 rounded-xl hover:bg-blue-600 transition-all duration-300 min-w-[160px]">
                        <div class="w-7 h-7 flex items-center justify-center">
                            <img src="{{ asset('images/facebook.png') }}" alt="Facebook"
                                class="h-full w-full object-contain brightness-100 group-hover:brightness-125 transition-all">
                        </div>
                        <span class="text-gray-300 group-hover:text-white text-sm font-medium">Facebook</span>
                    </a>

                </div>
            </div>

        </div>

        <!-- Phần dưới cùng -->
        <div
            class="mt-20 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6 text-xs">

            <!-- Copyright -->
            <div class="text-gray-500 text-center md:text-left">
                © 2026 MIXIGAMING Shop. All rights reserved.<br>

            </div>

            <!-- Điều khoản dịch vụ -->
            <div class="flex flex-wrap justify-center md:justify-end gap-x-6 gap-y-2">
                <a href="#" class="hover:text-white transition">Điều khoản dịch vụ</a>
                <a href="#" class="hover:text-white transition">Chính sách quyền riêng tư</a>
                <a href="#" class="hover:text-white transition">An toàn và bảo mật</a>
                <a href="#" class="hover:text-white transition">Chính sách hoàn tiền</a>
            </div>

            <!-- Nút quay lại đầu trang -->
            <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="flex items-center gap-1.5 text-gray-400 hover:text-white transition group whitespace-nowrap">
                <span class="text-lg group-hover:-translate-y-0.5 transition">↑</span>
                Quay lại đầu trang
            </a>

        </div>

    </div>
</footer>

</html>