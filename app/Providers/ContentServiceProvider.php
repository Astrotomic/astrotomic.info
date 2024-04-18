<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
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
