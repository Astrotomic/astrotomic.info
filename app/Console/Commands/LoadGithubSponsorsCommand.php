<?php

namespace App\Console\Commands;

use App\Models\Sponsor;
use Astrotomic\GithubSponsors\Facades\GithubSponsors;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class LoadGithubSponsorsCommand extends Command
{
    protected $signature = 'load:github:sponsors';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('Load sponsors ...');

        $sponsors = GithubSponsors::viewer()
            ->sponsors(fields: ['login', 'avatarUrl', 'location', 'name'])
            ->collect();

        $this->output->progressStart($sponsors->count());
        $rows = $sponsors->map(function (array $user): array {
            return tap([
                'login' => $user['login'],
                'name' => $user['name'],
                'location' => $user['location'],
                'avatar_url' => $user['avatarUrl'],
            ], fn () => $this->output->progressAdvance());
        });
        $this->output->progressFinish();

        Cache::forever(
            key: 'sponsors.rows',
            value: $rows->all()
        );

        $this->info('Sponsors: '.Sponsor::query()->count());

        return self::SUCCESS;
    }
}
