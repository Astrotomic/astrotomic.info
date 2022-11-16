@props(['package'])
<?php /** @var \App\Models\Package $package */ ?>

<div class="px-4 pb-8">
    <div @class([
        'flex flex-col p-8 rounded overflow-hidden h-full',
        'bg-astro-astrotomic' => !$package->is_abandoned,
        'bg-astro-moonlight' => $package->is_abandoned,
    ])>
        <h3 class="text-xl mb-1 flex items-center space-x-2">
            <x-dynamic-component :component="$package->icon" class="w-6 h-6 opacity-75"/>
            <span>{{ $package->label }}</span>
        </h3>

        <x-elements.package-stats :package="$package" />

        <p class="flex-grow">
            {{ $package->description }}
        </p>

        <x-elements.a :href="$package->repository" underlined class="mt-4 max-w-max flex items-center space-x-1">
            <x-fab-github class="w-4 h-4" />
            <span>
                <span class="hidden sm:inline">
                    <cite>{{ explode('/', $package->name, 2)[0] }}</cite>
                    <span class="opacity-75">/</span>
                </span>
                <span>{{ explode('/', $package->name, 2)[1] }}</span>
            </span>
        </x-elements.a>
    </div>
</div>
