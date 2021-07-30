<?php

use Astrotomic\Stancy\Facades\SitemapFactory;
use Illuminate\Support\Facades\Route;
use Spatie\Sheets\Facades\Sheets;

Route::get('/', function () {
    return view('content.home', [
        'slug' => 'home',
        'contributors' => Sheets::collection('contributor')->all(),
        'trusts' => Sheets::collection('trust')->all(),
        'sponsors' => Sheets::collection('sponsor')->all(),
    ]);
});

Route::get('/contributor/{name}', function (string $name) {
    return view('content.contributor', array_merge(
        ['slug' => 'contributor'],
        Sheets::collection('contributor')->get(strtolower($name) . '.json')->toArray()
    ));
})->name('contributor');

Route::get('/sitemap.xml', function () {
    return SitemapFactory::makeFromSheetList(['static', 'contributor']);
});

Route::get('/robots.txt', function () {
    return implode(PHP_EOL, [
        'User-Agent: *',
        'Allow: /',
        '',
        'Sitemap: '.url('sitemap.xml'),
    ]);
});
