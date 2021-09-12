<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Astrotomic')</title>
    <meta name="description" content="Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP." />

    {!!
        Astrotomic\OpenGraph\OpenGraph::website($__env->yieldContent('title', 'Astrotomic'))
            ->siteName('Astrotomic')
            ->description('Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP.')
            ->url(url()->current())
            ->image(url(mix('images/social.min.jpg')))
            ->locale(str_replace('_', '-', app()->getLocale()))
    !!}

    {!!
        Astrotomic\OpenGraph\Twitter::summaryLargeImage($__env->yieldContent('title', 'Astrotomic'))
            ->site('@astrotomic_oss')
            ->creator('@devgummibeer')
            ->image(url(mix('images/social.min.jpg')))
    !!}

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="sitemap" type="application/xml" href="{{ url('sitemap.xml') }}" title="Sitemap" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ mix('favicon.ico') }}" />
</head>
<body id="body-{{ $slug }}" class="bg-astro-night">

@yield('content')

<script defer src="{{ mix('js/app.js') }}" type="application/javascript"></script>
</body>
</html>
