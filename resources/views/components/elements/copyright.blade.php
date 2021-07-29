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
                <x-elements.aStyled href="https://gummibeer.de">Gummibeer</x-elements.aStyled>
            </span>
        </span>

        @foreach($links as $link)
            <x-elements.aStyled :href="$link['href']" underlined class="ml-4">
                <x-elements.icon :icon-style="$link['style']" :icon="$link['icon']" />
                {{ $link['label'] }}
            </x-elements.aStyled>
        @endforeach
    </div>
    <div class="container mx-auto p-4">
        <span class="opacity-75">Powered by</span>
        <span class="divided">
            <x-elements.aStyled href="https://github.com/Astrotomic/stancy">Stancy</x-elements.aStyled>
            <x-elements.aStyled href="https://netlify.com">Netlify</x-elements.aStyled>
            <x-elements.aStyled href="https://tailwindcss.com">tailwindcss</x-elements.aStyled>
            <x-elements.aStyled href="https://fontawesome.com">Font Awesome</x-elements.aStyled>
            <x-elements.aStyled href="https://rsms.me/inter">Inter</x-elements.aStyled>
            <x-elements.aStyled href="https://pingping.io/fvpd1bEn">PingPing</x-elements.aStyled>
        </span>
    </div>
</footer>
