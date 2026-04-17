<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100">

        <div
            class="w-full sm:max-w-2xl px-8 py-6 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-200">

            <div class="text-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Thanh toán đơn hàng</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t border-b border-gray-100 py-4">

                <div class="flex flex-col items-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                    <div class="bg-white p-1 rounded shadow-sm mb-2">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VNPay_Demo"
                            alt="VNPay QR Code" class="w-32 h-32 object-contain">
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="https://sandbox.vnpayment.vn/paymentv2/Images/brands/logo-vnpay.png" alt="VNPay Logo"
                            class="h-4">
                        <span class="text-[10px] font-bold text-blue-700 uppercase">VNPay-QR</span>
                    </div>
                </div>

                <div class="flex flex-col justify-center space-y-4">
                    <div class="text-center md:text-left">
                        <p class="text-gray-500 text-xs uppercase font-semibold tracking-wider">Số tiền cần trả</p>
                        <h3 class="text-3xl font-black text-red-600">
                            900.000 <span class="text-sm font-normal text-gray-400">VND</span>
                        </h3>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <button type="button"
                            class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-md font-bold text-white text-xs uppercase tracking-widest hover:bg-blue-700 transition">
                            Xác nhận thanh toán
                        </button>

                        <a href="{{ url()->previous() }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-50 border border-gray-200 rounded-md font-bold text-gray-500 text-[10px] uppercase tracking-widest hover:bg-gray-100 transition">
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>

            <p class="mt-4 text-[11px] text-center text-gray-400 italic">
                * Mã QR sẽ hết hạn sau <span class="text-red-400 font-semibold text-xs">15:00</span>
            </p>
        </div>
    </div>
</x-guest-layout>