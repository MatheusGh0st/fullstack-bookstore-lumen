<script>

import Navbar from "./Navbar.vue";

export default {
    name: 'App',
    components: {Navbar},
};
</script>

<template>
    <Navbar></Navbar>
    <router-view name="main"></router-view>
</template>

<style scoped>
</style>
