import Vue from 'vue'
import Router from 'vue-router'
import store from '@/store'

Vue.use(Router)

const Login = () => import('@/views/Login');
const About = () => import('@/views/About');
const Dash = () => import('@/views/Dash');
const Notfound = () => import('@/views/404');
const Userdetail = () => import('@/views/Userdetail');


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
