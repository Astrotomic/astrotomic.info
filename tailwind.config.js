module.exports = {
    mode: 'jit',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    safelist: [
        {pattern: /^bg-astro-/},
        {pattern: /^text-astro-/},
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                // https://mycolor.space
                sun: '#FFC311',
            },
            fontFamily: {
                sans: "Inter, sans-serif",
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('tailwind-astrotomic-colors'),
    ],
};
