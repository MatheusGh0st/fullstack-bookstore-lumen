import { createApp } from 'vue';
import App from './vue/components/App.vue';
import Register from './vue/components/Register.vue';
import Login from './vue/components/Login.vue';
import Home from './vue/components/Home.vue';
import './index.css';
import { createRouter, createWebHistory } from "vue-router";
import store from "./vue/store/index";
import BookList from './vue/components/BookList.vue';
import BookDetails from './vue/components/BookDetails.vue';
import CartItem from './vue/components/CartItem.vue';
import Me from './vue/components/Me.vue';
import Favorite from './vue/components/Favorite.vue';

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
            path: '/book/:id',
            name: 'BookDetails',
            components: {
                main: BookDetails
            }
        },
        {
            path: '/books/:genre',
            name: 'Books',
            components: {
                main: BookList
            }
        },
        {
            path: '/cart',
            name: 'CartItem',
            components: {
                main: CartItem
            }
        },
        {
            path: '/me',
            name: 'Me',
            components: {
                main: Me
            }
        },
        {
            path: '/favorites',
            name: 'Favorites',
            components: {
                main: Favorite
            }
        },
    ]
});

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('App', App);
    app.use(router);
    app.use(store);
    app.mount('#app');
});
