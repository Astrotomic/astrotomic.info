<x-layout>
    <x-hero>
        <div class="container mx-auto px-4 pt-4 pb-16 sm:py-32">
            <img src="{{ $contributor->avatar_url }}" alt="{{ $contributor->login.' Avatar' }}" class="mx-auto w-64 h-64 rounded" />

            <h2 class="flex items-center justify-center mt-2 text-4xl font-bold text-white sm:text-5xl">
                <span>{{ $contributor->name ?? $contributor->login }}</span>
                <x-elements.a :href="$contributor->html_url" class="p-1 ml-1">
                    <x-fab-github class="w-8 h-8"/>
                </x-elements.a>
            </h2>

            <ul class="flex flex-col justify-center my-2 mx-auto space-y-2 space-x-0 list-inline md:max-w-2xl sm:space-x-4 sm:space-y-0 sm:flex-row">
                @if($contributor->location)
                    <li class="flex items-center space-x-1">
                        <x-fas-location-dot class="w-4 h-4 opacity-75" />
                        <span>{{ $contributor->location }}</span>
                    </li>
                @endif
                @if($contributor->website)
                    <li class="flex items-center space-x-1">
                        <x-fas-globe class="w-4 h-4 opacity-75" />
                        <x-elements.a :href="$contributor->website" underlined>
                            {{ parse_url($contributor->website, PHP_URL_HOST) }}
                        </x-elements.a>
                    </li>
                @endif
                @if($contributor->twitter_username)
                    <li class="flex items-center space-x-1">
                        <x-fab-twitter class="w-4 h-4 opacity-75" />
                        <x-elements.a :href="$contributor->twitter_url" underlined>
                            {{ '@'.$contributor->twitter_username }}
                        </x-elements.a>
                    </li>
                @endif
            </ul>

            @if($contributor->bio)
                <div class="py-2 mx-auto mt-2 text-2xl md:max-w-3xl text-center">
                    {{ $contributor->bio }}
                </div>
            @endif

            <div class="flex items-center justify-center">
                <a href="{{ 'https://opendor.me/@'.$contributor->login }}" class="btn relative flex items-center rounded py-2 px-4 text-astro-astrotomic bg-white space-x-2 cursor-pointer">
                    <x-fas-door-open class="w-4 h-4" />
                    <span>opendor.me</span>
                </a>
            </div>

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-3 justify-center pt-16 mx-auto">
                <x-count-up icon="fad-box-heart" :value="$contributor->packages()->count()" label="packages"/>
                <x-count-up icon="fad-laptop-code" :value="$contributor->applications()->count()" label="applications"/>
                <x-count-up icon="fad-code-commit" :value="$contributor->total_commits" label="commits"/>
            </div>
        </div>
    </x-hero>

    <section class="container mx-auto px-4 mb-16 space-y-8">
        @foreach($contributor->applications() as $app)
            <x-app-promo :app="$app"/>
        @endforeach
    </section>

    <section class="container mx-auto grid grid-cols-1 lg:grid-cols-2">
        @foreach($contributor->packages()->sortByDesc('total_downloads') as $package)
            <x-package :package="$package" />
        @endforeach
    </section>

    <x-elements.copyright/>
</x-layout>>
