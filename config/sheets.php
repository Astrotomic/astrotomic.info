<?php

use Spatie\Sheets\ContentParsers\JsonParser;
use Spatie\Sheets\ContentParsers\YamlParser;

return [
    'default_collection' => null,

    'collections' => [
        'static',
        'error',
        'packagist' => [
            'content_parser' => JsonParser::class,
            'extension' => 'json',
        ],
        'github' => [
            'content_parser' => JsonParser::class,
            'extension' => 'json',
        ],
        'contributor' => [
            'content_parser' => JsonParser::class,
            'extension' => 'json',
        ],
        'trust' => [
            'content_parser' => YamlParser::class,
            'extension' => 'yml',
        ],
    ],
];
