
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import App from './App.vue';

const VUE_URL_PREFIX = '/sdmksip';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/component1.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);

const routes = [
    { path: VUE_URL_PREFIX+'/' ,  name: 'home', component: require('./components/component1.vue').default },
    { path: VUE_URL_PREFIX+'/component1' , name: 'comp1',  component: require('./components/component1.vue').default },
    { path: VUE_URL_PREFIX+'/component2' , name: 'comp2',  component: require('./components/component2.vue').default },
    { path: VUE_URL_PREFIX+'/component3' , name: 'comp3',  component: require('./components/component3.vue').default },
];

const router = new VueRouter({
    routes: routes,
    mode: "history",
})

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App),
});