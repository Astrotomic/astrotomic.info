module.exports = {
    mode: 'jit',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                // https://mycolor.space
                sun: '#FFC311',
            },
            fontFamily: {
                sans: "Roboto, sans-serif",
                mono: "'Roboto Mono', monospace",
                flex: "'Roboto Flex', sans-serif",
                slab: "'Roboto Slab', serif",
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('tailwind-astrotomic-colors'),
    ],
};
