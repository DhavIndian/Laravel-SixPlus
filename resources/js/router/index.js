import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Login from '@/views/Login'
import Dash from '@/views/Dash'
import About from '@/views/About'
import Notfound from '@/views/404'
import Userdetail from '@/views/Userdetail'
import store from '@/store'

const ifNotAuthenticated = (to, from, next) => {
    if (store.getters.isLoggedIn) {
        next('about');
    } else {
        next();
    }

}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.isLoggedIn) {
        next();
    } else {
        next('login');
    }

}

export default new Router({
    mode: 'history',
    routes: [{
            path: '/404',
            name: '404',
            component: Notfound,
        },
        {
            path: '/dash',
            name: 'dash',
            component: Dash,
            beforeEnter: ifAuthenticated,
        },
        {
            path: '/userdetail',
            name: 'userdetail',
            component: Userdetail,
            beforeEnter: ifAuthenticated,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            beforeEnter: ifAuthenticated,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: ifNotAuthenticated,
        },
        {
            path: '/',
            name: 'index',
            component: Login,
            beforeEnter: ifNotAuthenticated,
        },
        {
            path: '*',
            redirect: '/404'
        },
        {
            path: '/logout',
            redirect: '/login'
        }
    ],
})
