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

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 justify-center pt-16">
                <count-up icon="fa-trees" :value="json_decode(file_get_contents('https://public.ecologi.com/users/astrotomic/trees'), true)['total']" label="trees" />
                <count-up icon="fa-box-heart" :value="$packagist->count()" label="packages" />
                <count-up icon="fa-download" :value="$packagist->sum('downloads.total')" label="downloads" />
                <count-up icon="fa-users-cog" :value="$contributors->count()" label="contributors" />
                <count-up icon="fa-code-commit" :value="$contributors->sum('commits')" label="commits" />
            </div>
        </div>
    </hero>

    <context :packagist="$packagist" :github="$github">
        <section class="container mx-auto px-4">
            <package-promo bg-color="bg-astro-astrotomic" :image="mix('images/translatable.min.jpg')" label="Laravel Translatable" project="astrotomic/laravel-translatable">
                This is a Laravel package for translatable models. Its goal is to remove the complexity in retrieving and storing multilingual model instances. With this package you write less code, as the translations are being fetched/saved when you fetch/save your instance.
            </package-promo>
        </section>
    </context>

    <section class="container mx-auto grid grid-cols-1 lg:grid-cols-2">
        @foreach($packagist->except(['astrotomic/laravel-translatable'])->sortByDesc('downloads.total') as $package)
            <package :package="$package" :github="$github" />
        @endforeach
    </section>

    <section-wave bg="astro-astrotomic" before="astro-night">
        <slot name="title">Contributors</slot>

        <div class="flex flex-wrap -ml-4">
            @foreach($contributors->sortByDesc('commits') as $contributor)
                <contributor-badge :contributor="$contributor" />
            @endforeach
        </div>
    </section-wave>

    <section-wave bg="astro-mit" before="astro-astrotomic">
        <slot name="title">MIT License</slot>
        <slot name="badge"><img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT license" loading="lazy" /></slot>

        <div class="space-y-2">
            <p>
                If not other stated all our packages are licensed under MIT License (copy of license is in each package).
            </p>
            <p>
                A short and simple permissive license with conditions only requiring preservation of copyright and license notices.
                Licensed works, modifications, and larger works may be distributed under different terms and without source code.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <div class="sm:w-1/3">
                    <h3 class="text-xl mb-1">Permissions</h3>
                    <ul class="list-inside">
                        <li><i class="far fa-fw fa-check mr-1"></i> Commercial use</li>
                        <li><i class="far fa-fw fa-check mr-1"></i> Distribution</li>
                        <li><i class="far fa-fw fa-check mr-1"></i> Modification</li>
                        <li><i class="far fa-fw fa-check mr-1"></i> Private use</li>
                    </ul>
                </div>
                <div class="sm:w-1/3">
                    <h3 class="text-xl mb-1">Limitations</h3>
                    <ul class="list-inside">
                        <li><i class="far fa-fw fa-times mr-1"></i> Liability</li>
                        <li><i class="far fa-fw fa-times mr-1"></i> Warranty</li>
                    </ul>
                </div>
                <div class="sm:w-1/3">
                    <h3 class="text-xl mb-1">Conditions</h3>
                    <ul class="list-inside">
                        <li><i class="far fa-fw fa-info mr-1"></i> License and copyright notice</li>
                    </ul>
                </div>
            </div>
        </div>
    </section-wave>

    <section-wave bg="astro-treeware" before="astro-mit">
        <slot name="title">Treeware</slot>
        <slot name="badge"><img src="https://img.shields.io/badge/Treeware-🌳-lightgreen?style=for-the-badge" class="ml-4" alt="Treeware license" loading="lazy" /></slot>

        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="md:w-2/3 space-y-2">
                <p>
                    In addition to the MIT license all packages have also the Treeware additional license.
                </p>
                <p>
                    You're free to use our packages, but if one makes it to your production environment you are required to buy the world a tree (at least the lowest package <a-styled href="https://ecologi.com/treeware" underlined>offset.earth/treeware</a-styled> offers).
                </p>
                <p>
                    It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.
                </p>
                <p>
                    You can buy trees at <a-styled href="https://forest.astrotomic.info" underlined>ecologi.com/astrotomic</a-styled>.
                    <br>
                    Read more about Treeware at <a-styled href="https://treeware.earth" underlined>treeware.earth</a-styled>.
                </p>
            </div>
            <div class="md:w-1/3 mt-4 md:mt-0">
                <a href="https://forest.astrotomic.info">
                    <img src="https://api.ecologi.com/badges/cpw/607e8b98c670f00ac1c69f90?white=true&landscape=true" alt="image with dynamic amount of trees bought for Treeware license" loading="lazy" />
                </a>
            </div>
        </div>
    </section-wave>

    <section-wave bg="astro-larabelles" before="astro-treeware">
        <slot name="title">Larabelles</slot>
        <slot name="badge"><img src="https://img.shields.io/badge/Larabelles-🦄-lightpink?style=for-the-badge" class="ml-4" alt="Larabelles" loading="lazy" /></slot>

        <div class="space-y-2">
            <p>
                <strong>We strongly believe in a world full of diversity and equity!</strong>
            </p>
            <p>
                <a-styled href="https://www.larabelles.com/" :underlined="true">Larabelles</a-styled> is a community that focuses on reducing barriers for folks under-represented due to their gender to enter the world of technology.
                They do this by encourage people to consider a career in tech and by providing a safe space to feel welcome and supported, not just at the beginning of their development career, but throughout.
            </p>
            <p>
                They aim to make the world of Laravel development more accessible to women, non-binary and trans folk by promoting them, their accomplishments and projects, by providing networking and socialising opportunities, and by sharing resources.
            </p>
        </div>
    </section-wave>

    <section-wave bg="astro-sponsors" before="astro-larabelles">
        <slot name="title">Sponsors</slot>

        <div class="space-y-2 mb-4 md:mb-8 lg:md-10 xl:md-12">
            <p>
                Maintaining all the packages, creating new one and answering issues takes a lot of time.
                There are several ways to help us with that - one way is to sponsor us via <a-styled href="https://github.com/sponsors/Gummibeer" :underlined="true">GitHub Sponsors</a-styled> program.
            </p>
            <p>
                Here you see all of our current sponsors - and we are thankful for every single one of them!
            </p>
        </div>
        <div class="grid grid-flow-row grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-8 lg:gap-10 xl:gap-12">
            @foreach($sponsors as $sponsor)
                <a href="{{ $sponsor['github_url'] }}" target="_blank" rel="noreferrer" class="block space-y-2 opacity-75 hover:opacity-100">
                    <div class="flex justify-center">
                        <imgix
                            :src="$sponsor['avatar_url']"
                            :alt="$sponsor['slug']"
                            class="w-20 h-20 rounded bg-white"
                        />
                    </div>
                    <p class="text-center">
                        <strong class="block font-bold">{{ $sponsor['name'] ?? $sponsor['slug'] }}</strong>
                        <small class="block text-xs">{{ $sponsor['location'] }}</small>
                    </p>
                </a>
            @endforeach
        </div>
    </section-wave>

    <section-wave bg="astro-moonlight" before="astro-sponsors">
        <slot name="title">Trust</slot>

        <div class="space-y-2 mb-4 md:mb-8 lg:md-10 xl:md-12">
            <p>
                Several companies across the globe trust our work by using them in their own or customer projects.
            </p>
            <p>
                We are proud to provide value and reusable code to developers all over the world.
            </p>
        </div>

        <div class="grid grid-flow-row grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-8 lg:gap-10 xl:gap-12">
            @foreach($trusts as $trust)
                <a href="{{ $trust['website'] }}" target="_blank" rel="noreferrer" class="block space-y-2 opacity-75 hover:opacity-100">
                    <div class="relative pb-16/9">
                        <div class="w-full h-full absolute inset-0 p-4">
                            <imgix
                                :src="mix($trust['image'])"
                                :alt="$trust['name']"
                                class="w-full h-full object-contain"
                                trim
                            />
                        </div>
                    </div>
                    <p class="text-center">
                        <strong class="block font-bold">{{ $trust['name'] }}</strong>
                        <small class="block text-xs">{{ $trust['location'] }}</small>
                    </p>
                </a>
            @endforeach
        </div>
    </section-wave>

    <copyright before="astro-moonlight"/>

    {!! $schemaHome ?? null !!}
@endsection
