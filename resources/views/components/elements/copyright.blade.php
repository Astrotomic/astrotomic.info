<footer>
    <div class="container mx-auto p-4 flex items-center flex-wrap">
        <span class="flex-grow">
            <span class="whitespace-no-wrap opacity-50">
            Astrotomic &copy; 2019
            @if(date('Y') > 2019)
                - {{ date('Y') }}
            @endif
            </span>
            <span class="whitespace-no-wrap">
                <span class="opacity-50">created by</span>
                <a-styled href="https://gummibeer.de">Gummibeer</a-styled>
            </span>
        </span>

        @foreach($links as $link)
            <a-styled :href="$link['href']" underlined class="ml-4">
                <icon :icon-style="$link['style']" :icon="$link['icon']" />
                {{ $link['label'] }}
            </a-styled>
        @endforeach
    </div>
    <div class="container mx-auto p-4">
        <span class="opacity-50">Powered by</span>
        <span class="divided">
            <a-styled href="https://github.com/Astrotomic/stancy">Stancy</a-styled>
            <a-styled href="https://netlify.com">Netlify</a-styled>
            <a-styled href="https://tailwindcss.com">tailwindcss</a-styled>
            <a-styled href="https://fontawesome.com">Font Awesome</a-styled>
            <a-styled href="https://rsms.me/inter">Inter</a-styled>
        </span>
    </div>
</footer>
