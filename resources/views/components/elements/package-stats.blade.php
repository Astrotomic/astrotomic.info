@props(['package'])
<?php /** @var \App\Models\Package $package */ ?>

<ul class="flex mb-2 divided">
    <li class="flex items-center space-x-1">
        <x-fas-code class="w-4 h-4 opacity-75" />
        <span>{{ $package->language }}</span>
    </li>
    <li class="flex items-center space-x-1">
        <x-fas-star class="w-4 h-4 opacity-75" />
        <span class="tabular-nums">{{ number_format($package->github_stars, 0, '', ' ') }}</span>
    </li>
    <li class="flex items-center space-x-1">
        <x-fas-download class="w-4 h-4 opacity-75" />
        <span class="tabular-nums">{{ number_format($package->total_downloads, 0, '', ' ') }}</span>
    </li>
    <li class="flex items-center space-x-1">
        <x-fas-link class="w-4 h-4 opacity-75" />
        <span class="tabular-nums">{{ $package->dependents }}</span>
    </li>
    <li class="flex items-center space-x-1">
        <x-fas-user class="w-4 h-4 opacity-75" />
        <span class="tabular-nums">{{ number_format($package->contributors()->count(), 0, '', ' ') }}</span>
    </li>
    <li class="flex items-center space-x-1">
        <x-fas-tag class="w-4 h-4 opacity-75" />
        <span>{{ $package->latest_version }}</span>
    </li>
</ul>
