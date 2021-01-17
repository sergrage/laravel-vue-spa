require('./bootstrap');

import Vue from 'vue';

Vue.component('post-index', require('./components/Posts/Index.vue').default);

const app = new Vue({
   el: '#app'
});
