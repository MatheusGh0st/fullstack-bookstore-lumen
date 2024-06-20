<script>

import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

export default {
    name: 'App',
    components: {Navbar, Footer},
    created() {
         this.$router.push('/Login');
    }
};
</script>

<template>
    <Navbar></Navbar>
    <router-view class="main-content-container" name="main"></router-view>
    <Footer></Footer>
</template>

<style scoped>
.main-content-container {
    padding-bottom: 50px;
}
</style>
