var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss','resources/assets/css/app.css')
        .styles(['app.css','highlight.css','bootstrap-datetimepicker.min.css'],'public/css/app.css');


    mix.scripts(['jquery.min.js','bootstrap.min.js','highlight.min.js','moment.min.js','moment-sv.js','bootstrap-datetimepicker.min.js','lb-admin.js']);

    mix.version(["css/app.css","js/all.js"]);

    mix.copy(["node_modules/font-awesome/fonts","node_modules/bootstrap-sass/assets/fonts"], "public/build/fonts");

});
