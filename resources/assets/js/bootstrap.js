window._ = require('lodash');
window.Popper = require('@popperjs/core/dist/umd/popper-base.min');
try
{
    window.$ = window.jQuery = require('jquery/dist/jquery');

    require('bootstrap');

    require('jquery-ui-dist/jquery-ui.min');

} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}