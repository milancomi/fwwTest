const mix = require('laravel-mix');
const { stubString } = require('lodash');
const $ = require( "jquery" );

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

mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles(['resources/fullcalendar/packages/core/main.css',
                'resources/fullcalendar/packages/daygrid/main.css',
                'resources/fullcalendar/packages/timegrid/main.css',
                'resources/fullcalendar/packages/list/main.css'
            ],'public/css/CalendarStyle.css');



            // mix.js([
            //     'resources/fullcalendar/packages/core/main.js',
            //     'resources/fullcalendar/packages/interaction/main.js',
            //     'resources/fullcalendar/packages/daygrid/main.js',
            // ],'public/js/CalendarScript')

