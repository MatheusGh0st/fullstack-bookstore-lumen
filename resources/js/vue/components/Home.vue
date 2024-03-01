<script>
import BookList from "./BookList.vue";

export default {
    name: "Home",
    components: { BookList }
}
</script>

<template>
    <div class="home-container">
        <BookList></BookList>
    </div>
</template>

<style scoped>
.home-container {
}
</style>
