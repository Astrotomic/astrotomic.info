<footer>
    @isset($before)
        <x-elements.wave :before="$before" bg="astro-night" class="mb-8" />
    @endisset

    <div class="container mx-auto p-4 flex items-center flex-wrap">
        <span class="flex-grow">
            <span class="whitespace-no-wrap opacity-75">
                Astrotomic &copy; 2019 - {{ date('Y') }}
            </span>
            <span class="whitespace-no-wrap">
                <span class="opacity-75">created by</span>
                <x-elements.a href="https://gummibeer.de">Gummibeer</x-elements.a>
            </span>
        </span>

        @foreach($links as $link)
            <x-elements.a :href="$link['href']" underlined class="ml-4 flex space-x-1 items-center">
                <x-dynamic-component :component="$link['icon']" class="w-4 h-4"/>
                <span>{{ $link['label'] }}</span>
            </x-elements.a>
        @endforeach
    </div>
    <div class="container mx-auto p-4">
        <span class="opacity-75">Powered by</span>
        <span class="divided">
            <x-elements.a href="https://hetzner.cloud?ref=hWUvpaHHnyQM">Hetzner Cloud</x-elements.a>
            <x-elements.a href="https://tailwindcss.com">Tailwind CSS</x-elements.a>
            <x-elements.a href="https://fontawesome.com">Font Awesome</x-elements.a>
            <x-elements.a href="https://rsms.me/inter">Inter</x-elements.a>
            <x-elements.a href="https://pingping.io/fvpd1bEn">PingPing</x-elements.a>
            <x-elements.a href="https://brandfetch.com/astrotomic.info">Brandfetch</x-elements.a>
        </span>
    </div>
</footer>
