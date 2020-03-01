@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $github */
?>

@section('title', $login.' | Astrotomic')

@section('content')
    <hero>
        <div class="container mx-auto px-4 py-32 text-center">
            {{ picture(weserv($avatar_url)->w(256)->h(256), "{$login} Avatar", 'mx-auto rounded w-64 h-64') }}
            <h2 class="text-6xl text-white font-bold">{{ $login }}</h2>

            <div class="flex flex-row flex-wrap justify-center">
                <count-up icon="fa-box-heart" :value="count($packages)" label="packages" />
                <count-up icon="fa-code-commit" :value="$commits" label="commits" />
            </div>
        </div>
    </hero>

    <section class="container mx-auto flex flex-wrap">
        @foreach($packagist->only($packages)->sortByDesc('downloads.total') as $package)
            <package :package="$package" :github="$github" />
        @endforeach
    </section>

    <copyright/>
@endsection
