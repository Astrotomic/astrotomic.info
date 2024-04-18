<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astrotomic</title>
    <link rel="shortcut icon" type="image/x-icon"
          href="{{ \Illuminate\Support\Facades\Vite::asset('resources/img/favicon.ico') }}"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="antialiased bg-black font-flex text-neutral-400 space-y-8 p-12">

<div class="text-neutral-400 font-mono text-xs">
    {{ date('dmy') }}.{{ date('H') }}
</div>

<h1 class="text-3xl text-white font-sans uppercase font-light tracking-wide">
    Astrotomic
</h1>

<p>
    <strong class="font-sans text-neutral-200">Laravel Translatable</strong>
</p>

<p>
    Minions ipsum poopayee poopayee poopayee hahaha aaaaaah aaaaaah bappleees underweaaar bananaaaa. Tank yuuu! butt wiiiii jiji baboiii me want bananaaa! Poopayee. Wiiiii uuuhhh bananaaaa hana dul sae pepete. Pepete chasy butt jiji tulaliloo jiji bappleees gelatooo bappleees. Butt poulet tikka masala para tú potatoooo wiiiii. Poulet tikka masala po kass uuuhhh daa pepete tulaliloo bappleees.
</p>

<x-new.hr/>

<div class="flex flex-wrap gap-4">
    <button
        type="button"
        class="relative block p-1.5 group"
    >
        <div class="absolute top-0 inset-x-0 w-full border-t border-neutral-400 group-hover:border-neutral-200 transition-colors duration-500 ease-in-out"></div>
        <div class="absolute top-0 inset-x-0 w-full h-1 border-x border-neutral-400 group-hover:border-neutral-200 transition-colors duration-500 ease-in-out"></div>
        <div class="absolute top-1.5 bottom-1.5 inset-x-0 w-full border-x border-neutral-600 group-hover:border-neutral-400 transition-colors duration-500 ease-in-out"></div>
        <div class="absolute bottom-0 inset-x-0 w-full h-1 border-x border-neutral-400 group-hover:border-neutral-200 transition-colors duration-500 ease-in-out"></div>
        <div class="absolute bottom-0 inset-x-0 w-full border-b border-neutral-400 group-hover:border-neutral-200 transition-colors duration-500 ease-in-out"></div>

        <div class="relative bg-neutral-400 text-black py-1 px-8 group-hover:bg-neutral-200 transition-colors duration-500 ease-in-out">
            <div class="absolute top-px left-px -z-10 w-full h-full bg-neutral-600 group-hover:bg-neutral-400 group-hover:top-0.5 group-hover:left-0.5 transition-all duration-500 ease-in-out"></div>
            <span>Button</span>
        </div>
    </button>
    <x-new.button color="red">Button</x-new.button>
    <x-new.button color="orange">Button</x-new.button>
    <x-new.button color="amber">Button</x-new.button>
    <x-new.button color="yellow">Button</x-new.button>
    <x-new.button color="lime">Button</x-new.button>
    <x-new.button color="green">Button</x-new.button>
    <x-new.button color="emerald">Button</x-new.button>
    <x-new.button color="teal">Button</x-new.button>
    <x-new.button color="cyan">Button</x-new.button>
    <x-new.button color="sky">Button</x-new.button>
    <x-new.button color="blue">Button</x-new.button>
    <x-new.button color="indigo">Button</x-new.button>
    <x-new.button color="violet">Button</x-new.button>
    <x-new.button color="purple">Button</x-new.button>
    <x-new.button color="fuchsia">Button</x-new.button>
    <x-new.button color="pink">Button</x-new.button>
    <x-new.button color="rose">Button</x-new.button>
</div>

<section
    class="relative bg-cover bg-center"
    style="background-image: url({{ \Illuminate\Support\Facades\Vite::asset('resources/img/new/nebula_nexus.jpg') }});"
>
    <div class="bg-black/75 backdrop-blur-md p-4">
        <p>
            <strong class="font-sans text-neutral-200">Laravel Translatable</strong>
        </p>
        <p>
            Minions ipsum poopayee poopayee poopayee hahaha aaaaaah aaaaaah bappleees underweaaar bananaaaa. Tank yuuu! butt wiiiii jiji baboiii me want bananaaa! Poopayee. Wiiiii uuuhhh bananaaaa hana dul sae pepete. Pepete chasy butt jiji tulaliloo jiji bappleees gelatooo bappleees. Butt poulet tikka masala para tú potatoooo wiiiii. Poulet tikka masala po kass uuuhhh daa pepete tulaliloo bappleees.
        </p>
        <p>
            Minions ipsum poopayee poopayee poopayee hahaha aaaaaah aaaaaah bappleees underweaaar bananaaaa. Tank yuuu! butt wiiiii jiji baboiii me want bananaaa! Poopayee. Wiiiii uuuhhh bananaaaa hana dul sae pepete. Pepete chasy butt jiji tulaliloo jiji bappleees gelatooo bappleees. Butt poulet tikka masala para tú potatoooo wiiiii. Poulet tikka masala po kass uuuhhh daa pepete tulaliloo bappleees.
        </p>
        <p>
            Minions ipsum poopayee poopayee poopayee hahaha aaaaaah aaaaaah bappleees underweaaar bananaaaa. Tank yuuu! butt wiiiii jiji baboiii me want bananaaa! Poopayee. Wiiiii uuuhhh bananaaaa hana dul sae pepete. Pepete chasy butt jiji tulaliloo jiji bappleees gelatooo bappleees. Butt poulet tikka masala para tú potatoooo wiiiii. Poulet tikka masala po kass uuuhhh daa pepete tulaliloo bappleees.
        </p>
    </div>
</section>

<div class="grid grid-cols-2 gap-4">
    <section class="grid grid-cols-3 group overflow-hidden">
        <div class="overflow-hidden">
            <img
                src="{{ \Illuminate\Support\Facades\Vite::asset('resources/img/new/spaceship.jpg') }}"
                class="w-full h-full object-cover scale-110 blur-sm group-hover:scale-100 group-hover:blur-0 transition-all duration-500 ease-in-out"
            />
        </div>
        <div class="col-span-2 px-2 py-4 bg-neutral-950 flex flex-col">
            <div class="flex-grow">
                <h3 class="text-xl text-white font-sans uppercase font-light tracking-wide mb-2">
                    Laravel Translatable
                </h3>
                <x-new.hr/>
                <p class="mt-4">Minions ipsum poopayee poopayee poopayee hahaha aaaaaah aaaaaah bappleees underweaaar bananaaaa. Tank yuuu! butt wiiiii jiji baboiii me want bananaaa!</p>
            </div>
            <x-new.button color="fuchsia">Button</x-new.button>
        </div>
    </section>
</div>

</body>
</html>
