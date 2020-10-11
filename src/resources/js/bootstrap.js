window._ = require('lodash');

window.$ = require('jquery');
window.jQuery = require('jquery');
window.tmpl = require('jquery.tmpl');
window.axios = require('axios');
window.Vue = require('vue');
window.TextArea = require('./components/TextArea.vue').default;

moment.locale('ja');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
