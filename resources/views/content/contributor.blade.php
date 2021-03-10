@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $github */
?>

@section('title', $login.' | Astrotomic')

@section('content')
    <hero>
        <div class="container px-4 pt-4 pb-16 mx-auto text-center sm:py-32">
            <imgix :src="$avatar_url" width="256" height="256" ratio="1:1" :alt="$login.' Avatar'" class="mx-auto w-64 h-64 rounded" />
            <h2 class="mt-2 text-4xl font-bold text-white sm:text-5xl">
                <span>{{ $info['name'] ?? $login }}</span>
                <a-styled :href="$html_url" class="p-1 ml-1 text-3xl sm:text-4xl">
                    <icon icon="fa-github" icon-style="fab"/>
                </a-styled>
            </h2>

            <ul class="flex flex-col justify-between my-2 mx-auto space-y-2 space-x-0 list-inline md:max-w-2xl sm:space-x-4 sm:space-y-0 sm:flex-row">
                @if(isset($info['location']))
                    <li>
                        <icon icon="fa-map-marker-alt" icon-style="fas" class="mr-1 opacity-75" />
                        {{$info['location']}}
                    </li>
                @endif
                @if(!$info['blog']=="")
                    @php
                        $website = $info['blog']; 
                        $link = $info['blog'];
                        if(substr($website, 0, 8) == "https://"){
                            $website = substr($website, 8);    
                        }elseif(substr($website, 0, 7) === "http://"){
                            $website = substr($website, 7);  
                        }elseif(substr($website, 0, 8) != "https://" || substr($website, 0, 7) != "http://" ){
                            $link = "https://".$website;
                        }

                        if(strlen($website) > 20 && (isset($info['location']) && isset($info['twitter_username']))){
                            $website = substr($website, 0, 20) . ' ...';
                        }

                        if(substr($website, -1) === "/"){
                            $website = substr($website, 0, -1); 
                        }
                    @endphp

                    <div class="flex-1">
                        <icon icon="fa-browser" icon-style="fas" class="opacity-75 mr-1" />
                        <a-styled :href="$link" :underlined="true">{{$website}}</a-styled>
                    </div>
                @endif
                @if(isset($info['twitter_username']))
                    <li>
                        <icon icon="fa-twitter" icon-style="fab" class="mr-1 opacity-75" />
                        <a-styled :href="'https://www.twitter.com/'.$info['twitter_username']" underlined>
                            {{ '@'.$info['twitter_username'] }}
                        </a-styled>
                    </li>
                @endif
            </ul>

            @if(isset($info['bio']))
            <div class="py-2 mx-auto mt-2 text-2xl md:max-w-3xl">
                <p>{{$info['bio']}}</p>
            </div>
            @endif

            <div class="flex flex-row flex-wrap justify-center">
                <count-up icon="fa-box-heart" :value="count($packages)" label="packages" />
                <count-up icon="fa-code-commit" :value="$commits" label="commits" />
            </div>


        </div>
    </hero>

    <section class="container flex flex-wrap mx-auto">
        @foreach($packagist->only($packages)->sortByDesc('downloads.total') as $package)
            <package :package="$package" :github="$github" />
        @endforeach
    </section>

    <copyright/>
@endsection
