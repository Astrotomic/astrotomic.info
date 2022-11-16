<?php

namespace App\Providers;

use App\Models\Contributor;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Export\Exporter;

class ContentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->booted(function (): void {
            $this->app->booted(function (Application $application): void {
                if ($application->environment('prod', 'production')) {
                    $application->make(Exporter::class)->urls(
                        Contributor::all()->map(fn (Contributor $contributor) => route('contributor', $contributor))->all()
                    );
                }
            });
        });
    }

    public function boot(): void
    {
        View::share('links', [
            [
                'icon' => 'fas-door-open',
                'href' => 'https://opendor.me/@Astrotomic',
                'label' => 'opendor.me',
            ], [
                'icon' => 'fas-trees',
                'href' => 'https://forest.astrotomic.info',
                'label' => 'Treeware',
            ], [
                'icon' => 'fab-github',
                'href' => 'https://github.com/Astrotomic',
                'label' => 'GitHub',
            ],
        ]);
    }
}
