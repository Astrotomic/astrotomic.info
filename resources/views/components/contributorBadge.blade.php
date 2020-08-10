<a
    href="{{ route('contributor', [ 'name' => strtolower($contributor['login']) ]) }}"
    class="
        block flex items-center ml-4 mb-4 rounded overflow-hidden translate
        w-full sm:w-auto
        @if(in_array($contributor['id'], [6187884, 1785686]))
            bg-moonlight text-white
        @else
            bg-white text-black
        @endif
    "
>
    <imgix :src="$contributor['avatar_url']" width="48" height="48" ratio="1:1" :alt="$contributor['login'].' Avatar'" class="w-12 h-12" />
    <span class="pl-4 pr-2 flex flex-grow">{{ $contributor['login'] }}</span>
    <span class="opacity-75 pr-4 tabular-nums">{{ $contributor['commits'] }}</span>
</a>
