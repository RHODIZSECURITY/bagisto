<?php

return [
    [
        'key'    => 'sales.carriers.usps_flat',
        'info'   => 'Usps Shipping Rates',
        'name'   => 'Usps Shipping Rates',
        'sort'   => 20,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'Title',
                'type'          => 'text',
                'validation'    => 'required',
                'default'       => 'USPS Shipping Rates',
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'          => 'description',
                'title'         => 'Description',
                'type'          => 'textarea',
                'validation'    => '',
                'default'       => 'Shipping Rates based on USPS API. Services based in cart weight/dimensions/distance or flat rates. Calculated on real-time',
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'          => 'active',
                'title'         => 'Active',
                'type'          => 'boolean',
                'validation'    => '',
                'default'       => true,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'       => 'USPS_CLIENT_ID',
                'title'      => 'USPS CLIENT ID',
                'type'       => 'text',
                'validation' => 'required_if:active,1|min:5',
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'       => 'USPS_CLIENT_SECRET',
                'title'      => 'USPS CLIENT SECRET',
                'type'       => 'text',
                'validation' => 'required_if:active,1|min:5',
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'    => 'service_1',
                'title'   => 'Servicio #1',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Inactive',
                        'value' => 'INACTIVE',
                    ], [
                        'title' => 'Priority Mail - Dimensional (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL',
                    ], [
                        'title' => 'Priority Mail Express - Dimensional (1 a 2 días)',
                        'value' => 'PRIORITY_MAIL_EXPRESS',
                    ], [
                        'title' => 'Ground Advantage - Estandard (2 a 5 días hábiles)',
                        'value' => 'USPS_GROUND_ADVANTAGE',
                    ], [
                        'title' => 'Priority Mail - Flat Rates (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL_FLAT',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'    => 'service_2',
                'title'   => 'Servicio #2',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Inactive',
                        'value' => 'INACTIVE',
                    ], [
                        'title' => 'Priority Mail - Dimensional (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL',
                    ], [
                        'title' => 'Priority Mail Express - Dimensional (1 a 2 días)',
                        'value' => 'PRIORITY_MAIL_EXPRESS',
                    ], [
                        'title' => 'Ground Advantage - Estandard (2 a 5 días hábiles)',
                        'value' => 'USPS_GROUND_ADVANTAGE',
                    ], [
                        'title' => 'Priority Mail - Flat Rates (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL_FLAT',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'    => 'service_3',
                'title'   => 'Servicio #3',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Inactive',
                        'value' => 'INACTIVE',
                    ], [
                        'title' => 'Priority Mail - Dimensional (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL',
                    ], [
                        'title' => 'Priority Mail Express - Dimensional (1 a 2 días)',
                        'value' => 'PRIORITY_MAIL_EXPRESS',
                    ], [
                        'title' => 'Ground Advantage - Estandard (2 a 5 días hábiles)',
                        'value' => 'USPS_GROUND_ADVANTAGE',
                    ], [
                        'title' => 'Priority Mail - Flat Rates (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL_FLAT',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'    => 'service_4',
                'title'   => 'Servicio #4',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Inactive',
                        'value' => 'INACTIVE',
                    ], [
                        'title' => 'Priority Mail - Dimensional (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL',
                    ], [
                        'title' => 'Priority Mail Express - Dimensional (1 a 2 días)',
                        'value' => 'PRIORITY_MAIL_EXPRESS',
                    ], [
                        'title' => 'Ground Advantage - Estandard (2 a 5 días hábiles)',
                        'value' => 'USPS_GROUND_ADVANTAGE',
                    ], [
                        'title' => 'Priority Mail - Flat Rates (1 a 3 días hábiles)',
                        'value' => 'PRIORITY_MAIL_FLAT',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => false,
            ]
        ],
     ],
];
