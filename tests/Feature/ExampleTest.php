<?php

use App\Http\Controllers\HomeController;
use Astrotomic\Ecologi\Ecologi;
use Illuminate\Support\Facades\Cache;

it('builds the home page data from cached statistics', function (): void {
    Cache::put('ecologi.reporting.trees', 42);

    $view = app(HomeController::class)(app(Ecologi::class));

    expect($view->name())->toBe('pages.home')
        ->and($view->getData()['stats']['trees'])->toBe(42);
});
