<nav class="sm:absolute top-0 inset-x-0 z-50">
    <div class="mx-auto px-4 flex items-center flex-wrap">
        <h1 class="font-semibold text-white text-2xl leading-none tracking-wider py-4">
            <a href="{{ url('/') }}" class="block flex items-center">
                <x-fad-user-astronaut class="w-10 h-10 mr-2"/>
                <span>Astrotomic</span>
            </a>
        </h1>

        <div class="flex-grow"></div>

        @foreach($links as $link)
            <a href="{{ $link['href'] }}" class="btn relative flex items-center rounded py-2 px-4 text-astro-astrotomic bg-white space-x-2 cursor-pointer sm:ml-4 w-full sm:w-auto mb-2 sm:mb-0">
                <x-dynamic-component :component="$link['icon']" class="w-4 h-4"/>
                <span>{{ $link['label'] }}</span>
            </a>
        @endforeach
    </div>
</nav>
