@props(['package'])
<?php /** @var \App\Models\Package $package */ ?>

<div class="bg-[{{ $package->color }}] rounded-lg flex flex-col lg:flex-row overflow-hidden mb-16">
    <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
        <x-imgix
            source="astrotomic"
            :path="\Illuminate\Support\Facades\Vite::asset($package->image)"
            width="768"
            :alt="'Astrotomic '.$package->label.' Logo'"
            class="rounded-t"
        />
    </div>

    <div class="w-full lg:w-1/2 p-8 flex flex-col">
        <h2 class="text-white text-3xl">
            {{ $package->label }}
        </h2>

        <x-elements.package-stats :package="$package" />

        <p class="flex-grow">
            {{ $package->summary }}
        </p>

        <div class="w-full flex justify-between mt-4 self-start space-x-4">
            <a href="{{ $package->repository }}" class="btn relative flex items-center rounded py-2 px-4 bg-white space-x-2 cursor-pointer text-[{{ $package->color }}]">
                <x-fab-github class="w-4 h-4"/>
                <span>{{ \Illuminate\Support\Str::after($package->name, '/') }}</span>
            </a>
            <a href="https://plant.treeware.earth/{{ $package->repository_name }}" class="btn relative flex items-center rounded py-2 px-4 bg-white space-x-2 cursor-pointer text-[{{ $package->color }}]">
                <x-fas-trees class="w-4 h-4"/>
                <span class="hidden sm:inline">treeware</span>
            </a>
        </div>
    </div>
</div>
