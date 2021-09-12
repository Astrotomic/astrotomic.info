<?php

namespace App\Console\Commands;

use App\Pages\Sponsor;
use Github\Client as Github;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LoadSponsors extends Command
{
    protected $name = 'load:sponsors';
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
        $query = <<<'GRAPHQL'
        {
            viewer {
                sponsorshipsAsMaintainer(first: 100) {
                    nodes {
                        sponsorEntity {
                            ... on User {
                                avatarUrl
                                login
                                location
                                name
                            }
                            ... on Organization {
                                avatarUrl
                                login
                                location
                                name
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

        if (empty(env('GH_SPONSOR_PATS'))) {
            return;
        }

        $sponsors = collect();
        foreach (explode(';', env('GH_SPONSOR_PATS')) as $pat) {
            $this->github->authenticate($pat, null, Github::AUTH_ACCESS_TOKEN);
            $response = $this->github->graphql()->execute($query);
            $sponsors = $sponsors->merge(data_get($response, 'data.viewer.sponsorshipsAsMaintainer.nodes.*.sponsorEntity'));
        }

        $sponsors
            ->map(fn (array $sponsor) => [
                'slug' => $sponsor['login'],
                'name' => $sponsor['name'],
                'location' => $sponsor['location'],
                'avatar_url' => $sponsor['avatarUrl'],
                'github_url' => "https://github.com/{$sponsor['login']}",
            ])
            ->unique('slug')
            ->each(function (array $sponsor) {
                $sponsor['_pageData'] = Sponsor::class;
                Storage::disk('sponsor')->put(Str::lower($sponsor['slug']).'.json', collect($sponsor)->except('slug')->toJson());
            });
    }
}
