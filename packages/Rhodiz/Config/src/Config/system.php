<?php

return [
    [
        'key'  => 'rhodiz_config',
        'name' => 'rhodiz_config::app.admin.system.config_name',
        'info' => 'rhodiz_config::app.admin.system.info',
        'sort' => 1,
    ], [
        'key'  => 'rhodiz_config.config',
        'name' => 'rhodiz_config::app.admin.system.config_name',
        'info' => 'rhodiz_config::app.admin.system.info',
        'icon' => 'settings/store.svg',
        'sort' => 1,
    ], [
        'key'    => 'rhodiz_config.config.general',
        'name'   => 'rhodiz_config::app.admin.system.config_name',
        'info'   => 'rhodiz_config::app.admin.system.info',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'status',
                'title'         => 'rhodiz_config::app.admin.system.status',
                'type'          => 'boolean',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'name',
                'title'         => 'rhodiz_config::app.admin.system.name',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'web',
                'title'         => 'rhodiz_config::app.admin.system.web',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'display-product',
                'title'         => 'rhodiz_config::app.admin.system.display-products',
                'type'          => 'boolean',
                'channel_based' => false,
                'locale_based'  => false,
            ],
        ],
    ], [
        'key'    => 'rhodiz_config.config.store',
        'name'   => 'rhodiz_config::app.admin.store.config_name',
        'info'   => 'rhodiz_config::app.admin.store.info',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'status',
                'title'         => 'rhodiz_config::app.admin.store.status',
                'type'          => 'boolean',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'phone',
                'title'         => 'rhodiz_config::app.admin.store.phone',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'email',
                'title'         => 'rhodiz_config::app.admin.store.email',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ],[
                'name'          => 'address',
                'title'         => 'rhodiz_config::app.admin.store.address',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ]
        ],
    ],
];
