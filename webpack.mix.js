let mix = require('laravel-mix');
const del = require('del');
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

mix.options({
   processCssUrls: false,
});

mix.js('Modules/System/Resources/assets/javascripts/compile.js', 'Modules/System/Resources/assets/javascripts/compile.min.js')
   .combine([
      'Modules/System/Resources/assets/vendor/modernizr/modernizr.min.js',
      'Modules/System/Resources/assets/javascripts/compile.min.js',
      'Modules/System/Resources/assets/vendor/chosen/chosen.jquery.min.js',
      'Modules/System/Resources/assets/vendor/pnotify/pnotify.custom.js',
      'Modules/System/Resources/assets/javascripts/theme.custom.js',
   ], 'public/backend/default/javascripts/main.js');

mix.combine(['Modules/System/Resources/assets/javascripts/theme.js', 'Modules/System/Resources/assets/javascripts/theme.init.js'],'public/backend/default/javascripts/script.js');   

mix.combine([
   'Modules/System/Resources/assets/vendor/trumbowyg/trumbowyg.min.js', 
   'Modules/System/Resources/assets/vendor/trumbowyg/trumbowyg.resizimg.min.js',
   'Modules/System/Resources/assets/vendor/trumbowyg/trumbowyg.upload.min.js',
   'Modules/System/Resources/assets/vendor/flatpickr/flatpickr.min.js',
   'Modules/System/Resources/assets/vendor/mask/cleave.min.js',
   'Modules/System/Resources/assets/vendor/jquery-datatables/media/js/jquery.dataTables.min.js',
],'public/backend/default/javascripts/pjax.js');   

mix.sass('Modules/System/Resources/assets/stylesheets/theme.scss', 'public/backend/default/stylesheets/theme.css');

