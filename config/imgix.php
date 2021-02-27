<?php

return [
    'default' => 'astrotomic',

    'sources' => [
        'astrotomic' => [
            'domain' => env('IMGIX_DOMAIN', 'astrotomic.imgix.local'),
            'useHttps' => true,
            'signKey' => env('IMGIX_SIGN_KEY'),
            'includeLibraryParam' => false,
        ],
    ],
];
