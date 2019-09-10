import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        username: localStorage.getItem('username'),
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, data) {
            state.status = 'success'
            state.username = data.email
            state.token = data.token
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = '';
            state.token = '';
            state.activeTab = '';
            state.activeSubTab = '';
        },

    },
    actions: {
        login({ commit }, form) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({ url: './api/login', data: form, method: 'POST' })
                    .then(resp => {

                        if (resp.data.status == 200) {
                            axios.defaults.headers.common['Authorization'] = resp.data.data.token;
                            localStorage.setItem('token', resp.data.data.token);
                            localStorage.setItem('username', resp.data.data.email);
                            commit('auth_success', resp.data.data)
                            
                        } else {
                            // Vue.toasted.error("Username Password Not Match");
                        }
                        resolve(resp)

                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                localStorage.clear();
                delete axios.defaults.headers.common['Authorization'];
                commit('logout')
                resolve()
            })
        },
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    }
})
