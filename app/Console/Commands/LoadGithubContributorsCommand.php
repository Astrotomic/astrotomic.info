<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Contributor;
use App\Models\Package;
use Github\Client as Github;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LoadGithubContributorsCommand extends Command
{
    protected $signature = 'load:github:contributors';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('Load contributors ...');

        $contributors = collect()
            ->concat(Package::all()->pluck('contributor_stats'))
            ->concat(Application::all()->pluck('contributor_stats'))
            ->map(fn (Collection $stats) => $stats->keys())
            ->flatten()
            ->unique()
            ->filter()
            ->values();

        $this->output->progressStart($contributors->count());
        $rows = $contributors->map(function (string $login): ?array {
            $user = app(Github::class)->user()->show($login);

            if ($user['type'] === 'Bot') {
                return null;
            }

            return tap(Arr::only($user, [
                'id',
                'name',
                'login',
                'blog',
                'twitter_username',
                'bio',
                'location',
                'html_url',
                'avatar_url',
            ]), fn () => $this->output->progressAdvance());
        })->filter();
        $this->output->progressFinish();

        Cache::forever(
            key: 'contributors.rows',
            value: $rows->all()
        );

        $this->info('Contributors: '.Contributor::query()->count());

        return self::SUCCESS;
    }
}
