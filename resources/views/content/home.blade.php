@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $github */
?>

@section('content')
    <header class="relative min-h-screen">
        <div class="relative z-10 flex flex-col justify-center items-center min-h-screen">
            <nav class="absolute top-0 inset-x-0">
                <div class="container mx-auto px-4 flex items-center flex-wrap">
                    <h1 class="font-semibold text-white text-2xl leading-none tracking-wider py-4 flex-grow flex items-center">
                        <icon icon="fa-user-astronaut" icon-size="text-4xl mr-2" />
                        <span class="py-2">Astrotomic</span>
                    </h1>

                    <a href="https://join.slack.com/t/astrotomic/shared_invite/enQtNzk2MTgzNDgwODUwLWI4YTJjYTNjNTE1Y2EzNjEwYzEzNTM1MTRjZTFiZWVjM2U4YWY3MjczYzdmYjE2ZmU1ZmMzNGY1NWM1MTM1YTI" class="btn mr-4">
                        <icon icon-style="fab" icon="fa-slack" />
                        Slack
                    </a>

                    <a href="https://github.com/Astrotomic" class="btn">
                        <icon icon-style="fab" icon="fa-github" />
                        GitHub
                    </a>
                </div>
            </nav>

            <div class="container mx-auto px-4 py-32 text-center">
                <strong class="text-6xl text-white font-bold divided">
                    <span>Open Source</span>
                    <span>PHP</span>
                    <span>Laravel</span>
                </strong>
                <p class="text-2xl mb-8">
                    We want to provide helpful, solid and easy to use open source packages.
                    <br/>
                    Most of them will be for Laravel - but sometimes also plain PHP.
                </p>

                <div class="flex flex-row flex-wrap justify-center">
                    <count-up icon="fa-box-heart" :value="$packagist->count()" label="packages" />
                    <count-up icon="fa-users-cog" :value="$github->pluck('contributors')->collapse()->pluck('author.login')->unique()->count()" label="contributors" />
                    <count-up icon="fa-code-commit" :value="$github->pluck('contributors')->collapse()->sum('total')" label="commits" />
                </div>
            </div>
        </div>
    </header>

    <context :packagist="$packagist">
        <section class="container mx-auto px-4">
            <promo-card bg-color="bg-stancy-500" image="images/stancy.min.jpg" label="Stancy" project="astrotomic/stancy">
                This Laravel package aims to provide the most common and flexible CMS features to your Laravel project. You can still use the frontend/template engine of your choice, use the scheduler/queue and receive POST requests and all the other features Laravel provides.
            </promo-card>

            <promo-card bg-color="bg-astrotomic-400" image="images/translatable.min.jpg" label="Laravel Translatable" project="astrotomic/laravel-translatable">
                This Laravel package aims to provide the most common and flexible CMS features to your Laravel project. You can still use the frontend/template engine of your choice, use the scheduler/queue and receive POST requests and all the other features Laravel provides.
            </promo-card>
        </section>
    </context>

    <section class="container mx-auto flex flex-wrap">
    @foreach($packagist->except(['astrotomic/stancy', 'astrotomic/laravel-translatable'])->sortBy('name') as $package)
        <div class="w-full lg:w-1/2 px-4 pb-8">
            <div class="bg-background-lighter p-8 rounded overflow-hidden">
                <h3 class="text-xl mb-1">
                    @if($package['name'] === 'astrotomic/countdown-gif')
                        <icon icon="fa-stopwatch" icon-style="fas" />
                    @elseif($package['name'] === 'astrotomic/ignition-stackoverflow')
                        <icon icon="fa-stack-overflow" icon-style="fab" />
                    @elseif($package['name'] === 'astrotomic/laravel-cachable-attributes')
                        <icon icon="fa-cabinet-filing" icon-style="fas" />
                    @else
                        <icon icon="fa-box" icon-style="fas" />
                    @endif
                    {{ \Illuminate\Support\Str::title(\Illuminate\Support\Str::slug(\Illuminate\Support\Str::after($package['name'], 'astrotomic/'), ' ')) }}
                </h3>
                <div class="mb-2 divided">
                    <span>
                        <icon icon="fa-code" icon-style="fas opacity-50" />
                        {{ $package['language'] }}
                    </span>
                    <span>
                        <icon icon="fa-star" icon-style="fas opacity-50" />
                        {{ number_format($package['github_stars'], 0, '', ' ') }}
                    </span>
                    <span>
                        <icon icon="fa-download" icon-style="fas opacity-50" />
                        {{ number_format($package['downloads']['total'], 0, '', ' ') }}
                    </span>
                    <span>
                        <icon icon="fa-link" icon-style="fas opacity-50" />
                        {{ $package['dependents'] }}
                    </span>
                </div>
                <p>{{ $package['description'] }}</p>
                <a href="{{ data_get($package, 'repository') }}" class="inline-block mt-4 opacity-50 hover:opacity-100 border-b border-dotted border-white">
                    <icon icon-style="fab" icon="fa-github" />
                    {{ $package['name'] }}
                </a>
            </div>
        </div>
    @endforeach
    </section>

    <div class="bg-astrotomic-400 relative">
        <wave class="fill-current text-background mb-16" />
        <section class="container mx-auto flex flex-wrap px-4">
            <h2 class="text-white mb-8 text-4xl">Contributors</h2>
        </section>
        <section class="container mx-auto flex flex-wrap pr-4">
            @foreach($github->pluck('contributors')->collapse()->pluck('author')->unique('login')->sortByDesc(function(array $contributor) use ($github) { return $github->pluck('contributors')->collapse()->where('author.login', $contributor['login'])->sum('total'); }) as $contributor)
                <a href="{{ $contributor['html_url'] }}" class="bg-white text-black block flex items-center ml-4 mb-4 rounded overflow-hidden @if(in_array($contributor['id'], [6187884, 1785686])) opacity-50 @endif">
                    <img src="https://images.weserv.nl?il&w=48&output=jpg&url={{ urlencode($contributor['avatar_url']) }}" />
                    <span class="px-4">
                    {{ $contributor['login'] }}
                    <span class="opacity-50">
                        {{ $github->pluck('contributors')->collapse()->where('author.login', $contributor['login'])->sum('total') }}
                    </span>
                </span>
                </a>
            @endforeach
        </section>
        <wave class="fill-current text-astrotomic-400 bg-background mb-8" />
    </div>

    <footer>
        <div class="container mx-auto p-4 flex items-center flex-wrap">
            <span class="flex-grow whitespace-no-wrap opacity-50">
                Astrotomic &copy; 2019
            </span>
            <a href="https://join.slack.com/t/astrotomic/shared_invite/enQtNzk2MTgzNDgwODUwLWI4YTJjYTNjNTE1Y2EzNjEwYzEzNTM1MTRjZTFiZWVjM2U4YWY3MjczYzdmYjE2ZmU1ZmMzNGY1NWM1MTM1YTI" class="mr-4 opacity-50 hover:opacity-100 border-b border-dotted border-white">
                <icon icon-style="fab" icon="fa-slack" />
                Slack
            </a>

            <a href="https://github.com/Astrotomic" class="opacity-50 hover:opacity-100 border-b border-dotted border-white">
                <icon icon-style="fab" icon="fa-github" />
                GitHub
            </a>
        </div>
    </footer>
@endsection
