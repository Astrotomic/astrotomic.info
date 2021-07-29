<nav class="sm:absolute top-0 inset-x-0">
    <div class="mx-auto px-4 flex items-center flex-wrap">
        <h1 class="font-semibold text-white text-2xl leading-none tracking-wider py-4 flex-grow">
            <a href="{{ url('/') }}" class="block flex items-center">
                <x-elements.icon icon="fa-user-astronaut" icon-size="text-4xl mr-2" />
                <span>Astrotomic</span>
            </a>
        </h1>

        @foreach($links as $link)
            <a href="{{ $link['href'] }}" class="btn sm:ml-4 w-full sm:w-auto mb-2 sm:mb-0">
                <x-elements.icon :icon-style="$link['style']" :icon="$link['icon']" />
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</nav>
