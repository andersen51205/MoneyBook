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
    .css('resources/css/home.css', 'public/css')
    .css('resources/css/backstage.css', 'public/css')
    .js('resources/js/utility/FrontendValidation.js', 'public/js/utility')
    .js('resources/js/utility/SwalUtility.js', 'public/js/utility');
