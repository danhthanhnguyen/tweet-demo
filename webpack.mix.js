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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/follow.js', 'public/js')
    .js('resources/js/like.js', 'public/js')
    .js('resources/js/update.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js')
mix.postCss('resources/css/auth/auth.css', 'public/css/auth', [
        //
    ])
    .postCss('resources/css/layout/home.css', 'public/css/layout', [
        //
    ]);
