@env('local')
<img
    src="{{ $path }}"
    loading="lazy"
    {{ $attributes->only(['width', 'height', 'class', 'alt']) }}
/>
@endenv

@env('prod')
<x-imgix {{ $attributes }} />
@endenv
