<div class="w-full lg:w-1/2 px-4 pb-8">
    <div class="bg-astro-moonlight p-8 rounded overflow-hidden">
        <h3 class="text-xl mb-1">
            @if($package['name'] === 'astrotomic/countdown-gif')
                <x-elements.icon icon="fa-stopwatch" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/ignition-stackoverflow')
                <x-elements.icon icon="fa-stack-overflow" icon-style="fab" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-cachable-attributes')
                <x-elements.icon icon="fa-cabinet-filing" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-translatable')
                <x-elements.icon icon="fa-language" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/stancy')
                <x-elements.icon icon="fa-rocket" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-mime')
                <x-elements.icon icon="fa-file-search" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-guzzle')
                <x-elements.icon icon="fa-wifi" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-eloquent-uuid')
                <x-elements.icon icon="fa-fingerprint" icon-style="fas" class="opacity-75" />
            @elseif(in_array($package['name'], ['astrotomic/laravel-unavatar', 'astrotomic/php-unavatar']))
                <x-elements.icon icon="fa-user-circle" icon-style="fas" class="opacity-75" />
            @elseif(in_array($package['name'], ['astrotomic/laravel-weserv-images', 'astrotomic/php-weserv-images']))
                <x-elements.icon icon="fa-book-spells" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/php-open-graph')
                <x-elements.icon icon="fa-share-alt" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/php-conditional-proxy')
                <x-elements.icon icon="fa-brackets-curly" icon-style="fas" class="opacity-75" />
            @elseif(Illuminate\Support\Str::startsWith($package['name'], 'astrotomic/laravel-dashboard-'))
                <x-elements.icon icon="fa-tachometer" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/pest-plugin-laravel-snapshots')
                <x-elements.icon icon="fa-equals" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-auth-recovery-codes')
                <x-elements.icon icon="fa-key" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-transaction-proxy')
                <x-elements.icon icon="fa-undo" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/php-twemoji')
                <x-elements.icon icon="fa-grin-stars" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-fileable')
                <x-elements.icon icon="fa-file-plus" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/phpunit-assertions')
                <x-elements.icon icon="fa-vial" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/psr-8')
                <x-elements.icon icon="fa-heart" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-vcard')
                <x-elements.icon icon="fa-address-card" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-webmentions')
                <x-elements.icon icon="fa-blog" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-imgix')
                <x-elements.icon icon="fa-image" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/iso639')
                <x-elements.icon icon="fa-language" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'linfo/laravel')
                <x-elements.icon icon="fa-monitor-heart-rate" icon-style="fas" class="opacity-75" />
            @else
                <x-elements.icon icon="fa-box" icon-style="fas" class="opacity-75" />
            @endif
            {{
                [
                    'linfo/laravel' => 'Laravel Linfo',
                    'astrotomic/iso639' => 'ISO 639',
                ][$package['name']] ?? \Illuminate\Support\Str::title(\Illuminate\Support\Str::slug(\Illuminate\Support\Str::after($package['name'], 'astrotomic/'), ' '))
            }}
        </h3>
        <x-elements.packageStats :package="$package" />
        <p>{{ $package['description'] }}</p>
        <x-elements.aStyled :href="data_get($package, 'repository')" underlined class="mt-4">
            <x-elements.icon icon-style="fab" icon="fa-github" />
            <span class="hidden sm:inline">
                <cite>{{ explode('/', $package['name'], 2)[0] }}</cite>
                <span class="opacity-75">/</span>
            </span>
            {{ explode('/', $package['name'], 2)[1] }}
        </x-elements.aStyled>
    </div>
</div>
