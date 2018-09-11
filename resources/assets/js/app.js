
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import axios from 'axios';

import OfficeUIFabricVue from 'office-ui-fabric-vue';



// import css style
import 'office-ui-fabric-vue/dist/index.css';







Vue.use(OfficeUIFabricVue);
 


Vue.use(axios);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('manage-agent', require('./components/admin/manage-agent.vue'));
Vue.component('manage-order', require('./components/admin/manage-order.vue'));
Vue.component('agent-order', require('./components/agent/agent-orders.vue'));
Vue.component('agent-dashboard', require('./components/agent/agent-dashboard.vue'));

const app = new Vue({
    el: '#app'
});
