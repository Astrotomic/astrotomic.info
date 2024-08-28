@env('local')
<img
    src="{{ $path }}"
    loading="lazy"
    {{ $attributes->only(['width', 'height', 'class', 'alt']) }}
/>
@endenv

@production
<x-imgix {{ $attributes }} />
@endproduction
