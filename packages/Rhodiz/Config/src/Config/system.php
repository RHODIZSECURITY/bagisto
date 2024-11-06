<?php

return [
    [
        'key'  => 'rhodiz_config',
        'name' => 'rhodiz_config::app.admin.system.rhodiz_settings_name',
        'info' => 'rhodiz_config::app.admin.system.rhodiz_settings_info',
        'sort' => 1,
    ], [
        'key'  => 'rhodiz_config.config',
        'name' => 'rhodiz_config::app.admin.system.rhodiz_settings_name',
        'info' => 'rhodiz_config::app.admin.system.rhodiz_settings_info',
        'icon' => 'settings/store.svg',
        'sort' => 1,
    ], [
        'key'    => 'rhodiz_config.config.general',
        'name'   => 'rhodiz_config::app.admin.system.settings',
        'info'   => 'rhodiz_config::app.admin.system.rhodiz_settings_info',
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
    ],
];
