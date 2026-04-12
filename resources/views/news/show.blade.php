<x-app-layout>
    <div class="bg-[#121212] min-h-screen text-white py-16">
        <article class="max-w-[800px] mx-auto px-6">

            <nav class="flex gap-2 text-gray-500 text-xs font-bold uppercase tracking-widest mb-8">
                <a href="/news" class="hover:text-white">Tin tức</a>
                <span>/</span>
                <span class="text-gray-300">Chi tiết</span>
            </nav>

            <header class="mb-12">
                <h1 class="text-5xl font-extrabold mb-6 leading-tight">Rung cảm với hoài niệm của Mixtape</h1>
                <div class="flex items-center gap-4 text-gray-400 text-sm">
                    <span class="font-bold text-white uppercase">Bởi Ban Biên Tập</span>
                    <span>•</span>
                    <span>12 tháng 4, 2026</span>
                </div>
            </header>

            <div class="rounded-3xl overflow-hidden mb-12 shadow-2xl">
                <img src="images/news_hero.jpg" class="w-full h-auto">
            </div>

            <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed">
                <p class="mb-6 text-xl text-white font-medium">
                    Đây là đoạn tóm tắt nội dung bài viết. Nó thường có font chữ lớn hơn một chút để dẫn dắt người đọc.
                </p>
                <p class="mb-6">
                    Kỉ niệm lần đầu ra mắt trang web của tôi, chúng tôi không chỉ mang đến những trò chơi đỉnh cao mà
                    còn là những trải nghiệm cộng đồng khó quên. Như đã hứa, 10 hộp khô gà sẽ dành tặng cho những "chiến
                    thần" mua game sớm nhất.
                </p>
                <h2 class="text-2xl font-bold text-white mt-10 mb-4">Cảm hứng từ những thập niên cũ</h2>
                <p class="mb-6">
                    Nội dung chi tiết của bài viết sẽ được trình bày ở đây. Bạn có thể chèn thêm ảnh, video hoặc các
                    blockquote để bài viết thêm sinh động.
                </p>
                <blockquote class="border-l-4 border-blue-500 pl-6 my-10 italic text-2xl text-white">
                    "Chúng tôi muốn tạo ra một không gian nơi game thủ không chỉ chơi, mà còn sống trong kỉ niệm."
                </blockquote>
            </div>

            <div class="mt-16 pt-8 border-t border-gray-800 flex justify-between items-center">
                <div class="flex gap-4">
                    <button class="bg-gray-800 hover:bg-gray-700 p-3 rounded-full transition">Share FB</button>
                    <button class="bg-gray-800 hover:bg-gray-700 p-3 rounded-full transition">Share X</button>
                </div>
                <a href="/news" class="text-sm font-bold uppercase tracking-widest hover:underline">Quay lại tin tức</a>
            </div>

        </article>
    </div>
</x-app-layout>