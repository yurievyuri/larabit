<?php

return [

    /*
    |--------------------------------------------------------------------------
    | BASIC SETTINGS
    |--------------------------------------------------------------------------
    |
    */

    'registration_token' => env('LARABIT_REGISTRATION_TOKEN'),
    'token_key' => 'API_AUTH_TOKEN',
    'api_prefix' => env('LARABIT_API_PREFIX', 'larabit'),
    'api' => [
        'prefix' => env('LARABIT_API_PREFIX', 'larabit')
    ],

    /*
    |--------------------------------------------------------------------------
    | ROUTES
    |--------------------------------------------------------------------------
    |
    */

    'routes' => [
        'auth' => [
            'register' => '/auth/register',
            'unregister' => '/auth/unregister'
        ],
        'controller' => [
            'connection' => '/controller/connection',
            'handler' => '/controller/handler'
        ]
    ]
];
