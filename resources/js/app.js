import { createApp } from 'vue';
import App from './vue/components/App.vue';
import Register from './vue/components/Register.vue';
import Login from './vue/components/Login.vue';
import Home from './vue/components/Home.vue';
import './index.css';
import { createRouter, createWebHistory } from "vue-router";
import store from "./vue/store/index";
import BookList from './vue/components/BookList.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'App',
            component: App
        },
        {
            path: '/login',
            name: 'Login',
            components: {
                main: Login
            }
        },
        {
            path: '/register',
            name: 'Register',
            components: {
                main: Register
            }
        },
        {
            path: '/home',
            name: 'Home',
            components: {
                main: Home
            }
        },
        {
            path: '/books/:genre',
            name: 'Books',
            components: {
                main: BookList
            }
        }
    ]
});

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('App', App);
    app.use(router);
    app.use(store);
    app.mount('#app');
});
