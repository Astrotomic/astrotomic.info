<div class="{{ $bgColor }} rounded-lg flex flex-col lg:flex-row overflow-hidden mb-16">
    <div class="w-full lg:w-1/2 lg:ml-8 lg:mt-8 lg:self-end">
        <picture>
            <source srcset="{{ image($image, 'webp', 768) }}" type="image/webp">
            <img src="{{ image($image, 'jpg', 768) }}" class="rounded-t" alt="Astrotomic {{ $label }} Logo" />
        </picture>
    </div>
    <div class="w-full lg:w-1/2 p-8 flex flex-col">
        <h2 class="text-white text-3xl mb-3">{{ $label }}</h2>
        <p class="flex-grow">{!! $slot !!}</p>
        <a href="https://github.com/{{ $project }}" class="btn mt-4 self-start">
            <icon icon-style="fab" icon="fa-github" />
            {{ strtolower($project) }}
        </a>
    </div>
</div>