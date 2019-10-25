@extends('master')

@section('content')
    <header class="relative min-h-screen">
        <div class="relative z-10 flex flex-col justify-center items-center min-h-screen">
            <nav class="absolute top-0 inset-x-0">
                <div class="container mx-auto px-4 flex items-center">
                    <h1 class="font-semibold text-white text-2xl leading-none tracking-wider py-4 flex-grow flex items-center">
                        <icon icon="fa-user-astronaut" icon-size="text-4xl mr-2" />
                        <span class="py-2">Astrotomic</span>
                    </h1>

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
@endsection
