<div class="w-full lg:w-1/2 px-4 pb-8">
    <div class="bg-moonlight p-8 rounded overflow-hidden">
        <h3 class="text-xl mb-1">
            @if($package['name'] === 'astrotomic/countdown-gif')
                <icon icon="fa-stopwatch" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/ignition-stackoverflow')
                <icon icon="fa-stack-overflow" icon-style="fab" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-cachable-attributes')
                <icon icon="fa-cabinet-filing" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-translatable')
                <icon icon="fa-language" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/stancy')
                <icon icon="fa-rocket" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-mime')
                <icon icon="fa-file-search" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-guzzle')
                <icon icon="fa-wifi" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-eloquent-uuid')
                <icon icon="fa-fingerprint" icon-style="fas" class="opacity-75" />
            @elseif(in_array($package['name'], ['astrotomic/laravel-unavatar', 'astrotomic/php-unavatar']))
                <icon icon="fa-user-circle" icon-style="fas" class="opacity-75" />
            @elseif(in_array($package['name'], ['astrotomic/laravel-weserv-images', 'astrotomic/php-weserv-images']))
                <icon icon="fa-book-spells" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/php-open-graph')
                <icon icon="fa-share-alt" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/php-conditional-proxy')
                <icon icon="fa-brackets-curly" icon-style="fas" class="opacity-75" />
            @elseif(Illuminate\Support\Str::startsWith($package['name'], 'astrotomic/laravel-dashboard-'))
                <icon icon="fa-tachometer" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/pest-plugin-laravel-snapshots')
                <icon icon="fa-equals" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-auth-recovery-codes')
                <icon icon="fa-key" icon-style="fas" class="opacity-75" />
            @elseif($package['name'] === 'astrotomic/laravel-transaction-proxy')
                <icon icon="fa-undo" icon-style="fas" class="opacity-75" />
            @else
                <icon icon="fa-box" icon-style="fas" class="opacity-75" />
            @endif
            {{ \Illuminate\Support\Str::title(\Illuminate\Support\Str::slug(\Illuminate\Support\Str::after($package['name'], 'astrotomic/'), ' ')) }}
        </h3>
        <package-stats :package="$package" />
        <p>{{ $package['description'] }}</p>
        <a-styled :href="data_get($package, 'repository')" underlined class="mt-4">
            <icon icon-style="fab" icon="fa-github" />
            <span class="hidden sm:inline">
                <cite>astrotomic</cite>
                <span class="opacity-75">/</span>
            </span>
            {{ \Illuminate\Support\Str::after($package['name'], 'astrotomic/') }}
        </a-styled>
    </div>
</div>
