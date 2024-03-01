import { createApp } from 'vue';
import App from './vue/components/App.vue';
import Navbar from './vue/components/Navbar.vue';
import Register from './vue/components/Register.vue';
import Login from './vue/components/Login.vue';
import Home from './vue/components/Home.vue';
import './index.css';
import { createRouter, createWebHistory } from "vue-router";
import store from "./vue/store/index";

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
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/home',
            name: 'Home',
            component: Home
        }
    ]
});

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('App', App);
    app.component('Navbar', Navbar);
    app.component('Register', Register);
    app.use(router);
    app.use(store);
    app.mount('#app');
});
