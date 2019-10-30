<?php

namespace App\Console\Commands;

use App\Pages\Contributor;
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

        $this->output->progressStart($packages->count());
        $packages->each(function (Sheet $package): void {
            do {
                $stats['name'] = $package['name'];
                $stats['contributors'] = $this->github->repo()->statistics(...explode('/', $package['name']));
                if (empty($stats['contributors'])) {
                    usleep(5 * 1000);
                }
            } while(empty($stats['contributors']));

            Storage::disk('github')->put($package['name'].'.json', json_encode($stats));
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();

        $this->info(sprintf('loaded github data for %d packages:', $packages->count()));
        $packages->pluck('name')->each(function (string $name): void {
            $this->line('* '.$name);
        });

        $repos = Sheets::collection('github')->all();
        $contributors = $repos->pluck('contributors')->collapse();
        $contributors
            ->pluck('author.login')
            ->unique()
            ->each(function (string $name) use ($contributors, $repos): void {
                $data = $contributors->where('author.login', $name)->pluck('author')->first();
                $data['commits'] = $contributors->where('author.login', $name)->sum('total');
                $data['packages'] = $repos->filter(function (Sheet $repo) use ($name): bool {
                    return collect($repo['contributors'])->pluck('author.login')->contains($name);
                })->pluck('name');

                $data['_pageData'] = '\\'.Contributor::class;
                $data['_view'] = 'content.contributor';
                $data['_sheets'] = [
                    'packagist' => 'packagist:*',
                ];

                Storage::disk('contributor')->put(strtolower($name).'.json', json_encode($data));
            });
    }
}
