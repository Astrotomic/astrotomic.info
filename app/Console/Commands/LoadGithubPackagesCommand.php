<?php

namespace App\Console\Commands;

use App\Models\Package;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Github\Client as Github;
use Github\ResultPager;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\Packagist\PackagistClient;

class LoadGithubPackagesCommand extends Command
{
    protected $signature = 'load:github:packages';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('Load packages ...');

        $packagist = app(PackagistClient::class);

        $packages = collect($packagist->getPackagesNamesByVendor('astrotomic')['packageNames'])
            ->add('linfo/laravel')
            ->map(fn (string $name): array => $packagist->getPackage($name)['package'])
            //->reject(fn (array $package): bool => $package['abandoned'] ?? false)
            ->values();

        $this->output->progressStart($packages->count());
        $rows = $packages->map(function (array $package): array {
            $name = trim(parse_url($package['repository'], PHP_URL_PATH), '/');

            $pager = new ResultPager(
                client: app(Github::class),
            );

            $contributors = LazyCollection::make(fn () => $pager->fetchAllLazy(
                api: app(Github::class)->repo()->commits(),
                method: 'all',
                parameters: [
                    'username' => explode('/', $name, 2)[0],
                    'repository' => explode('/', $name, 2)[1],
                    'params' => [],
                ],
            ))
                ->countBy('author.login')
                ->collect();

            $latestVersion = Arr::first(
                Semver::rsort(
                    collect($package['versions'])
                        ->keys()
                        ->filter(fn (string $version) => VersionParser::parseStability($version) === 'stable' || in_array($version, ['dev-main', 'dev-master']))
                        ->map(function (string $version): string {
                            return (string) Str::of((new VersionParser)->normalize($version))
                                ->when(
                                    fn (Stringable $version): bool => preg_match('#\d+\.\d+\.\d+\.\d+#', $version),
                                    fn (Stringable $version): string => $version->explode('.')->take(3)->implode('.')
                                );
                        })
                        ->all()
                )
            );

            return tap([
                'name' => $package['name'],
                'description' => $package['description'],
                'repository' => $package['repository'],
                'repository_name' => $name,
                'language' => $package['language'],
                'github_stars' => (int) $package['github_stars'],
                'total_downloads' => (int) $package['downloads']['total'],
                'dependents' => (int) $package['dependents'],
                'is_abandoned' => (bool) ($package['abandoned'] ?? false),
                'replacement' => is_string(data_get($package, 'abandoned')) ? $package['abandoned'] : null,
                'latest_version' => $latestVersion,
                'contributor_stats' => $contributors->toJson(),
            ], fn () => $this->output->progressAdvance());
        });
        $this->output->progressFinish();

        Cache::forever(
            key: 'packages.rows',
            value: $rows->all()
        );

        $this->info('Packages: '.Package::query()->count());

        return self::SUCCESS;
    }
}
