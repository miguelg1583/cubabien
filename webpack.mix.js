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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.autoload({
    'jquery': ['$', 'window.jQuery', 'jQuery'],
    'vue': ['Vue','window.Vue'],
    'moment': ['moment','window.moment'],
});

mix.babel([
    'resources/assets/plugins/jquery/dist/jquery.js',
    'resources/assets/plugins/bootstrap/dist/js/bootstrap.js',

    'resources/assets/plugins/fastclick/lib/fastclick.js',
    'resources/assets/plugins/nprogress/nprogress.js',

    'resources/assets/plugins/gentelella-build/js/custom.js',

], 'public/backend/js/cubabien.js');

mix.copyDirectory('resources/assets/plugins/font-awesome/fonts', 'public/backend/fonts');
mix.copyDirectory('resources/assets/plugins/gentelella-build/images', 'public/backend/images');

mix.styles([
    'resources/assets/plugins/bootstrap/dist/css/bootstrap.css',
    'resources/assets/plugins/font-awesome/css/font-awesome.css',
    'resources/assets/plugins/nprogress/nprogress.css',
    'resources/assets/plugins/gentelella-build/css/custom.css',

], 'public/backend/css/cubabien.css');