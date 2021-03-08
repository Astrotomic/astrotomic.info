@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $github */
?>

@section('title', $login.' | Astrotomic')

@section('content')
    <hero>
        <div class="container mx-auto px-4 py-32 text-center">
            <imgix :src="$avatar_url" width="256" height="256" ratio="1:1" :alt="$login.' Avatar'" class="mx-auto rounded w-64 h-64" />
            <h2 class="text-6xl text-white font-bold">{{ $login }}</h2>

            @if(isset($info['bio']))
            <div class="py-4">  
                <p class="mt-4">{{$info['bio']}}</p>
            </div>
            @endif

            <div class="flex flex-row flex-wrap justify-center">
                <count-up icon="fa-box-heart" :value="count($packages)" label="packages" />
                <count-up icon="fa-code-commit" :value="$commits" label="commits" />
            </div>

            <div class="mx-auto max-w-3xl">
                <div class="py-12 space-x-24 flex  justify-between">
                    <div class="w-1/3">
                        <i class="fas fa-location-circle fa-5x"></i> 
                        <p class="mt-4">
                            @if(isset($info['location']))
                                {{$info['location']}}
                            @else
                                Whereabouts Unknown
                            @endif
                        </p>
                    </div>
                    <div class="w-1/3">
                        <i class="fad fa-browser fa-5x"></i> 
                        <p class="mt-4">
                            @if(!$info['blog']=="")
                                <a href="{{$info['blog']}}" target="_blank">{{$info['blog']}}</a>
                            @else
                                No Website Found
                            @endif
                        </p>
                    </div>
                    <div class="w-1/3">
                        <i class="fab fa-twitter fa-5x"></i> 
                        <p class="mt-4">
                            @if(isset($info['twitter_username']))
                                <a href="https://twitter.com/{{$info['twitter_username']}}" target="_blank">{{$info['twitter_username']}}</a>
                            @else
                                No Tweets Here
                            @endif
                        </p>
                    </div>
                </div>
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
