const mix = require('laravel-mix');
require('laravel-vue-i18n/mix');

mix.js('resources/js/app.js', 'public/js').vue()
  .i18n();
