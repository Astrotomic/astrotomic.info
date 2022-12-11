@props(['app'])
<?php /** @var \App\Models\Application $app */ ?>

<div
    class="bg-[{{ $app->color }}] rounded-lg flex flex-col lg:flex-row overflow-hidden"
    app-class="
        bg-[#28A745] text-[#28A745]
        bg-[#FF7A81] text-[#FF7A81]
    "
>
    <div class="w-full lg:w-1/2 2xl:w-2/5 lg:ml-8 lg:mt-8 lg:self-end">
        <x-elements.imgix
            source="astrotomic"
            :path="\Illuminate\Support\Facades\Vite::asset($app->image)"
            width="768"
            :alt="'Astrotomic '.$app->label.' Logo'"
            class="rounded-t"
        />
    </div>

    <div class="w-full lg:w-1/2 2xl:w-3/5 p-8 flex flex-col">
        <h2 class="text-white text-3xl">
            {{ $app->label }}
        </h2>

        <ul class="flex mb-2 divided">
            <li class="flex items-center space-x-1">
                <x-fas-code class="w-4 h-4 opacity-75" />
                <span>{{ $app->language }}</span>
            </li>
            <li class="flex items-center space-x-1">
                <x-fas-star class="w-4 h-4 opacity-75" />
                <span class="tabular-nums">{{ number_format($app->github_stars, 0, '', ' ') }}</span>
            </li>
            <li class="flex items-center space-x-1">
                <x-fas-user class="w-4 h-4 opacity-75" />
                <span class="tabular-nums">{{ number_format($app->contributors()->count(), 0, '', ' ') }}</span>
            </li>
        </ul>

        <p class="flex-grow">
            {{ $app->summary }}
        </p>

        <div class="w-full flex justify-between mt-4 self-start space-x-4">
            <a href="{{ $app->homepage }}" class="btn relative flex items-center rounded py-2 px-4 bg-white space-x-2 cursor-pointer text-[{{ $app->color }}]">
                <x-fas-link class="w-4 h-4"/>
                <span>{{ $app->domain }}</span>
            </a>

            <div class="flex space-x-4">
                <a href="{{ $app->repository }}" class="btn relative flex items-center rounded py-2 px-4 bg-white space-x-2 cursor-pointer text-[{{ $app->color }}]">
                    <x-fab-github class="w-4 h-4"/>
                    <span>{{ \Illuminate\Support\Str::after($app->name, '/') }}</span>
                </a>
                <a href="https://plant.treeware.earth/{{ $app->name }}" class="btn relative flex items-center rounded py-2 px-4 bg-white space-x-2 cursor-pointer text-[{{ $app->color }}]">
                    <x-fas-trees class="w-4 h-4"/>
                    <span class="hidden sm:inline">treeware</span>
                </a>
            </div>
        </div>
    </div>
</div>
