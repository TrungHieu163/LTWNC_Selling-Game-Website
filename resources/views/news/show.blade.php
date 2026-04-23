<x-app-layout>
    {{-- 1. CHÈN FONT INTER VÀ CẤU HÌNH TYPOGRAPHY --}}
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .font-article {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    /* Tinh chỉnh typography cho nội dung bài viết */
    .article-content p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #d1d5db;
        /* text-gray-300 */
    }
    </style>

    <div class="bg-[#121212] min-h-screen text-white py-16 font-article">
        <article class="max-w-[800px] mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex gap-2 text-gray-500 text-xs font-bold uppercase tracking-widest mb-8">
                <a href="{{ route('news.index') }}" class="hover:text-white transition">Tin tức</a>
                <span>/</span>
                <span class="text-gray-300">Chi tiết bài viết</span>
            </nav>

            {{-- TIÊU ĐỀ --}}
            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-8 leading-tight tracking-tight text-white">
                    {{ $article['title'] }}
                </h1>

                <div class="flex items-center gap-4 text-sm border-b border-gray-800 pb-8">
                    <div class="flex flex-col">
                        <span class="font-bold text-blue-500 uppercase tracking-wide">Tác giả:
                            {{ $article['author'] }}</span>
                        {{-- Nếu bạn có trường ngày tháng trong JSON, hãy thêm ở đây --}}
                    </div>
                </div>
            </header>

            {{-- ẢNH ĐẠI DIỆN BÀI VIẾT --}}
            <div class="rounded-3xl overflow-hidden mb-12 shadow-2xl">
                <img src="{{ asset($article['thumbnail']) }}" class="w-full h-auto object-cover">
            </div>

            {{-- NỘI DUNG BÀI VIẾT --}}
            <div class="article-content">

                {{-- PHẦN TÓM TẮT (Sapo) --}}
                <p
                    class="mb-12 text-xl text-white font-semibold italic border-l-4 border-blue-600 pl-6 leading-relaxed">
                    {{ $article['summary'] }}
                </p>

                {{-- CÁC KHỐI NỘI DUNG --}}
                @foreach($article['content'] as $block)
                @if($block['type'] === 'text')
                <p class="text-lg">
                    {!! nl2br(e($block['data'])) !!}
                </p>
                @elseif($block['type'] === 'image')
                <div class="my-12">
                    <figure>
                        <img src="{{ asset($block['data']) }}"
                            class="rounded-2xl w-full shadow-2xl border border-gray-800 transition duration-500 hover:border-gray-600"
                            alt="{{ $article['title'] }}">
                        @if(isset($block['caption']))
                        <figcaption class="text-center text-sm text-gray-500 mt-4 italic font-medium">
                            {{ $block['caption'] }}
                        </figcaption>
                        @endif
                    </figure>
                </div>
                @endif
                @endforeach
            </div>

            {{-- NÚT QUAY LẠI --}}
            <div class="mt-16 pt-8 border-t border-gray-800">
                <a href="{{ route('news.index') }}"
                    class="flex items-center gap-2 text-gray-400 hover:text-white transition font-bold uppercase text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                    </svg>
                    Quay lại tin tức
                </a>
            </div>

        </article>
    </div>
</x-app-layout>