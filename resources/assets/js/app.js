
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue';

// router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// element ui library
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, {locale});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const PassportClients = require('./components/passport/Clients.vue');
const PassportAuthorizedClients = require('./components/passport/AuthorizedClients.vue');
const PassportPersonalAccessTokens = require('./components/passport/PersonalAccessTokens.vue');
const ExampleComponent = require("./components/ExampleComponent.vue");

// global components
Vue.component('passport-clients', PassportClients);
Vue.component('passport-authorized-clients', PassportAuthorizedClients);
Vue.component('passport-personal-access-tokens', PassportPersonalAccessTokens);

// define route
const routes = [
    { path: '/', component: ExampleComponent },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    router
}).$mount('#app');

