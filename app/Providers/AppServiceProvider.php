<?php

namespace App\Providers;

use Astrotomic\Stancy\Contracts\ExportFactory as ExportFactoryContract;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
            $this->booted($exportFactory);
        });

        BladeX::components('components.**.*');

        View::share('links', [
            [
                'icon' => 'fa-trees',
                'style' => 'fas',
                'href' => 'https://offset.earth/treeware',
                'label' => 'Treeware',
            ], [
                'icon' => 'fa-github',
                'style' => 'fab',
                'href' => 'https://github.com/Astrotomic',
                'label' => 'GitHub',
            ],
        ]);

        View::share('packagist', Sheets::collection('packagist')->all()->keyBy('name'));
        View::share('github', Sheets::collection('github')->all()->keyBy('name'));
    }

    protected function booted(ExportFactoryContract $exportFactory)
    {
        $exportFactory
            ->addSheetCollectionName('static')
            ->addSheetCollectionName('contributor');

        $this->bootSchemaHome();
    }

    protected function bootSchemaHome(): void
    {
        if (Sheets::collection('packagist')->all()->isEmpty()) {
            return;
        }

        if (Sheets::collection('github')->all()->isEmpty()) {
            return;
        }

        if (Sheets::collection('contributor')->all()->isEmpty()) {
            return;
        }

        View::share(
            'schemaHome',
            Schema::organization()
                ->identifier(url('/'))
                ->name('Astrotomic')
                ->url(url('/'))
                ->logo(url(mix('images/logo.min.jpg')))
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
                    Sheets::collection('packagist')->all()->map(function (Sheet $sheet): OwnershipInfo {
                        $version = array_reduce(array_keys($sheet['versions']), function ($highest, $current) {
                            if (Str::startsWith($current, 'dev-')) {
                                return $highest;
                            }

                            return version_compare(
                                    Str::replaceFirst('v', '', $highest),
                                    Str::replaceFirst('v', '', $current),
                                    '>'
                                ) ? $highest : $current;
                        }) ?? 'dev-master';

                        return Schema::ownershipInfo()
                            ->identifier($sheet['repository'])
                            ->name($sheet['name'])
                            ->description($sheet['description'])
                            ->ownedFrom(Carbon::parse($sheet['time']))
                            ->url($sheet['repository'])
                            ->sameAs([
                                'https://packagist.org/packages/'.$sheet['name'],
                            ])
                            ->mainEntityOfPage(
                                Schema::softwareSourceCode()
                                    ->name($sheet['name'])
                                    ->codeRepository($sheet['repository'])
                                    ->url($sheet['repository'])
                                    ->dateCreated(Carbon::parse($sheet['versions'][$version]['time']))
                                    ->version($version)
                                    ->author(
                                        collect($sheet['versions'][$version]['authors'])->map(function (array $author): Person {
                                            return Schema::person()
                                                ->if(! empty($author['name']), function (Person $person) use ($author) {
                                                    $person->name($author['name']);
                                                })
                                                ->if(! empty($author['email']), function (Person $person) use ($author) {
                                                    $person->email($author['email']);
                                                })
                                                ->if(! empty($author['homepage']), function (Person $person) use ($author) {
                                                    $person
                                                        ->identifier($author['homepage'])
                                                        ->url($author['homepage']);
                                                });
                                        })->push(Schema::organization()->identifier(url('/')))->values()->all()
                                    )
                                    ->copyrightHolder(Schema::organization()->identifier(url('/')))
                                    ->publisher(Schema::organization()->identifier(url('/')))
                                    ->contributor(
                                        collect(Arr::get(Sheets::collection('github')->get($sheet['name']), 'contributors', []))->pluck('author')->map(function (array $contributor): Person {
                                            return Schema::person()
                                                ->identifier($contributor['html_url'])
                                                ->alternateName($contributor['login'])
                                                ->image($contributor['avatar_url'])
                                                ->url(route('contributor', ['name' => $contributor['login']]))
                                                ->sameAs($contributor['html_url']);
                                        })->values()->all()
                                    )
                                    ->programmingLanguage(
                                        Schema::computerLanguage()
                                            ->identifier('https://www.php.net')
                                            ->name($sheet['language'])
                                            ->url('https://www.php.net')
                                    )
                                    ->runtimePlatform($sheet['language'].' '.$sheet['versions'][$version]['require']['php'])
                                    ->offers(
                                        Schema::offer()
                                            ->description('Free')
                                            ->price(0)
                                            ->priceCurrency('USD')
                                    )
                            );
                    })->values()->all()
                )
                ->members(
                    Sheets::collection('contributor')->all()->map(function (Sheet $sheet): Person {
                        return Schema::person()
                            ->identifier($sheet['html_url'])
                            ->alternateName($sheet['login'])
                            ->image($sheet['avatar_url'])
                            ->url(route('contributor', ['name' => $sheet['login']]))
                            ->sameAs($sheet['html_url']);
                    })->values()->all()
                )
        );
    }
}
