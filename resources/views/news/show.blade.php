<x-app-layout>
    <div class="bg-[#121212] min-h-screen text-white py-16">
        <article class="max-w-[800px] mx-auto px-6">

            <nav class="flex gap-2 text-gray-500 text-xs font-bold uppercase tracking-widest mb-8">
                <a href="{{ route('news.index') }}" class="hover:text-white transition">Tin tức</a>
                <span>/</span>
                <span class="text-gray-300">Chi tiết bài viết</span>
            </nav>

            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                    {{ $article['title'] }}
                </h1>
                <div class="flex items-center gap-4 text-gray-400 text-sm">
                    <span class="font-bold text-blue-500 uppercase">Tác giả: {{ $article['author'] }}</span>
                    <span>•</span>
                </div>
            </header>


            <div class="rounded-3xl overflow-hidden mb-12 shadow-2xl">
                <img src="{{ asset($article['thumbnail']) }}" class="w-full h-auto object-cover">
            </div>

            <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed">


                <p class="mb-8 text-xl text-white font-medium italic border-l-4 border-blue-600 pl-6">
                    {{ $article['summary'] }}
                </p>

                @foreach($article['content'] as $block)
                    @if($block['type'] === 'text')
                        <p class="mb-6">
                            {!! nl2br(e($block['data'])) !!}
                        </p>
                    @elseif($block['type'] === 'image')
                        <div class="my-10">
                            <img src="{{ asset($block['data']) }}" class="rounded-2xl w-full shadow-lg border border-gray-800"
                                alt="{{ $article['title'] }}">
                            @if(isset($block['caption']))
                                <p class="text-center text-sm text-gray-500 mt-2 italic">{{ $block['caption'] }}</p>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

        </article>
    </div>
</x-app-layout>