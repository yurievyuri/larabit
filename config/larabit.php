<?php

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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

    'http' => [
        'code' => [
            'ok' => ResponseAlias::HTTP_OK,
            'created' => ResponseAlias::HTTP_CREATED,
            'error' => ResponseAlias::HTTP_BAD_REQUEST
        ]
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
            'unregister' => '/auth/unregister',
            'login' => '/auth/login',
        ],
        'controller' => [
            'connection' => '/controller/connection',
            'handler' => '/controller/handler'
        ]
    ]
];
