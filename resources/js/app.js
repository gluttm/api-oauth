require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';

Vue.component('dashboard-index', require('./views/Dashboard.vue').default);

const app = new Vue({
    el: '#app',
});
