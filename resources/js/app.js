/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

//Route information for Vue Router
import Routes from '@/js/routes.js';

//component File
import App from '@/js/views/App';

Vue.use(ElementUI);

const app = new Vue({
    el: '#app',
    router:Routes,
    render: h => h(App),
});

export default app;