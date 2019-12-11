<?php

return [

    'defaults' => [
        'driver' => env('TRANSLATOR_DRIVER', 'google'),
    ],

    'drivers' => [
        'google' => [
            'api_url' => 'https://google-translate-proxy.herokuapp.com/api/translate',
        ],
        
    ],
];
