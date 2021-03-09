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
            <h2 class="mt-2 text-5xl text-white font-bold">
                @if(isset($info['name']))
                    <a-styled :href="'https://github.com/'.$login">{{$info['name']}}</a-styled>
                @else
                    <a-styled :href="'https://github.com/'.$login">{{$login}}</a-styled>
                @endif
            </h2>

            <div class="mx-auto md:max-w-2xl">
                <div class="py-2 space-x-4 flex justify-between">
                    @if(isset($info['location']))
                        <div class="flex-1">
                            <icon icon="fa-location-circle" icon-style="fas" class="opacity-75 mr-1" />
                            {{$info['location']}}
                        </div>
                    @endif
                    @if(!$info['blog']=="")
                        <div class="flex-1">
                            <icon icon="fa-browser" icon-style="fas" class="opacity-75 mr-1" />
                            <a-styled :href="$info['blog']" :underlined="true">{{$info['blog']}}</a-styled>
                        </div>
                    @endif
                    @if(isset($info['twitter_username']))
                        <div class="flex-1">
                            <icon icon="fa-at" icon-style="fas" class="opacity-75 mr-1" />
                            <a-styled :href="'https://www.twitter.com/'.$info['twitter_username']" :underlined="true">{{$info['twitter_username']}}</a-styled>
                        </div>
                    @endif
                </div>
            </div>

            @if(isset($info['bio']))
            <div class="mt-2 mx-auto md:max-w-3xl py-2 text-2xl">  
                <p>{{$info['bio']}}</p>
            </div>
            @endif

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
