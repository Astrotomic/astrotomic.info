@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $github */
?>

@section('title', $login.' | Astrotomic')

@section('content')
    <x-hero>
        <div class="container px-4 pt-4 pb-16 mx-auto text-center sm:py-32">
            <x-elements.imgix :src="$avatar_url" width="256" height="256" ratio="1:1" :alt="$login.' Avatar'" class="mx-auto w-64 h-64 rounded" />
            <h2 class="mt-2 text-4xl font-bold text-white sm:text-5xl">
                <span>{{ $name ?? $login }}</span>
                <x-elements.aStyled :href="$html_url" class="p-1 ml-1 text-3xl sm:text-4xl">
                    <x-elements.icon icon="fa-github" icon-style="fab"/>
                </x-elements.aStyled>
            </h2>

            <ul class="flex flex-col justify-center my-2 mx-auto space-y-2 space-x-0 list-inline md:max-w-2xl sm:space-x-4 sm:space-y-0 sm:flex-row">
                @if(!empty($location))
                    <li>
                        <x-elements.icon icon="fa-map-marker-alt" icon-style="fas" class="mr-1 opacity-75" />
                        {{ $location }}
                    </li>
                @endif
                @if(!empty($blog))
                    @php
                        $website = rtrim(str_replace(['http://', 'https://'], '', $blog), '/');

                        if (mb_strlen($website) > 30) {
                            $website = parse_url($blog, PHP_URL_HOST) ?? substr($website, 0, 30) . '…';
                        }
                    @endphp

                    <li>
                        <x-elements.icon icon="fa-globe" icon-style="fas" class="mr-1 opacity-75"/>
                        <x-elements.aStyled :href="$blog" :underlined="true">{{ $website }}</x-elements.aStyled>
                    </li>
                @endif
                @if(!empty($twitter_username))
                    <li>
                        <x-elements.icon icon="fa-twitter" icon-style="fab" class="mr-1 opacity-75"/>
                        <x-elements.aStyled :href="'https://www.twitter.com/'.$twitter_username" underlined>
                            {{ '@'.$twitter_username }}
                        </x-elements.aStyled>
                    </li>
                @endif
            </ul>

            @if(!empty($bio))
                <div class="py-2 mx-auto mt-2 text-2xl md:max-w-3xl">
                    <p>{{ $bio }}</p>
                </div>
            @endif

            <div class="flex flex-row flex-wrap justify-center">
                <x-countUp icon="fa-box-heart" :value="count($packages)" label="packages"/>
                <x-countUp icon="fa-code-commit" :value="$commits" label="commits"/>
            </div>
        </div>
    </x-hero>

    <section class="container flex flex-wrap mx-auto">
        @foreach($packagist->only($packages)->sortByDesc('downloads.total') as $package)
            <x-package :package="$package" :github="$github" />
        @endforeach
    </section>

    <x-elements.copyright/>
@endsection
