@extends('master')

@section('content')
    <header>
        <div>
            <nav>
                <div class="container mx-auto px-4">
                    <h1>
                        <i class="fad fa-user-astronaut fa-fw"></i>
                        <span>Astrotomic</span>
                    </h1>

                    <ul>
                        <li>
                            <a href="https://github.com/Astrotomic" class="btn">
                                <i class="fab fa-github"></i>
                                GitHub
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="lead container mx-auto px-4">
                <strong>
                    <span>Open Source</span>
                    <span>PHP</span>
                    <span>Laravel</span>
                </strong>
                <p>
                    We want to provide helpful, solid and easy to use open source packages.
                    <br/>
                    Most of them will be for Laravel - but sometimes also plain PHP.
                </p>

                <div class="flex flex-row flex-wrap justify-center">
                    <div class="px-8 pb-16">
                        <div class="border-2 border-gray-400 p-4 rounded-lg">
                            <div class="px-8">
                                <i class="fad fa-box-heart fa-fw fa-5x"></i>
                            </div>
                            <strong class="block py-4 text-3xl text-white">123456</strong>
                            <span class="block border-t-2 border-gray-400 pt-2">packages</span>
                        </div>
                    </div>
                    <div class="px-8 pb-16">
                        <div class="border-2 border-gray-400 p-4 rounded-lg">
                            <div class="px-8">
                                <i class="fad fa-users-cog fa-fw fa-5x"></i>
                            </div>
                            <strong class="block py-4 text-3xl text-white">123456</strong>
                            <span class="block border-t-2 border-gray-400 pt-2">contributors</span>
                        </div>
                    </div>
                    <div class="px-8">
                        <div class="border-2 border-gray-400 p-4 rounded-lg">
                            <div class="px-8">
                                <i class="fad fa-code-commit fa-fw fa-5x"></i>
                            </div>
                            <strong class="block py-4 text-3xl text-white">123456</strong>
                            <span class="block border-t-2 border-gray-400 pt-2">commits</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="container mx-auto px-4">
        <div class="bg-stancy-500 rounded-lg flex flex-col lg:flex-row overflow-hidden mb-16">
            <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
                <picture>
                    <source srcset="{{ image('images/stancy.min.jpg', 'webp', 768) }}" type="image/webp">
                    <img src="{{ image('images/stancy.min.jpg', 'jpg', 768) }}" class="rounded-t" alt="Astrotomic Stancy Logo" />
                </picture>
            </div>
            <div class="w-full lg:w-1/2 p-8 flex flex-col">
                <h2 class="text-white text-3xl mb-3">Stancy</h2>
                <p class="flex-grow">This Laravel package aims to provide the most common and flexible CMS features to your Laravel project. You can still use the frontend/template engine of your choice, use the scheduler/queue and receive POST requests and all the other features Laravel provides.</p>
                <a href="https://github.com/Astrotomic/stancy" class="btn mt-4 self-start">
                    <i class="fab fa-github fa-fw"></i>
                    astrotomic/stancy
                </a>
            </div>
        </div>

        <div class="bg-astrotomic-400 rounded-lg flex flex-col lg:flex-row overflow-hidden mb-32">
            <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
                <picture>
                    <source srcset="{{ image('images/translatable.min.jpg', 'webp', 768) }}" type="image/webp">
                    <img src="{{ image('images/translatable.min.jpg', 'jpg', 768) }}" class="rounded-t" alt="Astrotomic Laravel Translatable Logo" />
                </picture>
            </div>
            <div class="w-full lg:w-1/2 p-8 flex flex-col">
                <h2 class="text-white text-3xl mb-3">Laravel Translatable</h2>
                <p class="flex-grow">This is a Laravel package for translatable models. Its goal is to remove the complexity in retrieving and storing multilingual model instances. With this package you write less code, as the translations are being fetched/saved when you fetch/save your instance.</p>
                <a href="https://github.com/Astrotomic/stancy" class="btn mt-4 self-start">
                    <i class="fab fa-github fa-fw"></i>
                    astrotomic/laravel-translatable
                </a>
            </div>
        </div>
    </section>
@endsection
