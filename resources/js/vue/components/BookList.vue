<script>
import BookListItem from "./BookListItem.vue";

export default {
    name: "Book",
    components: {BookListItem}
}
</script>

<template>
    <div class="book-container">
        <BookListItem></BookListItem>
    </div>
</template>

<style scoped>
.book-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(5, 1fr);
    grid-column-gap: 5px;
    grid-row-gap: 100px;
    place-items: center;
}
</style>
