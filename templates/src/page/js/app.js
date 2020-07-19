window.$ = window.jQuery = require('jquery/dist/jquery');
require('bootstrap');
require('select2');
window.Vue = require('vue/dist/vue.esm').default;
require('./components/search')

$('select').select2({
    width: '100%',
    theme: 'bootstrap4',
});