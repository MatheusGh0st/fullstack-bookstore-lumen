<script>
    import axios from "axios";
    import { ref, watch } from "vue";
    import { useStore } from "vuex";

    export default {
        name: "Navbar",
        computed: {
            isLogged() {
                return this.$store.state.isLogged;
            }
        },
        data() {
            return {
                imgFavBookUrl: '/images/bx_bx-book-heart.svg',
                imgNotificationUrl: 'images/ic_round-notifications-none.svg',
                imgAvatarUrl: '/images/avatar.svg',
                iconBookStoreUrl: '/images/online-bookstore.jpeg',
                imgCartUrl: '/images/cart-default.jpeg',
            }
        },
        setup() {
            const inputBooks = ref('');
            const store = useStore();
            const books = ref([]);

            const setNavQuery = async (query) => {
                await store.dispatch('setQuery', { query: query });
            };

            watch(inputBooks, (newVal, oldVal) => {
                setNavQuery(newVal);
            });

            return {
                inputBooks,
            }
        }
    }
</script>

<template>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <nav>
        <ul>
            <li><router-link to="/home"><img class="img-bookstore" :src=iconBookStoreUrl />BookStore</router-link></li>
        </ul>
        <ul>
            <li><input v-model="inputBooks" type="text" placeholder="Search..."></li>
        </ul>
        <ul class="ul-register" v-show="!$store.state.isLogged">
            <li class="li-btn-register"><router-link to="/login">Login</router-link></li>
            <li class="li-btn-register"><router-link to="/register">Register</router-link></li>
        </ul>
        <ul v-show="$store.state.isLogged">
            <li><router-link to="/notifications"><img :src=imgNotificationUrl /></router-link></li>
            <li><router-link to="/favorites"><img :src=imgFavBookUrl /></router-link></li>
            <li><router-link to="/cart"><img :src=imgCartUrl  /></router-link></li>
            <li><router-link to="me"><img :src=imgAvatarUrl /></router-link></li>
        </ul>
    </nav>
</template>

<style scoped>
* {
    font-family: 'Ubuntu';
}

nav {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    align-content: center;
    height: 75px;
    padding: 0px 20px 0px 20px;
    background-color: #292828;
}

.li-btn-register {
    background-color: #B6B6B6;
    color: #EAEAEA;
    padding: 12px 20px;
    margin-left: 15px;
    border-radius: 5px;
}

.li-btn-register:hover {
    cursor: pointer;
    background-color: #d3cdcd;
}

input {
    width: 500px;
    height: 30px;
    background: #373737 url("/images/search-outline.svg") no-repeat 10px center;
    margin: 10px;
    padding: 10px 35px;
    background-size: 20px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    color: #808080;
}

.ul-register > li {
    font-weight: bold;
}

input:focus {
    outline: none;
}

img {
    height: 36px;
    width: 36px;
}

.img-bookstore {
    height: 64px;
    width: 64px;
    background: #B6B6B6;
}

.img-bookstore:hover {
    cursor: pointer;
    background-color: #d3cdcd;
}

a, a:active, a:hover {
    color: white;
    text-decoration: none;
}

li {
    list-style: none;
    width: 100%;
    border-bottom: 1px solid hsla(0, 0%, 100%, 0.1);
    padding: 0px 20px 0px 20px;
}

ul {
    display: flex;
    align-content: space-between;
    margin: 0px;
}
</style>
