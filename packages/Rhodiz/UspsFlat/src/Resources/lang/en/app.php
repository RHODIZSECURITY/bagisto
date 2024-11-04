<?php

return [
    'shop' => [
        'layouts' => [

        ],
        'address' => [
            'modal_suggestion' => [
                'title'              => 'Please Confirm Your Address',
                'description'        => 'If the suggested address is accurate, please select ACCEPT SUGGESTION. Otherwise, select SAVE to retain the address you provided.',
                'button-save'        => 'Save',
                'button-accept'      => 'Accept Suggestion',
                'address-entered'    => 'Entered Address',
                'address-suggested'  => 'Suggested Address',
            ],
            'modal_invalid' => [
                'title'              => 'Address Could Not Be Verified',
                'description'        => 'Please review your address carefully. Select EDIT to make any changes, or select SAVE if the address is correct.',
                'button-save'        => 'Save',
                'button-accept'      => 'Edit'
            ],
        ],
    ],

    'admin' => [
        'layouts' => [

        ],

        'system' => [
            'title'                 => 'Title',
            'description'           => 'Description',
            'status'                => 'Status',
            'usps'                  => 'USPS Shipping',
            'usps-shipping'         => 'United States Postal Service (USPS) is the Post Office, U.S. Mail, or Postal Service, is an independent agency of the executive branch of the United States federal government responsible for providing postal service in the U.S., its insular areas, and its associated states.',
            'gateway-url'           => 'Gateway URL',
            'gateway-secure-url'    => 'Secure Gateway URL',
            'user-id'               => 'User ID' ,
            'password'              => 'Password',
            'mode'                  => 'Mode',
            'container'             => 'Container',
            'size'                  => 'Size',
            'size-description'      => 'Height, Length, Width will work in the case of LARGE size.',
            'machinable'            => 'Machinable',
            'allowed-methods'       => 'Allowed Methods',
            'allow-seller'          => 'Allow Seller To Save Usps Details',
            'length'                => 'Length',
            'height'                => 'Height',
            'width'                 => 'Width',
            'grith'                 => 'Grith',
            'allowed-countries'     => 'Allowed Countries',
            'usps-error'            => 'No Method Avaialble for the selected location,select another address',
            'error-message'         => 'Error Message',
            'shipping-not-available'=> 'Usps Shipping is not available for this product',
            'business-days'         => 'Business Days',
        ],
    ],
];
