<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoadGithubCommand extends Command
{
    protected $signature = 'load:github';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->call(LoadGithubSponsorsCommand::class);
        $this->call(LoadGithubApplicationsCommand::class);
        $this->call(LoadGithubPackagesCommand::class);
        $this->call(LoadGithubContributorsCommand::class);

        return self::SUCCESS;
    }
}
