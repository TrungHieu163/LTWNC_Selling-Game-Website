<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Giỏ hàng của tôi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            @php $cartItems = [1, 2]; @endphp @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                    <div
                        class="bg-[#1a1a1a] p-6 rounded-lg border border-gray-800 flex items-center gap-6 group hover:bg-[#202020] transition">
                        <div class="w-24 h-32 flex-shrink-0 overflow-hidden rounded shadow-md">
                            <img src="https://via.placeholder.com/150x200"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>

                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span
                                        class="text-[10px] bg-gray-700 px-2 py-1 rounded uppercase font-bold text-gray-300">Bản
                                        Cơ Bản</span>
                                    <h3 class="text-xl font-bold mt-2 hover:text-blue-500 cursor-pointer transition">
                                        Black Myth: Wukong</h3>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-white">1.300.000 VNĐ</div>
                                    <div class="text-xs text-gray-500 line-through">1.500.000 VNĐ</div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-6">
                                <div class="text-xs text-gray-500 flex gap-4">
                                    <span>Dùng được trên: <i class="fab fa-windows ml-1"></i></span>
                                </div>
                                <button class="text-gray-500 hover:text-red-500 text-sm underline transition">
                                    Xóa khỏi giỏ hàng
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-[#1a1a1a] p-8 rounded-lg border border-gray-800 sticky top-8">
                        <h2 class="text-xl font-bold mb-6">Tóm tắt đơn hàng</h2>

                        <div class="space-y-3 text-sm border-b border-gray-800 pb-6">
                            <div class="flex justify-between text-gray-400">
                                <span>Giá gốc</span>
                                <span>2.600.000 VNĐ</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Giảm giá</span>
                                <span class="text-green-500">- 200.000 VNĐ</span>
                            </div>
                            <div class="flex justify-between text-gray-400 font-medium">
                                <span>Thuế (VAT)</span>
                                <span>Bao gồm</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-extrabold my-6">
                            <span>Tổng cộng</span>
                            <span class="text-blue-500">2.400.000 VNĐ</span>
                        </div>

                        <a class=" block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold
                                        py-4 rounded transition uppercase tracking-widest shadow-lg">
                            Thanh toán ngay
                        </a>

                        <div class="mt-4 text-center">
                            <a href="/dashboard"
                                class="text-xs text-gray-500 hover:text-white transition uppercase tracking-tighter underline">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🛒</div>
                <h2 class="text-2xl font-bold mb-4 text-gray-400">Giỏ hàng của bạn đang trống</h2>
                <p class="text-gray-600 mb-8">Hãy khám phá các trò chơi mới và bắt đầu hành động ngay!</p>
                <a href="/search"
                    class="bg-white text-black px-10 py-3 rounded font-bold uppercase hover:bg-gray-200 transition">
                    Tìm kiếm game
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>