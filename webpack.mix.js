const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/filter.js', 'public/js')
    .js('resources/js/stats.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options ({
        processCssUrls: false,
    })
    .browserSync({
        proxy: 'http://127.0.0.1:8000',
        open: false,
        watch: true,
        notify: false,
        ui: false
    });
