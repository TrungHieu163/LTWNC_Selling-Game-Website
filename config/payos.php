<?php

return [
    'client_id'     => env('PAYOS_CLIENT_ID'),
    'api_key'       => env('PAYOS_API_KEY'),
    'checksum_key'  => env('PAYOS_CHECKSUM_KEY'),

    // URL callback sau khi thanh toán
    'return_url'    => env('PAYOS_RETURN_URL', 'http://127.0.0.1:8000/library'),
    
    // URL nếu người dùng hủy thanh toán
    'cancel_url'    => env('PAYOS_CANCEL_URL', 'http://127.0.0.1:8000/giohang'),

    // Webhook URL (PayOS sẽ gọi khi thanh toán thành công)
    'webhook_url'   => env('PAYOS_WEBHOOK_URL', 'http://127.0.0.1:8000/payos-webhook'),
];