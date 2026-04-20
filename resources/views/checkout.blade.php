<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-2xl px-8 py-6 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-200">

            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Xác nhận thanh toán</h2>
                <p class="text-gray-500 text-sm">Vui lòng kiểm tra lại số tiền trước khi tiếp tục</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-t border-b border-gray-100 py-6">
                <div class="flex flex-col items-center p-6 bg-green-50 rounded-lg border border-green-100">
                    <div class="bg-white p-3 rounded-xl shadow-sm mb-3">
                        <img src="https://payos.vn/wp-content/uploads/2023/07/Logo-PayOS.svg" 
                             alt="PayOS Logo" class="w-32 h-12 object-contain">
                    </div>
                    <div class="text-center">
                        <span class="text-[12px] font-bold text-green-700 uppercase tracking-widest">Cổng thanh toán PayOS</span>
                        <p class="text-[10px] text-green-600 mt-1">An toàn - Nhanh chóng - Tự động</p>
                    </div>
                </div>

                <div class="flex flex-col justify-center space-y-5">
                    <div class="text-center md:text-left">
                        <p class="text-gray-500 text-xs uppercase font-semibold tracking-wider">Tổng cộng đơn hàng</p>
                        <h3 class="text-3xl font-black text-blue-600">
                            {{ number_format(session('total_price', 0)) }} 
                            <span class="text-sm font-normal text-gray-400">VND</span>
                        </h3>
                    </div>

                    <div class="flex flex-col space-y-3">
                        <button type="button" id="btn-payos"
                            class="w-full inline-flex justify-center items-center px-4 py-3 bg-blue-600 border border-transparent rounded-md font-bold text-white text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-md active:scale-95">
                            Thanh toán ngay qua PayOS
                        </button>

                        <a href="{{ route('giohang') }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-200 rounded-md font-bold text-gray-400 text-[10px] uppercase tracking-widest hover:bg-gray-50 transition">
                            Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>

            <p class="mt-6 text-[11px] text-center text-gray-400 italic leading-relaxed">
                * Sau khi nhấn "Thanh toán ngay", bạn sẽ được chuyển hướng đến trang quét mã VietQR chính thức của PayOS. 
                Đơn hàng sẽ được tự động xử lý ngay sau khi chuyển khoản thành công.
            </p>
        </div>
    </div>

    <script>
        document.getElementById('btn-payos').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerText;
            
            // Hiệu ứng loading
            btn.innerText = 'ĐANG KHỞI TẠO GD...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            fetch("{{ route('checkout') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.checkoutUrl) {
                    // Chuyển hướng sang PayOS
                    window.location.href = data.checkoutUrl;
                } else {
                    throw new Error(data.error || "Không thể tạo link thanh toán");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Lỗi: " + error.message);
                
                // Khôi phục nút bấm nếu lỗi
                btn.innerText = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
            });
        });
    </script>
</x-guest-layout>