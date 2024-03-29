const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/users.js', 'public/js')
    .js('resources/js/page.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/page.scss', 'public/css')

    .options({ processCssUrls: false })
    .version();

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');