<?php

namespace App\Console\Commands;

use Github\Client as Github;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\Sheets\Facades\Sheets;
use Spatie\Sheets\Sheet;

class LoadGithub extends Command
{
    protected $name = 'load:github';
    protected $description = 'Command description';

    /** @var Github */
    protected $github;

    public function __construct(Github $github)
    {
        parent::__construct();

        $this->github = $github;
    }

    public function handle()
    {
        $packages = Sheets::collection('packagist')->all();

        $packages->each(function(Sheet $package) {
            $stats['name'] = $package['name'];
            $stats['contributors'] = $this->github->repo()->statistics(...explode('/', $package['name']));
            Storage::disk('github')->put($package['name'] . '.json', json_encode($stats));
        });

        $this->info(sprintf('loaded github data for %d packages:', $packages->count()));
        $packages->pluck('name')->each(function (string $name): void {
            $this->line('* ' . $name);
        });
    }
}
