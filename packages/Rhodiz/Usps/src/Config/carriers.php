<?php

return [
    'usps' => [
        'code'         => 'usps',
        'title'        => 'USPS Shipping',
        'description'  => 'USPS Shipping',
        'active'       => true,
        'default_rate' => '10',
        'type'         => 'per_unit',
        'class'        => 'Rhodiz\Usps\Carriers\Usps',
    ],
];
