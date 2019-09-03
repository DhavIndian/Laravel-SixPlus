import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import router from './router/'
import store from './store'
import Toasted from 'vue-toasted';
import mixin from '@/mixins'

Vue.use(VueRouter)
Vue.mixin(mixin)
Vue.use(Toasted, {
    "duration": 1000,
    "position": 'bottom-right',
    "theme": 'toasted-primary',
    "type": 'success'
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
