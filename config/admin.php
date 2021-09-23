<?php

return [
    'modules' => [

        // module example
        [
            'name' => 'Dashboard',
            'icon' => 'bx-car',
            'path' => 'dashboard',
            'permission' => 'view_dashboard'
        ]
    ],

    'audit' => [
        'types' => [

        ],
        'actions' => [
            'created'       => 'Criação',
            'updated'       => 'Alteração',
            'deleted'       => 'Exclusão',
            'restored'      => 'Reativação'
        ]
    ],

    'user' => [
        'password' => '@admin8Laravel'
    ]
];
