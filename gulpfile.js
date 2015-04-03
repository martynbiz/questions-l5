var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    
    // phpUnit - test php
    mix.phpUnit();
    
    // less - compile LESS styles
    // styles - combine css files
    // version - ?? 
    mix.less('app.less').styles([
        'jquery.validate.css',
        'app.css'
    ], 'public/css/all.css', 'public/css').version('public/css/all.css');
    
    // coffee - combine coffee script
    // scripts - combine scripts
    mix.coffee().scripts([
        'jquery.validate.js',
        'app.js'
    ], 'public/js/all.js', 'public/js');
});
