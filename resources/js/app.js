require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from './components/App.vue';
import PostsIndex from './components/Posts/Index.vue';
import PostsCreate from './components/Posts/Create.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: PostsIndex
        },
        {
            path: '/create',
            component: PostsCreate
        },
    ]
})

Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    components: {App},
    router
});
