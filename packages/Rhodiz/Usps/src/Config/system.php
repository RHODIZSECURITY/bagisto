<?php

return [
    [
        'key'    => 'sales.carriers.usps',
        'info'   => 'Usps extension created for bagisto by Rhodiz.',
        'name'   => 'Usps',
        'sort'   => 3,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'usps::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'usps::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'active',
                'title'         => 'usps::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false
            ], [
                'name'          => 'gateway_url',
                'title'         => 'usps::app.admin.system.gateway-url',
                'type'          => 'text',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'gateway_secure_url',
                'title'         => 'usps::app.admin.system.gateway-secure-url',
                'type'          => 'text',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'user_id',
                'title'         => 'usps::app.admin.system.user-id',
                'type'          => 'text',
                'validation'    => 'required_if:active,1',
                'channel_based' => true,
                'locale_based'  => false,
            ], [
                'name'          => 'password',
                'title'         => 'usps::app.admin.system.password',
                'type'          => 'password',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'    => 'mode',
                'title'   => 'usps::app.admin.system.mode',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Development',
                        'value' => 'DEVELOPMENT',
                    ], [
                        'title' => 'Live',
                        'value' => "LIVE",
                    ],
                ],
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'    => 'container',
                'title'   => 'usps::app.admin.system.container',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Variable',
                        'value' => 'VARIABLE',
                    ], [
                        'title' => 'Small Flat-Rate Box',
                        'value' => 'SM FLAT RATE BOX',
                    ], [
                        'title' => 'Medium Flat-Rate Box',
                        'value' => 'MD FLAT RATE BOX',
                    ], [
                        'title' => 'Large Flat-Rate Box',
                        'value' => 'LG FLAT RATE BOX',
                    ], [
                        'title' => 'Flat-Rate Envelope',
                        'value' => 'FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Small Flat-Rate Envelope',
                        'value' => 'SM FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Window Flat-Rate Envelope',
                        'value' => 'GIFT CARD FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Legal Flat-Rate Envelope',
                        'value' => 'LEGAL FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Padded Flat-Rate Envelope',
                        'value' => 'PADDED FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Rectangular',
                        'value' => 'RECTANGULAR',
                    ], [
                        'title' => 'Non-rectangular',
                        'value' => 'GIFT CARD FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Window Flat-Rate Envelope',
                        'value' => 'NONRECTANGULAR',
                    ],
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'    => 'size',
                'title'   => 'usps::app.admin.system.size',
                'info'    => 'usps::app.admin.system.size-description',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Regular',
                        'value' => 'REGULAR',
                    ], [
                        'title' => 'Large',
                        'value' => 'LARGE',
                    ],
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'length',
                'title'         => 'Length',
                'type'          => 'depends',
                'depend'        => 'size:LARGE',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'          => 'width',
                'title'         => 'Width',
                'type'          => 'depends',
                'depend'        => 'size:LARGE',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'          => 'height',
                'title'         => 'Height',
                'type'          => 'depends',
                'depend'        => 'size:LARGE',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'    => 'machinable',
                'title'   => 'usps::app.admin.system.machinable',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'Yes',
                        'value' => 'true',
                    ], [
                        'title' => 'No',
                        'value' => 'false',
                    ],
                ],
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'          => 'allowed_countries',
                'title'         => 'usps::app.admin.system.allowed-countries',
                'type'          => 'select',
                'options' => [
                    [
                        'title' => 'United States',
                        'value' => 'US',
                    ], [
                        'title' => 'Guam',
                        'value' => 'GU',
                    ], [
                        'title' => 'Northern Mariana Islands',
                        'value' => 'MP',
                    ], [
                        'title' => 'Palau',
                        'value' => 'PW',
                    ], [
                        'title' => 'Puerto Rico',
                        'value' => 'PR',
                    ], [
                        'title' => 'Virgin Islands US',
                        'value' => 'VI',
                    ], [
                        'title' => 'Samoa American',
                        'value' => 'AS',
                    ]
                ],
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'          => 'error_message',
                'title'         => 'usps::app.admin.system.error-message',
                'type'          => 'text',
                'validation'    => 'required_if:active,1',
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'    => 'services',
                'title'   => 'usps::app.admin.system.allowed-methods',
                'type'    => 'multiselect',
                'options' => [
                    [
                        'title' => 'First-Class Mail Large Envelope',
                        'value' => '0_FCLE',
                    ], [
                        'title' => 'First-Class Mail Letter',
                        'value' => '0_FCL',
                    ], [
                        'title' => 'First-Class Package Service - Retail',
                        'value' => '0_FCP',
                    ], [
                        'title' => 'First-Class Mail Postcards',
                        'value' => '0_FCPC',
                    ], [
                        'title' => 'Priority Mail',
                        'value' => '1',
                    ], [
                        'title' => 'Priority Mail Express Hold For Pickup',
                        'value' => '2',
                    ], [
                        'title' => 'Priority Mail Express',
                        'value' => '3',
                    ], [
                        'title' => 'Retail Ground',
                        'value' => '4',
                    ], [
                        'title' => 'Media Mail',
                        'value' => '6',
                    ], [
                        'title' => 'Library Mail',
                        'value' => '7',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope',
                        'value' => '13',
                    ], [
                        'title' => 'First-Class Mail Large Postcards',
                        'value' => '15',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope',
                        'value' => '16',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box',
                        'value' => '17',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box',
                        'value' => '22',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery',
                        'value' => '23',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Envelope',
                        'value' => '25',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope Hold For Pickup',
                        'value' => '27',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box',
                        'value' => '28',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope',
                        'value' => '29',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope',
                        'value' => '30',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '31',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Legal Flat Rate Envelope',
                        'value' => '32',
                    ], [
                        'title' => 'Priority Mail Hold For Pickup',
                        'value' => '33',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box Hold For Pickup',
                        'value' => '34',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box Hold For Pickup',
                        'value' => '35',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box Hold For Pickup',
                        'value' => '36',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope Hold For Pickup',
                        'value' => '37',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope',
                        'value' => '38',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope Hold For Pickup',
                        'value' => '39',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope',
                        'value' => '40',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope Hold For Pickup',
                        'value' => '41',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope',
                        'value' => '42',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope Hold For Pickup',
                        'value' => '43',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope',
                        'value' => '44',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '45',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '46',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A',
                        'value' => '47',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A Hold For Pickup',
                        'value' => '48',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B',
                        'value' => '49',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B Hold For Pickup',
                        'value' => '50',
                    ], [
                        'title' => 'First-Class Package Service Hold For Pickup',
                        'value' => '53',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Boxes',
                        'value' => '57',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C',
                        'value' => '58',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C Hold For Pickup',
                        'value' => '59',
                    ], [
                        'title' => 'First-Class Package Service',
                        'value' => '61',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope',
                        'value' => '62',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '63',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Padded Flat Rate Envelope',
                        'value' => '64',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'    => 'service1',
                'title'   => 'usps::app.admin.system.service1',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'First-Class Mail Large Envelope',
                        'value' => '0_FCLE',
                    ], [
                        'title' => 'First-Class Mail Letter',
                        'value' => '0_FCL',
                    ], [
                        'title' => 'First-Class Package Service - Retail',
                        'value' => '0_FCP',
                    ], [
                        'title' => 'First-Class Mail Postcards',
                        'value' => '0_FCPC',
                    ], [
                        'title' => 'Priority Mail',
                        'value' => '1',
                    ], [
                        'title' => 'Priority Mail Express Hold For Pickup',
                        'value' => '2',
                    ], [
                        'title' => 'Priority Mail Express',
                        'value' => '3',
                    ], [
                        'title' => 'Retail Ground',
                        'value' => '4',
                    ], [
                        'title' => 'Media Mail',
                        'value' => '6',
                    ], [
                        'title' => 'Library Mail',
                        'value' => '7',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope',
                        'value' => '13',
                    ], [
                        'title' => 'First-Class Mail Large Postcards',
                        'value' => '15',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope',
                        'value' => '16',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box',
                        'value' => '17',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box',
                        'value' => '22',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery',
                        'value' => '23',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Envelope',
                        'value' => '25',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope Hold For Pickup',
                        'value' => '27',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box',
                        'value' => '28',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope',
                        'value' => '29',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope',
                        'value' => '30',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '31',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Legal Flat Rate Envelope',
                        'value' => '32',
                    ], [
                        'title' => 'Priority Mail Hold For Pickup',
                        'value' => '33',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box Hold For Pickup',
                        'value' => '34',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box Hold For Pickup',
                        'value' => '35',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box Hold For Pickup',
                        'value' => '36',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope Hold For Pickup',
                        'value' => '37',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope',
                        'value' => '38',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope Hold For Pickup',
                        'value' => '39',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope',
                        'value' => '40',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope Hold For Pickup',
                        'value' => '41',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope',
                        'value' => '42',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope Hold For Pickup',
                        'value' => '43',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope',
                        'value' => '44',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '45',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '46',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A',
                        'value' => '47',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A Hold For Pickup',
                        'value' => '48',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B',
                        'value' => '49',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B Hold For Pickup',
                        'value' => '50',
                    ], [
                        'title' => 'First-Class Package Service Hold For Pickup',
                        'value' => '53',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Boxes',
                        'value' => '57',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C',
                        'value' => '58',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C Hold For Pickup',
                        'value' => '59',
                    ], [
                        'title' => 'First-Class Package Service',
                        'value' => '61',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope',
                        'value' => '62',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '63',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Padded Flat Rate Envelope',
                        'value' => '64',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'    => 'service2',
                'title'   => 'usps::app.admin.system.service2',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'First-Class Mail Large Envelope',
                        'value' => '0_FCLE',
                    ], [
                        'title' => 'First-Class Mail Letter',
                        'value' => '0_FCL',
                    ], [
                        'title' => 'First-Class Package Service - Retail',
                        'value' => '0_FCP',
                    ], [
                        'title' => 'First-Class Mail Postcards',
                        'value' => '0_FCPC',
                    ], [
                        'title' => 'Priority Mail',
                        'value' => '1',
                    ], [
                        'title' => 'Priority Mail Express Hold For Pickup',
                        'value' => '2',
                    ], [
                        'title' => 'Priority Mail Express',
                        'value' => '3',
                    ], [
                        'title' => 'Retail Ground',
                        'value' => '4',
                    ], [
                        'title' => 'Media Mail',
                        'value' => '6',
                    ], [
                        'title' => 'Library Mail',
                        'value' => '7',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope',
                        'value' => '13',
                    ], [
                        'title' => 'First-Class Mail Large Postcards',
                        'value' => '15',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope',
                        'value' => '16',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box',
                        'value' => '17',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box',
                        'value' => '22',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery',
                        'value' => '23',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Envelope',
                        'value' => '25',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope Hold For Pickup',
                        'value' => '27',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box',
                        'value' => '28',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope',
                        'value' => '29',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope',
                        'value' => '30',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '31',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Legal Flat Rate Envelope',
                        'value' => '32',
                    ], [
                        'title' => 'Priority Mail Hold For Pickup',
                        'value' => '33',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box Hold For Pickup',
                        'value' => '34',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box Hold For Pickup',
                        'value' => '35',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box Hold For Pickup',
                        'value' => '36',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope Hold For Pickup',
                        'value' => '37',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope',
                        'value' => '38',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope Hold For Pickup',
                        'value' => '39',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope',
                        'value' => '40',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope Hold For Pickup',
                        'value' => '41',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope',
                        'value' => '42',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope Hold For Pickup',
                        'value' => '43',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope',
                        'value' => '44',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '45',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '46',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A',
                        'value' => '47',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A Hold For Pickup',
                        'value' => '48',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B',
                        'value' => '49',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B Hold For Pickup',
                        'value' => '50',
                    ], [
                        'title' => 'First-Class Package Service Hold For Pickup',
                        'value' => '53',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Boxes',
                        'value' => '57',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C',
                        'value' => '58',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C Hold For Pickup',
                        'value' => '59',
                    ], [
                        'title' => 'First-Class Package Service',
                        'value' => '61',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope',
                        'value' => '62',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '63',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Padded Flat Rate Envelope',
                        'value' => '64',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ],[
                'name'    => 'service3',
                'title'   => 'usps::app.admin.system.service3',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'First-Class Mail Large Envelope',
                        'value' => '0_FCLE',
                    ], [
                        'title' => 'First-Class Mail Letter',
                        'value' => '0_FCL',
                    ], [
                        'title' => 'First-Class Package Service - Retail',
                        'value' => '0_FCP',
                    ], [
                        'title' => 'First-Class Mail Postcards',
                        'value' => '0_FCPC',
                    ], [
                        'title' => 'Priority Mail',
                        'value' => '1',
                    ], [
                        'title' => 'Priority Mail Express Hold For Pickup',
                        'value' => '2',
                    ], [
                        'title' => 'Priority Mail Express',
                        'value' => '3',
                    ], [
                        'title' => 'Retail Ground',
                        'value' => '4',
                    ], [
                        'title' => 'Media Mail',
                        'value' => '6',
                    ], [
                        'title' => 'Library Mail',
                        'value' => '7',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope',
                        'value' => '13',
                    ], [
                        'title' => 'First-Class Mail Large Postcards',
                        'value' => '15',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope',
                        'value' => '16',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box',
                        'value' => '17',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box',
                        'value' => '22',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery',
                        'value' => '23',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Envelope',
                        'value' => '25',
                    ], [
                        'title' => 'Priority Mail Express Flat Rate Envelope Hold For Pickup',
                        'value' => '27',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box',
                        'value' => '28',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope',
                        'value' => '29',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope',
                        'value' => '30',
                    ], [
                        'title' => 'Priority Mail Express Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '31',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Legal Flat Rate Envelope',
                        'value' => '32',
                    ], [
                        'title' => 'Priority Mail Hold For Pickup',
                        'value' => '33',
                    ], [
                        'title' => 'Priority Mail Large Flat Rate Box Hold For Pickup',
                        'value' => '34',
                    ], [
                        'title' => 'Priority Mail Medium Flat Rate Box Hold For Pickup',
                        'value' => '35',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Box Hold For Pickup',
                        'value' => '36',
                    ], [
                        'title' => 'Priority Mail Flat Rate Envelope Hold For Pickup',
                        'value' => '37',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope',
                        'value' => '38',
                    ], [
                        'title' => 'Priority Mail Gift Card Flat Rate Envelope Hold For Pickup',
                        'value' => '39',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope',
                        'value' => '40',
                    ], [
                        'title' => 'Priority Mail Window Flat Rate Envelope Hold For Pickup',
                        'value' => '41',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope',
                        'value' => '42',
                    ], [
                        'title' => 'Priority Mail Small Flat Rate Envelope Hold For Pickup',
                        'value' => '43',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope',
                        'value' => '44',
                    ], [
                        'title' => 'Priority Mail Legal Flat Rate Envelope Hold For Pickup',
                        'value' => '45',
                    ], [
                        'title' => 'Priority Mail Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '46',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A',
                        'value' => '47',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box A Hold For Pickup',
                        'value' => '48',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B',
                        'value' => '49',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box B Hold For Pickup',
                        'value' => '50',
                    ], [
                        'title' => 'First-Class Package Service Hold For Pickup',
                        'value' => '53',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Flat Rate Boxes',
                        'value' => '57',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C',
                        'value' => '58',
                    ], [
                        'title' => 'Priority Mail Regional Rate Box C Hold For Pickup',
                        'value' => '59',
                    ], [
                        'title' => 'First-Class Package Service',
                        'value' => '61',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope',
                        'value' => '62',
                    ], [
                        'title' => 'Priority Mail Express Padded Flat Rate Envelope Hold For Pickup',
                        'value' => '63',
                    ], [
                        'title' => 'Priority Mail Express Sunday/Holiday Delivery Padded Flat Rate Envelope',
                        'value' => '64',
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => true,
            ]

        ],
    ],
];
