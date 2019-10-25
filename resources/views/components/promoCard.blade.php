<div class="{{ $bgColor }} rounded-lg flex flex-col lg:flex-row overflow-hidden mb-16">
    <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
        <picture>
            <source srcset="{!! image($image, 'webp', 768) !!}" type="image/webp">
            <img src="{!! image($image, 'jpg', 768) !!}" class="rounded-t" alt="Astrotomic {{ $label }} Logo" />
        </picture>
    </div>
    <div class="w-full lg:w-1/2 p-8 flex flex-col">
        <h2 class="text-white text-3xl">{{ $label }}</h2>
        <div class="mb-2 divided">
            <span>
                <icon icon="fa-code" icon-style="fas opacity-50" />
                {{ data_get($packagist, $project.'.language') }}
            </span>
            <span>
                <icon icon="fa-star" icon-style="fas opacity-50" />
                {{ number_format(data_get($packagist, $project.'.github_stars'), 0, '', ' ') }}
            </span>
            <span>
                <icon icon="fa-download" icon-style="fas opacity-50" />
                {{ number_format(data_get($packagist, $project.'.downloads.total'), 0, '', ' ') }}
            </span>
            <span>
                <icon icon="fa-link" icon-style="fas opacity-50" />
                {{ data_get($packagist, $project.'.dependents') }}
            </span>
        </div>
        <p class="flex-grow">{!! $slot !!}</p>
        <a href="{{ data_get($packagist, $project.'.repository') }}" class="btn mt-4 self-start">
            <icon icon-style="fab" icon="fa-github" />
            {{ $project }}
        </a>
    </div>
</div>