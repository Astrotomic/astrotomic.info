<?php

use Astrotomic\Weserv\Images\Laravel\Url;
use Illuminate\Support\HtmlString;

if (! function_exists('picture')) {
    function picture(
        Url $url,
        string $alt = '',
        string $class = ''
    ): HtmlString {
        return $url->toPicture([
            'alt' => $alt,
            'class' => $class,
            'loading' => 'lazy',
        ], [
            '1x' => fn (Url $url) => $url->dpr(1),
            '2x' => fn (Url $url) => $url->dpr(2),
        ]);
    }
}
