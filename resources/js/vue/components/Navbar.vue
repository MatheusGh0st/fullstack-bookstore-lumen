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
            imgCartUrl: 'https://thecleverheart.com/wp-content/uploads/2023/10/SHOPPING-CART-light-grey-app-icon.png',
        }
    },
}
</script>

<template>
    <nav>
        <div>
            <img />
        </div>
        <ul>
            <li><router-link to="/home">Home</router-link></li>
            <li><router-link to="/cart"><img :src=imgCartUrl width="48" height="48" /></router-link></li>
        </ul>
        <ul v-show="!$store.state.isLogged">
            <li><router-link to="/login">Login</router-link></li>
            <li><router-link to="/register">Register</router-link></li>
        </ul>
    </nav>
</template>

<style scoped>
nav {
    height: 70px;
    display: flex;
    padding: 20px 36px;
    box-shadow: 0px 2.98256px 7.4564px rgba(0, 0, 0, 0.1);
}

li {
    list-style: none;
    width: 100%;
    border-bottom: 1px solid hsla(0, 0%, 100%, 0.1);
    padding: 0px 25px 20px 20px;
}

ul {
    display: flex;
    align-content: space-between;
}

.nav--logo {
    max-width: 100px;
}
</style>
