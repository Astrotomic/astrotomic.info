@extends('master')

<?php
/** @var \Illuminate\Support\Collection $packagist */
/** @var \Illuminate\Support\Collection $contributors */
?>

@section('content')
    <hero>
        <div class="container mx-auto px-4 pt-4 pb-16 sm:py-32 text-center">
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
                <count-up icon="fa-download" :value="$packagist->sum('downloads.total')" label="downloads" />
            </div>
        </div>
    </hero>

    <context :packagist="$packagist" :github="$github">
        <section class="container mx-auto px-4">
            <package-promo bg-color="bg-astrotomic-400" image="images/translatable.min.jpg" label="Laravel Translatable" project="astrotomic/laravel-translatable">
                This is a Laravel package for translatable models. Its goal is to remove the complexity in retrieving and storing multilingual model instances. With this package you write less code, as the translations are being fetched/saved when you fetch/save your instance.
            </package-promo>
        </section>
    </context>

    <section class="container mx-auto flex flex-wrap">
    @foreach($packagist->except(['astrotomic/laravel-translatable'])->sortByDesc('downloads.total') as $package)
        <package :package="$package" :github="$github" />
    @endforeach
    </section>

    <section class="bg-astrotomic-400 relative">
        <wave class="fill-current text-background mb-16" />
        <h2 class="container mx-auto text-white mb-8 text-4xl px-4">Contributors</h2>
        <div class="container mx-auto flex flex-wrap pr-4">
            @foreach($contributors->sortByDesc('commits') as $contributor)
                <contributor-badge :contributor="$contributor" />
            @endforeach
        </div>
    </section>

    <section class="bg-treeware-500 relative">
        <wave class="fill-current text-astrotomic-400 bg-treeware-500 mb-16" />
        <h2 class="container mx-auto text-white mb-4 text-4xl px-4">License: MIT & Treeware</h2>
        <div class="container mx-auto pr-4 mb-8 flex flex-wrap">
            <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" class="ml-4" alt="MIT license" loading="lazy" />
            <img src="https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=for-the-badge" class="ml-4" alt="Treeware license" loading="lazy" />
        </div>
        <div class="container mx-auto px-4 flex flex-col md:flex-row">
            <div class="md:w-2/3 md:pr-4">
                <p class="mb-2">
                    If not other stated all our packages are licensed under MIT License (copy of license is in each package) and also as Treeware.
                </p>
                <p class="mb-2">
                    You're free to use our packages, but if one makes it to your production environment you are required to buy the world a tree (at least the lowest package <a href="https://offset.earth/treeware" class="inline-block opacity-50 hover:opacity-100 border-b border-dotted border-white">offset.earth/treeware</a> offers).
                </p>
                <p class="mb-2">
                    It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.
                </p>
                <p class="mb-2">
                    You can buy trees at <a href="https://offset.earth/treeware" class="inline-block opacity-50 hover:opacity-100 border-b border-dotted border-white">offset.earth/treeware</a>.
                    <br>
                    Read more about Treeware at <a href="https://treeware.earth" class="inline-block opacity-50 hover:opacity-100 border-b border-dotted border-white">treeware.earth</a>.
                </p>
            </div>
            <div class="md:w-1/3 mt-4 md:mt-0">
                <a href="https://offset.earth/treeware">
                    <img src="https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?white=true&landscape=true" alt="image with dynamic amount of trees bought for Treeware license" loading="lazy" />
                </a>
            </div>
        </div>
        <wave class="fill-current text-treeware-500 bg-background mb-8" />
    </section>

    <copyright/>

    {!! $schemaHome !!}
@endsection
