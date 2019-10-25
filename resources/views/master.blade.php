<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Astrotomic</title>
    <meta name="description" content="Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP." />

    <meta name="og:title" content="Astrotomic - Open Source / PHP / Laravel" />
    <meta name="og:description" content="Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP." />
    <meta name="og:type" content="website" />
    <meta name="og:image" content="{{ url(mix('images/social.min.jpg')) }}" />
    <meta name="og:url" content="{{ url()->current() }}" />
    <meta name="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@devgummibeer" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="sitemap" type="application/xml" href="{{ url('sitemap.xml') }}" title="Sitemap" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ mix('favicon.ico') }}" />
</head>
<body id="body-{{ $slug }}">

@yield('content')

<script async defer src="{{ mix('js/app.js') }}" type="application/javascript"></script>
</body>
</html>
