@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $contributors */
?>

@section('content')
    <hero>
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
                <count-up icon="fa-users-cog" :value="$contributors->count()" label="contributors" />
                <count-up icon="fa-code-commit" :value="$contributors->sum('commits')" label="commits" />
            </div>
        </div>
    </hero>

    <context :packagist="$packagist">
        <section class="container mx-auto px-4">
            <package-promo bg-color="bg-stancy-500" image="images/stancy.min.jpg" label="Stancy" project="astrotomic/stancy">
                This Laravel package aims to provide the most common and flexible CMS features to your Laravel project. You can still use the frontend/template engine of your choice, use the scheduler/queue and receive POST requests and all the other features Laravel provides.
            </package-promo>

            <package-promo bg-color="bg-astrotomic-400" image="images/translatable.min.jpg" label="Laravel Translatable" project="astrotomic/laravel-translatable">
                This Laravel package aims to provide the most common and flexible CMS features to your Laravel project. You can still use the frontend/template engine of your choice, use the scheduler/queue and receive POST requests and all the other features Laravel provides.
            </package-promo>
        </section>
    </context>

    <section class="container mx-auto flex flex-wrap">
    @foreach($packagist->except(['astrotomic/stancy', 'astrotomic/laravel-translatable'])->sortBy('name') as $package)
        <package :package="$package" />
    @endforeach
    </section>

    <div class="bg-astrotomic-400 relative">
        <wave class="fill-current text-background mb-16" />
        <section class="container mx-auto flex flex-wrap px-4">
            <h2 class="text-white mb-8 text-4xl">Contributors</h2>
        </section>
        <section class="container mx-auto flex flex-wrap pr-4">
            @foreach($contributors->sortByDesc('commits') as $contributor)
                <a href="{{ route('contributor', [ 'name' => strtolower($contributor['login']) ]) }}" class="bg-white text-black block flex items-center ml-4 mb-4 rounded overflow-hidden @if(in_array($contributor['id'], [6187884, 1785686])) opacity-50 @endif">
                    <img src="https://images.weserv.nl?il&w=48&output=jpg&url={{ urlencode($contributor['avatar_url']) }}" />
                    <span class="px-4">
                    {{ $contributor['login'] }}
                    <span class="opacity-50">
                        {{ $contributor['commits'] }}
                    </span>
                </span>
                </a>
            @endforeach
        </section>
        <wave class="fill-current text-astrotomic-400 bg-background mb-8" />
    </div>

    <copyright/>
@endsection
