<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Astrotomic')</title>
    <meta name="description" content="Astrotomic is an open source developer collective and wants to provide helpful, solid and easy to use open source packages.
Most of them will be for Laravel - but sometimes also plain PHP." />

    <link rel="shortcut icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/img/favicon.ico') }}" />

    <script
        async
        defer
        data-website-id="1ec02b85-c6bf-4918-bd08-534d78da68da"
        data-domains="astrotomic.info"
        src="https://u.gummibeer.dev/umami.js"
    ></script>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-astro-night">

{{ $slot }}
</body>
</html>
