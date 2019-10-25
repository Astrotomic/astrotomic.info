<footer>
    <div class="container mx-auto p-4 flex items-center flex-wrap">
        <span class="flex-grow whitespace-no-wrap opacity-50">
            Astrotomic &copy; 2019
            @if(date('Y') > 2019)
                - {{ date('Y') }}
            @endif
        </span>
        <a href="https://join.slack.com/t/astrotomic/shared_invite/enQtNzk2MTgzNDgwODUwLWI4YTJjYTNjNTE1Y2EzNjEwYzEzNTM1MTRjZTFiZWVjM2U4YWY3MjczYzdmYjE2ZmU1ZmMzNGY1NWM1MTM1YTI" class="mr-4 opacity-50 hover:opacity-100 border-b border-dotted border-white">
            <icon icon-style="fab" icon="fa-slack" />
            Slack
        </a>

        <a href="https://github.com/Astrotomic" class="opacity-50 hover:opacity-100 border-b border-dotted border-white">
            <icon icon-style="fab" icon="fa-github" />
            GitHub
        </a>
    </div>
    <div class="container mx-auto p-4">
        <span class="opacity-50">Powered by</span>
        <span class="divided">
            <a href="https://github.com/Astrotomic/stancy" class="opacity-50 hover:opacity-100">Stancy</a>
            <a href="https://www.netlify.com" class="opacity-50 hover:opacity-100">Netlify</a>
            <a href="https://tailwindcss.com" class="opacity-50 hover:opacity-100">tailwindcss</a>
            <a href="https://fontawesome.com" class="opacity-50 hover:opacity-100">Font Awesome</a>
            <a href="https://rsms.me/inter" class="opacity-50 hover:opacity-100">Inter typeface</a>
        </span>
    </div>
</footer>
