const mix = require('laravel-mix');
require('laravel-mix-purgecss');
const glob = require('glob');
const path = require('path');

Mix.listen('configReady', webpackConfig => {
    webpackConfig.module.rules.forEach(rule => {
        if (Array.isArray(rule.use)) {
            rule.use.forEach(ruleUse => {
                if (ruleUse.loader === 'resolve-url-loader') {
                    ruleUse.options.engine = 'postcss';
                }
            });
        }
    });
});

mix
    .sass('resources/assets/scss/app.scss', 'css')
    .babel('resources/assets/js/app.js', 'public/js/app.js')
    .copy('resources/assets/img/favicon.ico', 'public/favicon.ico')
    .webpackConfig({
        module: {
            rules: [{
                test: /\.svg$/,
                use: [{
                    loader: 'svgo-loader',
                    options: {
                        plugins: [
                            {removeTitle: true},
                            {convertColors: {shorthex: false}},
                            {convertPathData: false}
                        ]
                    }
                }]
            }]
        }
    })
    .options({
        processCssUrls: true,
        postCss: [
            require('tailwindcss')('./tailwind.config.js'),
            require('postcss-discard-comments')({
                removeAll: true,
            }),
        ],
    })
    .purgeCss({
        whitelistPatterns: [
            /body-home/,
            /-night/,
            /-moonlight/,
            /-astrotomic/,
            /-treeware/,
            /-mit/,
            /-larabelles/,
            /-sponsors/,
        ]
    })
    .version()
;

glob.sync(path.resolve(__dirname, 'resources', 'assets', 'img') + '/**/*.@(png|jpg|svg)').forEach(img => {
    mix.copy(img, img.replace(path.resolve(__dirname, 'resources', 'assets', 'img'), 'public/images'));
});
