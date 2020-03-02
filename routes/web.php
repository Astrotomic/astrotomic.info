<?php

use Astrotomic\Stancy\Facades\PageFactory;
use Astrotomic\Stancy\Facades\SitemapFactory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return PageFactory::makeFromSheetName('static', 'home');
});

Route::get('/contributor/{name}', function (string $name) {
    return PageFactory::makeFromSheetName('contributor', strtolower($name));
})->name('contributor');

Route::get('/sitemap.xml', function () {
    return SitemapFactory::makeFromSheetList(['static', 'contributor']);
});

Route::get('/404.html', function () {
    return PageFactory::makeFromSheetName('error', '404');
});

Route::get('/robots.txt', function () {
    return implode(PHP_EOL, [
        'User-Agent: *',
        'Allow: /',
        '',
        'Sitemap: '.url('sitemap.xml'),
    ]);
});
