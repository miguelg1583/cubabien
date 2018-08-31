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
    'vue': ['Vue', 'window.Vue'],
    'moment': ['moment', 'window.moment'],
});

mix.babel([
    'resources/assets/plugins/jquery/dist/jquery.js',
    'resources/assets/plugins/bootstrap/dist/js/bootstrap.js',

    'resources/assets/plugins/fastclick/lib/fastclick.js',
    'resources/assets/plugins/nprogress/nprogress.js',

    'resources/assets/plugins/gentelella-build/js/custom.js',

    './node_modules/vue/dist/vue.js',
    './node_modules/vee-validate/dist/vee-validate.js',
    './node_modules/vee-validate/dist/locale/es.js',

    'resources/assets/plugins/datatables/datatables.net/js/jquery.dataTables.js',
    'resources/assets/plugins/datatables/datatables.net-bs/js/dataTables.bootstrap.js',
    'resources/assets/plugins/datatables/datatables.net-responsive/js/dataTables.responsive.js',
    'resources/assets/plugins/datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js',

    'resources/assets/plugins/moment/moment.js',
    'resources/assets/plugins/moment/locale/es.js',

    'resources/assets/plugins/summernote/summernote.js',
    'resources/assets/plugins/summernote/vue/summernote.js',

    'resources/assets/plugins/jQuery-Autocomplete/dist/jquery.autocomplete.js',

    'resources/assets/plugins/pnotify/dist/pnotify.js',
    'resources/assets/plugins/pnotify/dist/pnotify.buttons.js',
    'resources/assets/plugins/pnotify/dist/pnotify.nonblock.js',

    'resources/assets/js/cubabien.js'

], 'public/backend/js/cubabien.js');

mix.copy('resources/assets/plugins/datatables/Spanish.json', 'public/backend/js/Spanish.json');

mix.copyDirectory('resources/assets/plugins/font-awesome/fonts', 'public/backend/fonts');
mix.copyDirectory('resources/assets/plugins/bootstrap/fonts', 'public/backend/fonts');
mix.copyDirectory('resources/assets/plugins/summernote/font', 'public/backend/fonts');

mix.copyDirectory('resources/assets/plugins/gentelella-build/images', 'public/backend/images');

mix.styles([
    'resources/assets/plugins/bootstrap/dist/css/bootstrap.css',
    'resources/assets/plugins/font-awesome/css/font-awesome.css',
    'resources/assets/plugins/nprogress/nprogress.css',
    'resources/assets/plugins/animate.css/animate.css',

    'resources/assets/plugins/datatables/datatables.net-bs/css/dataTables.bootstrap.css',
    'resources/assets/plugins/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.css',

    'resources/assets/plugins/summernote/summernote.css',

    'resources/assets/plugins/jQuery-Autocomplete/dist/autocomplete.css',

    'resources/assets/plugins/pnotify/dist/pnotify.css',
    'resources/assets/plugins/pnotify/dist/pnotify.buttons.css',
    'resources/assets/plugins/pnotify/dist/pnotify.nonblock.css',

    'resources/assets/plugins/gentelella-build/css/custom.css',

], 'public/backend/css/cubabien.css');

//------------------------------------------------------------------ ahora lo del front de aqui para abajo

mix.babel([
    'resources/assets/plugins/jquery/dist/jquery.js',
    'resources/assets/plugins/bootstrap/dist/js/bootstrap.js',

    'resources/assets/plugins/fastclick/lib/fastclick.js',
    'resources/assets/plugins/nprogress/nprogress.js',

    'resources/assets/plugins/gentelella-build/js/custom.js',

    './node_modules/vue/dist/vue.js',
    './node_modules/vee-validate/dist/vee-validate.js',
    './node_modules/vee-validate/dist/locale/es.js',

    'resources/assets/plugins/datatables/datatables.net/js/jquery.dataTables.js',
    'resources/assets/plugins/datatables/datatables.net-bs/js/dataTables.bootstrap.js',
    'resources/assets/plugins/datatables/datatables.net-responsive/js/dataTables.responsive.js',
    'resources/assets/plugins/datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js',

    'resources/assets/plugins/moment/moment.js',
    'resources/assets/plugins/moment/locale/es.js',

    'resources/assets/plugins/summernote/summernote.js',
    'resources/assets/plugins/summernote/vue/summernote.js',

    'resources/assets/plugins/jQuery-Autocomplete/dist/jquery.autocomplete.js',

    'resources/assets/plugins/pnotify/dist/pnotify.js',
    'resources/assets/plugins/pnotify/dist/pnotify.buttons.js',
    'resources/assets/plugins/pnotify/dist/pnotify.nonblock.js',

    'resources/assets/js/cubabien.js'

], 'public/frontend/js/cubabien.js');