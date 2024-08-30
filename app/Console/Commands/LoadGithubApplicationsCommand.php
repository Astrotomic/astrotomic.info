<?php

namespace App\Console\Commands;

use App\Models\Application;
use Github\Client as Github;
use Github\ResultPager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;

class LoadGithubApplicationsCommand extends Command
{
    protected $signature = 'load:github:applications';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('Load applications ...');

        $repos = collect([
            'Astrotomic/astrotomic.info',
            'Astrotomic/git-author',
            'Astrotomic/dnd-converter',
        ]);

        $this->output->progressStart($repos->count());
        $rows = $repos->map(function (string $name): array {
            $repo = app(Github::class)->repo()->show(
                ...explode('/', $name, 2)
            );

            $pager = new ResultPager(
                client: app(Github::class),
            );

            $contributors = LazyCollection::make(fn () => $pager->fetchAllLazy(
                api: app(Github::class)->repo()->commits(),
                method: 'all',
                parameters: [
                    'username' => explode('/', $repo['full_name'], 2)[0],
                    'repository' => explode('/', $repo['full_name'], 2)[1],
                    'params' => [],
                ],
            ))
                ->countBy('author.login')
                ->collect();

            return tap([
                'name' => $repo['full_name'],
                'description' => $repo['description'],
                'repository' => $repo['html_url'],
                'homepage' => $repo['homepage'],
                'language' => $repo['language'],
                'github_stars' => (int) $repo['stargazers_count'],
                'contributor_stats' => $contributors->toJson(),
            ], fn () => $this->output->progressAdvance());
        });
        $this->output->progressFinish();

        Cache::forever(
            key: 'applications.rows',
            value: $rows->all()
        );

        $this->info('Applications: '.Application::query()->count());

        return self::SUCCESS;
    }
}
