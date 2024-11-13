<?php

return [
    'shop' => [
        'contact' => 'Contact',
        'email'   => 'Email',
        'phone'   => 'Phone',
        'address' => 'Address',
    ],
    'admin' => [
        'system' => [
            'config_name'         => 'Rhodiz Settings',
            'info'                => 'Set Rhodiz Related Settings',
            'settings'            => 'Rhodiz Settings',
            'general'             => 'General',
            'status'              => 'Status',
            'name'                => 'Business Name',
            'web'                 => 'Web url',
            'new_order_customer_id'   => 'Customer ID used to create store orders',
            'display-products'    => 'Display Products',
        ],
        'store' => [
            'config_name'         => 'Store Settings',
            'info'                => 'Set Store Related Settings',
            'settings'            => 'Settings',
            'general'             => 'General',
            'status'              => 'Status',
            'phone'               => 'Contact Phone',
            'email'               => 'Email',
            'address'             => 'Address',
        ],
    ],
    'validation' => [
        'date_bad_format' => 'The date format is incorrect.',
        'date_before_min' => 'The date of birth field must be a date after :date_min.',
        'date_after_max' =>  'The date of birth field must be a date before today.'
    ],
];
