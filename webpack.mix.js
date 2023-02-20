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
    .styles([
        'public/css/app.css',
        'public/css/custom.css',
        'public/dist/css/adminlte.min.css',
        'public/bootstrap5/css/bootstrap.min.css',
        'public/plugins/fontawesome-free/css/all.min.css',
        'public/prism/css/prism.css'

        ], 'public/css/backend.css')
    .scripts([
        'public/plugins/jquery/jquery.min.js',
        'public/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'public/dist/js/adminlte.js',
        'public/prism/js/prism.js',
        'public/fontawesome/js/all.min.js',
        'public/js/share.js',
        ], 'public/js/backend.js')
    .styles([
        'public/assets/vendor/bootstrap/css/bootstrap.min.css',
        'public/assets/vendor/bootstrap-icons/bootstrap-icons.css',
        'public/assets/vendor/glightbox/css/glightbox.min.css',
        'public/assets/vendor/remixicon/remixicon.css',
        'public/assets/vendor/swiper/swiper-bundle.min.css',
        'public/assets/css/style.css'
        ], 'public/css/frontend.css')
    .scripts([
        'public/js/share.js',
        'public/fontawesome/js/all.min.js',
        'public/assets/vendor/purecounter/purecounter.js',
        'public/assets/vendor/aos/aos.js',
        'public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'public/assets/vendor/glightbox/js/glightbox.min.js',
        'public/assets/vendor/isotope-layout/isotope.pkgd.min.js',
        'public/assets/vendor/swiper/swiper-bundle.min.js',
        'public/assets/vendor/php-email-form/validate.js',
        'public/prism/js/prism.js'
        ], 'public/js/frontend.js');
