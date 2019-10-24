<?php

use Spatie\Sheets\ContentParsers\JsonParser;

return [
    'default_collection' => null,

    'collections' => [
        'static',
        'packagist' => [
            'content_parser' => JsonParser::class,
            'extension' => 'json',
        ],
        'github' => [
            'content_parser' => JsonParser::class,
            'extension' => 'json',
        ],
    ],
];
