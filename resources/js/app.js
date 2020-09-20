/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');

Vue.prototype.$http = axios;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
    data() {
      return {
          alertBox: false,
          loader: true,
          checkingStatusLoader: false,
          user: {},
          termsAndCondIsDisabled: false
      }
    },
    methods: {
        userLogin() {
            console.log(JSON.stringify(this.user));
        },
        ContinueAsGuest(bookingUrl) {
            // Before continuing check status of AirSellFromRecommendation
            this.checkingStatusLoader = "Checking sell status from recommendation ...";
            try {
                axios.get(base_url+'flight/airSellFromRecommendation')
                .then(response => {
                    if (response.data.status == "OK") {
                        this.checkingStatusLoader = "OK, Proceeding ...";
                        // proceed
                        setTimeout(() => {
                            window.location.href = bookingUrl;
                        }, 3000);
                    } else {
                        // stop
                        this.checkingStatusLoader = "Error ["+response.data.messages[0].code +"] : "+ response.data.messages[0].text;
                        setTimeout(() => {
                            this.checkingStatusLoader = false;
                        }, 7000);
                    }
                });
            } catch (error) {
                this.checkingStatusLoader = false;
                console.error(error)
            }
        }
    }
});
