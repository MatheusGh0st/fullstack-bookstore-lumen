<script>
    export default {
        name: "Footer",
    }
</script>

<template>
    <footer>
        <p>Author: Boook Store<br>
        <a href="mailto:bookstore@store.com">boookstore@store.com</a></p>
    </footer>
</template>

<style scoped>
footer {
    text-align: center;
    height: 90px;
    padding-top: 5px;
    box-shadow: 0 -3px 10px 3px rgba(0, 0, 0, 0.2);
    background-color: #1b1c1f;
    color: white;
}

a {
    color: white;
    text-decoration: none;
}
</style>
