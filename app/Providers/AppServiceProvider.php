<?php

namespace App\Providers;

use Astrotomic\Stancy\Contracts\ExportFactory as ExportFactoryContract;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(ExportFactoryContract $exportFactory)
    {
        $this->app->booted(function () use ($exportFactory): void {
            $exportFactory
                ->addSheetCollectionName('static')
                ->addSheetCollectionName('contributor');
        });

        BladeX::components('components.**.*');

        View::share('links', [
            [
                'icon' => 'fa-donate',
                'style' => 'fas',
                'href' => 'https://opencollective.com/astrotomic',
                'label' => 'Open Collective',
            ], [
                'icon' => 'fa-slack',
                'style' => 'fab',
                'href' => 'https://join.slack.com/t/astrotomic/shared_invite/enQtNzk2MTgzNDgwODUwLWI4YTJjYTNjNTE1Y2EzNjEwYzEzNTM1MTRjZTFiZWVjM2U4YWY3MjczYzdmYjE2ZmU1ZmMzNGY1NWM1MTM1YTI',
                'label' => 'Slack',
            ], [
                'icon' => 'fa-github',
                'style' => 'fab',
                'href' => 'https://github.com/Astrotomic',
                'label' => 'GitHub',
            ],
        ]);
    }
}
