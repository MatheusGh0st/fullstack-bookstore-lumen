import { createApp } from 'vue';
import App from './vue/components/App.vue';
import Navbar from './vue/components/Navbar.vue';
import Register from './vue/components/Register.vue';
import './index.css';

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('App', App);
    app.component('Navbar', Navbar);
    app.component('Register', Register);
    app.mount('#app');
});
