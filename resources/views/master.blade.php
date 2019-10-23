<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Astrotomic</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="sitemap" type="application/xml" href="{{ url('sitemap.xml') }}" title="Sitemap" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ mix('favicon.ico') }}" />
</head>
<body id="body-{{ $slug }}">

@yield('content')

</body>
</html>
