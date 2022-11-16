<div class="w-full">
    <div class="flex justify-center mb-4">
        <x-dynamic-component :component="$icon" class="w-24 h-24 text-white"/>
    </div>
    <strong class="block text-4xl text-white tabular-nums text-center" data-count-up="{{ $value }}">{{ $value }}</strong>
    <span class="block text-white opacity-75 text-xl text-center">{{ $label }}</span>
</div>
