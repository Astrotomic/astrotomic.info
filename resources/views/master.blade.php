<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Astrotomic</title>
    <meta name="description" content="Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP." />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="sitemap" type="application/xml" href="{{ url('sitemap.xml') }}" title="Sitemap" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ mix('favicon.ico') }}" />
</head>
<body id="body-{{ $slug }}">

@yield('content')

</body>
</html>
