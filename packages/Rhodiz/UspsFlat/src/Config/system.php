<?php

return [
    [
        'key'    => 'sales.carriers.usps_flat',
        'info'   => 'Usps Flat Rate by Weight',
        'name'   => 'Usps Flat Rate by Weight',
        'sort'   => 20,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'Title',
                'type'          => 'text',
                'validation'    => 'required',
                'default'       => 'USPS Flat Rate Shipping',
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'          => 'description',
                'title'         => 'Description',
                'type'          => 'textarea',
                'validation'    => '',
                'default'       => 'USPS Flat Rate Shipping based on total cart weight.',
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
            // Service cost configurations for each weight range

            // First-Class Package Service
            [
                'name'       => 'first_class_package_service',
                'title'      => 'First-Class Package Service (0 - 1 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 5.50,
                'channel_based' => false,
                'locale_based'  => false,
            ],

            // Priority Mail Flat Rate Envelope (applies to any weight up to 70 lb)
            [
                'name'       => 'priority_mail_flat_rate_envelope',
                'title'      => 'Priority Mail Flat Rate Envelope (up to 70 lb) (31.75 cm x 24.13 cm)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 9.65,
                'channel_based' => false,
                'locale_based'  => false,
            ],

            // Priority Mail Flat Rate Small Box (applies to any weight up to 70 lb)
            [
                'name'       => 'priority_mail_flat_rate_small_box',
                'title'      => 'Priority Mail Flat Rate Small Box (up to 70 lb) (21.91 cm x 13.65 cm x 4.12 cm) o (27.94 cm x 21.59 cm x 13.97 cm)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 10.20,
                'channel_based' => false,
                'locale_based'  => false,
            ],

            // NO USPS Retail Ground

            // Priority Mail Medium Flat Rate Box
            [
                'name'       => 'priority_mail_medium_flat_rate_box',
                'title'      => 'Priority Mail Flat Rate Medium Box (up to 70 lb) (27.9 cm x 21.6 cm x 14 cm) o (34.6 cm x 30.2 cm x 8.6 cm)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 17.10,
                'channel_based' => false,
                'locale_based'  => false,
            ],

            // Priority Mail Large Flat Rate Box
            [
                'name'       => 'priority_mail_large_flat_rate_box',
                'title'      => 'Priority Mail Flat Rate Large Box (up to 70 lb) (31.1 cm x 31.1 cm x 15.2 cm)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 22.80,
                'channel_based' => false,
                'locale_based'  => false,
            ],

        ],
     ],
];
