<footer>
    <div class="container mx-auto p-4 flex items-center flex-wrap">
        <span class="flex-grow whitespace-no-wrap opacity-50">
            Astrotomic &copy; 2019
            @if(date('Y') > 2019)
                - {{ date('Y') }}
            @endif
        </span>

        <a-styled href="https://join.slack.com/t/astrotomic/shared_invite/enQtNzk2MTgzNDgwODUwLWI4YTJjYTNjNTE1Y2EzNjEwYzEzNTM1MTRjZTFiZWVjM2U4YWY3MjczYzdmYjE2ZmU1ZmMzNGY1NWM1MTM1YTI" underlined class="mr-4">
            <icon icon-style="fab" icon="fa-slack" />
            Slack
        </a-styled>
        <a-styled href="https://github.com/Astrotomic" underlined>
            <icon icon-style="fab" icon="fa-github" />
            GitHub
        </a-styled>
    </div>
    <div class="container mx-auto p-4">
        <span class="opacity-50">Powered by</span>
        <span class="divided">
            <a-styled href="https://github.com/Astrotomic/stancy">Stancy</a-styled>
            <a-styled href="https://www.netlify.com">Netlify</a-styled>
            <a-styled href="https://tailwindcss.com">tailwindcss</a-styled>
            <a-styled href="https://fontawesome.com">Font Awesome</a-styled>
            <a-styled href="https://rsms.me/inter">Inter</a-styled>
        </span>
    </div>
</footer>
