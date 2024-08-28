<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Contributor;
use App\Models\Package;
use App\Models\Sponsor;
use Astrotomic\GithubSponsors\Facades\GithubSponsors;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Generator;
use Github\Client as Github;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\Packagist\PackagistClient;

class LoadGithubCommand extends Command
{
    protected $signature = 'load:github';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('Load sponsors ...');
        Cache::forever(
            key: (new Sponsor())->getTable().'.rows',
            value: $this->sponsors()->all()
        );

        $this->info('Load applications ...');
        Cache::forever(
            key: (new Application())->getTable().'.rows',
            value: $this->applications()->all()
        );

        $this->info('Load packages ...');
        Cache::forever(
            key: (new Package())->getTable().'.rows',
            value: $this->packages()->all()
        );

        $this->info('Load contributors ...');
        Cache::forever(
            key: (new Contributor())->getTable().'.rows',
            value: $this->contributors()->all()
        );

        return self::SUCCESS;
    }

    private function applications(): Collection
    {
        return collect([
            'Astrotomic/git-author',
            'Astrotomic/dnd-converter',
        ])
            ->map(fn (string $name): array => app(Github::class)->repo()->show(
                ...explode('/', $name, 2)
            ))
            ->values()
            ->map(function (array $repo): array {
                return [
                    'name' => $repo['full_name'],
                    'description' => $repo['description'],
                    'repository' => $repo['html_url'],
                    'homepage' => $repo['homepage'],
                    'language' => $repo['language'],
                    'github_stars' => (int) $repo['stargazers_count'],
                    'contributor_stats' => LazyCollection::make(function () use ($repo): Generator {
                        do {
                            $contributors = app(Github::class)->repo()->statistics(
                                ...explode('/', $repo['full_name'], 2)
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
            });
    }

    private function packages(): Collection
    {
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
            });
    }

    private function contributors(): Collection
    {
        return collect()
            ->merge(Package::all()->pluck('contributor_stats'))
            ->merge(Application::all()->pluck('contributor_stats'))
            ->map(fn (Collection $stats) => $stats->keys())
            ->flatten()
            ->unique()
            ->map(fn (string $login) => app(Github::class)->user()->show($login))
            ->reject(fn (array $user) => $user['type'] === 'Bot')
            ->map(fn (array $user) => Arr::only($user, [
                'id',
                'name',
                'login',
                'blog',
                'twitter_username',
                'bio',
                'location',
                'html_url',
                'avatar_url',
            ]));
    }

    private function sponsors(): Collection
    {
        return GithubSponsors::viewer()
            ->sponsors(fields: ['login', 'avatarUrl', 'location', 'name'])
            ->map(fn (array $user) => [
                'login' => $user['login'],
                'name' => $user['name'],
                'location' => $user['location'],
                'avatar_url' => $user['avatarUrl'],
            ])
            ->collect();
    }
}
