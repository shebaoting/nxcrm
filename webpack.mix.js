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
    .sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/customer_show.scss', 'public/static/css');
mix.sass('resources/sass/contract_show.scss', 'public/static/css');
mix.sass('resources/sass/opportunity_show.scss', 'public/static/css');
mix.sass('resources/sass/home.scss', 'public/static/css');
