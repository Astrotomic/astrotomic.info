<div class="w-full lg:w-1/2 px-4 pb-8">
    <div class="bg-background-lighter p-8 rounded overflow-hidden">
        <h3 class="text-xl mb-1">
            @if($package['name'] === 'astrotomic/countdown-gif')
                <icon icon="fa-stopwatch" icon-style="fas" />
            @elseif($package['name'] === 'astrotomic/ignition-stackoverflow')
                <icon icon="fa-stack-overflow" icon-style="fab" />
            @elseif($package['name'] === 'astrotomic/laravel-cachable-attributes')
                <icon icon="fa-cabinet-filing" icon-style="fas" />
            @elseif($package['name'] === 'astrotomic/laravel-translatable')
                <icon icon="fa-language" icon-style="fas" />
            @elseif($package['name'] === 'astrotomic/stancy')
                <icon icon="fa-rocket" icon-style="fas" />
            @else
                <icon icon="fa-box" icon-style="fas" />
            @endif
            {{ \Illuminate\Support\Str::title(\Illuminate\Support\Str::slug(\Illuminate\Support\Str::after($package['name'], 'astrotomic/'), ' ')) }}
        </h3>
        <div class="mb-2 divided">
            <span>
                <icon icon="fa-code" icon-style="fas opacity-50" />
                {{ $package['language'] }}
            </span>
            <span>
                <icon icon="fa-star" icon-style="fas opacity-50" />
                {{ number_format($package['github_stars'], 0, '', ' ') }}
            </span>
            <span>
                <icon icon="fa-download" icon-style="fas opacity-50" />
                {{ number_format($package['downloads']['total'], 0, '', ' ') }}
            </span>
            <span>
                <icon icon="fa-link" icon-style="fas opacity-50" />
                {{ $package['dependents'] }}
            </span>
            <span>
                <icon icon="fa-user" icon-style="fas opacity-50" />
                {{ number_format(count(data_get($github, $package['name'].'.contributors', [])), 0, '', ' ') }}
            </span>
        </div>
        <p>{{ $package['description'] }}</p>
        <a-styled :href="data_get($package, 'repository')" underlined class="mt-4">
            <icon icon-style="fab" icon="fa-github" />
            {{ \Illuminate\Support\Str::after($package['name'], 'astrotomic/') }}
        </a-styled>
    </div>
</div>
