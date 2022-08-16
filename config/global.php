<?php

return [
    'admin' => [
        'default_user_id' => 11000,
        'default_email' => 'admin@aspire.com',
        'default_password' => 'admin@9015'
    ],
    'role' => [
        'admin' => 1001,
        'customer' => 1002
    ],
    'permission' => [
            'loan' => [
                'create' => 2001,
                'view' => 2002,
                'approve' => 2003,
                'repayment' => 2004
            ],
    ],
    'system_settings' => [
                'group' => [
                    'loan_status' => 100
                ],
                'name' => [
                    'cancelled'  => 101,
                    'refunded'   => 103,
                    'pending'    => 105,
                    'approved'   => 106,
                    'processing' => 108,
                    'paid'       => 110
                ]
    ]

];
