<?php

return [
    [
        'key'    => 'sales.carriers.usps_flat',
        'info'   => 'Usps Flat Rate by Weight - extension created for bagisto by Rhodiz.',
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
                'name'       => 'first_class_package_service_0_1_lb',
                'title'      => 'First-Class Package Service (0 - 1 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 5.50,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            // USPS Retail Ground
            [
                'name'       => 'usps_retail_ground_0_1_lb',
                'title'      => 'USPS Retail Ground (0 - 1 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 8.80,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'       => 'usps_retail_ground_1_5_lb',
                'title'      => 'USPS Retail Ground (1 - 5 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 10.50,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'       => 'usps_retail_ground_5_10_lb',
                'title'      => 'USPS Retail Ground (5 - 10 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 14.50,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            [
                'name'       => 'usps_retail_ground_10_20_lb',
                'title'      => 'USPS Retail Ground (10 - 20 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 24.50,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            // Priority Mail Medium Flat Rate Box
            [
                'name'       => 'priority_mail_medium_flat_rate_box_5_10_lb',
                'title'      => 'Priority Mail Medium Flat Rate Box (5 - 10 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 17.10,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            // Priority Mail Large Flat Rate Box
            [
                'name'       => 'priority_mail_large_flat_rate_box_10_20_lb',
                'title'      => 'Priority Mail Large Flat Rate Box (10 - 20 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 22.80,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            // Priority Mail Flat Rate Envelope (applies to any weight up to 70 lb)
            [
                'name'       => 'priority_mail_flat_rate_envelope',
                'title'      => 'Priority Mail Flat Rate Envelope (applies to any weight up to 70 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 9.65,
                'channel_based' => false,
                'locale_based'  => false,
            ],
            // Priority Mail Flat Rate Small Box (applies to any weight up to 70 lb)
            [
                'name'       => 'priority_mail_flat_rate_small_box',
                'title'      => 'Priority Mail Flat Rate Small Box (applies to any weight up to 70 lb)',
                'type'       => 'number',
                'validation' => 'required|min:0',
                'default'    => 10.20,
                'channel_based' => false,
                'locale_based'  => false,
            ],

        ],
     ],
];
