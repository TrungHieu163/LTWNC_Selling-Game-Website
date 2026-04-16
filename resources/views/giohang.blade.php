<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Giỏ hàng của tôi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen text-white">
        <div class="max-w-[80%] mx-auto px-6" style="width: 80%;">

            @php 
                $cart = session('cart', []); 
                $totalPrice = 0;
            @endphp

            @if(is_array($cart) && count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $details)
                        @if(is_array($details))
                            @php 
                                $qty = $details['quantity'] ?? 1;
                                $price = $details['price'] ?? 0;
                                $subtotal = $price * $qty;
                                $totalPrice += $subtotal; 
                            @endphp
                            
                            <div class="bg-[#1a1a1a] p-6 rounded-lg border border-gray-800 flex items-center gap-6 group hover:bg-[#202020] transition">
                                <div class="w-24 h-32 flex-shrink-0 overflow-hidden rounded shadow-md">
                                    <img src="{{ asset('storage/' . ($details['image'] ?? '')) }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                         onerror="this.src='https://via.placeholder.com/150x200'">
                                </div>

                                <div class="flex-grow">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="text-[10px] bg-gray-700 px-2 py-1 rounded uppercase font-bold text-gray-300">Bản Cơ Bản</span>
                                            <h3 class="text-xl font-bold mt-2 hover:text-blue-500 cursor-pointer transition">
                                                {{ $details['name'] ?? 'Không rõ tên' }}
                                            </h3>
                                            <p class="text-sm text-gray-400 mt-1">
                                                Số lượng: <span class="text-white font-bold">{{ $qty }}</span>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-white">{{ number_format($price) }} VNĐ</div>
                                            @if($qty > 1)
                                                <div class="text-xs text-blue-400 font-semibold mt-1">
                                                    Thành tiền: {{ number_format($subtotal) }} VNĐ
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-6">
                                        <div class="text-xs text-gray-500">
                                            <span>Dùng được trên: <i class="fab fa-windows ml-1"></i> Windows</span>
                                        </div>
                                        <a href="{{ url('/cart/remove/'.$id) }}" class="text-gray-500 hover:text-red-500 text-sm underline transition">
                                            Xóa khỏi giỏ hàng
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-[#1a1a1a] p-8 rounded-lg border border-gray-800 sticky top-8">
                        <h2 class="text-xl font-bold mb-6">Tóm tắt đơn hàng</h2>
                        
                        <div class="space-y-3 border-b border-gray-800 pb-4">
                            <div class="flex justify-between text-gray-400">
                                <span>Tạm tính</span>
                                <span>{{ number_format($totalPrice) }} VNĐ</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Giảm giá</span>
                                <span>0 VNĐ</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-extrabold my-6">
                            <span>Tổng cộng</span>
                            <span class="text-blue-500">{{ number_format($totalPrice) }} VNĐ</span>
                        </div>

                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-4 rounded transition uppercase tracking-widest shadow-lg">
                                Thanh toán ngay
                            </button>
                        </form>
                        
                        <p class="text-[10px] text-gray-500 mt-4 text-center italic">
                            * Mã kích hoạt sẽ được hiển thị ngay sau khi thanh toán thành công.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🛒</div>
                <h2 class="text-2xl font-bold mb-4 text-gray-400">Giỏ hàng của bạn đang trống</h2>
                <a href="{{ route('home') }}" class="bg-white text-black px-10 py-3 rounded font-bold uppercase hover:bg-gray-200 transition">
                    Tìm kiếm game
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>