@props(['contributor'])
<?php /** @var \App\Models\Contributor $contributor */ ?>

<a
    href="{{ route('contributor', $contributor) }}"
    @class([
        'block flex items-center ml-4 mb-4 rounded overflow-hidden translate w-full sm:w-auto',
        'bg-astro-moonlight text-white' => $contributor->is_member,
        'bg-white text-black' => !$contributor->is_member,
    ])
>
    <img
        src="{{ $contributor->avatar_url }}"
        alt="{{ $contributor->login.' Avatar' }}"
        loading="lazy"
        class="w-12 h-12"
    />
    <span class="pl-4 pr-2 flex flex-grow">{{ $contributor->login }}</span>
    <span class="opacity-75 pr-4 tabular-nums">{{ $contributor->total_commits }}</span>
</a>
