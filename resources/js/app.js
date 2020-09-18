require('./bootstrap');

import Vue from 'vue'
import store from './store'
import VeeValiadate from 'vee-validate'
import router from './router.js'
import App from './App.vue'
import LaravelVuePagination from 'laravel-vue-tailwind-pagination'


Vue.use(VeeValiadate)
Vue.use(LaravelVuePagination)


const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
    	App,
    }
});
