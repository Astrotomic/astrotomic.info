<div class="{{ $bgColor }} rounded-lg flex flex-col lg:flex-row overflow-hidden mb-16">
    <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
        {{ picture(weserv(mix($image))->w(768), 'rounded-t', "Astrotomic {$label} Logo") }}
    </div>
    <div class="w-full lg:w-1/2 p-8 flex flex-col">
        <h2 class="text-white text-3xl">{{ $label }}</h2>
        <package-stats :package="data_get($packagist, $project)" />
        <p class="flex-grow">{!! $slot !!}</p>
        <div class="flex mt-4 self-start">
            <a href="{{ data_get($packagist, $project.'.repository') }}" class="btn">
                <icon icon-style="fab" icon="fa-github" />
                {{ \Illuminate\Support\Str::after($project, 'astrotomic/') }}
            </a>
            <a href="https://docs.astrotomic.info/{{ \Illuminate\Support\Str::after($project, 'astrotomic/') }}" class="btn ml-4">
                <icon icon-style="fas" icon="fa-book" />
                <span class="hidden sm:inline">documentation</span>
            </a>
        </div>
    </div>
</div>
