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
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/admin-lte/dist/img', 'public/dist/img')
    .copy('node_modules/admin-lte/dist/css', 'public/dist/css')
    .copy('node_modules/admin-lte/dist/js', 'public/dist/js')
    .copy('node_modules/admin-lte/plugins/fontawesome-free/css', 'public/plugins/fontawesome-free/css')
    .copy('node_modules/admin-lte/plugins/jquery', 'public/plugins/jquery')
    .copy('node_modules/admin-lte/plugins/bootstrap/js', 'public/plugins/bootstrap/js')
    .copy('node_modules/admin-lte/plugins/chart.js', 'public/plugins/chart.js')
    .copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce')
    .purgeCss();
