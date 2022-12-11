<x-layout>
    <x-hero>
        <div class="container mx-auto px-4 pt-4 pb-16 sm:py-32">
            <ul class="flex items-center justify-center text-6xl text-white font-bold divided mb-4">
                <li>Open Source</li>
                <li>PHP</li>
                <li>Laravel</li>
            </ul>

            <p class="text-2xl mb-8 text-center">
                We want to provide helpful, solid and easy to use open source packages.
                <br/>
                Most of them will be for Laravel - but sometimes also plain PHP.
            </p>

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 justify-center pt-16">
                <x-count-up icon="fad-box-heart" :value="$stats['packages']" label="packages" />
                <x-count-up icon="fad-download" :value="$stats['downloads']" label="downloads" />
                <x-count-up icon="fad-users-gear" :value="$stats['contributors']" label="contributors" />
                <x-count-up icon="fad-code-commit" :value="$stats['commits']" label="commits" />
                <x-count-up icon="fad-stars" :value="$stats['stars']" label="stars" />
                <x-count-up icon="fad-trees" :value="$stats['trees']" label="trees" />
            </div>
        </div>
    </x-hero>

    <section class="container mx-auto px-4 mb-16 space-y-8">
        @foreach($apps as $app)
            <x-app-promo :app="$app"/>
        @endforeach
    </section>

    <section class="container mx-auto px-4 mb-16 space-y-8">
        @foreach($promos as $promo)
            <x-package-promo :package="$promo"/>
        @endforeach
    </section>

    <section class="container mx-auto grid grid-cols-1 lg:grid-cols-2">
        @foreach($packages as $package)
            <x-package :package="$package"/>
        @endforeach
    </section>


    <x-elements.section-wave bg="astro-astrotomic" before="astro-night">
        <x-slot name="title">Contributors</x-slot>

        <div class="flex flex-wrap -ml-4">
            @foreach($contributors as $contributor)
                <x-contributor-badge :contributor="$contributor" />
            @endforeach
        </div>
    </x-elements.section-wave>

    <x-elements.section-wave bg="astro-mit" before="astro-astrotomic">
        <x-slot name="title">MIT License</x-slot>
        <x-slot name="badge"><img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT license" loading="lazy" /></x-slot>

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
    </x-elements.section-wave>

    <x-elements.section-wave bg="astro-treeware" before="astro-mit">
        <x-slot name="title">Treeware</x-slot>
        <x-slot name="badge"><img src="https://img.shields.io/badge/Treeware-🌳-lightgreen?style=for-the-badge" class="ml-4" alt="Treeware license" loading="lazy" /></x-slot>

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
    </x-elements.section-wave>

    <x-elements.section-wave bg="astro-larabelles" before="astro-treeware">
        <x-slot name="title">Larabelles</x-slot>
        <x-slot name="badge"><img src="https://img.shields.io/badge/Larabelles-🦄-lightpink?style=for-the-badge" class="ml-4" alt="Larabelles" loading="lazy" /></x-slot>

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
    </x-elements.section-wave>

    <x-elements.section-wave bg="astro-sponsors" before="astro-larabelles">
        <x-slot name="title">Sponsors</x-slot>

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
                <a href="{{ $sponsor->html_url }}" target="_blank" rel="noreferrer" class="block space-y-2 opacity-75 hover:opacity-100">
                    <div class="flex justify-center">
                        <img
                            src="{{ $sponsor->avatar_url }}"
                            alt="{{ $sponsor->login }}"
                            loading="lazy"
                            class="w-20 h-20 rounded bg-white"
                        />
                    </div>
                    <p class="text-center">
                        <strong class="block font-bold">{{ $sponsor->name ?? $sponsor->login }}</strong>
                        <small class="block text-xs">{{ $sponsor->location }}</small>
                    </p>
                </a>
            @endforeach
        </div>
    </x-elements.section-wave>

    <x-elements.section-wave bg="astro-moonlight" before="astro-sponsors">
        <x-slot name="title">Trust</x-slot>

        <div class="space-y-2 mb-4 md:mb-8 lg:md-10 xl:md-12">
            <p>
                Several companies across the globe trust our work by using them in their own or customer projects.
            </p>
            <p>
                We are proud to provide value and reusable code to developers all over the world.
            </p>
        </div>

        <div class="grid grid-flow-row grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-8 lg:gap-10 xl:gap-12">
            @foreach($trustees as $trustee)
                <a href="{{ $trustee->website }}" target="_blank" rel="noreferrer" class="block space-y-2 opacity-75 hover:opacity-100">
                    <div class="relative aspect-w-16 aspect-h-9">
                        <div class="w-full h-full absolute inset-0 p-4">
                            <x-elements.imgix
                                source="astrotomic"
                                :path="\Illuminate\Support\Facades\Vite::asset($trustee->image)"
                                :alt="$trustee->name"
                                :width="768"
                                :height="432"
                                :params="['trim' => 'auto']"
                                class="w-full h-full object-contain"
                                trim
                            />
                        </div>
                    </div>
                    <p class="text-center">
                        <strong class="block font-bold">{{ $trustee->name }}</strong>
                        <small class="block text-xs">{{ $trustee->location }}</small>
                    </p>
                </a>
            @endforeach
        </div>
    </x-elements.section-wave>

    <x-elements.copyright before="astro-moonlight"/>
</x-layout>
