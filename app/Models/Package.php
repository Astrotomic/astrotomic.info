<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Generator;
use Github\Client as Github;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\Packagist\PackagistClient;
use Sushi\Sushi;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $repository
 * @property string|null $repository_name
 * @property string|null $language
 * @property int|null $github_stars
 * @property int|null $total_downloads
 * @property int|null $dependents
 * @property bool|null $is_abandoned
 * @property string|null $replacement
 * @property string|null $latest_version
 * @property \Illuminate\Support\Collection|null $contributor_stats
 * @property-read string|null $color
 * @property-read string $icon
 * @property-read string|null $image
 * @property-read string $label
 * @property-read string|null $summary
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Package extends Model
{
    use Sushi;

    protected $casts = [
        'github_stars' => 'int',
        'total_downloads' => 'int',
        'dependents' => 'int',
        'contributor_stats' => 'collection',
        'is_abandoned' => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection<array-key, \App\Models\Contributor>
     */
    public function contributors(): EloquentCollection
    {
        return Contributor::query()
            ->whereIn('login', $this->contributor_stats->keys())
            ->get();
    }

    public function getSchema(): array
    {
        return [
            'name' => 'string',
            'description' => 'text',
            'repository' => 'string',
            'language' => 'string',
            'github_stars' => 'unsignedInteger',
            'total_downloads' => 'unsignedInteger',
            'dependents' => 'unsignedInteger',
            'latest_version' => 'string',
            'contributor_stats' => 'json',
            'is_abandoned' => 'boolean',
            'replacement' => 'string',
        ];
    }

    public function getRows(): array
    {
        return Cache::remember("{$this->getTable()}.rows", CarbonInterval::hour(), function (): array {
            $packagist = app(PackagistClient::class);

            return collect($packagist->getPackagesNamesByVendor('astrotomic')['packageNames'])
                ->add('linfo/laravel')
                ->map(fn (string $name): array => $packagist->getPackage($name)['package'])
                //->reject(fn (array $package): bool => $package['abandoned'] ?? false)
                ->values()
                ->map(function (array $package): array {
                    $repoName = trim(parse_url($package['repository'], PHP_URL_PATH), '/');

                    return [
                        'name' => $package['name'],
                        'description' => $package['description'],
                        'repository' => $package['repository'],
                        'repository_name' => $repoName,
                        'language' => $package['language'],
                        'github_stars' => (int) $package['github_stars'],
                        'total_downloads' => (int) $package['downloads']['total'],
                        'dependents' => (int) $package['dependents'],
                        'is_abandoned' => (bool) ($package['abandoned'] ?? false),
                        'replacement' => is_string(data_get($package, 'abandoned')) ? $package['abandoned'] : null,
                        'latest_version' => Arr::first(
                            Semver::rsort(
                                collect($package['versions'])
                                    ->keys()
                                    ->filter(fn (string $version) => VersionParser::parseStability($version) === 'stable' || in_array($version, ['dev-main', 'dev-master']))
                                    ->map(function (string $version): string {
                                        return (string) Str::of((new VersionParser())->normalize($version))
                                            ->when(
                                                fn (Stringable $version): bool => preg_match('#\d+\.\d+\.\d+\.\d+#', $version),
                                                fn (Stringable $version): string => $version->explode('.')->take(3)->implode('.')
                                            );
                                    })
                                    ->all()
                            )
                        ),
                        'contributor_stats' => LazyCollection::make(function () use ($repoName): Generator {
                            do {
                                $contributors = app(Github::class)->repo()->statistics(
                                    ...explode('/', $repoName, 2)
                                );

                                if (empty($contributors)) {
                                    usleep(5 * 1000);
                                }
                            } while (empty($contributors));

                            yield from $contributors;
                        })->collect()->mapWithKeys(fn (array $stats) => [
                            $stats['author']['login'] => $stats['total'],
                        ]),
                    ];
                })
                ->all();
        });
    }

    public function getLabelAttribute(): string
    {
        return match ($this->name) {
            'linfo/laravel' => 'Laravel Linfo',
            'astrotomic/iso639' => 'ISO 639',
            'astrotomic/psr-8' => 'PSR-8',
            default => Str::of($this->name)
                ->after('/')
                ->slug(' ')
                ->headline()
                ->replace('Tmdb', 'TMDB')
                ->replace('Php', 'PHP')
                ->replace('Sdk', 'SDK'),
        };
    }

    public function getSummaryAttribute(): ?string
    {
        return match ($this->name) {
            'astrotomic/laravel-translatable' => 'This is a Laravel package for translatable models. Its goal is to remove the complexity in retrieving and storing multilingual model instances. With this package you write less code, as the translations are being fetched/saved when you fetch/save your instance.',
            'astrotomic/tmdb-sdk' => '',
            default => null,
        };
    }

    public function getImageAttribute(): ?string
    {
        return match ($this->name) {
            'astrotomic/laravel-translatable' => 'resources/img/translatable.min.jpg',
            'astrotomic/tmdb-sdk' => 'resources/img/tmdb-sdk.png',
            default => null,
        };
    }

    public function getColorAttribute(): ?string
    {
        return match ($this->name) {
            'astrotomic/laravel-translatable' => '#dd3224',
            'astrotomic/tmdb-sdk' => '#97cc9f',
            default => null,
        };
    }

    public function getIconAttribute(): string
    {
        if (str_starts_with($this->name, 'astrotomic/laravel-dashboard-')) {
            return 'fas-gauge';
        }

        return match ($this->name) {
            'astrotomic/countdown-gif' => 'fas-stopwatch',
            'astrotomic/ignition-stackoverflow' => 'fab-stack-overflow',
            'astrotomic/laravel-cachable-attributes' => 'fas-cabinet-filing',
            'astrotomic/laravel-translatable', 'astrotomic/iso639', 'astrotomic/laravel-translation' => 'fas-language',
            'astrotomic/stancy' => 'fas-rocket',
            'astrotomic/laravel-mime' => 'fas-file-magnifying-glass',
            'astrotomic/laravel-guzzle' => 'fas-wifi',
            'astrotomic/laravel-eloquent-uuid' => 'fas-fingerprint',
            'astrotomic/laravel-unavatar', 'astrotomic/php-unavatar' => 'fas-circle-user',
            'astrotomic/laravel-weserv-images', 'astrotomic/php-weserv-images' => 'fas-book-sparkles',
            'astrotomic/php-open-graph' => 'fas-share-nodes',
            'astrotomic/php-conditional-proxy' => 'fas-brackets-curly',
            'astrotomic/pest-plugin-laravel-snapshots' => 'fas-equals',
            'astrotomic/laravel-auth-recovery-codes' => 'fas-key',
            'astrotomic/laravel-transaction-proxy' => 'fas-rotate-left',
            'astrotomic/php-twemoji' => 'fas-face-grin-stars',
            'astrotomic/laravel-fileable' => 'fas-file-plus',
            'astrotomic/phpunit-assertions' => 'fas-vial',
            'astrotomic/psr-8' => 'fas-heart',
            'astrotomic/laravel-vcard' => 'fas-address-card',
            'astrotomic/laravel-webmentions' => 'fas-blog',
            'astrotomic/laravel-imgix' => 'fas-image',
            'linfo/laravel' => 'fas-monitor-waveform',
            'astrotomic/tmdb-sdk', 'astrotomic/laravel-tmdb' => 'fas-film',
            'astrotomic/steam-sdk' => 'fab-steam',
            'astrotomic/ecologi-sdk', 'astrotomic/laravel-ecologi' => 'fas-tree-deciduous',
            'astrotomic/laravel-github-sponsors' => 'fas-circle-dollar-to-slot',
            'astrotomic/laravel-dns' => 'fas-router',
            'astrotomic/instagram-parser' => 'fab-instagram',
            'astrotomic/laravel-medialibrary-hls' => 'fas-video',
            'astrotomic/graphql-query-builder' => 'fas-filter',
            default => match ($this->is_abandoned) {
                true => 'fas-box',
                false => 'fas-box-check',
            },
        };
    }
}
