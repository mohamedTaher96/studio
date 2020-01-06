<?php

return [
    'api_key' => env('wg_2f3f9974745043c1c737557af8ae33ff2'),
    'original_language' => config('app.locale', 'ar'),
    'destination_languages' => [
        'en'
    ],
    'exclude_blocks' => [],
    'exclude_urls' => [],
    'prefix_path' => '',
    'cache' => false,

    'laravel' => [
        'controller_namespace' => 'App\Http\Controllers',
        'routes_web' => 'routes/web.php'
    ]
];
