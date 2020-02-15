<a
    href="{{ route('contributor', [ 'name' => strtolower($contributor['login']) ]) }}"
    class="
        block flex items-center ml-4 mb-4 rounded overflow-hidden translate
        w-full sm:w-auto
        @if(in_array($contributor['id'], [6187884, 1785686]))
            bg-background-lighter text-white
        @else
            bg-white text-black
        @endif
    "
>
    <img src="https://images.weserv.nl?il&w=96&output=jpg&url={{ urlencode($contributor['avatar_url']) }}" alt="{{ $contributor['login'] }} Avatar" class="w-12 h-12" />
    <span class="pl-4 pr-2 flex flex-grow">{{ $contributor['login'] }}</span>
    <span class="opacity-50 pr-4">{{ $contributor['commits'] }}</span>
</a>
