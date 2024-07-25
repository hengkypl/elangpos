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
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .styles([
        'public/stisla-assets/css/style.css',
        'public/stisla-assets/css/components.css',
    ], 'public/css/stisla.css')
    .scripts([
        'public/stisla-assets/js/scripts.js',
        'public/stisla-assets/js/custom.js',
    ], 'public/js/stisla.js');
