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
mix.browserSync({
    proxy: 'localhost:8000', // Assurez-vous que c'est le même port que votre serveur Laravel
    open: false,
});

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [

    ])
    .css('./node_modules/bootstrap/dist/css/bootstrap.min.css','public/css')
;

