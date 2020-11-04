window.$ = window.jQuery = require('jquery/dist/jquery');
require('bootstrap');
require('select2');
window.Vue = require('vue/dist/vue.esm').default;
require('./components/search')
require('./components/formInsurance');
require('./components/fixedMenu');
require('./components/slide');

$('select').select2({
    theme: 'bootstrap4',
});