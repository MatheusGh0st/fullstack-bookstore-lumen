<template>
    <nav>
        <div>
            <img />
        </div>
        <ul>
            <li> Books </li>
            <li> Cart </li>
            <li> Login </li>
            <li> Register </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'App',
};
</script>

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
