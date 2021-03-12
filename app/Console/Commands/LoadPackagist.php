<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Packagist\Packagist;

class LoadPackagist extends Command
{
    protected $name = 'load:packagist';
    protected $description = 'Command description';

    /** @var Packagist */
    protected $packagist;

    public function __construct(Packagist $github)
    {
        parent::__construct();

        $this->packagist = $github;
    }

    public function handle()
    {
        $packages = collect($this->packagist->getPackagesByVendor('astrotomic')['packageNames'])
            ->add('linfo/laravel')
            ->keyBy(null)
            ->map(function (string $name): array {
                return $this->packagist->findPackageByName($name)['package'];
            })
            ->reject(function (array $package): bool {
                return $package['abandoned'] ?? false;
            })
            ->map(function (array $package): array {
                $package['github_name'] =  Str::lower(Str::after($package['repository'], 'https://github.com/'));
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
