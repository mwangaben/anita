let mix = require('laravel-mix').mix;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"],
        'popper.js/dist/umd/popper.js': ['Popper']
    })
   .js('resources/assets/js/app.js', 'public/js')
   .version()
   .styles(['resources/assets/css/agency.css', 'resources/assets/css/custom.css'], 'public/css/agency.css')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .version();