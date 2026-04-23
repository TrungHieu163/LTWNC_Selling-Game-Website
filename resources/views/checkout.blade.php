<x-app-layout> {{-- Chuyển sang app-layout để dùng nền tối đồng bộ --}}
    <div class="min-h-screen flex items-center justify-center py-12 bg-[#121212] px-4">
        <div class="w-full max-w-2xl">
            
            {{-- Nút quay lại nhanh --}}
            <a href="{{ route('giohang') }}" class="inline-flex items-center text-gray-500 hover:text-white transition mb-6 group text-sm">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại chỉnh sửa giỏ hàng
            </a>

            <div class="bg-[#1a1a1a] border border-gray-800 rounded-[2rem] overflow-hidden shadow-2xl">
                
                {{-- Header --}}
                <div class="p-8 text-center border-b border-gray-800 bg-gradient-to-b from-blue-600/10 to-transparent">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/20 rounded-2xl mb-4 border border-blue-500/30">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter italic">Xác nhận thanh toán</h2>
                    <p class="text-gray-500 text-sm mt-1">An toàn và bảo mật qua cổng kết nối PayOS</p>
                </div>

                <div class="p-8">
                    <div class="flex flex-col items-center max-w-sm mx-auto space-y-8">
                        
                        {{-- Phần ảnh Brand --}}
                        <div class="relative group w-full max-w-[240px]">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                            <div class="relative flex flex-col items-center p-8 bg-[#202020] rounded-2xl border border-gray-800">
                                <img src="{{ asset('images/payos.png') }}"
                                    alt="PayOS Logo" class="w-32 h-auto mb-4 brightness-110"
                                    onerror="this.src='https://payos.vn/wp-content/uploads/2023/07/Logo-PayOS.svg'">
                                <div class="h-px w-12 bg-gray-800 mb-4"></div>
                                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Official Partner</span>
                            </div>
                        </div>

                        {{-- Phần thông tin tiền và Nút bấm nằm dưới ảnh --}}
                        <div class="w-full text-center space-y-6">
                            <div>
                                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-[0.15em] mb-1">Tổng tiền thanh toán</p>
                                <div class="flex items-baseline justify-center gap-2">
                                    <span class="text-5xl font-black text-white tracking-tighter">
                                        {{ number_format($total ?? session('total_price', 0)) }}
                                    </span>
                                    <span class="text-lg font-bold text-blue-500">VND</span>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="button" id="btn-payos"
                                    class="w-full group relative flex justify-center items-center px-6 py-5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-black uppercase tracking-widest text-xs transition-all active:scale-95 shadow-xl shadow-blue-900/40 overflow-hidden">
                                    <span class="relative z-10 flex items-center">
                                        Thanh toán ngay 
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Chú ý bảo mật --}}
                    <div class="mt-10 p-4 bg-blue-500/5 border border-blue-500/10 rounded-xl">
                        <p class="text-[11px] text-gray-500 text-center leading-relaxed italic">
                            Hệ thống sẽ chuyển hướng bạn đến trang thanh toán của <span class="text-blue-400 font-bold">PayOS</span>. 
                            Vui lòng không tắt trình duyệt cho đến khi giao dịch được xác nhận thành công.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>

    <script>
        document.getElementById('btn-payos').addEventListener('click', function() {
            const btn = this;
            const originalContent = btn.innerHTML;
            
            btn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ĐANG XỬ LÝ...
            `;
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');

            fetch("{{ route('checkout') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok) {
                    // Nếu là game miễn phí, chuyển hướng về Thư viện
                    if (data.is_free) {
                        const modal = document.getElementById('success-modal');
                        document.getElementById('modal-message').innerText = data.message;
                        modal.classList.remove('hidden');

                        document.getElementById('btn-modal-redirect').onclick = function() {
                            window.location.href = data.redirectUrl;
                        };
                    } else if (data.checkoutUrl) {
                        // Nếu có phí, chuyển hướng sang PayOS
                        window.location.href = data.checkoutUrl;
                    }
                } else {
                    throw new Error(data.error || "Không thể tạo link thanh toán");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Lỗi: " + error.message);
                btn.innerHTML = originalContent;
                btn.disabled = false;
                btn.classList.remove('opacity-80', 'cursor-not-allowed');
            });
        });
    </script>
    <div id="success-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-sm"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">​</span>

        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-[#1a1a1a] border border-gray-800 rounded-[2rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="p-8">
                <div class="flex flex-col items-center text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-green-500/20 border border-green-500/30">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white uppercase italic mb-2" id="modal-title">Thành công!</h3>
                    <p class="text-gray-400 mb-8" id="modal-message"></p>
                    
                    <button type="button" id="btn-modal-redirect"
                        class="w-full px-6 py-4 bg-green-600 hover:bg-green-500 text-white rounded-xl font-black uppercase tracking-widest text-xs transition-all active:scale-95 shadow-lg shadow-green-900/40">
                        Đi tới thư viện ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>