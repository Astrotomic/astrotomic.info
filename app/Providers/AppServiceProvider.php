<?php

namespace App\Providers;

use Astrotomic\Ecologi\Ecologi;
use Astrotomic\GithubSponsors\Graphql;
use Github\AuthMethod;
use Github\Client as Github;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Spatie\Packagist\PackagistClient;
use Spatie\Packagist\PackagistUrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Ecologi::class, function (): Ecologi {
            return new Ecologi(config('services.ecologi.api_key') ?? '');
        });

        $this->app->singleton(PackagistClient::class, function (): PackagistClient {
            return new PackagistClient(
                client: new Client(),
                url: new PackagistUrlGenerator()
            );
        });

        $this->app->singleton(Github::class, function (): Github {
            $client = new Github();

            if (config('services.github.access_token')) {
                $client->authenticate(config('services.github.access_token'), null, AuthMethod::ACCESS_TOKEN);
            }

            return $client;
        });

        $this->app->when(Graphql::class)
            ->needs('$token')
            ->give(config('services.github.access_token'));
    }
}
