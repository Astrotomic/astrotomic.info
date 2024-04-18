@props(['color'])

<!--
border-red-800 group-hover/button:border-red-600 border-red-950 group-hover/button:border-red-900 bg-red-800 group-hover/button:bg-red-600 bg-red-950 group-hover/button:bg-red-900
border-orange-800 group-hover/button:border-orange-600 border-orange-950 group-hover/button:border-orange-900 bg-orange-800 group-hover/button:bg-orange-600 bg-orange-950 group-hover/button:bg-orange-900
border-amber-800 group-hover/button:border-amber-600 border-amber-950 group-hover/button:border-amber-900 bg-amber-800 group-hover/button:bg-amber-600 bg-amber-950 group-hover/button:bg-amber-900
border-yellow-800 group-hover/button:border-yellow-600 border-yellow-950 group-hover/button:border-yellow-900 bg-yellow-800 group-hover/button:bg-yellow-600 bg-yellow-950 group-hover/button:bg-yellow-900
border-lime-800 group-hover/button:border-lime-600 border-lime-950 group-hover/button:border-lime-900 bg-lime-800 group-hover/button:bg-lime-600 bg-lime-950 group-hover/button:bg-lime-900
border-green-800 group-hover/button:border-green-600 border-green-950 group-hover/button:border-green-900 bg-green-800 group-hover/button:bg-green-600 bg-green-950 group-hover/button:bg-green-900
border-emerald-800 group-hover/button:border-emerald-600 border-emerald-950 group-hover/button:border-emerald-900 bg-emerald-800 group-hover/button:bg-emerald-600 bg-emerald-950 group-hover/button:bg-emerald-900
border-teal-800 group-hover/button:border-teal-600 border-teal-950 group-hover/button:border-teal-900 bg-teal-800 group-hover/button:bg-teal-600 bg-teal-950 group-hover/button:bg-teal-900
border-cyan-800 group-hover/button:border-cyan-600 border-cyan-950 group-hover/button:border-cyan-900 bg-cyan-800 group-hover/button:bg-cyan-600 bg-cyan-950 group-hover/button:bg-cyan-900
border-sky-800 group-hover/button:border-sky-600 border-sky-950 group-hover/button:border-sky-900 bg-sky-800 group-hover/button:bg-sky-600 bg-sky-950 group-hover/button:bg-sky-900
border-blue-800 group-hover/button:border-blue-600 border-blue-950 group-hover/button:border-blue-900 bg-blue-800 group-hover/button:bg-blue-600 bg-blue-950 group-hover/button:bg-blue-900
border-indigo-800 group-hover/button:border-indigo-600 border-indigo-950 group-hover/button:border-indigo-900 bg-indigo-800 group-hover/button:bg-indigo-600 bg-indigo-950 group-hover/button:bg-indigo-900
border-violet-800 group-hover/button:border-violet-600 border-violet-950 group-hover/button:border-violet-900 bg-violet-800 group-hover/button:bg-violet-600 bg-violet-950 group-hover/button:bg-violet-900
border-purple-800 group-hover/button:border-purple-600 border-purple-950 group-hover/button:border-purple-900 bg-purple-800 group-hover/button:bg-purple-600 bg-purple-950 group-hover/button:bg-purple-900
border-fuchsia-800 group-hover/button:border-fuchsia-600 border-fuchsia-950 group-hover/button:border-fuchsia-900 bg-fuchsia-800 group-hover/button:bg-fuchsia-600 bg-fuchsia-950 group-hover/button:bg-fuchsia-900
border-pink-800 group-hover/button:border-pink-600 border-pink-950 group-hover/button:border-pink-900 bg-pink-800 group-hover/button:bg-pink-600 bg-pink-950 group-hover/button:bg-pink-900
border-rose-800 group-hover/button:border-rose-600 border-rose-950 group-hover/button:border-rose-900 bg-rose-800 group-hover/button:bg-rose-600 bg-rose-950 group-hover/button:bg-rose-900
-->
<button
    type="button"
    class="relative block p-1.5 group/button min-w-40"
>
    <div class="absolute top-0 inset-x-0 w-full border-t border-{{ $color }}-800 group-hover/button:border-{{ $color }}-600 transition-colors duration-500 ease-in-out"></div>
    <div class="absolute top-0 inset-x-0 w-full h-1 border-x border-{{ $color }}-800 group-hover/button:border-{{ $color }}-600 transition-colors duration-500 ease-in-out"></div>
    <div class="absolute top-1.5 bottom-1.5 inset-x-0 w-full border-x border-{{ $color }}-950 group-hover/button:border-{{ $color }}-900 transition-colors duration-500 ease-in-out"></div>
    <div class="absolute bottom-0 inset-x-0 w-full h-1 border-x border-{{ $color }}-800 group-hover/button:border-{{ $color }}-600 transition-colors duration-500 ease-in-out"></div>
    <div class="absolute bottom-0 inset-x-0 w-full border-b border-{{ $color }}-800 group-hover/button:border-{{ $color }}-600 transition-colors duration-500 ease-in-out"></div>

    <div class="relative bg-{{ $color }}-800 text-white py-1 px-8 group-hover/button:bg-{{ $color }}-600 transition-colors duration-500 ease-in-out">
        <div class="absolute top-px left-px -z-10 w-full h-full bg-{{ $color }}-950 group-hover/button:bg-{{ $color }}-900 group-hover/button:top-0.5 group-hover/button:left-0.5 transition-all duration-500 ease-in-out"></div>
        <span>{{ $slot }}</span>
    </div>
</button>
