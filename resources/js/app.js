import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import BootstrapVue from 'bootstrap-vue'
require('./bootstrap');

// window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// Vue.component('edit-test', require('./components/test/EditTest').default);
// Vue.component('tags-bar', require('./components/TagsBar').default);
// Vue.component('tags-input', require('@voerro/vue-tagsinput').default);
// Vue.component('pass-test', require('./components/test/PassTest').default);


import Vue from 'vue';
import Vuelidate from 'vuelidate';
import VueRouter from 'vue-router';
import router from './router';
import App from './views/App';

Vue.use(Vuelidate);
Vue.use(VueRouter);

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
