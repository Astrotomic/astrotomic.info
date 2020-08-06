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
            <package-promo bg-color="bg-astrotomic" image="images/translatable.min.jpg" label="Laravel Translatable" project="astrotomic/laravel-translatable">
                This is a Laravel package for translatable models. Its goal is to remove the complexity in retrieving and storing multilingual model instances. With this package you write less code, as the translations are being fetched/saved when you fetch/save your instance.
            </package-promo>
        </section>
    </context>

    <section class="container mx-auto flex flex-wrap">
    @foreach($packagist->except(['astrotomic/laravel-translatable'])->sortByDesc('downloads.total') as $package)
        <package :package="$package" :github="$github" />
    @endforeach
    </section>

    <section class="bg-astrotomic relative">
        <wave class="fill-current text-night mb-16" />
        <h2 class="container mx-auto text-white mb-8 text-4xl px-4">Contributors</h2>
        <div class="container mx-auto flex flex-wrap pr-4">
            @foreach($contributors->sortByDesc('commits') as $contributor)
                <contributor-badge :contributor="$contributor" />
            @endforeach
        </div>
    </section>

    <section class="bg-mit relative">
        <wave class="fill-current text-astrotomic bg-mit mb-16" />
        <div class="container mx-auto px-4 mb-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8 items-center justify-between">
            <h2 class="text-white text-4xl leading-none">MIT License</h2>
            <div>
                <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT license" loading="lazy" />
            </div>
        </div>
        <div class="container mx-auto px-4">
            <p class="mb-3">
                If not other stated all our packages are licensed under MIT License (copy of license is in each package).
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <div class="sm:w-1/3">
                    <h3 class="text-2xl mb-1">Permissions</h3>
                    <ul class="list-disc list-inside">
                        <li>Commercial use</li>
                        <li>Distribution</li>
                        <li>Modification</li>
                        <li>Private use</li>
                    </ul>
                </div>
                <div class="sm:w-1/3">
                    <h3 class="text-2xl mb-1">Conditions</h3>
                    <ul class="list-disc list-inside">
                        <li>License and copyright notice</li>
                    </ul>
                </div>
                <div class="sm:w-1/3">
                    <h3 class="text-2xl mb-1">Limitations</h3>
                    <ul class="list-disc list-inside">
                        <li>Liability</li>
                        <li>Warranty</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-treeware relative">
        <wave class="fill-current text-mit bg-treeware mb-16" />
        <div class="container mx-auto px-4 mb-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8 items-center justify-between">
            <h2 class="text-white text-4xl leading-none">Treeware</h2>
            <div>
                <img src="https://img.shields.io/badge/Treeware-🌳-lightgreen?style=for-the-badge" class="ml-4" alt="Treeware license" loading="lazy" />
            </div>
        </div>
        <div class="container mx-auto px-4 flex flex-col md:flex-row md:space-x-4">
            <div class="md:w-2/3 space-y-2">
                <p>
                    In addition to the MIT license all packages have also the Treeware additional license.
                </p>
                <p>
                    You're free to use our packages, but if one makes it to your production environment you are required to buy the world a tree (at least the lowest package <a href="https://offset.earth/treeware" class="inline-block opacity-75 hover:opacity-100 border-b border-dotted border-white">offset.earth/treeware</a> offers).
                </p>
                <p>
                    It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.
                </p>
                <p>
                    You can buy trees at <a href="https://offset.earth/treeware" class="inline-block opacity-75 hover:opacity-100 border-b border-dotted border-white">offset.earth/treeware</a>.
                    <br>
                    Read more about Treeware at <a href="https://treeware.earth" class="inline-block opacity-75 hover:opacity-100 border-b border-dotted border-white">treeware.earth</a>.
                </p>
            </div>
            <div class="md:w-1/3 mt-4 md:mt-0">
                <a href="https://offset.earth/treeware">
                    <img src="https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?white=true&landscape=true" alt="image with dynamic amount of trees bought for Treeware license" loading="lazy" />
                </a>
            </div>
        </div>
    </section>
    <section class="bg-larabelles relative">
        <wave class="fill-current text-treeware bg-larabelles mb-16" />
        <div class="container mx-auto px-4 mb-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8 items-center justify-between">
            <h2 class="text-white text-4xl leading-none">Larabelles</h2>
            <div>
                <img src="https://img.shields.io/badge/Larabelles-🦄-lightpink?style=for-the-badge" class="ml-4" alt="Treeware license" loading="lazy" />
            </div>
        </div>
        <div class="container mx-auto px-4 space-y-2">
            <p>
                <strong>We strongly believe in a world full of diversity and equity!</strong>
            </p>
            <p>
                Larabelles is a community that focuses on reducing barriers for folks under-represented due to their gender to enter the world of technology.
                They do this by encourage people to consider a career in tech and by providing a safe space to feel welcome and supported, not just at the beginning of their development career, but throughout.
            </p>
            <p>
                They aim to make the world of Laravel development more accessible to women, non-binary and trans folk by promoting them, their accomplishments and projects, by providing networking and socialising opportunities, and by sharing resources.
            </p>
        </div>
        <wave class="fill-current text-larabelles bg-night mb-8" />
    </section>

    <copyright/>

    {!! $schemaHome !!}
@endsection
