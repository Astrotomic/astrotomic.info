<a href="{!! $href !!}" class="
    inline-block opacity-75 hover:opacity-100
    @isset($underlined) border-b border-dotted border-white @endif
    {{ $class ?? '' }}
">
    {!! $slot !!}
</a>
