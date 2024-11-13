<?php

return [
    'shop' => [
        'contact' => 'Contacto',
        'email'   => 'Correo',
        'phone'   => 'Teléfono',
        'address' => 'Dirección',
    ],
    'admin' => [
        'system' => [
            'config_name'         => 'Configuraciones de Rhodiz',
            'info'                => 'Configurar opciones de Rhodiz',
            'settings'            => 'Configuraciones de Rhodiz',
            'general'             => 'General',
            'status'              => 'Estado',
            'name'                => 'Nombre Empresa',
            'web'                 => 'Web url',
            'new_order_customer_id'   => 'ID del cliente utilizado para crear los pedidos de la tienda',
            'display-products'    => 'Mostrar Productos'
        ],
        'store' => [
            'config_name'         => 'Configuraciones de la Tienda',
            'info'                => 'Configurar opciones de Tienda',
            'settings'            => 'Configuraciones',
            'general'             => 'General',
            'status'              => 'Estado',
            'phone'               => 'Telefono de Contacto',
            'email'               => 'Email',
            'address'             => 'Direccion',
        ],
    ],
    'validation' => [
        'date_bad_format' => 'El formato de la fecha es incorrecto.',
        'date_before_min' => 'La fecha de nacimiento debe ser una fecha posterior a :date_min.',
        'date_after_max' =>  'El fecha de nacimiento debe ser anterior al dia de hoy.',
    ],
];
