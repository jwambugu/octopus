<?php

return [
    'current_environment' => env('PAYPAL_ENVIRONMENT'),
    'environment' => [
        'sandbox' => [
            'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
            'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        ],
        'production' => [
            'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
            'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
        ],
    ]
];
