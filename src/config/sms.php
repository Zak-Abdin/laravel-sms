<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The default SMS Driver
    |--------------------------------------------------------------------------
    |
    | The default sms driver to use as a fallback when no driver is specified
    | while using the SMS component.
    |
    */
    'default' => env('SMS_DRIVER', 'null'),
    /*
    |--------------------------------------------------------------------------
    | Enable SMS logs
    |--------------------------------------------------------------------------
    |
    | The SMS logs will be added to log based on driver
    |
    */
    'enable_log' => env('SMS_LOG_DRIVER', 'file'),
    /*
    |--------------------------------------------------------------------------
    | The log file name
    |--------------------------------------------------------------------------
    |
    | The SMS logs will be added to log based on driver
    |
    */
    'log_file_name' => 'laravel-sms.log',
    /*
    |--------------------------------------------------------------------------
    | Poct Goyarchini Driver Configuration
    |--------------------------------------------------------------------------
    |
    */
    'queue_name' => 'default',
    /*
    |--------------------------------------------------------------------------
    | Poct Goyarchini Driver Configuration
    |--------------------------------------------------------------------------
    |
    */

    'poct_goyarchini' => [
        'user' => env('POCTGOYARCINI_USER', null),
        'password' => env('POCTGOYARCINI_PASSWORD', null),
        'url' => [
            '994' => env('POCT_GOYARCHINI_URL_COUNTRY_994', 'http://www.poctgoyercini.com/api_http/sendsms.asp'),
            'others' => env('POCT_GOYARCHINI_URL_OTHER_COUNTRIES', 'http://www.poctgoyercini.com/api_http/sendsms.asp')
        ]
    ]

];
