<header class="hero relative min-h-screen">
    <div class="absolute inset-0">
        <div class="comets comets-1" data-speed="0.4"></div>
        <div class="comets comets-2" data-speed="0.3"></div>
        <div class="comets comets-3" data-speed="0.2"></div>
        <div class="comets comets-4" data-speed="0.5"></div>
    </div>

    <div class="relative z-10 flex flex-col justify-center items-center min-h-screen">
        <x-partials.menu/>

        {!! $slot !!}
    </div>
</header>
