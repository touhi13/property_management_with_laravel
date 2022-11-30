<?php

return [
    'store_id' => '5',
    'signature_key' => '1111',
    'sandbox' => true,
    'redirect_url' => [
        'success' => [
            'route' => 'payment.success'
        ],
        'cancel' => [
            'route' => 'payment.cancel' 
        ]
    ]
];
