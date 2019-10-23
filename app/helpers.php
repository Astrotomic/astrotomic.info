<?php

if( !function_exists('image')) {
    function image(string $path, string $format = 'jpg', ?int $width = null): string
    {
        $url = mix($path);

        if (!app()->environment('prod')) {
            return $url;
        }

        return 'https://images.weserv.nl?il&output='.$format.($width ? '&w='.$width : null).'&url='.url($url);
    }
}
