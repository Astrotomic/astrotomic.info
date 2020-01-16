<a
    href="{{ route('contributor', [ 'name' => strtolower($contributor['login']) ]) }}"
    class="
        block flex items-center ml-4 mb-4 rounded overflow-hidden translate
        @if(in_array($contributor['id'], [6187884, 1785686]))
            bg-background-lighter text-white
        @else
            bg-white text-black
        @endif
    "
>
    <img src="https://images.weserv.nl?il&w=96&output=jpg&url={{ urlencode($contributor['avatar_url']) }}" alt="{{ $contributor['login'] }} Avatar" class="w-12 h-12" />
    <span class="px-4">
        {{ $contributor['login'] }}
        <span class="opacity-50">{{ $contributor['commits'] }}</span>
    </span>
</a>
