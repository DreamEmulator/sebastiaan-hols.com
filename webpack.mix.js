let mix = require('laravel-mix');

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
mix.babel([
    'resources/assets/js/popmotion/keepy_uppy.js'
], 'public/js/popmotion/keepy_uppy.js').version();

mix.js('resources/assets/js/navbar.js', 'public/js/').version();
mix.js('resources/assets/js/extra.js', 'public/js/').version();
mix.js('resources/assets/js/app.js', 'public/js/').version();
mix.sass('resources/assets/sass/light_dream.scss', 'public/css').sass('resources/assets/sass/dark_dream.scss', 'public/css');