<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'url'        => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        // Disco personalizado para tus archivos en 'storage/app/private/public'
        'private_public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/private/public'),
            'url'        => env('APP_URL') . '/private',
            'visibility' => 'public',
        ],

        's3' => [
            'driver'  => 's3',
            'key'     => env('AWS_ACCESS_KEY_ID'),
            'secret'  => env('AWS_SECRET_ACCESS_KEY'),
            'region'  => env('AWS_DEFAULT_REGION'),
            'bucket'  => env('AWS_BUCKET'),
            'url'     => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw'   => false,
            'report'  => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    */
    'links' => [
        public_path('storage') => storage_path('app/public'),
        // Enlace simbólico para el disco "private_public"
        public_path('private') => storage_path('app/private/public'),
    ],

];
