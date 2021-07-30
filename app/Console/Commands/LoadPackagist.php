<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Packagist\PackagistClient;

class LoadPackagist extends Command
{
    protected $name = 'load:packagist';
    protected $description = 'Command description';

    /** @var PackagistClient */
    protected $packagist;

    public function __construct(PackagistClient $github)
    {
        parent::__construct();

        $this->packagist = $github;
    }

    public function handle()
    {
        $packages = collect($this->packagist->getPackagesNamesByVendor('astrotomic')['packageNames'])
            ->add('linfo/laravel')
            ->reject(fn ($package) => $package == 'astrotomic/laravel-medialibrary-hls') // TODO: https://blog.packagist.com/deprecating-composer-1-support
            ->keyBy(null)
            ->map(function (string $name): array {
                return current($this->packagist->searchPackagesByName($name)['results']);
            })
            ->reject(function (array $package): bool {
                return $package['abandoned'] ?? false;
            })
            ->map(function (array $package): array {
                return array_merge($package, $this->packagist->getPackage($package['name'])['package']);
            })
            ->map(function (array $package): array {
                $package['github_name'] = Str::lower(Str::after($package['repository'], 'https://github.com/'));

                return $package;
            })
            ->each(function (array $package, string $name): void {
                Storage::disk('packagist')->put($name.'.json', json_encode($package));
            });

        $this->info(sprintf('loaded %d packages:', $packages->count()));
        $packages->keys()->each(function (string $name): void {
            $this->line('* '.$name);
        });
    }
}
