<section class="relative bg-{{ $bg }} {{ $class ?? '' }}">
    <wave class="mb-16" :bg="$bg" :before="$before" />
    <div class="container mx-auto px-4 mb-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8 items-center justify-between">
        <h2 class="text-white text-4xl leading-none">{{ $title }}</h2>
        @isset($badge)
            <div>{!! $badge !!}</div>
        @endisset
    </div>
    <div class="container mx-auto px-4">
        {!! $slot !!}
    </div>
</section>
