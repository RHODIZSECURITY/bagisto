<?php

return [
    'shop' => [
        'layouts' => [

        ],
        'address' => [
            'modal_suggestion' => [
                'title'              => 'Por Favor, Confirme Su Dirección',
                'description'        => 'Si la dirección sugerida es correcta, seleccione ACEPTAR SUGERENCIA. De lo contrario, seleccione GUARDAR para conservar la dirección que ingresó.',
                'button-save'        => 'Guardar',
                'button-accept'      => 'Aceptar Sugerencia',
                'address-entered'    => 'Dirección Ingresada',
                'address-suggested'  => 'Dirección Sugerida',
            ],
            'modal_invalid' => [
                'title'              => 'No Se Pudo Verificar La Dirección',
                'description'        => 'Revise cuidadosamente su dirección. Seleccione EDITAR para realizar cambios o seleccione GUARDAR si la dirección es correcta.',
                'button-save'        => 'Guardar',
                'button-accept'      => 'Editar'
            ],
        ],
    ],

    'admin' => [
        'layouts' => [

        ],

        'system' => [
            'title'                 => 'Título',
            'description'           => 'Descripción',
            'status'                => 'Estado',
            'usps'                  => 'Envío USPS',
            'usps-shipping'         => 'El Servicio Postal de los Estados Unidos (USPS) es la Oficina de Correos, el Servicio Postal de los Estados Unidos o el Servicio Postal. Es una agencia independiente del poder ejecutivo del gobierno federal de los Estados Unidos responsable de proporcionar servicios postales en los EE. UU., sus áreas insulares y sus estados asociados.',
            'gateway-url'           => 'URL del portal',
            'gateway-secure-url'    => 'URL segura del portal',
            'user-id'               => 'ID de usuario',
            'password'              => 'Contraseña',
            'mode'                  => 'Modo',
            'container'             => 'Contenedor',
            'size'                  => 'Tamaño',
            'size-description'      => 'La altura, longitud y anchura funcionarán en el caso de un tamaño GRANDE.',
            'machinable'            => 'Mecanizable',
            'allowed-methods'       => 'Métodos permitidos',
            'allow-seller'          => 'Permitir al vendedor guardar detalles de USPS',
            'length'                => 'Longitud',
            'height'                => 'Altura',
            'width'                 => 'Anchura',
            'grith'                 => 'Circunferencia',
            'allowed-countries'     => 'Países permitidos',
            'usps-error'            => 'No hay método disponible para la ubicación seleccionada. Seleccione otra dirección.',
            'error-message'         => 'Mensaje de error',
            'shipping-not-available'=> 'El envío USPS no está disponible para este producto',
            'business-days'         => 'Días hábiles'
        ],
    ],
];
