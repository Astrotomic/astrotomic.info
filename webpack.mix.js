const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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
    .copy('resources/assets/img/stancy.min.jpg', 'public/images/stancy.min.jpg')
    .copy('resources/assets/img/translatable.min.jpg', 'public/images/translatable.min.jpg')
    .copy('resources/assets/img/social.min.jpg', 'public/images/social.min.jpg')
    .copy('resources/assets/img/logo.min.jpg', 'public/images/logo.min.jpg')
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
        ]
    })
    .version()
;
