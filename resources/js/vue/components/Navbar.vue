<script>
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
            iconBookStoreUrl: '/images/icon-bookstore.jpeg',
            imgCartUrl: '/images/cart-default.jpeg',
        }
    },
}
</script>

<template>
    <nav>
        <ul>
            <li><router-link to="/home"><img :src=iconBookStoreUrl /></router-link></li>
        </ul>
        <ul v-show="!$store.state.isLogged">
            <li><router-link to="/login">Login</router-link></li>
            <li><router-link to="/register">Register</router-link></li>
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
nav {
    height: 75px;
    display: flex;
    padding: 0px 20px 0px 20px;
    background-color: #292828;
    box-shadow: 0px 2.98256px 7.4564px rgba(0, 0, 0, 0.1);
}

img {
    height: 48px;
    width: 48px;
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
