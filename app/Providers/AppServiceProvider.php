<?php

namespace App\Providers;

use Astrotomic\Stancy\Contracts\ExportFactory as ExportFactoryContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(ExportFactoryContract $exportFactory)
    {
        $this->app->booted(function () use ($exportFactory) {
            $exportFactory
                ->addSheetCollectionName('static')
            ;
        });
    }
}
