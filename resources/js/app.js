import { createApp } from 'vue';
import Navbar from './vue/components/Navbar.vue';
import './index.css';

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('Navbar', Navbar);
    app.mount('#app');
});
