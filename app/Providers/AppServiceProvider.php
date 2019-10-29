<?php

namespace App\Providers;

use Astrotomic\Stancy\Contracts\ExportFactory as ExportFactoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;
use Spatie\SchemaOrg\GenderType;
use Spatie\SchemaOrg\OwnershipInfo;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Schema;
use Spatie\Sheets\Facades\Sheets;
use Spatie\Sheets\Sheet;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(ExportFactoryContract $exportFactory)
    {
        $this->app->booted(function () use ($exportFactory): void {
            self::booted($exportFactory);
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

    protected function booted(ExportFactoryContract $exportFactory)
    {
        $exportFactory
            ->addSheetCollectionName('static')
            ->addSheetCollectionName('contributor');

        View::share(
            'schemaHome',
            Schema::organization()
                ->identifier(url('/'))
                ->name('Astrotomic')
                ->url(url('/'))
                ->founder(
                    Schema::person()
                        ->identifier('https://gummibeer.de')
                        ->name('Tom Witkowski')
                        ->givenName('Tom')
                        ->familyName('Witkowski')
                        ->gender(GenderType::Male)
                        ->alternateName('Gummibeer')
                        ->birthDate(Carbon::create(1993, 1, 25, 0, 0, 0, '+01:00'))
                        ->url('https://gummibeer.de')
                        ->email('dev@gummibeer.de')
                        ->telephone('+491621525105')
                        ->sameAs('https://github.com/Gummibeer')
                )
                ->sameAs([
                    'https://github.com/Astrotomic',
                    'https://opencollective.com/astrotomic',
                ])
                ->owns(
                    Sheets::collection('packagist')->all()->map(function(Sheet $sheet): OwnershipInfo {
                        return Schema::ownershipInfo()
                            ->identifier($sheet['repository'])
                            ->name($sheet['name'])
                            ->description($sheet['description'])
                            ->ownedFrom(Carbon::parse($sheet['time']))
                            ->url($sheet['repository'])
                            ->sameAs([
                                'https://packagist.org/packages/'.$sheet['name'],
                            ])
                            ;
                    })->values()->all()
                )
                ->members(
                    Sheets::collection('contributor')->all()->map(function(Sheet $sheet): Person {
                        return Schema::person()
                            ->identifier($sheet['html_url'])
                            ->alternateName($sheet['login'])
                            ->image($sheet['avatar_url'])
                            ->url(route('contributor', ['name' => $sheet['login']]))
                            ->sameAs($sheet['html_url'])
                            ;
                    })->values()->all()
                )
        );
    }
}
