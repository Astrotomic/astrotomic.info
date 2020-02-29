<?php

use Astrotomic\Weserv\Images\Laravel\Url;
use Illuminate\Support\HtmlString;

if (! function_exists('image')) {
    function image(string $path, string $format = 'jpg', ?int $width = null): string
    {
        $url = mix($path);

        if (! app()->environment('prod')) {
            return $url;
        }

        return 'https://images.weserv.nl?il&we&dpr=2&output='.$format.($width ? '&w='.$width : null).'&url='.urlencode(url($url));
    }
}

if (! function_exists('picture')) {
    function picture(
        Url $url,
        string $class = '',
        string $alt = ''
    ): HtmlString {
        $imgSrcSet = implode(', ', array_map(
            fn(int $density) => (clone $url)->dpr($density).' '.$density.'x',
            [1, 2]
        ));

        $webpSrcSet = implode(', ', array_map(
            fn(int $density) => (clone $url)->dpr($density)->output('webp').' '.$density.'x',
            [1, 2]
        ));

        return new HtmlString(
            <<<HTML
            <picture>
                <source srcset="{$webpSrcSet}" type="image/webp" />
                <img src="{$url}" srcset="{$imgSrcSet}" alt="{$alt}" class="{$class}" />
            </picture>
            HTML
        );
    }
}
