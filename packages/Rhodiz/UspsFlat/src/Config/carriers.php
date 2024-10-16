<?php

return [
    'usps_flat' => [
        'code'         => 'usps_flat',
        'title'        => 'USPS Flat Rate by Weight Shipping',
        'description'  => 'USPS Flat Rate by Weight Shipping',
        'active'       => true,
        'default_rate' => '10',
        'type'         => 'per_order',  //per_order o per_unit
        'class'        => 'Rhodiz\UspsFlat\Carriers\UspsFlat'
    ],
];
